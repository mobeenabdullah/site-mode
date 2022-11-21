
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
    })
});
