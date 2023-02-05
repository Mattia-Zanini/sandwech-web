//$(window).on('load', function () {
$(document).ready(function () {
    var cookies = CookiesToObject(document.cookie);

    if (cookies.hasOwnProperty('userLoginData') == false) {
        window.location.replace("http://localhost/sandwech-web/login-page");
    }
    else {
        /*
        document.cookie = CreateCookie("userLoginData", {
            "userName": cookies["userLoginData"]["userName"],
            "password": cookies["userLoginData"]["password"]
        }, addDaysToDate(20));
        */
        console.log(cookies);
    }
});