var server = document.currentScript.getAttribute('server');
var key = document.currentScript.getAttribute('wid-key');

(function () {
    var script_tag = document.createElement('script');
    script_tag.setAttribute("type", "text/javascript");
    script_tag.setAttribute("src", "https://code.jquery.com/jquery-3.6.0.min.js");
    script_tag.onload = main;
    (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);

    function main() {
        var jQuery = window.jQuery;
        jQuery(document).ready(function ($) {
            $.ajaxSetup({
                headers: {
                    'Access-Control-Allow-Origin': '*'
                }
            });
            var host = window.location.host;
            var url = 'https://' + server + '.wablas.com';
            if (server == 'local') {
                url = 'https://cors-anywhere.herokuapp.com/https://3afc-103-107-71-140.ngrok.io';
            }
            var newDiv = document.createElement("div");
            newDiv.setAttribute("id", "widget");
            document.body.appendChild(newDiv);
            $.ajax({
                url: url + '/chat-template/' + key,
                type: 'GET',
                headers: {
                    'Access-Control-Allow-Origin': 'http://127.0.0.1:8001',
                    'Access-Control-Allow-Methods': 'GET',
                    'Access-Control-Allow-Headers': 'Content-Type'
                },
                success: function (data) {
                    $('#widget').append(data);
                }
            });

        });
    }
})();
