//
//  Former main.js (Magnetic Theme)
//

$(document).ready(function(){


    //mobile menu toggling
    $("#menu_icon").click(function(){
        $("header nav ul").toggleClass("show_menu");
        $("#menu_icon").toggleClass("close_menu");

        $("#search_icon").removeClass("close_menu");
        $(".easy-autocomplete").toggle(false);
        return false;
    });

    //mobile menu toggling
    $("#search_icon").click(function(){
        $(".easy-autocomplete").toggle(); //Search bar
        $("header nav ul").toggleClass("show_menu");
        $("#search_icon").toggleClass("close_menu");

        $("header nav ul").removeClass("show_menu");
        $("#menu_icon").removeClass("close_menu");

        $("#buscador_serie").focus();
        return false;
    });

    //Depending on window size initial show/hide search bar
    if ( $(".easy-autocomplete").css("max-width") === "100000px") {
        $(".easy-autocomplete").toggle(true);
    }else {
        $(".easy-autocomplete").toggle(false);
    } 

    $(window).resize(function(){
        //HandCrafter mediaquery trigger
        if ( $(".easy-autocomplete").css("max-width") === "100000px") {

           $("#menu_icon").removeClass("close_menu");
           $("#search_icon").removeClass("close_menu");
           $("header nav ul").removeClass("show_menu");
           $(".easy-autocomplete").toggle(true);
        }
        else
        {
          if(!$("#search_icon").hasClass("close_menu"))
            $(".easy-autocomplete").toggle(false);
        }
    });
});