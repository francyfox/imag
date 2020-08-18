$(function() {
    try {
        console.log('READY STADY GO');
        $('.delete').click(function(e) {
            console.log($(this));
            let $id = $(this).attr('itemid');
            let $input = $(this).parents('form').find('.get').val($id);
            console.log($(this).parents('form'));
        });
        $('select').niceSelect();

        $('.nice-select .list').click(function(e) {
            let $name = $(this).find('.option.selected').text();
            $('input[name="category"]').val($name);
            console.log($id);

        });


        $(function() {
            $('#pagination-container').pagination({
                items: 100,
                itemsOnPage: 2,
                cssStyle: 'dark-theme'
            });
        });

        $('.slick').slick({
            dots: true,
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear'
        });

    }catch (e) {
        console.log(e);
    }
});