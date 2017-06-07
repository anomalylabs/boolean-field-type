$(function () {

    // Initialize form switches
    $('[data-provides="ajax-switch"]').each(function () {
        $(this).bootstrapSwitch({
            onSwitchChange: function (e, state) {
                $.post('/admin/boolean-field_type/toggle', {
                    state: state,
                    entry: $(this).data('entry'),
                    field: $(this).data('field'),
                    stream: $(this).data('stream'),
                    namespace: $(this).data('namespace')
                });
            }
        });
    });
});
