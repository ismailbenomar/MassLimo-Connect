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
