$(function() {
    $('input[type="submit"]').click(function(e) {
        let $id = $(this).attr('itemid');
        let $input = $(this).parent().parent().parent().parent().parent().find('input[name="id"]').val($id);
        console.log($input);
    });
});