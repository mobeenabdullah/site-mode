
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
    $("body").on("click", ".logo-remove", function (event) {
    event.preventDefault();
    const button = $(this);
    button.next().val(""); // emptying the hidden field
    button.hide().prev().addClass("button").html("Upload Logo"); // replace the image with text
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
    $("body").on("click", ".bg-image-remove", function (event) {
        let image_btn = $('.bg-image-upload');
        let bg_image = $('.display_bg_img');
        event.preventDefault();
        const button = $(this);

        button.next().val(""); // emptying the hidden field
        button.hide().prev(); // replace the image with text

        image_btn.addClass("button normal_btn").html("Upload Background Image");
        bg_image.hide();
    });

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
});
