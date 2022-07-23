$(document).ready(function() {

    $("#show-register").click(function() {
        $("#loginForm").hide();
        $("#registerForm").show();
    });

    $("#show-login").click(function() {
        $("#registerForm").hide();
        $("#loginForm").show();
    });

});