var $ = jQuery.noConflict();
contact_form7_transparent_captcha = {
    run: function () {
        var this_calss = this;

        setTimeout(function () {
            this_calss.inject('form.wpcf7-form');
        }, 999);
    },

    inject: function (selector) {
        var name = window.contact_form7_transparent_captcha_name;
        var url =  window.contact_form7_transparent_captcha_url;

        $(selector).append("<input style='left: -11000px; top: -300px; position: fixed;' name='"+name+"'  value='" + url + "' type='text'/>");
    }

};

$(document).ready(function () {
    contact_form7_transparent_captcha.run();
});