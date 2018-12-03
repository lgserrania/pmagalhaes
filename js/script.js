//hide or not logo
$(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 500) {
            $('.logo').fadeOut();
        } else {
            $('.logo').fadeIn();
        }
    });
});
//add e remove logo-inside
$(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 500) {
            document.getElementById("logo-inside").style.display = "block";
        }else{
            document.getElementById("logo-inside").style.display = "none";
        } 
    });
});
//menu-navigation
$("#session-1").click(function(e){
    e.preventDefault();
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#session-one").offset().top
    }, 2000);
});

$("#session-2").click(function(e){
    e.preventDefault();
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#session-two").offset().top
    }, 2000);
});
$("#session-3").click(function(e){
    e.preventDefault();
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#session-three").offset().top
    }, 2000);
});
$("#session-4").click(function(e){
    e.preventDefault();
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#session-four").offset().top
    }, 2000);
});
$("#session-5").click(function(e){
    e.preventDefault();
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#session-five").offset().top
    }, 2000);
});
$("#session-motivo").click(function(e){
    e.preventDefault();
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#box-caroulsel-home").offset().top
    }, 2000);
});
$("#session-servico").click(function(e){
    e.preventDefault();
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#box-content-servico").offset().top
    }, 2000);
});