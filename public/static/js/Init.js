function Init () {
    this.onloadInit = function() {
        var self = this;
        if ( self.isIE() ) {
            $.ajaxSetup({ cache: false });
        }

        $.getJSON('/api/v1/settings', function(data) {
            if (data.Status ===1 ) {
                if ( window.location.pathname ===  '/welcome' ) {
                    window.location.href = '/';
                }

                self.initUser(data.Settings);
            } else {
                if ( window.location.pathname !==  '/welcome' ) {
                    window.location.href = '/welcome';
                }

                new Session().init();
            }
        });

        $.getJSON('/api/v1/csrf_token', function (data) {
            if ( !data.error ) {
                $(document).ajaxSend( function (e, xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', data.token);
                });
                $('input[name="csrf_token"]').val(data.token);
            }
        });
    };

    this.initUser = function (user) {
        var fullname = user.FirstName + ' ' + user.LastName;

        $('.user-fullname').html( fullname );
        return;
    };

    this.isIE = function() {
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf('MSIE ') !== -1;

        return msie >= 0 ? 1 : 0;
    }
}
