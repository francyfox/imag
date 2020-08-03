$(function() {
    try {
        $('select').niceSelect();
        $('input[type="submit"]').click(function(e) {
            let $id = $(this).attr('itemid');
            let $input = $(this).parents('form').find('input[name="id"]').val($id);
            console.log($input);
        });
        $('.nice-select .list').click(function(e) {
            let $name = $(this).find('.option.selected').text();
            $('input[name="category"]').val($name)
            // let $param = jQuery.param({category_id: $id});
            // window.history.replaceState({}, '', `${location.pathname}?${$param}`);
            console.log($id);

        });
    }catch (e) {
        console.log(e);
    }
});