<?php

return [
    'business' => [
        'name' => 'MassLimo Connect',
        'role' => 'Independent transportation marketing and referral service',
        'area_served' => 'Massachusetts',
        'language' => 'en-US',
        'description' => 'An independent marketing and referral service connecting Massachusetts travelers with independent transportation providers.',
    ],
    'services' => [
        'logan' => [
            'route_name' => 'services.logan', 'uri' => '/services/boston-logan-airport-car-service', 'category' => 'Airport', 'home_label' => 'Boston Logan transfers', 'label' => 'Logan Airport referrals',
            'service' => 'Logan Airport car service referrals',
            'summary' => 'Discuss flight timing, terminals, luggage and pickup details with an independent provider.',
            'description' => 'Request a Logan Airport car service connection for a trip to or from Boston Logan International Airport, then discuss pickup details directly with an independent provider.',
            'seo_title' => 'Logan Airport Car Service Referrals | MassLimo Connect',
            'seo_description' => 'Request a Logan Airport car service referral and discuss Boston airport transportation, pickup timing, terminals and luggage with a provider.',
            'details' => ['Airline and flight number', 'Arrival or departure time', 'Terminal and pickup location', 'Passenger and luggage count'],
            'planning_title' => 'Prepare for Boston airport transportation.',
            'planning_copy' => [
                'A useful Boston airport transportation request starts with the flight and route. Share whether the trip is an arrival or departure, the airline and flight number, the expected terminal, the pickup or destination address and a telephone number the provider can use for day-of coordination.',
                'For a car service to Logan Airport, discuss the planned pickup time and any schedule buffer directly with the provider. For an arrival, ask the provider where communication begins after landing and what Logan Airport pickup option applies to the trip. Airport procedures and provider practices can change, so confirm the final instructions before travel.',
            ],
            'provider_questions' => ['Where will pickup occur for the applicable Logan terminal?', 'How are flight delays or early arrivals handled?', 'Which vehicle options fit the passengers and luggage?', 'What are the quote, cancellation and payment terms?'],
            'related_services' => [
                ['service' => 'corporate', 'label' => 'Corporate car service Boston referrals', 'description' => 'Discuss airport connections, meetings and executive schedules with an independent provider.'],
                ['service' => 'group', 'label' => 'Group transportation referrals', 'description' => 'Plan for additional passengers, luggage, equipment or vehicle requirements.'],
            ],
        ],
        'corporate' => [
            'route_name' => 'services.corporate', 'uri' => '/services/corporate-transportation', 'category' => 'Business', 'home_label' => 'Corporate transportation', 'label' => 'Corporate transportation',
            'service' => 'Corporate car service Boston referrals',
            'summary' => 'Plan transportation for meetings, executive schedules, client travel and business events.',
            'description' => 'Connect with an independent provider to discuss corporate car service in Boston for meetings, client travel, airport connections and executive schedules.',
            'seo_title' => 'Corporate Car Service Boston Referrals | MassLimo Connect',
            'seo_description' => 'Connect with an independent provider to discuss corporate car service in Boston, executive transportation, meetings and client travel.',
            'details' => ['Meeting or flight schedule', 'Pickup and destination addresses', 'Passenger count', 'Additional stops or return travel'],
            'planning_title' => 'Organize executive transportation in Boston.',
            'planning_copy' => [
                'An executive transportation request is easier to evaluate when the provider receives the full itinerary. Include each pickup, meeting, airport or hotel address, the passenger names or count, the required arrival times and the contact responsible for schedule changes.',
                'For recurring or multi-stop corporate travel, ask how the independent provider handles itinerary updates, traveler communication, waiting time, invoicing and receipts. MassLimo Connect introduces the request; the provider explains its own service process, confirms availability and supplies the quote and reservation terms.',
            ],
            'provider_questions' => ['Who receives itinerary changes before and during the trip?', 'How are waiting time and additional stops quoted?', 'Can the provider accommodate luggage or group requirements?', 'What documentation, cancellation and payment terms apply?'],
            'related_services' => [
                ['service' => 'logan', 'label' => 'Logan Airport car service referrals', 'description' => 'Prepare flight, terminal, pickup and luggage details for an airport conversation.'],
                ['service' => 'hourly', 'label' => 'Hourly chauffeur service referrals', 'description' => 'Ask about flexible transportation for meetings, appointments and multiple stops.'],
            ],
        ],
        'weddings' => [
            'route_name' => 'services.weddings', 'uri' => '/services/wedding-limousine-referrals', 'category' => 'Occasions', 'home_label' => 'Weddings and events', 'label' => 'Wedding transportation',
            'service' => 'Wedding limo service Massachusetts referrals',
            'summary' => 'Share venue locations, timing and passenger groups for a wedding-day transportation conversation.',
            'description' => 'Request a wedding limo service referral in Massachusetts and discuss venues, timing, wedding-party or guest transportation and vehicle needs with an independent provider.',
            'seo_title' => 'Wedding Limo Service Massachusetts Referrals',
            'seo_description' => 'Request a wedding limo service referral in Massachusetts and discuss venues, timing, guest transportation and vehicle needs with a provider.',
            'details' => ['Ceremony and reception locations', 'Transportation timeline', 'Passenger groups', 'Planned stops and departure times'],
            'planning_title' => 'Build a clear wedding transportation plan.',
            'planning_copy' => [
                'Wedding transportation in Massachusetts can involve several locations and passenger groups. Share the ceremony and reception addresses, hotel or preparation locations, photography stops, the number of people in each movement and the time each group needs to arrive.',
                'Ask the provider to explain which vehicle options may fit the plan, how waiting time is handled and who coordinates changes on the wedding day. MassLimo Connect does not assign vehicles or operate the trip; the independent provider confirms the schedule, quote, reservation and transportation arrangements directly with you.',
            ],
            'provider_questions' => ['Does the proposed vehicle fit each passenger group and its belongings?', 'How much time is allowed between locations and planned stops?', 'Who should the planner or couple contact for schedule changes?', 'What deposit, cancellation, overtime and payment terms apply?'],
            'related_services' => [
                ['service' => 'group', 'label' => 'Group transportation referrals', 'description' => 'Discuss guest groups, luggage, accessibility needs and possible vehicle options.'],
                ['service' => 'hourly', 'label' => 'Hourly chauffeur service referrals', 'description' => 'Ask about a flexible schedule for several wedding-day locations or stops.'],
            ],
        ],
        'hourly' => [
            'route_name' => 'services.hourly', 'uri' => '/services/hourly-chauffeur-service', 'category' => 'Flexible', 'home_label' => 'Hourly chauffeur', 'label' => 'Hourly chauffeur referrals',
            'service' => 'Hourly chauffeur service referrals',
            'summary' => 'Ask a provider about flexible, multi-stop transportation for a day or evening.',
            'description' => 'Ask an independent provider about hourly chauffeur transportation in Massachusetts for a flexible schedule, multiple stops, appointments or an evening itinerary.',
            'seo_title' => 'Hourly Chauffeur Service Referrals in Massachusetts',
            'seo_description' => 'Ask an independent provider about flexible hourly chauffeur transportation for appointments, events and multi-stop travel.',
            'details' => ['Requested start and end time', 'Pickup point and planned stops', 'Passenger count', 'Waiting time or schedule flexibility'],
            'planning_title' => 'Decide whether an hourly arrangement fits the itinerary.',
            'planning_copy' => [
                'Hourly transportation may be worth discussing when a trip includes several stops, uncertain departure times or a need to keep the same transportation arrangement available for a block of time. Share the expected start and end time, planned locations and the parts of the schedule that may change.',
                'The provider determines minimum time requirements, service boundaries, vehicle availability, waiting-time treatment and pricing. Compare those terms with a point-to-point arrangement before making a reservation, especially when the itinerary has long gaps or a fixed final destination.',
            ],
            'provider_questions' => ['Is there a minimum number of hours for the requested date?', 'How are extra time, mileage, waiting and itinerary changes handled?', 'Which vehicle options fit the passengers and planned stops?', 'When does the reserved time begin and end?'],
            'related_services' => [
                ['service' => 'corporate', 'label' => 'Corporate car service Boston referrals', 'description' => 'Plan meetings, client travel and executive transportation requirements.'],
                ['service' => 'weddings', 'label' => 'Wedding limo service Massachusetts referrals', 'description' => 'Discuss wedding-day locations, timing and passenger groups with a provider.'],
            ],
        ],
        'group' => [
            'route_name' => 'services.group', 'uri' => '/services/luxury-suv-group-transportation', 'category' => 'Groups', 'home_label' => 'Group transportation', 'label' => 'Group transportation',
            'service' => 'Luxury SUV and group transportation referrals',
            'summary' => 'Discuss passenger count, luggage, accessibility needs and possible vehicle options.',
            'description' => 'Connect with an independent provider to discuss Massachusetts group transportation, passenger count, luggage, accessibility, route details and possible vehicle options.',
            'seo_title' => 'Luxury SUV & Group Transportation Referrals',
            'seo_description' => 'Discuss group size, luggage, Massachusetts routes and vehicle options directly with an independent transportation provider.',
            'details' => ['Total passenger count', 'Luggage or equipment needs', 'Pickup, destination and stops', 'Accessibility or vehicle requirements'],
            'planning_title' => 'Plan around the people, luggage and route.',
            'planning_copy' => [
                'A group transportation request should describe more than the headcount. Tell the provider how many adults and children are traveling, how much luggage or equipment is expected, whether passengers arrive together and whether accessibility or child-seat questions need to be discussed.',
                'Vehicle names do not guarantee a universal seating or luggage capacity. Ask the independent provider to confirm the specific option proposed for the trip, the pickup plan for every passenger group and how multiple stops or schedule changes affect the quote.',
            ],
            'provider_questions' => ['What is the passenger and luggage capacity of the proposed vehicle?', 'Can the provider address the stated accessibility or equipment needs?', 'How will separate arrivals, pickups or multiple stops be coordinated?', 'What quote, cancellation and payment terms apply to the group?'],
            'related_services' => [
                ['service' => 'logan', 'label' => 'Logan Airport car service referrals', 'description' => 'Share flight timing, terminal and airport pickup details with a provider.'],
                ['service' => 'weddings', 'label' => 'Wedding limo service Massachusetts referrals', 'description' => 'Plan venue timing and transportation for wedding parties or guests.'],
            ],
        ],
    ],
];
