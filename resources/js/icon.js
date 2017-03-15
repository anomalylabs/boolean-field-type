$(function () {
    // Initialize form switches
    $('[data-provides="icon-switch"]').each(function () {
        var $this = $(this);

        var onIcon = $this.data('on-icon');
        var offIcon = $this.data('off-icon');
        var state = $this.hasClass('checked');

        if (state === true) {
            $this.addClass(onIcon);
        } else {
            if (offIcon.length > 1) {
                $this.addClass(offIcon);
            } else {
                $this.addClass(onIcon).addClass('text-muted');
            }
        }

        $(this).click(function () {
            if (offIcon.length > 1) {
                $this
                    .toggleClass(onIcon)
                    .toggleClass(offIcon)
                    .toggleClass('checked');
            } else {
                $this
                    .toggleClass('text-muted')
                    .toggleClass('checked');
            }

            $.post('/streams/boolean-field_type/toggle', {
                entry: $this.data('entry'),
                field: $this.data('field'),
                stream: $this.data('stream'),
                namespace: $this.data('namespace'),
                state: $this.hasClass('checked')
            });
        });
    });
});
