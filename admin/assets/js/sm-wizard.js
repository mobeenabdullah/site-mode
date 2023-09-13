/*---------------------------------------------------------
   -    Close wizard and redirect to admin
   -    Filter by categories
   -    a.  Filter by categories
---------------------------------------------------------*/

jQuery(function ($) {

    //  Close wizard and redirect to admin
    $('.sm_close_wizard').on('click', function() {
        window.location.href = "/wp-admin/";
    })


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


});

