(function ($) {
    'use strict';

    $(document).ready(function () {
        var excludes = [];
        var chosen_countries = [];
        for (let i = 1; i < id; i++) {
            $("#kmcp-country-" + i).select2();
            $('#kmcp-country-zip-' + i).tagEditor();

            if (i > 1) {
                remove_country(i);
            }
        }

        $("#publish").click(function (e) {
            var data = '';
            var submit = true;
            e.preventDefault();

            for (var i = 1; i < id; i++) {
                if (!is_excluded(i)) {
                    if ($("#kmcp-country-" + i).val() == 0 || $('#kmcp-country-zip-' + i).val() == '') {
                        submit = false;
                        break;
                    } else {
                        data += $("#kmcp-country-" + i).val() + ":" + $('#kmcp-country-zip-' + i).val() + ";";
                    }
                }
            }

            if (submit) {
                $("#kmcp-country-zip-data").val(data);
                $(this).unbind('click').click();
            } else {
                $("#kmcp-country-warning").css("display", "block");
            }
        });

        $("#kmcp-add-country").click(function (e) {
            let my_id = id;
            e.preventDefault();
            let pass = true;
            for (let i = 1; i < id; i++) {
                if (!is_excluded(i)) {
                    if ($("#kmcp-country-" + i).val() == 0 || $('#kmcp-country-zip-' + i).val() == '') {
                        pass = false;
                        break;
                    }
                }
            }
            if (pass) {
                $("#kmcp-country-warning").css("display", "none");
                var content = '<tr class="kmcp-country-zip-' + id + '-container">' +
                    '                <td>' +
                    '                    <label for="kmcp-country-' + id + '">Country:</label>' +
                    '                </td>' +
                    '                <td>' +
                    '                    <select name="kmcp-country-' + id + '"  id="kmcp-country-' + id + '">' +
                    '                        <option value="0"> Select a country ...</option>';
                for (let i = 0; i < countries.length; i++) {
                    let next = i + 1;
                    content += '<option value="' + next + '">' + countries[i] + '</option>';
                }
                content += '</select>' +
                    '                </td>' +
                    '                <td>' +
                    '                   <button class="button button-link-delete" id="kmcp-country-delete-' + id + '">' +
                    '                       Delete' +
                    '                   </button>' +
                    '                </td>' +
                    '            </tr>' +
                    '            <tr class="kmcp-country-zip-' + id + '-container">' +
                    '                <td>' +
                    '                    <label for="kmcp-country-zip-' + id + '">ZIP Codes:</label>' +
                    '                </td>' +
                    '                <td>' +
                    '                    <input type="text" name ="kmcp-country-zip-' + id + '" id ="kmcp-country-zip-' + id + '" value="" style="width: 100%">' +
                    '                </td>' +
                    '            </tr>';

                $("#kmcp-country-container").append(content);
                $("#kmcp-country-" + id).select2();
                $('#kmcp-country-zip-' + id).tagEditor();
                remove_country(my_id);
                id++;
            } else {
                $("#kmcp-country-warning").css("display", "block");
            }
        });

        function is_excluded(id) {
            for (var i = 0; i < excludes.length; i++) {
                if (id === excludes[i]) {
                    return true;
                }
            }
            return false;
        }

        function is_country_chosen(val) {
            for (var i = 0; i < chosen_countries.length; i++) {
                if (val == chosen_countries[i]) {
                    return true;
                }
            }
            return false;
        }

        function remove_country(val){
            $("#kmcp-country-delete-" + val).click(function (e) {
                e.preventDefault();
                if (confirm("Are you sure you want to remove this country and its zip codes?")) {
                    excludes.push(val);
                    $(".kmcp-country-zip-" + val + "-container").remove();
                }

            });
        }
    });
})
(jQuery);