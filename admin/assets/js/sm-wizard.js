/*---------------------------------------------------------
   a.   Templates filter by categories
   b.   Show selected template
   c.   Back to template page
   d.   Post message to iframe
   e.   AJAX Functionality for import template
   f.   show and hide sidebar options on mobile
   g.   Reset to default options functionality
   h    On select change fonts/colors
   i.   Show/hide sidebar
---------------------------------------------------------*/

jQuery(function ($) {

    //  a.  Templates filter by categories
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

    // b.   Show selected template
    $('.select_tempalte').on('click', function() {
        const templateLabel = $(this).attr('data-template-label');
        $('.template__name').html(templateLabel);
        
        // get template name and set value to hidden field
        const templateName = $(this).attr('data-template-name');
        $('#selected-template-name').val(templateName);

        $('.wizard__content-wrapper').hide();
        $('.sm_customize_settings').show();
        $('.component__settings').show();
        $('.customize__actions').show();
        $('.sm-customize').addClass('active');
        $('.import__settings').hide();
        $('.import__actions').hide();
        $('body').addClass('remove_scroll');
        $('.wizard__templates-cards--single').removeClass('active');
        $('.wizard__templates-cards--single button span').html('select');
        $(this).parents('.wizard__templates-cards--single').addClass('active');
        $(this).children('span').html('selected');
    });

    // b.   Show selected template
    $('.start_importing').on('click', function() {
        $('.wizard__content-wrapper').hide();
        $('.component__settings').hide();
        $('.customize__actions').hide();
        $('.customize__sidebar-content').show();
        $('.import__settings').show();
        $('.import__actions').show();
        $('.sm-import').addClass('active');
        $('body').addClass('remove_scroll');
    });

    // c.   Back to Template Page
    $('.template-init-back').on('click', function() {
        $('.wizard__content-wrapper').show();
        $('.sm_customize_settings').hide();
        $('.component__settings').hide();
        $('.customize__actions').hide();
        $('.sm-customize').removeClass('active');
        $('.import__settings').hide();
        $('.import__actions').hide();
        $('body').removeClass('remove_scroll');
    });

    $('.template-back-customize').on('click', function() {
        $('.wizard__content-wrapper').hide();
        $('.sm_customize_settings').show();
        $('.component__settings').show();
        $('.customize__actions').show();
        $('.import__settings').hide();
        $('.import__actions').hide();
        $('.sm-import').removeClass('active');
        $('body').addClass('remove_scroll');
    });

    // d.   Post message to iframe
    $('#show-countdown').on('change', sendPostMessage);
    $('#show-subscribe').on('change', sendPostMessage);
    $('#show-social').on('change', sendPostMessage);
    function sendPostMessage() {
        const iframe = document.querySelector("#sm-preview-iframe");
        const showSocial = document.getElementById("show-social").checked;
        const showSubscribe = document.getElementById("show-subscribe").checked;
        const showCountdown = document.getElementById("show-countdown").checked;
        iframe.contentWindow.postMessage(
            {
                hideCountdown: !showCountdown,
                hideSubscribeBox: !showSubscribe,
                hideSocialIcons: !showSocial,
            },
            "*"
        )
    }

    // e.   AJAX Functionality for import template
    $('.import-template').on('click', function() {
        const showSocial        = document.getElementById("show-social").checked;

        const showCountdown     = document.getElementById("show-countdown").checked;
        const add_subscriber    = document.getElementById("show-subscribe-field").checked
        const nonce             = $("#template_init_field").val();
        const templateName      = $('#selected-template-name').val();
        const subscriber_email  = $('#sm-subscribe-email').val();

        if(!templateName) return;

        const data = {
            action: "ajax_site_mode_template_init",
            template: templateName,
            template_init_field: nonce,
            showSocial: showSocial,
            showCountdown: showCountdown,
            wizard: true,
        }

        if(add_subscriber && subscriber_email) {
            data.subscriber_email = subscriber_email;
        }

        $.ajax({
            url: ajaxObj.ajax_url,
            dataType: "json",
            method: "post",
            data: data,
            beforeSend: function () {
                $('#importing__popup').css('display', 'flex');
                $('.error__content').hide();
                $('.thank__you-content').hide();
            },
            success: function (res) {
                setTimeout(function () {
                    console.log(res);
                    $('#importing__popup').css('display', 'flex');
                    $('.import__content').hide();
                    $('.error__content').hide();
                    $('.thank__you-content').show();
                    $('.sm-modal-success-message').html(`Your ${res.data.template_name} page is ready. Now you can view the page or start customizing it.`)
                    $('.sm-modal-content-text .outline_btn').attr('href', res.data.page_link);
                }, 1000);
            },
            error: function (error) {
                setTimeout(function () {
                    console.log(error);
                    $('#importing__popup').css('display', 'flex');
                    $('.import__content').hide();
                    $('.thank__you-content').hide();
                    $('.error__content').show();
                }, 1000);
            },
        });
    });

    // f.   show and hide sidebar options on mobile
    const $sidebarContent = $(".sm_customize_settings-sidebar");
    const isMobile = window.innerWidth <= 768;

    if (isMobile) {
        $sidebarContent.hide();
        $('.settings__card-options').hide();
        $('.sidebar_content-header').hide();
    }

    $(".setting_dropdown").on("click", function() {
        if (isMobile) {
            $sidebarContent.toggle();
        }
    });

    $(".settings_card_heading").on("click", function() {
        if (isMobile) {
            const $options = $(this).parent().next(".settings__card-options");
            $options.toggle();
        }
    });


   // g.    Reset to default options functionality
    function handleSettingsClick() {
        const $parentOfAction = $(this).closest('.settings__card');

        if ($(this).hasClass('sm-setting-reset-components')) {
            const $checkboxes = $parentOfAction.find(".settings__card-options--field input[type='checkbox']");
            $checkboxes.prop('checked', function() {
                const checkboxValue = $(this).val();
                return checkboxValue === '1' || checkboxValue === 'true';
            });
        } else if ($(this).hasClass('setting__label')) {
            // Toggle checkbox click on labels
            const $checkbox = $(this).siblings('.settings__card-options--field').find("input[type='checkbox']");
            $checkbox.prop('checked', function(_, checked) {
                return !checked;
            });
        }
        sendPostMessage();
    }

    $('.setting__label, .sm-setting-reset-components').on('click', handleSettingsClick);

    // h.    On select change fonts/colors
    function setupSelectAndPresets(selectId, presetBoxesClass) {
        $(presetBoxesClass).hide();
        var selectedOption = $(selectId).val();
        $(presetBoxesClass + '[data-preset="' + selectedOption + '"]').show();

        $(selectId).change(function() {
            $(presetBoxesClass).hide();
            var selectedOption = $(this).val();
            $(presetBoxesClass + '[data-preset="' + selectedOption + '"]').show();
        });
    }

    setupSelectAndPresets('#color_scheme', '.color__scheme-preset-box');


    //  i.  Show/hide sidebar
    function toggleSidebar() {
        const sidebar = $(this).parent().parent().prev();

        sidebar.toggleClass('slide_right_to_left');
        sidebar.prev().toggle();

        if (sidebar.hasClass('slide_right_to_left')) {
            // sidebar.slideRight(300);
            $('.sm_full_screen').css('display', 'none');
            $('.sm_exit_full_screen').css('display', 'flex');
            console.log('if condition');
        } else {
            // sidebar.slideLeft(300);
            $('.sm_full_screen').css('display', 'flex');
            $('.sm_exit_full_screen').css('display', 'none');
            console.log('else condition');
        }

    }
    $('.sm_full_screen, .sm_exit_full_screen').on('click', toggleSidebar);




    updateSubscribeBoxDisplay();

    $('#show-subscribe-field').change(function() {
        updateSubscribeBoxDisplay();
    });

    $('.subscribe_label').click(function() {
        $('.subscribe_box').toggle();
        // Change the checkbox value
        $('#show-subscribe-field').prop('checked', function(_, checked) {
            return !checked; // Toggle the checkbox value
        });

    });


    function updateSubscribeBoxDisplay() {
        if ($('#show-subscribe-field').is(':checked')) {
            $('.subscribe_box').show();
        } else {
            $('.subscribe_box').hide();
        }
    }

    var initialText = $('.template-category-filter:first').html();
    $('.display_template_name').html(initialText);

    $('.template-category-filter').on('click', function() {
        var clickedText = $(this).html();
        $('.display_template_name').html(clickedText);
    })

    $('.sm_clearfilter').on('click', function() {
        $('.template-category-filter[data-template-category=all]').trigger('click');
    })

});

