(function () {
    'use strict';

    const config = window.GOOGLE_REVIEWS_CONFIG || {};
    const track = document.querySelector('#google-reviews-track');
    const dots = document.querySelector('#google-reviews-dots');
    const summary = document.querySelector('#google-review-summary');
    const summaryStars = document.querySelector('#review-summary-stars');
    const summaryCopy = document.querySelector('#review-summary-copy');

    if (!track || !dots || !summaryCopy) {
        return;
    }

    function starText(rating) {
        const rounded = Math.max(0, Math.min(5, Math.round(Number(rating) || 0)));
        return '★'.repeat(rounded) + '☆'.repeat(5 - rounded);
    }

    function setLink(element, url) {
        if (!url) {
            return;
        }

        element.href = url;
        element.target = '_blank';
        element.rel = 'noopener noreferrer';
    }

    function makeReviewCard(review) {
        const card = document.createElement('article');
        const header = document.createElement('div');
        const authorBlock = document.createElement('div');
        const author = document.createElement('a');
        const date = document.createElement('p');
        const stars = document.createElement('div');
        const body = document.createElement('p');
        const source = document.createElement('a');
        const attribution = review.authorAttribution || {};
        const authorName = attribution.displayName || 'Google user';

        card.className = 'panel-card review-card';
        header.className = 'review-card-header';
        author.className = 'review-author';
        date.className = 'review-date';
        stars.className = 'review-stars';
        body.className = 'review-text';
        source.className = 'review-source';

        if (attribution.photoURI) {
            const avatar = document.createElement('img');
            avatar.className = 'review-avatar';
            avatar.src = attribution.photoURI;
            avatar.alt = '';
            avatar.referrerPolicy = 'no-referrer';
            header.appendChild(avatar);
        } else {
            const avatar = document.createElement('span');
            avatar.className = 'review-avatar';
            avatar.textContent = authorName.charAt(0).toUpperCase();
            avatar.setAttribute('aria-hidden', 'true');
            header.appendChild(avatar);
        }

        author.textContent = authorName;
        setLink(author, attribution.uri);
        date.textContent = review.relativePublishTimeDescription || '';
        stars.textContent = starText(review.rating);
        stars.setAttribute('aria-label', (review.rating || 0) + ' out of 5 stars');
        body.textContent = review.text || 'This customer left a star rating on Google.';
        source.textContent = 'Read on Google Maps →';
        setLink(source, review.googleMapsURI || attribution.uri);

        authorBlock.append(author, date);
        header.appendChild(authorBlock);
        card.append(header, stars, body, source);
        return card;
    }

    function setPage(pageNumber) {
        track.style.setProperty('--comments-page', String(pageNumber));
        dots.querySelectorAll('.comment-dot').forEach(function (dot, index) {
            dot.classList.toggle('active', index === pageNumber);
        });
    }

    function renderReviews(reviews) {
        track.replaceChildren();
        dots.replaceChildren();

        for (let pageStart = 0; pageStart < reviews.length; pageStart += 3) {
            const page = document.createElement('div');
            page.className = 'comments-page';

            reviews.slice(pageStart, pageStart + 3).forEach(function (review) {
                page.appendChild(makeReviewCard(review));
            });

            track.appendChild(page);
        }

        const pageCount = Math.ceil(reviews.length / 3);
        for (let index = 0; index < pageCount; index += 1) {
            const dot = document.createElement('button');
            dot.className = 'dot comment-dot' + (index === 0 ? ' active' : '');
            dot.type = 'button';
            dot.setAttribute('aria-label', 'Show Google review page ' + (index + 1));
            dot.addEventListener('click', function () {
                setPage(index);
            });
            dots.appendChild(dot);
        }

        setPage(0);
    }

    function showUnavailable(message) {
        const page = document.createElement('div');
        const card = document.createElement('article');
        const heading = document.createElement('p');
        const copy = document.createElement('p');
        const link = document.createElement('a');

        page.className = 'comments-page';
        card.className = 'panel-card review-card review-empty';
        heading.className = 'review-author';
        copy.className = 'review-text';
        link.className = 'review-source';
        heading.textContent = 'See what customers say';
        copy.textContent = message;
        link.textContent = 'Open Google Maps →';
        setLink(link, summary.href);
        card.append(heading, copy, link);
        page.appendChild(card);
        track.replaceChildren(page);
        dots.replaceChildren();
    }

    async function findPlace(Place) {
        if (config.placeId) {
            return new Place({ id: config.placeId });
        }

        const response = await Place.searchByText({
            textQuery: config.placeQuery,
            fields: ['id'],
            maxResultCount: 1
        });

        if (!response.places || !response.places.length) {
            throw new Error('Google could not find the configured business.');
        }

        return response.places[0];
    }

    window.initGoogleReviews = async function () {
        try {
            const library = await google.maps.importLibrary('places');
            const place = await findPlace(library.Place);

            await place.fetchFields({
                fields: ['displayName', 'googleMapsURI', 'rating', 'reviews', 'userRatingCount']
            });

            setLink(summary, place.googleMapsURI);
            summaryStars.textContent = starText(place.rating);
            summaryCopy.textContent = place.rating
                ? Number(place.rating).toFixed(1) + ' from ' + (place.userRatingCount || 0).toLocaleString() + ' Google reviews'
                : 'Customer reviews on Google';

            if (!place.reviews || !place.reviews.length) {
                showUnavailable('No written Google reviews are available right now.');
                return;
            }

            renderReviews(place.reviews);
        } catch (error) {
            console.error('Google reviews could not be loaded:', error);
            showUnavailable('Google reviews are temporarily unavailable.');
        }
    };

    if (!config.apiKey || config.apiKey.indexOf('PASTE_') === 0) {
        showUnavailable('Add the Google Maps API key in google-reviews-config.js to display live reviews here.');
        return;
    }

    const apiScript = document.createElement('script');
    apiScript.src = 'https://maps.googleapis.com/maps/api/js?key=' + encodeURIComponent(config.apiKey) + '&loading=async&callback=initGoogleReviews&v=weekly';
    apiScript.async = true;
    apiScript.defer = true;
    apiScript.onerror = function () {
        showUnavailable('Google reviews are temporarily unavailable.');
    };
    document.head.appendChild(apiScript);
}());
