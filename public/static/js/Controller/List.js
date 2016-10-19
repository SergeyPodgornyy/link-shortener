function List() {
    this.init = function() {
        var self = this;

        var body = document.body,
            html = document.documentElement;

        var height = Math.max( body.scrollHeight, body.offsetHeight,
                               html.clientHeight, html.scrollHeight, html.offsetHeight );
        $('#overlay').show();
        $('#overlay').height(height);
        $('.loader').show();

        $.getJSON('/api/v1/link', {}, function(data) {
            if (data.Status === 1) {
                var $rows = '';
                $.each(data.Links, function(key, value) {
                    $rows += ''
                        + '<div class="col-sm-12 links-row">'
                        + '    <a href="' + value.ShortLink + '" target="_blank">'
                        +           value.DomainLink
                        + '    </a>'
                        + '    Created by ' + value.CreatedBy + ' (' + value.Accessibility + ')'
                        + '    <span style="float:right"><b>Opened ' + value.Views + ' times</b></span>'
                        + '    <br>'
                        + '    Reference to '
                        + '    <a href="' + value.Origin + '" target="_blank">'
                        +           value.Origin
                        + '    </a>'
                        + '</div>';
                });
                $('.container[data-page=statistic]').html($rows);
                $('#overlay').hide();
                $('.loader').hide();
            } else {
                $('.container[data-page=statistic]')
                    .html('<h1 class="failer-action">Some Error occured. Try later...</h1>');
                $('#overlay').hide();
                $('.loader').hide();
            }
        });
    }
}
