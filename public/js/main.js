$(function() {
    $('input[type="submit"]').click(function(e) {
        let $id = $(this).attr('itemid');
        let $input = $(this).parents('form').find('input[name="id"]').val($id);
        console.log($input);
    });
});