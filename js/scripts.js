jQuery(document).ready(function($) {

    var win_height_func = function() {
        if ($('body').hasClass('admin-bar')) {
            var admin_bar_height = $('#wpadminbar').height();
            var win_height = $(window).height() - admin_bar_height;
        } else {
            var win_height = $(window).height();
        }
        $('.win_height').css('height', win_height);
    }

    $(window).on("load resize",function(e){
        win_height_func();
    });

});