$(function() {

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