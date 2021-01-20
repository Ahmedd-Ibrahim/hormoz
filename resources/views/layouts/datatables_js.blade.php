<!-- Datatables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.colVis.min.js"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script>

    (function ($, DataTable) {
        "use strict";
        DataTable.ext.buttons.create.text = function (dt) {
            return '<i class="fa fa-plus"></i> ' + dt.i18n('buttons.create', '{{ __('datatables_buttons.create') }}');
        };

        DataTable.ext.buttons.export.text = function (dt) {
            return '<i class="fa fa-download"></i> ' + dt.i18n('buttons.export', '{{ __('datatables_buttons.export') }}');
        };

        DataTable.ext.buttons.print.text = function (dt) {
            return '<i class="fa fa-print"></i> ' + dt.i18n('buttons.print', '{{ __('datatables_buttons.print') }}');
        };

        DataTable.ext.buttons.reset.text = function (dt) {
            return '<i class="fa fa-undo"></i> ' + dt.i18n('buttons.reset', '{{ __('datatables_buttons.reset') }}');
        };

        DataTable.ext.buttons.reload.text = function (dt) {
            return '<i class="fa fa-refresh"></i> ' + dt.i18n('buttons.reload', '{{ __('datatables_buttons.reload') }}');
        };

    })(jQuery, jQuery.fn.dataTable);
</script>
