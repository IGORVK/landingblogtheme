
/*$(function () {
 $('.globe').on('click', function () {
 $('.icons').slideToggle();
 });
 });*/

/*$(function(){
    $('.anchor').on("click","a", function (event) {
        event.preventDefault();

        //up to get-in-touch
       /!* $("body").animate({"scrollTop":0},5000);*!/

        $('html, body').stop().animate({
            scrollTop: $("#anchor1").offset().top - 100
        }, 2000);

    });

});*/
$(document).ready( function(){

    $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    navText:[
        '<a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>',
        '<a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>'
    ],
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        768:{
            items:2,
            nav:true
        },
        1024:{
            items:3,
            nav:true,
        }
    }
});


    $(document).ready(function(){
        $('.anchor a').smoothScroll();
        // When to show the scroll link
        // higher number = scroll link appears further down the page
        var upperLimit = 140;

        // Our scroll link element
        var scrollElem = $('.anchor a');

        // Scroll Speed. Change the number to change the speed
        var scrollSpeed = 600;

        var scrollStyle = 'swing';

        // Show and hide the scroll to top link based on scroll position
        scrollElem.hide();
        $(window).scroll(function () {
            var scrollTop = $(document).scrollTop();
            if ( scrollTop > upperLimit ) {
                $(scrollElem).stop().fadeTo(300, 1); // fade back in
            }else{
                $(scrollElem).stop().fadeTo(300, 0); // fade out
            }
        });

        // Scroll to top animation on click
        $(scrollElem).click(function(){
            $('html, body').animate({scrollTop: $("#anchor1").offset().top - upperLimit}, scrollSpeed, scrollStyle ); return false;
        });



    });

});

$(document).ready(function(){
    $(".hider").click(function(){
        $("#hidden").slideToggle("slow");
        return false;
    });
});






