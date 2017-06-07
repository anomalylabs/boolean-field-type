$(document).on('ajaxComplete ready', function () {

    setTimeout(function () {

        // Initialize form switches
        $('[data-provides="anomaly.field_type.boolean"]:not([data-initialized])').each(function () {

            $(this)
                .attr('data-initialized', '')
                .bootstrapSwitch();
        });

    }, 10);
});
