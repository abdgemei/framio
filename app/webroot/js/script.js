$(window).load(function(){
    $('#feedContainer').masonry({
        itemSelector:   '.feedItem',
        // columnWidth:    220,
        gutter:         80,
        isOriginTop:    true,
        containerStyle: null
    });
});