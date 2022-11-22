
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
    event.preventDefault();
    const button = $(this);
    button.next().val(""); // emptying the hidden field
    button.hide().prev().addClass("button").html("Upload Background Image"); // replace the image with text
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
    })
});
