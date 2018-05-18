var Cookie = {
    set: function(key, val, expiresDays) {
        // 判断是否设置了expiresDays
        if (expiresDays) {
            var date = new Date();
            date.setTime(date.getTime()+expiresDays*24*3600*1000); // 格式化时间
            var expiresDays = "expires="+date.toGMTString()+';';
        }
        else {
            var expiresDays = '';
        }
        document.cookie = key + '=' + escape(val) + ';' + expiresDays;
    },
    get: function(key) {
        var getCookie = document.cookie.replace('[ ]/g', '');
        var resArr = getCookie.split(';');
        var res;
        for (var i=0, len=resArr.length; i<len; i++) {
            var arr = resArr[i].split('=');
            if (arr[0] == key) {
                res = arr[1];
                break;
            }
        }

        return unescape(res);
    }
};

Cookie.set('username', 'zhangsan', 7);
