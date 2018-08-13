(function ($) {
    'use strict';

    $(document).ready(function () {
        prevent_delete_default_post();

        $("#kmcp-country").select2();

        function prevent_delete_default_post() {
            $("#post-" + my_data.default_post_id + " .submitdelete").remove();
            $("#post-" + my_data.default_post_id + " .editinline").click(function () {
                setTimeout(function () {
                    $("#edit-" + my_data.default_post_id + " .inline-edit-status").remove();
                }, 50);

            });

            if (my_data.this_post_id == my_data.default_post_id) {
                $(".submitdelete,.deletion").remove();
                $(".misc-pub-post-status").remove();
            }
        }
    });
})
(jQuery);