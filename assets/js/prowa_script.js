(function($) {
    "use strict";
    var app = {
        elMsg: $('#prowa-message'),
        elList: $('#prowa-list'),
        show: function() {
            $(this.elMsg).show();
        },
        hide: function() {
            $(this.elMsg).hide();
        },
        empty: function() {
            $(this.elMsg).html('');

            return this.hide();
        },
        setMessage: function(text) {
            $(this.elMsg).html(text);

            return this.show();
        },
        append: function(phone, status) {
            var compiled = _.template(prowa.ul_tpl);
            $(this.elList).append(compiled({ data: { phone: phone, status: prowa[status] } }));
        },
        request: function(phone) {
            // alert("ddss");

            if (!$('body').hasClass('prowa-loading')) {
                var self = this;

                $('body').addClass('prowa-loading');

                $.ajax({
                    url: prowa['AJAX_URL'],
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
                        self.append(phone, data.status);
                    },
                    error: function() {
                        $('body').removeClass('prowa-loading');
                        self.setMessage(prowa[801]);
                    }
                });
            }
        }
    };

    $(document).ready(function() {
        $('#prowa-button-validate').on('click', function() {
            if ($('#prowa-phone').val().length) {
                app.hide();
                app.request($('#prowa-phone').val());
                console.log('code here');
            } else {
                app.setMessage(prowa[800]);
            }

            return false;
        });
    });
}(jQuery));