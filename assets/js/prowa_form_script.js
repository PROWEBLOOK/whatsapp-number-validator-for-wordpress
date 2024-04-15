(function($) {
    "use strict";
    var app = {
        el: '',
        msgContainer: false,
        validPhones: [],

        submit: function() {
            var self = this;
            $(self.el).trigger('submit');
        },

        request: function(phone) {
            alert("ajacx call");
            if (!$('body').hasClass('prowa-loading')) {
                var self = this;

                $('body').addClass('prowa-loading');

                var inputs = $(self.el).find('.prowa-phone');
                _.each($(inputs), function(el, key) {
                    if ($(el).val() == phone) {
                        $(el).addClass('prowa-loading-phone');
                    }
                });

                if (phone.length > 1) {
                    alert("ajacx call");
                    $.ajax({
                        url: prowa.AJAX_URL,
                        type: 'POST',
                        cache: false,
                        crossDomain: true,
                        data: {
                            'action': 'wappy-verify-phone',
                            'prow-nonce': prowa.nonce,
                            'number': phone
                        },
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            $('body').removeClass('prowa-loading');
                            var inputs = $(self.el).find('.prowa-phone');
                            _.each($(inputs), function(el, key) {
                                if ($(el).val() == phone) {
                                    $(el).removeClass('prowa-loading-phone');
                                }
                            });

                            if (data.is_valid != false) {
                                self.validPhones.push(phone);
                                self.submit();
                            } else {
                                self.showError(phone, data.status);
                            }
                        },
                        error: function() {
                            $('body').removeClass('prowa-loading');
                        }
                    });
                } else {
                    $('body').removeClass('prowa-loading');
                    self.showError(phone, 'UNKNOWN');
                }
            }
        },
        validateForm: function(form) {
            var self = this,
                inputs = $(form).find('.prowa-phone');

            self.el = form;

            if ($(self.el).find('.wpcf7-response-output').length) {
                self.msgContainer = $(self.el).find('.wpcf7-response-output');
            } else {
                self.msgContainer = false;
            }

            var phones = [],
                inputs = $(form).find('.prowa-phone');

            _.each(inputs, function(el, key) {
                phones.push($(inputs[key]).val());
            });

            if (_.isEmpty(_.difference(phones, app.validPhones))) {
                self.submit();
            } else {
                var phone = _.difference(phones, app.validPhones);
                self.request(phone[0]);
            }


        },
        showError: function(phone, status) {
            var self = this;
            if (self.msgContainer) {
                var template = _.template(prowa.tpl);
                $(self.msgContainer).html(template({ phone: phone, status: status })).show();
            } else {
                var inputs = $(self.el).find('.prowa-phone');
                _.each($(inputs), function(el, key) {
                    if ($(el).val() == phone) {
                        var template = _.template(prowa.tpl);
                        $(el).after(template({ phone: phone, status: status }));
                    }
                });
            }
        }
    };

    $(document).ready(function() {
        if ($('form').length) {


            _.each($('form'), function(form, key) {
                if ($(form).find('.prowa-phone').length) {
                    $(form).on('submit', function() {
                        var phones = [],
                            inputs = $(form).find('.prowa-phone');

                        $(form).find('.prowa-error').remove();

                        _.each(inputs, function(el, key) {
                            phones.push($(inputs[key]).val());
                        });

                        if (_.isEmpty(_.difference(phones, app.validPhones))) {
                            $(form).removeClass(prowa.form_class);
                            return true;
                        } else {
                            app.validateForm($(form));
                        }

                        return false;
                    });
                }
            });
        }
    });
}(jQuery));