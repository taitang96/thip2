function callAjax(url, type, dataType, para, callback_success, callback_fail) {
    return $.ajax({
        type: type,
        url: url,
        data: para,
        async: false,
        dataType: dataType,
        success: function (data) {
            if (callback_success !== undefined && callback_success !== null)
                callback_success(data);
        },
        error: function (e) {
            console.log("ERROR: ", e);
            if (callback_fail !== undefined && callback_fail !== null)
                callback_fail(e);

        }
    });
}

function combineParams(m, a, t) {
    var url = '';
    if (isNotNull(m) && isNotNull(a)) {
        url = baseURL + '?m=' + m + '&a=' + a;
        if (isNotNull(t)) {
            url += '&t=' + t;
        }
    }
    return url;
}

function validStr(str) {
    if (str == undefined || str === 'undefined' || str == null || str == '') str = '';
    return str;
}

function isValidStr(str) {
    return !(str == undefined || str === 'undefined' || str == null || str == '');
}

/**********************************************************************************
     Format currency VND
     + VNDConvert(input) => Định dạng tiền tệ VND
     + VNDRevert(input) => Định dạng chuỗi thường
 **********************************************************************************/
var formatNumber = (function() {
    var decimalchar = '.';
    var thousandchar = ',';
    var _convertVND = function(value) {
        var strValue = value.toString();
        var returnstr = null;
        while (strValue.length > 0) {
            if (returnstr == null) returnstr = strValue.substring(Math.max(0, strValue.length - 3));
            else returnstr = strValue.substring(Math.max(0, strValue.length - 3)) + thousandchar + returnstr;
            strValue = strValue.substring(0, Math.max(0, strValue.length - 3));
        }
        return returnstr;
    }
    var _revertVND = function(inputVND) {
        inputVND = inputVND.replace(/\./g, "");
        inputVND = inputVND.replace(/\,/g, "");
        return inputVND;
    }

    // Public
    return {
        VND: _convertVND,
        VNDRevert: _revertVND
    }

})();