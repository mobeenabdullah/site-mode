
jQuery(function ($) {

    // Custom Image Uploader
    $("body").on("click", ".sm-upload-image", function () {

        const uploadButton = $(this);
        const imageType = uploadButton.attr('data-image-type');
        const imageId = uploadButton.next().next().val();

        const customUploader = wp
            .media({
                title: "Insert " + imageType,
                library: { type: "image" },
                button: { text: "Use this " + imageType },
                multiple: false,
            })
            .on("select", function () {
                const attachment = customUploader
                    .state()
                    .get("selection")
                    .first()
                    .toJSON();
                uploadButton.text("Change " + imageType);

                let altText = attachment.alt || attachment.title;

                uploadButton.parent().siblings('.sm_image_wrapper').html('<img src="' + attachment.url + '" alt="'+ altText +'">');
                uploadButton.next().show();
                uploadButton.next().next().val(attachment.id);
            });

        // already selected images
        customUploader.on("open", function () {
            if (imageId) {
                const selection = customUploader.state().get("selection");
                attachment = wp.media.attachment(imageId);
                attachment.fetch();
                selection.add(attachment ? [attachment] : []);
            }
        });

        customUploader.open();
    });
    // on remove button click
    $("body").on("click", ".sm-remove-image", function () {
        let imageWrapper = $(this).parent().siblings('.sm_image_wrapper');
        imageWrapper.hide();
        const removeButton = $(this);
        const imageType = removeButton.attr('data-image-type');
        removeButton.next().val("");
        removeButton.hide().prev().addClass("button").html("Upload " + imageType);
    });



    // toaster
    function launch_toast(response) {
        if(response == true) {
            var x = document.getElementById("toast-success");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
        }
        if(response == false) {
            var y = document.getElementById("toast-error");
            y.className = "show";
            setTimeout(function(){ y.className = y.className.replace("show", ""); }, 5000);
        }
    }


    // ajax call for download json file from server
    function saverequest(url, data) {
        return $.ajax({
            url:ajaxObj.ajax_url,
            timeout: requestTimeout,
            global: false,
            cache: false,
            type: "POST",
            data: data,
            dataType: "json",
            success: function(data) { // note 'data' here
                var blob = new Blob([data], {
                    type: 'application/json'
                });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "export.json";
                link.click();
            }
        });
    }

    /*------------------------------------------------
    1.  Mode change on general tab
    2.  Tabs setting page
    3.  Logo Type
    4.   Show Login URL field
    5.  Sort social media
    6.  Ajax call for general tab
    7.  Ajax call for content tab
    8.  Ajax call for social tab
    9.  Ajax calls for design tab
    10.  Ajax call for SEO tab
    11.  Ajax call for advance Tab
    12.  Ajax call for import and export
    ------------------------------------------------*/

    $(document).ready(function () {

        // 1.   Mode change on general tab
        const siteMode = $('#site_mode');
        const redirectOption = $('.redirect_options');

        function showHideURLOptions() {
            if($(this).val() === 'redirect') {
                redirectOption.removeClass('sm_hide_field');
            } else {
                redirectOption.addClass('sm_hide_field');

            }
        }
        siteMode.on('change', showHideURLOptions);

        // 2.  Tabs setting page
        const allTabs = $('.sm_tabs li');
        const allTabsContent = $('.tab-content');

        function changeTab() {
            let selectedTabID = $(this).attr('data-tab');
            let selectedTabSlug = selectedTabID.replace('tab-', '');

            // remove current class from all tabs and tab content
            allTabs.removeClass('current');
            allTabsContent.removeClass('current');

            // add current class to selected tab and tab content
            $(this).addClass('current');
            $("#"+selectedTabID).addClass('current');

            // update the url
            window.history.pushState("", "", "?page=site-mode&tab="+selectedTabSlug);
        }
        allTabs.on('click', changeTab);

        // 3.   Logo Type
        const imageLogoWrapper = $('.image_logo_wrapper');
        const textLogoWrapper = $('.text_logo_wrapper');
        const logoInput = $('.logo_type_selector');

        function showLogoWrapper() {
            const logoType = $(this).val();
            $('.logo_wrapper').removeClass('show_logo_wrapper');

            if(logoType === 'image'){
                imageLogoWrapper.addClass('show_logo_wrapper');
            }
            else if($(this).val() === 'text'){
                textLogoWrapper.addClass('show_logo_wrapper');
            }
        }
        logoInput.on('click', showLogoWrapper);

        // 4.   Show Login URL field
        const loginUrlField = $('.login_url_field');
        const enableLoginIcon = $('.enable_login_icon');
        const enableBackground = $('.check_background');
        const showBackgroundField = $('.show_background');
        const enableOverlay = $('.background_overlay');
        const showOverlayFields = $('.background_overlay');
        const googleAnalyticSelect = $('#google_analytics');
        const analyticId = $('.analytic_id');
        const analyticCode = $('.analytic_code');

        function enableDisableField(element, field) {
            if(element.is(':checked')) {
                field.removeClass('sm_hide_field');
            } else {
                field.addClass('sm_hide_field');
            }
        }

        enableLoginIcon.on('click', (function() {
            enableDisableField(enableLoginIcon, loginUrlField)
        }));

        enableBackground.on('click', (function() {
            enableDisableField(enableBackground, showBackgroundField)
        }));

        enableOverlay.on('click', (function() {
            enableDisableField(enableOverlay, showOverlayFields)
        }));

        // 5. Manage Social Icons
        const addSocialIcon = (title, iconClass) => {
            const formSocial = $('#site-mode-social .sm-social_icons');
            const socialIcons = $('.sm-social_icons');
            const iconMarkup = `
                <li class="sm-social_icon ui-state-default" id="sm-social_icon_${title.toLowerCase()}">
                    <div class="option__row">
                        <div class="option__row--label">
                            <span><label for="icon_${title.toLowerCase()}">${title}</label></span>
                        </div>
                        <div class="option__row--field">
                            <div class="social_media_field">
                                <div class="sortable_icon">
                                    <span class="dashicons dashicons-sort"></span>
                                </div>
                                <div class="social_icon">
                                    <span class="dashicons dashicons-${iconClass}"></span>
                                </div>
                                <div class="social_field">
                                    <input type="text" id="icon_${title.toLowerCase()}" name="social_icons[${title.toLowerCase()}][link]" value="" required />
                                </div>
                            </div>
                        </div>
                        <div class="option__row--remove">
                            <span class="dashicons dashicons-no-alt remove-social-icon" data-icon-id="sm-social_icon_${title.toLowerCase()}"></span>
                        </div>
                    </div>
                    <input type="hidden" name="social_icons[${title.toLowerCase()}][title]" value="${title}" />
                    <input type="hidden" name="social_icons[${title.toLowerCase()}][icon]" value="${iconClass}" />
                </li>
            `;

            // socialIcons.append(iconMarkup);
            formSocial.append(iconMarkup);

        }
        const selectSocialIcon = $('.sm-social_icon_selector');
        selectSocialIcon.on('click', function (e) {

            if(e.target !== this) {
                return;
            }

            const iconId = $(this).attr('data-icon-id');
            const iconTitle = $(this).attr('data-icon-title');
            const iconClass = $(this).attr('data-icon-class');

            if($(this).hasClass('sm-social_icon--checked')) {
                $(this).removeClass('sm-social_icon--checked');
                $("#" + iconId).remove();
            } else {
                $(this).addClass('sm-social_icon--checked');
                addSocialIcon( iconTitle, iconClass);
            }

        });

        $('body').on('click', '.remove-social-icon', function (e) {
            const iconId = $(this).attr('data-icon-id');
            $("#" + iconId).remove();
            // remove the checked class
            $(`[data-icon-id="${iconId}"]`).removeClass('sm-social_icon--checked');
        });

        // 5. Sort Social Icons
        const smSortable = $( ".sm_sortable" );
        if(smSortable) {
            smSortable.sortable({
                cursor: "move"
            });

        }

        // 6.  Ajax call for general tab
        $( "#site-mode-general" ).submit(function( event ) {
            event.preventDefault();
            const form = document.getElementById("site-mode-general");
            const formData = new FormData(form);
            formData.append('action', 'ajax_site_mode_general');
            formData.append('ajax_site_mode_general',form);
            $('.save-btn-loader').show();
            $.ajax({
                url: ajaxObj.ajax_url,
                dataType : "json",
                method: "post",
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: "multipart/form-data",
                success:function (res) {
                    setTimeout(function () {
                        $('.save-btn-loader').hide();
                        launch_toast(res.success);
                    }, 1000)
                }
            });
        });

        // 7.  Ajax call for content tab
        $( "#site-mode-content" ).submit(function( event ) {
            event.preventDefault();
            const form = document.getElementById("site-mode-content");
            const formData = new FormData(form);
            formData.append('action', 'ajax_site_mode_content');
            formData.append('ajax_site_mode_content',form);
            $.ajax({
                url: ajaxObj.ajax_url,
                dataType : "json",
                method: "post",
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: "multipart/form-data",
                success:function (res) {
                    launch_toast(res.success);
                }
            });
        });

        // 8.  Ajax calls for design tab
        $("#site-mode-design").submit(function( event ) {
            alert('Click');
            event.preventDefault();
            const form = document.getElementById("site-mode-design");
            const formData = new FormData(form);
            formData.append('action', 'ajax_site_mode_design');
            formData.append('ajax_site_mode_design',form);
            $.ajax({
                url: ajaxObj.ajax_url,
                dataType : "json",
                method: "post",
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: "multipart/form-data",
                success:function (res) {
                    launch_toast(res.success);
                }
            });
        });


        $( "#site-mode-design-fonts" ).submit(function( event ) {
            event.preventDefault();
            const form = document.getElementById("site-mode-design-fonts");
            const formData = new FormData(form);
            formData.append('action', 'ajax_site_mode_design_font');
            formData.append('ajax_site_mode_design_font',form);
            $.ajax({
                url: ajaxObj.ajax_url,
                dataType : "json",
                method: "post",
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: "multipart/form-data",
                success:function (res) {
                    launch_toast(res.success);
                }
            });
        });



        // 9.  Ajax call for social tab
        $( "body" ).on('submit', '#site-mode-social', function( event ) {
            event.preventDefault();
            const form = document.getElementById("site-mode-social");
            const formData = new FormData(form);
            formData.append('action', 'ajax_site_mode_social');
            formData.append('ajax_site_mode_social',form);
            $.ajax({
                url: ajaxObj.ajax_url,
                dataType : "json",
                method: "post",
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: "multipart/form-data",
                success:function (res) {
                    launch_toast(res.success);
                }
            });
        });

        // 10.  Ajax calls for design tab

        $("body").on( 'click', '.activate-template-btn', function(e) {
            const templateName = e.target.value;
            // save template name to wp_options
            $.ajax({
                url: ajaxObj.ajax_url,
                dataType : "json",
                method: "post",
                data: {
                    action: 'ajax_site_mode_design',
                    template_name: templateName
                },
                success:function (res) {
                    console.log(res);
                    const activatedTemplate = res.data;
                    $('.template_card').removeClass('active_template');
                    $('.template_card .activate-template-btn').text('Active');
                    $(`.template-${activatedTemplate}`).addClass('active_template');
                    $('.active_template .activate-template-btn').text('Activated');
                    launch_toast(res.success);
                }
            });
        });

        // ajax call for this form id test_form
        $("#test_form").submit( function( event ) {
            event.preventDefault();
            alert("This is working fine..");
    // get form input data using jquery input field nam is submit .
            //select clicked form input data.
            var form_data = $(this).serialize();
            alert(form_data);

            var data =  $('input[name="submit"]').val();
            console.log(data);
            alert(data);
            $.ajax({
                url: ajaxObj.ajax_url,
                dataType : "json",
                method: "post",
                data: data,
                success:function (res) {
                    launch_toast(res.success);
                }
            });
        }
    );
        $("#site-mode-design-logo-background").submit(function( event ) {
            event.preventDefault();
            const form = document.getElementById("site-mode-design-logo-background");
            alert(form);
            const formData = new FormData(form);
            console.log(formData);
            formData.append('action', 'ajax_site_mode_design_lb');
            formData.append('ajax_site_mode_design_lb',form);
            $.ajax({
                url: ajaxObj.ajax_url,
                dataType : "json",
                method: "post",
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: "multipart/form-data",
                success:function (res) {
                    launch_toast(res.success);
                }
            });
        });

        $( "#site-mode-design-color-section" ).submit(function( event ) {
            event.preventDefault();
            const form = document.getElementById("site-mode-design-color-section");
            const formData = new FormData(form);
            formData.append('action', 'ajax_site_mode_design_color_section');
            formData.append('ajax_site_mode_design_color_section',form);
            $.ajax({
                url: ajaxObj.ajax_url,
                dataType : "json",
                method: "post",
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: "multipart/form-data",
                success:function (res) {
                    launch_toast(res.success);
                }
            });
        });

        // 11.  Ajax call for SEO tab
        $( "#site-mode-seo" ).submit(function( event ) {
            event.preventDefault();
            const form = document.getElementById("site-mode-seo");
            console.log(form);
            const formData = new FormData(form);
            formData.append('action', 'ajax_site_mode_seo');
            formData.append('ajax_site_mode_seo',form);
            $.ajax({
                url:ajaxObj.ajax_url,
                dataType : "json",
                method: "post",
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: "multipart/form-data",
                success:function (res) {
                    launch_toast(res.success);
                }
            });
        });

        // 12.  Ajax call for advance Tab
        $( "#site-mode-advanced" ).submit(function( event ) {
            event.preventDefault();
            const form = document.getElementById("site-mode-advanced");
            const formData = new FormData(form);
            formData.append('action', 'ajax_site_mode_advanced');
            formData.append('ajax_site_mode_advanced',form);
            $.ajax({
                url: ajaxObj.ajax_url,
                dataType : "json",
                method: "post",
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: "multipart/form-data",
                success:function (res) {
                    launch_toast(res.success);
                }
            });
        });

        // 13.  Ajax call for import and export Tab
        $( "#site-mode-import" ).submit(function( event ) {
            event.preventDefault();
            const form = document.getElementById("site-mode-import");
            const formData = new FormData(form);
            formData.append('action', 'ajax_site_mode_import');
            formData.append('ajax_site_mode_import',form);
            // import json file and save it to database
            $.ajax({
                url: ajaxObj.ajax_url,
                type: "POST",
                dataType : "json",
                method: "post",
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                enctype: "multipart/form-data",
                success:function (res) {
                    launch_toast(res.success);
                }
            });
        });

        $('.btn-export').on('click', function() {
            $.ajax({
                url: ajaxObj.ajax_url,
                type: "GET",
                data:{action:'ajax_site_mode_export'},
                success:function (data) {
                    console.log(data);
                    var blob = new Blob([data], {
                        type: 'application/json'
                    });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    //get site name using window.location and split it by dot
                    var siteName = window.location.hostname.split('.')[0];
                    //plugin name
                    var pluginName = 'site-mode';
                    //get current date and time
                    var date = new Date();
                    var dateStr = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate() + '-' + date.getHours() + '-' + date.getMinutes() + '-' + date.getSeconds();
                    //create file name with site name and current date and time
                    var fileName = siteName + '-' + pluginName + '-' + dateStr + '.json';
                    link.download = fileName;

                    //name of the file with site name
                    // link.download = siteName + '.json';
                    // link.download = "export.json";
                    link.click();
                }
            });
        });

        // Multi Select
        $('.js-example-basic-multiple').select2();

        // Upload file
        const hiddenBtn = document.querySelector('.hiddenBtn');
        const chooseBtn = document.querySelector('.chooseBtn');

        hiddenBtn.addEventListener('change', function() {
            if (hiddenBtn.files.length > 0) {
                //chooseBtn.innerText = hiddenBtn.files[0].name;
                chooseBtn.insertAdjacentHTML("afterend", `<div class="file_name">${hiddenBtn.files[0].name}</div>`);
            } else {
                chooseBtn.innerText = 'Choose';
                chooseBtn.removeAdjacentHTML("afterend", `<div class="file_name">${hiddenBtn.files[0].name}</div>`);
            }
        });
    })

    const mobileMenu = document.querySelector('.mobile_menu');
    const smTabs = document.querySelector('.sm_tabs');
    const smTabsList = document.querySelectorAll('.sm_tabs li');
    const menuLabel = document.querySelector('.menu_label');

    mobileMenu.addEventListener('click', function() {
        smTabs.classList.toggle('active_tabs');
    });

    if(window.innerWidth < 768) {
        smTabsList.forEach(function(item) {
            item.addEventListener('click', function() {
                smTabs.classList.remove('active_tabs');
                let tabName = item.getAttribute('data-tab').replace('-', ' ');
                tabName = tabName.replace('tab ','').toLowerCase();
                tabNameChar = tabName.split('');
                let tabLabel = tabNameChar[0].toUpperCase() + tabNameChar.slice(1).join('').toLowerCase();
                menuLabel.innerText = tabLabel + ' Setting';
            });
        });
    }


    // ACE Editor
    if($('#header_code').length > 0) {
        let headerEditor = ace.edit('header_code');
        headerEditor.setTheme("ace/theme/ambiance");
        headerEditor.session.setMode("ace/mode/html");
    }

    if($('#footer_code').length > 0) {
        let footerEditor = ace.edit('footer_code');
        footerEditor.setTheme("ace/theme/ambiance");
        footerEditor.session.setMode("ace/mode/html");
    }

    if($('#custom_css').length > 0) {
        let customCssEditor = ace.edit('custom_css');
        customCssEditor.setTheme("ace/theme/ambiance");
        customCssEditor.session.setMode("ace/mode/html");
    }

    // Range slider - gravity forms
    /*
     * Range Slider
     */
    let range_selector = "[data-rangeSlider]";
    let $element = $(range_selector);


    function valueOutput(element) {
      let value = element.value;
      let output =
        element.parentNode.getElementsByClassName("output-value")[0] ||
        element.parentNode.parentNode.getElementsByClassName("output-value")[0];
      output.textContent = value / 10;
    }

    /**
     * Input range event
     */
    $(document).on(
      "input",
      'input[type="range"], ' + range_selector,
      function (e) {
        valueOutput(e.target);
      }
    );
    $(document).on("input", "input[data-rangeslider]", function (e) {
      $(range_selector, e.target.parentNode).rangeslider({
        polyfill: false,
      });
    });
    $element.rangeslider({
      polyfill: false,
      onInit: function () {
        valueOutput(this.$element[0]);
      },
    });



});





