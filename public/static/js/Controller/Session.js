function Session() {
    this.getForm = function() {
        return $('#login');
    }

    this.create = function() {
        var self = this,
            $form    = self.getForm(),
            email    = $('input[type="email"]', $form),
            password = $('input[type="password"]', $form);

        if ( !email.val() || !password.val() ) {
            $('.error-message', $form).html('All inputs required');
            !email.val() ? email.parent().addClass('has-error') : email.parent().removeClass('has-error');
            !password.val() ? password.parent().addClass('has-error') : password.parent().removeClass('has-error');
            !email.val() ? email.addClass('has-error') : email.removeClass('has-error');
            !password.val() ? password.addClass('has-error') : password.removeClass('has-error');
            return false;
        }

        $('.error-message', $form).html('');

        $.postJSON('/api/v1/sessions', { 'Email': email.val(), 'Password': password.val() }, function (data) {
            $('input[name="Password"]', $form).val('');

            if ( !data.Error ) {
                window.location.href = '/';
            } else {
                var message = self.getMessageError(data.Error.Type, email.val());
                $('.form-group', $form).removeClass('has-error');
                $('input', $form).removeClass('has-error');
                for ( var field in data.Error.Fields ) {
                    $('input[name="' + field + '"]', $form).parent().addClass('has-error');
                    $('input[name="' + field + '"]', $form).addClass('has-error');
                }
                $('.error-message', $form).html( message || 'Verify highlighted fields' );
            }
        });
    }

    this.logout = function() {
        $.deleteJSON('/api/v1/sessions', {}, function (data) {
            if ( !data.error ) {
                window.location.href = '/';
            }
        });
        return false;
    }

    this.init = function() {
        // hide registraction form
        var self = this;
        $('.btn-login').hide();

        var $form = self.getForm();
        // show form and registr button

        $('input[type="email"]', $form).focus();

        $form.unbind('submit').on('submit', function (e) {
            e.preventDefault();
            self.create();
            return false;
        });
    }

    this.getMessageError = function(type, data) {
        var message = {
            'WRONG_EMAIL': 'Wrong username or password',
            'ACCESS_DENIED': 'Access denied',
            'FORMAT_ERROR': 'Incorrect format of E-mail'
        }[type];

        return message;
    }
}
