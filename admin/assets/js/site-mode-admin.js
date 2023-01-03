
jQuery(function ($) {

    $("body").on("click", ".logo-upload", function (event) {
        event.preventDefault(); // prevent default link click and page refresh

        const button = $(this);
        const imageId = button.next().next().val();

        const customUploader = wp
            .media({
                title: "Insert logo", // modal window title
                library: {
                    // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                    type: "image",
                },
                button: {
                    text: "Use this logo", // button label text
                },
                multiple: false,
            })
            .on("select", function () {
                // it also has "open" and "close" events
                const attachment = customUploader
                    .state()
                    .get("selection")
                    .first()
                    .toJSON();
                button.removeClass("button").html('<div class="image_logo_display"><img src="' + attachment.url + '"></div>'); // add image instead of "Upload Image"
                button.next().show(); // show "Remove image" link
                button.next().next().val(attachment.id); // Populate the hidden field with image ID
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
    $("body").on("click", ".logo-remove", function (event) {
        let image_logo_display = $('.image_display');
        event.preventDefault();
        const button = $(this);
        button.next().val(""); // emptying the hidden field
        button.hide().prev().addClass("button").html("Upload Logo"); // replace the image with text
        image_logo_display.hide();
    });

    /*
    * Background Image
    */


    // on upload button click
    $("body").on("click", ".bg-image-upload", function (event) {
        event.preventDefault(); // prevent default link click and page refresh

        const button = $(this);
        const imageId = button.next().next().val();

        const customUploader = wp
            .media({
                title: "Insert Background Image", // modal window title
                library: {
                    // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                    type: "image",
                },
                button: {
                    text: "Use this background", // button label text
                },
                multiple: false,
            })
            .on("select", function () {
                // it also has "open" and "close" events
                const attachment = customUploader
                    .state()
                    .get("selection")
                    .first()
                    .toJSON();
                button.removeClass("button").html('<div class="image_display"><img src="' + attachment.url + '"></div>'); // add image instead of "Upload Image"
                button.next().show(); // show "Remove image" link
                button.next().next().val(attachment.id); // Populate the hidden field with image ID
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
    $("body").on("click", ".bg-image-remove", function (event) {
        let image_btn = $('.bg-image-upload');
        let image_display = $('.image_display');
        let bg_image = $('.display_bg_img');
        event.preventDefault();
        const button = $(this);

        console.log("image_btn", image_btn, "bg_image", bg_image, "button", button);

        button.next().val(""); // emptying the hidden field
        button.hide().prev(); // replace the image with text

        image_btn.addClass("button").html("Upload Background Image");
        bg_image.hide();
        image_display.hide();
    });


    /*
    *   SEO media upload
    */

    // on upload button click
    $("body").on("click", ".favicon-upload", function (event) {
        event.preventDefault(); // prevent default link click and page refresh

        const button = $(this);
        const imageId = button.next().next().val();

        const customUploader = wp
            .media({
                title: "Insert logo", // modal window title
                library: {
                    // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                    type: "image",
                },
                button: {
                    text: "Use this logo", // button label text
                },
                multiple: false,
            })
            .on("select", function () {
                // it also has "open" and "close" events
                const attachment = customUploader
                    .state()
                    .get("selection")
                    .first()
                    .toJSON();
                button.removeClass("button").html('<img src="' + attachment.url + '">'); // add image instead of "Upload Image"
                button.next().show(); // show "Remove image" link
                button.next().next().val(attachment.id); // Populate the hidden field with image ID
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
    $("body").on("click", ".favicon-remove", function (event) {
        event.preventDefault();
        const button = $(this);
        button.next().val(""); // emptying the hidden field
        button.hide().prev().addClass("button").html("Upload Logo"); // replace the image with text
    });

    /*
        *   SEO media upload
        */

    // on upload button click
    $("body").on("click", ".image-upload", function (event) {
        event.preventDefault(); // prevent default link click and page refresh

        const button = $(this);
        const imageId = button.next().next().val();

        const customUploader = wp
            .media({
                title: "Insert logo", // modal window title
                library: {
                    // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                    type: "image",
                },
                button: {
                    text: "Use this logo", // button label text
                },
                multiple: false,
            })
            .on("select", function () {
                // it also has "open" and "close" events
                const attachment = customUploader
                    .state()
                    .get("selection")
                    .first()
                    .toJSON();
                button.removeClass("button").html('<img src="' + attachment.url + '">'); // add image instead of "Upload Image"
                button.next().show(); // show "Remove image" link
                button.next().next().val(attachment.id); // Populate the hidden field with image ID
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
    $("body").on("click", ".image-remove", function (event) {
        event.preventDefault();
        const button = $(this);
        button.next().val(""); // emptying the hidden field
        button.hide().prev().addClass("button").html("Upload Logo"); // replace the image with text
    });


    // end of seo media upload



    // Start document ready function
    $(document).ready(function () {
        // Show and hide redirect options
        $('#site_mode').on('change', function() {
            $('.redirect_options').css('display', 'none');
            if ( $(this).val() === 'redirect' ) {
                $('.redirect_options').css('display', 'flex');
            }
        });

        // Input Number
        function customInputNumber() {
            /** Custom Input number increment js **/
            jQuery(
                '<div class="um_number-cover--nav"><div class="um_InputButton um_InputUp" role="button" tabindex="1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path></svg></div><div class="um_InputButton um_InputDown" role="button" tabindex="1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5 11h14v2H5z"></path></svg></div></div>'
            ).insertAfter(".um_number-cover input");

            jQuery(".um_number-cover").each(function() {
                var spinner = jQuery(this),
                    input = spinner.find('input[type="number"]'),
                    btnUp = spinner.find(".um_InputUp"),
                    btnDown = spinner.find(".um_InputDown"),
                    min = input.attr("min"),
                    max = input.attr("max"),
                    valOfAmout = input.val(),
                    newVal = 0;

                btnUp.on("click", function() {
                    var oldValue = parseFloat(input.val());

                    if (oldValue >= max) {
                        var newVal = oldValue;
                    } else {
                        var newVal = oldValue + 1;
                    }
                    spinner.find("input").val(newVal);
                    spinner.find("input").trigger("change");
                });
                btnDown.on("click", function() {
                    var oldValue = parseFloat(input.val());
                    if (oldValue <= min) {
                        var newVal = oldValue;
                    } else {
                        var newVal = oldValue - 1;
                    }
                    spinner.find("input").val(newVal);
                    spinner.find("input").trigger("change");
                });
            });
        }
        customInputNumber();

        // Image and text logo toggle
        $('.image_logo_wrapper').hide();
        $('.text_logo_wrapper').hide();

        $('input[name="content-logo-settings"]').on('click',function(){
            if($(this).val() === 'type-image'){
                $('.image_logo_wrapper').show();
                $('.text_logo_wrapper').hide();
            }
            else if($(this).val() === 'type-text'){
                $('.text_logo_wrapper').show();
                $('.image_logo_wrapper').hide();
            } else if($(this).val() === 'type-disable') {
                $('.image_logo_wrapper').hide();
                $('.text_logo_wrapper').hide();
            }
        });

        // hide Social Media
        function showTableRowOnEnableDisable() {
            let enableDisableParentRow = $('.enable_disable-rows').parent().parent().parent();
            if($('.enable_disable-rows').is(':checked')) {
                enableDisableParentRow.nextAll().removeClass('hide_socialmedia');
            } else {
                enableDisableParentRow.nextAll().addClass('hide_socialmedia');
            }
        }

        function disableSingleMedia() {
            if($('.disable_media').is(':checked')) {
                let disableMediaInput = $(this).parent().prev();
                disableMediaInput.addClass('disable_media_input');
            } else {
                let disableMediaInput = $(this).parent().prev();
                disableMediaInput.removeClass('disable_media_input');
            }
        }

        $('.enable_disable-rows').on('click', showTableRowOnEnableDisable);
        $('.enable_disable-rows').load(showTableRowOnEnableDisable());

        $('.disable_media').on('click', disableSingleMedia);
        $('.disable_media').load(disableSingleMedia());

        $('.login_url_field').hide();
        function enableDisableLoginIcon() {
            if($('.enable_login_icon').is(":checked")) {
                $('.login_url_field').show();
            } else {
                $('.login_url_field').hide();
            }
        }
        $('.enable_login_icon').on('click', enableDisableLoginIcon);
        $('.enable_login_icon').load(enableDisableLoginIcon);
    })

    // Drag and Drop JQuery
    $( "#sortable" ).sortable({
        cursor: "move"
    });

    $( "#sortable" ).on( "sortchange", function( event, ui ) {
        var sortedIDs = $( "#sortable" ).sortable( "toArray" );
        console.log(sortedIDs);
    } );

    $('.show_icon').on('click', function() {
        let socialParentElement = $(this).parent().parent().parent();
        if($($(this)).is(':checked')) {
            socialParentElement.addClass('disable_media');
        } else {
            socialParentElement.removeClass('disable_media');
        }
    })

    //toaster
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


    // ajax calls
    $( "#site-mode-general" ).submit(function( event ) {
        event.preventDefault();
        const form = document.getElementById("site-mode-general");
        const formData = new FormData(form);
        formData.append('action', 'ajax_site_mode_general');
        formData.append('ajax_site_mode_general',form);
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

    $( "#site-mode-social" ).submit(function( event ) {
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


    $("#site-mode-design").submit(function( event ) {
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

    // ajax call for import

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


    $('ul.tabs li').click(function(){
        var tab_id = $(this).attr('data-tab');
        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');
        $(this).addClass('current');
        $("#"+tab_id).addClass('current');
    })
});

