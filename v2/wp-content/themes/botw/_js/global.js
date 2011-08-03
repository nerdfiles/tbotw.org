$script.ready('jquery', function() {

$(function() {

    $.fn.preload = function() {
        var imgArray = this;
        
        for ( var i = 0; i < imgArray.length; i++ ) {
            var $img = $('<img/>')[0];
            $img.src = imgArray[i];
        }

    };
    
    $([
        '/v2/wp-content/themes/botw/_img/home_page_hero.jpg',
        '/v2/wp-content/themes/botw/_img/faqs_hero.jpg',
        '/v2/wp-content/themes/botw/_img/about_us_hero.jpg',
        '/v2/wp-content/themes/botw/_img/our_new_center_hero.jpg',
        '/v2/wp-content/themes/botw/_img/partners_hero.jpg',
        '/v2/wp-content/themes/botw/_img/past_events_hero.jpg',
        '/v2/wp-content/themes/botw/_img/resources_hero.jpg',
        '/v2/wp-content/themes/botw/_img/support_donate_hero.jpg'
    ]).preload();
            
    $(".cushycms-wysiwyg").removeAttr("title");

    $("a[rel='external']").bind("click", function(e) {
        $(this).attr("target", "_blank");
    });
    
    $('body').bind('keydown.exitImmediately', function(e) {
        
        var code = (e.keyCode ? e.keyCode : e.which);
        
        if ( code == 27 ) { 
            location.href = 'http://google.com';
        }
    
    });
    
});

});