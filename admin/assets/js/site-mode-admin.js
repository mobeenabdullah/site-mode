
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
    2.  Google Analytic on advance tab
    3.  Tabs setting page
    4.  Logo Type
    5.   Show Login URL field
    6.  Sort social media
    7.  Ajax call for general tab
    8.  Ajax call for content tab
    9.  Ajax call for social tab
    10.  Ajax calls for design tab
    11.  Ajax call for SEO tab
    12.  Ajax call for advance Tab
    13.  Ajax call for import and export
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

        // 2.   Google Analytic on advance tab
        const googleAnalyticSelect = $('#google_analytics');
        const analyticId = $('.analytic_id');
        const analyticCode = $('.analytic_code');    

        function showHideGoogleAnalytics() {  
            console.log($(this).val());
            if($(this).val() === 'analytics-id') {
                analyticId.removeClass('sm_hide_field');                                        
            } else {
                analyticId.addClass('sm_hide_field');     
                analyticCode.removeClass('sm_hide_field');       
            }

            if($(this).val() === 'analytics-code') {            
                analyticCode.removeClass('sm_hide_field');
            } else {
                analyticCode.addClass('sm_hide_field');       
                analyticId.removeClass('sm_hide_field');     
            }
        }
        googleAnalyticSelect.on('change', showHideGoogleAnalytics);

        // 3.  Tabs setting page
        const tabLink = $('.sm_tabs li');
        const tabContent = $('.tab-content');
        
        function smTabs() {
            let tab_id = $(this).attr('data-tab');
            tabLink.removeClass('current');
            tabContent.removeClass('current');
            $(this).addClass('current');
            $("#"+tab_id).addClass('current');
        }
        tabLink.on('click', smTabs);
        
        // 4.   Logo Type
        const imageLogoWrapper = $('.image_logo_wrapper');
        const textLogoWrapper = $('.text_logo_wrapper');
        const logoInput = $('input[name="content-logo-settings"]');

        imageLogoWrapper.hide();
        textLogoWrapper.hide();

        function logoType() {
            if($(this).val() === 'type-image'){
                imageLogoWrapper.show();
                textLogoWrapper.hide();
            }
            else if($(this).val() === 'type-text'){
                textLogoWrapper.show();
                imageLogoWrapper.hide();
            } else if($(this).val() === 'type-disable') {
                imageLogoWrapper.hide();
                textLogoWrapper.hide();
            }
        }
        logoInput.on('click', logoType);

        // 5.   Show Login URL field
        const loginUrlField = $('.login_url_field');
        const enableLoginIcon = $('.enable_login_icon');        

        function enableDisableLoginIcon() {            
            if(enableLoginIcon.is(':checked')) {
                loginUrlField.removeClass('hide_url');                
            } else {
                loginUrlField.addClass('hide_url');
                
            }
        } 
        
        enableLoginIcon.on('click', enableDisableLoginIcon);  
        
        // 6.  Sort social media
        const smSortable = $( "#sm_sortable" );
        
        // sortable library setting object
        smSortable.sortable({
            cursor: "move"
        });

        // Sort change function 
        smSortable.on( "sortchange", function( event, ui ) {
            var sortedIDs = smSortable.sortable( "toArray" );
            console.log(sortedIDs);
        });

        // 7.  Ajax call for general tab
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

        // 8.  Ajax call for content tab
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
        
        // 9.  Ajax call for social tab
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
    
        // 10.  Ajax calls for design tab
        $("#active-btn").on('click', function( event ) {
            alert("button working");
            event.preventDefault();
            const data = document.getElementById("active-btn").value;
            console.log(data);
            $.ajax({
                url: ajaxObj.ajax_url,
                dataType : "json",
                method: "post",
                data: data,
                action: 'ajax_site_mode_design',
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

});


