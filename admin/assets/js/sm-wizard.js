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
        $('.import-template').attr('data-template-name', '');
        $('.sm-import').removeClass('active');
        // $('.sm-step-2').removeClass('active');
    });


    // post message to iframe
    $('#show-countdown').on('click', sendPostMessage);
    $('#show-subscribe').on('click', sendPostMessage);
    $('#show-social').on('click', sendPostMessage);
    function sendPostMessage() {
        const iframe = document.querySelector("#sm-preview-iframe");
        const showSocial = document.getElementById("show-social").checked;
        const showSubscribe = document.getElementById("show-subscribe").checked;
        const showCountdown = document.getElementById("show-countdown").checked;
        iframe.contentWindow.postMessage(
            {
                hideCountdown: showCountdown,
                hideSubscribeBox: showSubscribe,
                hideSocialIcons: showSocial,
            },
            "*"
        )
    }

    // c.   Import template

    $('.import-template').on('click', function() {
        const showSocial = document.getElementById("show-social").checked;
        const showSubscribe = document.getElementById("show-subscribe").checked;
        const showCountdown = document.getElementById("show-countdown").checked;
        const nonce = $("#template_init_field").val();
        const templateName = $(this).attr('data-template-name');

        const data = {
            action: "ajax_site_mode_template_init",
            template: templateName,
            template_init_field: nonce,
            showSocial: showSocial,
            showSubscribe: showSubscribe,
            showCountdown: showCountdown,
        }

        $.ajax({
            url: ajaxObj.ajax_url,
            dataType: "json",
            method: "post",
            data: data,
            success: function (res) {
                setTimeout(function () {
                    console.log(res);
                }, 1000);
            },
            error: function (error) {
                setTimeout(function () {
                    console.log(error);
                }, 1000);
            },
        });


    });




});

