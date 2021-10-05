$(document).ready(function () {

    $('.input-daterange input').each(function () {
        $(this).datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true,
            changeMonth: false,
            changeYear: false,
            hideIfNoPrevNext: true,
            orientation: 'bottom',
            // startView: 'years',
            // startDate: minDate,
            // endDate: maxDate
        });
    });

    $('#type').change(function () {
        $("#customers_form").submit()
    });

    $('#status').change(function () {
        $("#txn_form").submit()
    })
});
