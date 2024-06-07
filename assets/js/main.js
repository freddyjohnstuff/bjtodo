jQuery(function ($) {
    window._delay = 2000;
    var checkLoginStatus = function() {
        $.ajax({
            type: "POST",
            url: window._checkLoginUrl,
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                if(!data.check) {
                    window.location = window._mainPageUrl;
                }
                setTimeout(function () {
                    checkLoginStatus();
                }, window._delay);
            }
        });
    }

    setTimeout(function (){
        if(window._runChecklogout) {
            checkLoginStatus();
        }
    }, 200)

});