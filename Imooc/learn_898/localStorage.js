// var CustomLocalStorage = {
//     set: function(key, value) {
//         var item = {
//             data: value
//         }
//         localStorage.setItem(key, JSON.stringify(item));
//     },
//     get:function(key) {
//         var val = localStorage.getItem(key);
//         if (!val) return null;
//         val = JSON.parse(val);
//         return val;
//     }
// };

var CustomLocalStorage = {
    // 添加缓存时间
    set: function(key, value, days) {
        var item={
            data:value,
            endTime: new Date().getTime() + days*24*3600*1000
        };
        localStorage.setItem(key, JSON.stringify(item));
    },
    get:function(key) {
        var val = localStorage.getItem(key);
        if (!val) return null;
        val = JSON.parse(val);
        if (new Date().getTime() > val.endTime) {
            val = null;
            localStorage.removeItem(key);
        }
        return val;
    },
    remove: function(key) {
        localStorage.removeItem(key);
        return null;
    },
    removeAll:function() {
        localStorage.clear();
        return null;
    }
};
