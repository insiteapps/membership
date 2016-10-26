(function ($) {
    "use strict";
    /*global jQuery, document, window*/
    jQuery(document).ready(function () {
        var InsiteAppsMemberShipManagerInstance = new InsiteAppsMemberShipManager();
    });

    var InsiteAppsMemberShipManager = function () {
        var self = this;
        $.proxy(self.init, self);
        self.initBootstrapOnForms();
    };

    InsiteAppsMemberShipManager.prototype.init = function () {

    };
    InsiteAppsMemberShipManager.prototype.initBootstrapOnForms = function () {

        this.forms = $("#Form_ProfileForm,#Form_RegisterForm");
        this.forms.each(function (i, e) {
            $(this).find('*').filter(':input').not('.Actions input, .Actions button,input.radio').each(function () {
                $(this).addClass('form-control');
            });
            $(this).find('.Actions input').each(function () {
                $(this).addClass('btn btn-default');
            });
            $(this).addClass('row').find('fieldset').addClass('col-sm-6');
            $(this).find('.Actions').addClass('col-sm-12');
        });
    };

}(jQuery));

