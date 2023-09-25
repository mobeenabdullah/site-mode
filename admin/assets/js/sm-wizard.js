jQuery(function ($) {

    // Hide Elements
    function hideElements(elements) {
        $(elements).hide();
    }

    // Show Elements
    function showElements(elements) {
        $(elements).show();
    }

    // Add Class from Element
    function addElementClass(element, className) {
        $(element).addClass(className);
    }

    // Remove Class from Element
    function removeElementClass(element, className) {
        $(element).removeClass(className);
    }
    // Remove Attribute
    function removeElementAttribute(element, attr, attr_val) {
        $(element).removeAttr(attr, attr_val);
    }

    function categoryFilters () {
        removeElementClass('.template-category-filter', 'active');
        addElementClass($(this), 'active');
        const templateCategory = $(this).attr('data-template-category');
        if(templateCategory === 'all') {
            showElements('.template-content-wrapper');
        } else {
            hideElements(`.template-content-wrapper`);
            showElements(`.template-content-wrapper[data-category-name="${templateCategory}"]`);
        }
    }
    $('.template-category-filter').on('click', categoryFilters);

    function smClearFilters () {
        $('.template-category-filter[data-template-category=all]').trigger('click');
    }

    $('.sm_clearfilter').on('click', smClearFilters);

    // Choose page type
    function choosePageType () {
        hideElements('.wizard__start, .sm_customize_settings, .component__settings, .customize__actions, .import__settings, .import__actions');
        showElements('.wizard__content-wrapper');
        addElementClass('.sm-select-template', 'active');
    }
    $('.choose_page_type').on('click', choosePageType);

    $(".setup-coming-soon-page").on("click", function() {
        choosePageType();
        $('.template-category-filter[data-template-category=coming-soon]').trigger('click');
    });

    $(".setup-maintenance-page").on("click", function() {
        choosePageType();
        $('.template-category-filter[data-template-category=maintenance]').trigger('click');
    });

    // Back to wizard start page
    function backToWizardStart () {
        hideElements('.wizard__content-wrapper, .sm_customize_settings, .component__settings, .customize__actions, .import__settings, .import__actions');
        showElements('.wizard__start');
        removeElementClass('.sm-select-template', 'active');
        removeElementClass('.sm__wizard-wrapper', 'sm_add_scroll');
    }
    $('.back_wizard_start').on('click', backToWizardStart);

    // Go to select template page
    function selectTemplate () {
        removeElementClass('.wizard__templates-cards--single', 'active');
        $('.wizard__templates-cards--single button span').html('select');
        $(this).parents('.wizard__templates-cards--single').addClass('active');
        $(this).children('span').html('Selected');
        hideElements('.wizard__start, .wizard__content-wrapper, .component__settings, .customize__actions');
        showElements('.customize__sidebar-content, .import__settings, .import__actions, .sm_customize_settings');
        addElementClass('.sm-import', 'active');
        addElementClass('.sm__wizard-wrapper', 'sm_add_scroll');
    }
    $('.select_tempalte').on('click', selectTemplate);


    // Go to customize template page
    function customizeTemplate () {
        const templateLabel = $(this).attr('data-template-label');
        $('.template__name').html(templateLabel);
        const templateName = $(this).attr('data-template-name');
        $('#selected-template-name').val(templateName);
        hideElements('.wizard__start, .wizard__content-wrapper, .import__settings, .import__actions');
        showElements('.sm_customize_settings, .component__settings, .customize__actions');
        addElementClass('.sm-customize', 'active');
        addElementClass('.sm__wizard-wrapper', 'sm_add_scroll');
    }
    $('.select_template_btn').on('click', customizeTemplate);

    // Back to select template page
    function backToSelectTemplate () {
        console.log('working');
        hideElements('.wizard__start, .import__settings, .import__actions, .sm_customize_settings, .component__settings, .customize__actions');
        showElements('.wizard__content-wrapper');
        removeElementClass('.sm-customize', 'active');
        removeElementClass('.sm__wizard-wrapper', 'sm_add_scroll');
    }
    $('.template-init-back').on('click', backToSelectTemplate);

    // Go to import template page
    function startImportingTemplate () {
        hideElements('.wizard__start, .wizard__content-wrapper, .component__settings, .customize__actions');
        showElements('.customize__sidebar-content, .import__settings, .import__actions');
        addElementClass('.sm-import', 'active');
        addElementClass('.sm__wizard-wrapper', 'sm_add_scroll');
    }
    $('.start_importing').on('click', startImportingTemplate);

    // Back to custom template page
    function backTemplateCustomize () {
        hideElements('.wizard__start, .wizard__content-wrapper, .import__settings, .import__actions');
        showElements('.sm_customize_settings, .component__settings, .customize__actions');
        removeElementClass('.sm-import', 'active');
        addElementClass('.sm__wizard-wrapper', 'sm_add_scroll');
    }
    $('.template-back-customize').on('click', backTemplateCustomize);

    // Post message to iframe
    $('#show-countdown').on('change', sendPostMessage);
    $('#show-subscribe').on('change', sendPostMessage);
    $('#show-social').on('change', sendPostMessage);
    function sendPostMessage() {
        const iframe = document.querySelector("#sm-preview-iframe");
        const showSocial = document.getElementById("show-social").checked;
        const showCountdown = document.getElementById("show-countdown").checked;
        iframe.contentWindow.postMessage(
            {
                hideCountdown: !showCountdown,
                hideSocialIcons: !showSocial,
            },
            "*"
        )
    }

    //  AJAX Functionality for import template
    $('.import-template').on('click', function() {
        const showSocial        = document.getElementById("show-social").checked;

        const showCountdown     = document.getElementById("show-countdown").checked;
        const add_subscriber    = document.getElementById("show-subscribe-field").checked
        const category          = $(".sm__card-radio").val()
        const nonce             = $("#template_init_field").val();
        const templateName      = $('#selected-template-name').val();
        const subscriber_email  = $('#sm-subscribe-email').val();

        if(!templateName) {
            console.log('Select Template!');
            return
        }

        const data = {
            action: "ajax_site_mode_template_init",
            template: templateName,
            template_init_field: nonce,
            showSocial: showSocial,
            showCountdown: showCountdown,
            category: category,
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
                    $('.sm-modal-content-text .outline_btn').attr('href', res.data.page_link.replace('amp;', ''))
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


   // Reset to default options functionality
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

    // On select change fonts/colors
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

    // Show/hide sidebar
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


    // Skip wizard

    $(".close_wizard_btn").on("click", function () {
        const nonce = $("#template_init_field").val();

        $.ajax({
            url: ajaxObj.ajax_url,
            dataType: "json",
            method: "post",
            data: {
                action: "ajax_site_mode_skip_wizard",
                template_init_field : nonce,
            },
            success: function (res) {
                location.reload();
            },
            error: function (error) {
                location.reload();
            },
        });
    });

});

