/*---------------------------------------------------------
   a.   Filter by categories
   b.   Show Import Screen
   c.   Back to template page
   d.   Post message to iframe
   f.   Import template
   g.   show and hide options
   h.   Reset Functionality
   i.   change colors
   j.   Show/hide sidebar
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
        $('.template__name').html(templateName);
    });

    // c.   Back to Template Page
    $('.template-init-back').on('click', function() {
        $('.wizard__content').show();
        $('.template__import').hide();
        $('.import-template').attr('data-template-name', '');
        $('.sm-import').removeClass('active');
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

    // f.   Import template
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

    // g.   show and hide options
    const $sidebarContent = $(".template__import-sidebar");
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





   // h.    Reset Functionality
    function handleSettingsClick() {
        const $parentOfAction = $(this).closest('.settings__card');

        if ($(this).hasClass('sm-setting-reset-components')) {
            const $checkboxes = $parentOfAction.find(".settings__card-options--field input[type='checkbox']");
            $checkboxes.prop('checked', function() {
                const checkboxValue = $(this).val();
                return checkboxValue === '1' || checkboxValue === 'true';
            });
        } else if ($(this).hasClass('settings__card-options--label')) {
            // Toggle checkbox click on labels
            const $checkbox = $(this).siblings('.settings__card-options--field').find("input[type='checkbox']");
            $checkbox.prop('checked', function(_, checked) {
                return !checked;
            });
        }

        sendPostMessage();
    }

    $('.settings__card-options--label, .sm-setting-reset-components').on('click', handleSettingsClick);

    // i    change colors and fonts
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


    //  j.  Show/hide sidebar
    function toggleSidebar() {
        $('.template__import-sidebar').toggleClass('slide_right_to_left');
        $('.sm_full_screen, .sm_exit_full_screen').toggle();
    }
    $('.sm_full_screen, .sm_exit_full_screen').on('click', toggleSidebar);

});

