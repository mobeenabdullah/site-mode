/*---------------------------------------------------------
   a.  Filter by categories
---------------------------------------------------------*/

jQuery(function ($) {

    //  a.  Filter by categories
    $('.template-category-filter').on('click', function() {
        $('.template-category-filter').removeClass('active');
        $(this).addClass('active');
        const templateCategory = $(this).attr('data-template-category');
        if(templateCategory === 'all') {
            $(".template-content-wrapper").show();
        } else {
            $(".template-content-wrapper").hide();
            $(`.template-content-wrapper[data-category-name="${templateCategory}"]`).show();
        }
    });


     // b.   Show import screen
    $('.select_tempalte').on('click', function() {
        const templateName = $(this).attr('data-template-name');
        $('.wizard__content').hide();
        $('.template__import').show();
        $('.template-init-next').attr('data-template-name', templateName);
        $('.sm-import').addClass('active');
    });



    $('.template-init-back').on('click', function() {
        $('.wizard__content').show();
        $('.template__import').hide();
        $('.template-init-next').attr('data-template-name', '');
        $('.sm-import').removeClass('active');
        // $('.sm-step-2').removeClass('active');
    });



});

