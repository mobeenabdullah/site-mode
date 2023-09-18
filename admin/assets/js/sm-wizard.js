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
        const templateName = $(this).attr('data-template-name');
        $('.wizard__content').hide();
        $('.sm_customize_settings').show();
        $('.template-init-next').attr('data-template-name', templateName);
        $('.sm-customize').addClass('active');
        $('.template__name').html(templateName);
        $('.template__import').hide();
    });

    // c.   Back to Template Page
    $('.template-init-back').on('click', function() {
        $('.wizard__content').show();
        $('.sm_customize_settings').hide();
        $('.import-template').attr('data-template-name', '');
        $('.sm-customize').removeClass('active');
        $('.template__import').hide();
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
            wizard: true,
        }

        console.log(data);

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
    setupSelectAndPresets('#fonts', '.fonts-preset-box');


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


    // b.   Show selected template
    $('.start_importing').on('click', function() {
        $('.wizard__content').hide();
        $('.sm_customize_settings').hide();
        $('.template__import').show();
        $('.sm-import').addClass('active');
    });

    $('.template-back-customize').on('click', function() {
        $('.wizard__content').hide();
        $('.sm_customize_settings').show();
        $('.import-template').attr('data-template-name', '');
        $('.sm-import').removeClass('active');
        $('.template__import').hide();
    });

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


});

