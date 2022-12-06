require(['jquery'], function ($) {
    $(document).on('click', '.in3-widget .tooltip-toggle', function () {
        $('.in3-tooltip').toggleClass('show');
    });
});

