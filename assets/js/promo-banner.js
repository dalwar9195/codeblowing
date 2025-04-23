jQuery(document).ready( ($) => {
    if ( sessionStorage.getItem("promoBannerClosed") === "true" ) {
        $("#promo-banner").hide();
    }

    $("#close-banner").click( () => {
        $("#promo-banner").slideUp();
        sessionStorage.setItem("promoBannerClosed", "true");
    });
});