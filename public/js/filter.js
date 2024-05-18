
    document.querySelector('form:not(#sellerRequestForm)').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = e.target;
        const params = Array.from(new FormData(form), ([key, value]) =>
            value === '' || (form[key].tagName === 'SELECT' && form[key].selectedIndex === 0) ? null : `${encodeURIComponent(key)}=${encodeURIComponent(value)}`
        ).filter(Boolean).join('&');

        const originalUrl = window.location.href.split('?')[0];

        window.location.href = params ? originalUrl + '?' + params : originalUrl;
    });

