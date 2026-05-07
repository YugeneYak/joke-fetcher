(function() {
    function getDeviceInfo() {
        const ua = navigator.userAgent;
        if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) return 'tablet';
        if (/Mobile|Android|iP(hone|od)|IEMobile|BlackBerry|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(ob|in)i/.test(ua)) return 'mobile';
        return 'desktop';
    }

    function sendVisit(data) {
        const endpoint = '/api/track';
        fetch(endpoint, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        }).catch(console.error);
    }

    fetch('http://ip-api.com/json/')
        .then(response => response.json())
        .then(geo => {
            sendVisit({
                ip: geo.query,
                city: geo.city,
                device: getDeviceInfo(),
                page: window.location.href,
                referrer: document.referrer,
                timestamp: new Date().toISOString()
            });
        })
        .catch(() => {
            sendVisit({
                ip: 'unknown',
                city: 'unknown',
                device: getDeviceInfo(),
                page: window.location.href,
                referrer: document.referrer,
                timestamp: new Date().toISOString()
            });
        });
})();
