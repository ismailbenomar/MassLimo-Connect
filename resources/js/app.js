document.addEventListener('click', (event) => {
	const link = event.target.closest('[data-phone-cta]');

	if (!link) {
		return;
	}

	const payload = {
		event: 'phone_click',
		page_path: window.location.pathname,
		cta_location: link.dataset.phoneCta,
		utm_source: new URLSearchParams(window.location.search).get('utm_source'),
		utm_medium: new URLSearchParams(window.location.search).get('utm_medium'),
		utm_campaign: new URLSearchParams(window.location.search).get('utm_campaign'),
	};

	window.dispatchEvent(new CustomEvent('phone_click', { detail: payload }));
	window.dataLayer = window.dataLayer || [];
	window.dataLayer.push(payload);
});

const formErrors = document.getElementById('form-errors');

if (formErrors) {
	formErrors.focus({ preventScroll: true });
	formErrors.scrollIntoView({ block: 'start', behavior: 'instant' });
}

const reservationPlanner = document.querySelector('[data-reservation-planner]');

if (reservationPlanner) {
	const form = reservationPlanner.querySelector('[data-reservation-form]');
	const estimateButton = reservationPlanner.querySelector('[data-estimate-button]');
	const estimateButtonLabel = reservationPlanner.querySelector('[data-estimate-button-label]');
	const routeError = reservationPlanner.querySelector('[data-route-error]');
	const routeInputs = reservationPlanner.querySelectorAll('[data-route-input]');
	const estimateToken = reservationPlanner.querySelector('[data-estimate-token]');
	const submitButton = reservationPlanner.querySelector('[data-reservation-submit]');
	const details = reservationPlanner.querySelector('[data-reservation-details]');
	const mapFrame = reservationPlanner.querySelector('[data-route-map-frame]');
	const mapEmpty = reservationPlanner.querySelector('[data-map-empty]');
	const routeLine = reservationPlanner.querySelector('[data-route-line]');
	const routeSummary = reservationPlanner.querySelector('[data-route-summary]');

	const invalidateEstimate = () => {
		estimateToken.value = '';
		submitButton.disabled = true;
		details.inert = true;
		details.setAttribute('aria-disabled', 'true');
	};

	const drawRoute = (geometry) => {
		if (!Array.isArray(geometry) || geometry.length < 2) {
			routeLine.hidden = true;
			return;
		}

		const longitudes = geometry.map(([longitude]) => longitude);
		const latitudes = geometry.map(([, latitude]) => latitude);
		const longitudePadding = Math.max((Math.max(...longitudes) - Math.min(...longitudes)) * 0.18, 0.01);
		const latitudePadding = Math.max((Math.max(...latitudes) - Math.min(...latitudes)) * 0.18, 0.01);
		const west = Math.min(...longitudes) - longitudePadding;
		const east = Math.max(...longitudes) + longitudePadding;
		const south = Math.min(...latitudes) - latitudePadding;
		const north = Math.max(...latitudes) + latitudePadding;
		const points = geometry.map(([longitude, latitude]) => {
			const x = ((longitude - west) / (east - west)) * 100;
			const y = 100 - ((latitude - south) / (north - south)) * 100;

			return `${x.toFixed(2)},${y.toFixed(2)}`;
		}).join(' ');

		mapFrame.src = `https://www.openstreetmap.org/export/embed.html?bbox=${encodeURIComponent(`${west},${south},${east},${north}`)}&layer=mapnik`;
		mapFrame.hidden = false;
		mapEmpty.hidden = true;
		routeLine.querySelector('polyline').setAttribute('points', points);
		routeLine.hidden = false;
	};

	routeInputs.forEach((input) => input.addEventListener('input', invalidateEstimate));

	estimateButton.addEventListener('click', async () => {
		const pickupAddress = form.elements.pickup_address.value.trim();
		const destinationAddress = form.elements.destination_address.value.trim();

		if (!pickupAddress || !destinationAddress) {
			routeError.textContent = 'Enter both a complete pickup address and destination.';
			routeError.hidden = false;
			return;
		}

		estimateButton.disabled = true;
		estimateButtonLabel.textContent = 'Calculating route…';
		routeError.hidden = true;

		try {
			const response = await fetch(reservationPlanner.dataset.estimateUrl, {
				method: 'POST',
				headers: {
					Accept: 'application/json',
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': form.elements._token.value,
				},
				body: JSON.stringify({
					pickup_address: pickupAddress,
					destination_address: destinationAddress,
				}),
			});
			const data = await response.json();

			if (!response.ok) {
				throw new Error(data.message || 'The route could not be calculated. Check the addresses and try again.');
			}

			estimateToken.value = data.estimate_token;
			reservationPlanner.querySelector('[data-route-distance]').textContent = `${data.distance_miles.toLocaleString()} mi`;
			reservationPlanner.querySelector('[data-route-duration]').textContent = `${data.duration_minutes.toLocaleString()} min`;
			reservationPlanner.querySelector('[data-route-price]').textContent = data.estimated_price === null
				? 'Provider quote'
				: new Intl.NumberFormat('en-US', { style: 'currency', currency: data.currency }).format(data.estimated_price);
			reservationPlanner.querySelector('[data-route-disclaimer]').textContent = data.disclaimer;
			routeSummary.hidden = false;
			details.inert = false;
			details.setAttribute('aria-disabled', 'false');
			submitButton.disabled = false;
			drawRoute(data.geometry);
			details.scrollIntoView({ behavior: 'smooth', block: 'start' });
		} catch (error) {
			invalidateEstimate();
			routeError.textContent = error.message;
			routeError.hidden = false;
		} finally {
			estimateButton.disabled = false;
			estimateButtonLabel.textContent = 'Calculate mileage and time';
		}
	});
}
