$(function() {

    $(".cushycms-wysiwyg").removeAttr("title");

    $("a[rel='external']").bind("click", function(e) {
        $(this).attr("target", "_blank");
    });
    
});