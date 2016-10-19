$.postJSON = function(url, data, callback) {
    return jQuery.ajax({
        'type' : 'POST',
        'url': url,
        'data': data,
        'dataType' : 'json',
        'success' : callback
    });
};

$.deleteJSON = function(url, data, callback) {
    return jQuery.ajax({
        'type' : 'DELETE',
        'url': url,
        'data': data,
        'dataType' : 'json',
        'success' : callback
    });
};

function mixin(dst, src) {
    // tobj - вспомогательный объект для фильтрации свойств,
    // которые есть у объекта Object и его прототипа
    var tobj = {}
    for (var x in src) {
        // копируем в dst свойства src, кроме тех, которые унаследованы от Object
        if ((typeof tobj[x] == "undefined") || (tobj[x] != src[x])) {
            dst[x] = src[x];
        }
    }
    // В IE пользовательский метод toString отсутствует в for..in
    if (document.all && !document.isOpera) {
        var p = src.toString;
        if (typeof p == "function" && p != dst.toString && p != tobj.toString &&
                p != "\nfunction toString() {\n    [native code]\n}\n") {
            dst.toString = src.toString;
        }
    }
}

function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
};

function validateDateType (date) {
    var dateReg = /^\d{2}\.\d{2}\.\d{4}$/;
    return date.match(dateReg);
}

function validateDateTimeType (date) {
    var dateReg = /^\d{2}\.\d{2}\.\d{4}\,\s\d{2}\:\d{2}$/;
    return date.match(dateReg);
}

function validateEmail (val) {
    if (val.length == 0) return true;
    var reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return reg.test(val);
}

function validateUrl (url) {
    var reg = /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/;
    return reg.test(url);
}

function maxLengthCheck() {
    if (this.value.length > this.maxLength)
        this.value = this.value.slice(0, this.maxLength)
}

function toInt( v ) {
    return parseInt(v, 10) || 0;
};

function toFloat( v ) {
    return parseFloat(v, 10) || 0;
};

function toNatural( v ) {
    var n = parseInt(v, 10) || 0;
    return ( n > 0 ? n : -n );
};

function isIE() {
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf('MSIE ') !== -1;

    return msie >= 0 ? 1 : 0;
};

function objectClearKeys(obj) {
    for (var key in obj) {
        if (_.isUndefined(key) || _.isNull(key) || typeof key === undefined || key ===  'undefined')
            delete obj[key];
    }
    return obj;
};

function objectClearValues(obj) {
    for (var key in obj) {
        if (_.isUndefined(obj[key]) || _.isNull(obj[key]) || _.isEmpty({key: obj[key]}) || typeof obj[key] === undefined || obj[key] == 'undefined' || obj[key] == '')
            delete obj[key];
    }
    return obj;
};

function clearBase64(obj) {
    if (obj) {
        _.each(obj, function(val, key) {
            var reg = /^data:,$/;
            if (_.isString(val) && val !== null && val.match(reg) !== null) obj[key] = obj[key].replace(reg, '');
        });
    }
    return obj;
};

function getUrlHashParams() {
    var hash = window.location.hash;

    var vars = hash.split(';');
    var result = {};

    $(vars).each(function(num, data) {
        var name  = data.split('=')[0];
        var value = data.split('=')[1];
        if ( value ) {
            result[name] = value;
        }
    });

    return result;
};

function setUrlHashParams(params) {
    var hash = window.location.hash;

    hash = hash.split(';')[0];

    for ( var name in params ) {
        hash += ';' + name + '=' + params[name];
    }

    window.location.hash = hash;
};

function getCSRFToken() {
    return $.getJSON('/api/v1/csrf_token', function(data) {
        if ( !data.error ) {
            $(document).ajaxSend(function(e, xhr) {
                xhr.setRequestHeader('X-CSRF-Token', data.token);
            });
            $('input[name="csrf_token"]').val(data.token);
        }
    });
};

function setDataAttribute(element, attributeName, attributevalue) {
    $(element).attr('data-' + attributeName, attributevalue);
}
