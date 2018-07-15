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
            xhr.open('GET', domain + '/api/page?token=' + token + '&url=' + url);
            xhr.withCredentials = true;
            xhr.send();
        }

    };

    window[_var] = new AnalytiqueGTI525(_dom, _tok);
    delete _var;
    delete _dom;
    delete _tok;

})();


