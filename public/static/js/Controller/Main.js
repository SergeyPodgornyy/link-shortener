function Main() {
    this.init = function() {
        var self = this;

        $('.switch-label').on('click', function() {
            var checkbox = $(this).attr('for');
            $('input[name=Type]').val(checkbox);
        });

        $('button.shorten').on('click', function() {
            var $btn = $(this);
            $btn.prop('disabled', true);
            $('.failer-action').hide();
            $('.result').hide();

            var body = document.body,
                html = document.documentElement;

            var height = Math.max( body.scrollHeight, body.offsetHeight,
                                   html.clientHeight, html.scrollHeight, html.offsetHeight );
            $('#overlay').show();
            $('#overlay').height(height);
            $('.loader').show();

            var params = {
                Link: $('input[name=Link]').val(),
                Type: $('input[name=Type]').val(),
            };

            $.postJSON('/api/v1/link', params, function(data) {
                if (data.Status === 1) {
                    $('.result').html(''
                        + '<h3 class="text-center">Shorten link</h3>'
                        + '<p class="success-action">'
                        + '    <a href="' + data.Data.ShortLink + '" target="_blank">'
                        +          data.Data.DomainLink
                        + '    </a>'
                        + '</p>'
                    ).show();
                } else {
                    var msg = '';
                    $.each(data.Error.Fields, function(field, error) {
                        msg += field + ' - ' + error + '<br>';
                    });
                    $('.failer-action').html(msg).slideDown();
                }
                $btn.prop('disabled', false);
                $('#overlay').hide();
                $('.loader').hide();
            });
        });
    }
}
