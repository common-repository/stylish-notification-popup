jQuery(document).ready(function($) {

    jQuery(".stylishnotificationpopup-close").bind("click", function() {
        jQuery(".stylishnotificationpopup-modal div").addClass("zoomOutDown");
        setTimeout(function() {
            jQuery(".stylishnotificationpopup-modal").fadeOut("slow", function() {
                jQuery(this).css({
                    "display": "none"
                });
            })
        }, 1000);
    });

});
