;$(function(){
    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

    $('table input[type=checkbox]').on('ifClicked', function(e) {
        $(this).iCheck('update');
        if ($(this).attr('id') == 'checkAll') {
            if ($(this).is(':checked')) {
                $('input[type=checkbox]').iCheck('uncheck');
            } else {
                $('input[type=checkbox]').iCheck('check');
            }
        } else {
            var status = !$(this).is(':checked');
            $('table input[type=checkbox]:not(#checkAll)').each(function(i, n) {
                if ($(n).is(':checked') == false) {
                    status = false;
                    return;
                }
            });
            $('#checkAll').iCheck(status ? 'check' : 'uncheck');
        }

    });


});