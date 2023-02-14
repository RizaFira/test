var server = document.currentScript.getAttribute('server');
var key = document.currentScript.getAttribute('wid-key');
(function () {
    var jQuery;
    if (window.jQuery === undefined || window.jQuery.fn.jquery !== '1.4.2') {
        var script_tag = document.createElement('script');
        script_tag.setAttribute("type", "text/javascript");
        script_tag.setAttribute("src",
            "https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js");
        if (script_tag.readyState) {
            script_tag.onreadystatechange = function () { // For old versions of IE
                if (this.readyState == 'complete' || this.readyState == 'loaded') {
                    scriptLoadHandler();
                }
            };
        } else {
            script_tag.onload = scriptLoadHandler;
        }
        (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
    } else {
        jQuery = window.jQuery;
        main(); openForm(); closeForm()
    }


    function main() {
        jQuery(document).ready(function ($) {
            var url = 'https://' + server + '.wablas.com'
            if (server == 'local') {
                url = 'http://127.0.0.1:8000'
            }
            var host = window.location.host
            var newDiv = document.createElement("div");
            newDiv.setAttribute("id", "widget");
            document.body.appendChild(newDiv);
            $.get(url + '/chat-template/' + key, function (data) {
                $('#widget').append(data);
            });
        });
    }

    function scriptLoadHandler() {
        jQuery = window.jQuery.noConflict(true);
        main(); openForm(); closeForm()
    }
})();


