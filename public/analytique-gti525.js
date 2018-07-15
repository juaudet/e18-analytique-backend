(function () {

    function AnalytiqueGTI525(domain, token) {

        var domain = domain;
        var token = token;

        this.banniere = function (selector, format) {
            var xhr = new XMLHttpRequest();
            var target = document.querySelector(selector);
            if(target) {
                xhr.onreadystatechange = function () {
                    if(xhr.readyState === 4 && xhr.status === 200) {
                        target.innerHTML = xhr.responseText;
                    }
                }
                xhr.open('GET', domain + '/api/banniere?format=' + format);
                xhr.send();
            }
        }

        this.page = function (url) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', domain + '/api/page');
            // https://stackoverflow.com/q/10977058
            xhr.withCredentials = true;
            // https://stackoverflow.com/a/9713078
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('token=' + token + '&url=' + url);
        }

    };

    window[_var] = new AnalytiqueGTI525(_dom, _tok);
    delete _var;
    delete _dom;
    delete _tok;

})();


