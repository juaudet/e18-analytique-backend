(function () {

    function AnalytiqueGTI525(domain) {

        var domain = domain;

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

    };

    window[_var] = new AnalytiqueGTI525(_dom);
    delete _var;
    delete _dom;

})();


