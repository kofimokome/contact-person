(function ($) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
	 *
	 * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
	 *
	 * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

    $(document).ready(function () {
        var results = $("#kmcp-results-container");
        var tel_translate = ""; // dirty way of fixiing translation problem

        $("#kmcp-search-button").click(function (e) {
            e.preventDefault();
            results.html(' <span class="fa fa-spinner fa-pulse fa-3x"></span>');

            var data = {
                'action': 'kmcp_find_zip',
                'zip': $("#kmcp-search").val()
            };
            // We can also pass the url value separately from ajaxurl for front end AJAX implementations
            $.post(ajax_object.ajax_url, data, function (response) {
                results.html("");
                response = JSON.parse(response);
                if (response.status === 'fail') {
                    results.html("No Result found / keine Ergebnisse gefunden");
                } else {
                    tel_translate = response.tel;
                    for (var i = 0; i < response.results.length; i++) {
                        add_search_result(response.results[i]);
                    }
                }
            });
        });

        function add_search_result(result) {
            var name = result.name;
            var location = result.location;
            var address = result.address;
            var tel = result.tel;
            var email = result.email;

            // todo: do the translation with php and pass the data in the respose
            var content = '<div class="kmcp-result-title">' + address + ', ' + name +
                '            </div>' +
                '            <div class="kmcp-result-body">' +
                '                <div class="kmcp-result-information">' +
                '                    <p><b>' + name + '</b></p>' +
                '                    <p>' + location + '</p>' +
                '                    <p>' + address +
                '                    </p>' +
                '                    <p>' + tel_translate + ' : <a href="tel:' + tel + '">' + tel + '</a>' +
                '                    </p>' +
                '                    <p>' +
                '                        E-mail: <a href="mailto:' + email + '">' + email + '</a>' +
                '                    </p>' +
                '                </div>' +
                '                <div class="kmcp-result-pic">' +
                '                </div>' +
                '            </div>';

            results.append(content);
        }
    });
})(jQuery);
