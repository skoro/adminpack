(function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
        if (this.href === path) {
            $(this)
                .addClass("active")
                .parents('div.sidebar-submenu')
                .collapse('show');
        }
    });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });

    // This adds to the submit button a spinner.
    $('form button[type="submit"]').on('click', function () {
        var p = $(this).parents('form');
        // Don't show a spinner if the form's client validation is failed.
        if (p.length > 0 && !p[0].checkValidity()) {
            return;
        }
        // Show a spinner.
        $(this)
            .prop('disabled', true)
            .prepend('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
    });

})(jQuery);
