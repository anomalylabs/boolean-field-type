$(function () {
    // Initialize form switches
    $('[data-provides="ajax-switch"]').each(function () {
        var $this = $(this);

        $this.bootstrapSwitch({
            onSwitchChange: function (e, state) {
                $.post(REQUEST_ROOT_PATH + '/admin/boolean-field_type/toggle', {
                    state: state,
                    entry: $this.data('entry'),
                    field: $this.data('field'),
                    stream: $this.data('stream'),
                    namespace: $this.data('namespace')
                });
            }
        });
    });
});
