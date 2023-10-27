(function ($) {
    // loading after

    $( document ).ready(function() {
        history();
    });

    function history() {
        var id = $(".id_single").val();
        let historyArr = Cookie.get("HISTORY") ? JSON.parse(Cookie.get("HISTORY")) : [];
        var date = Date.now();
        const findId = historyArr.findIndex(item =>
            item.id === id
        );
        if (findId > -1) {
            historyArr[findId] = {id, date};
        }
        else {
            historyArr = [...historyArr, {id, date}];
        }
        Cookie.set("HISTORY", JSON.stringify(historyArr), 30);
    }
})(jQuery);
const Cookie = {
    set: (cname, cvalue, exdays) => {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    },
    get: (cname) => {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
};