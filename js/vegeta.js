//
//  vegeta.js
//

$(document).ready(function(){
    // mobile menu toggling
    $("#menu_icon").click(function(){
        $("header nav ul").toggleClass("show_menu");
        $("#menu_icon").toggleClass("close_menu");
        return false;
    });

    $(window).resize(function(){
        if ( $(".easy-autocomplete").css("max-width") === "100000px") {
           $("#menu_icon").removeClass("close_menu");
           $("header nav ul").removeClass("show_menu");
           $(".easy-autocomplete").toggle(true);
        }
    });
});