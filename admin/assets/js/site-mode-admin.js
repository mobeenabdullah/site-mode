jQuery(function ($) {
  // Custom Image Uploader
  $("body").on("click", ".sm-upload-image", function () {
    const uploadButton = $(this);
    const imageType = uploadButton.attr("data-image-type");
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

        uploadButton
          .parent()
          .siblings(".sm_image_wrapper")
          .html(`<img src="${attachment.url}" alt="${altText}">`);
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
    let imageWrapper = $(this).parent().siblings(".sm_image_wrapper");
    imageWrapper.hide();
    const removeButton = $(this);
    const imageType = removeButton.attr("data-image-type");
    removeButton.next().val("");
    removeButton
      .hide()
      .prev()
      .addClass("btn btn_outline btn_sm")
      .html("Upload " + imageType);
  });

  // toaster
  function launch_toast(response) {
    var x = document.getElementById("toast-success");
    var y = document.getElementById("toast-error");
    if (response == true && x.length !== 0) {
      x.className = "show";
      setTimeout(function () {
        x.className = x.className.replace("show", "");
      }, 5000);
    } else if (y.length !== 0) {
      y.className = "show";
      setTimeout(function () {
        y.className = y.className.replace("show", "");
      }, 5000);
    }
  }

  /*------------------------------------------------
    1.  Mode change on general tab
    2.  Tabs setting page
    3.  Logo Type
    4.   Show Login URL field
    6.  Ajax call for general tab
    10.  Ajax call for SEO tab
    11.  Ajax call for advance Tab
    ------------------------------------------------*/

  $(document).ready(function () {
    // 1.   Mode change on general tab
    const siteMode = $("#site_mode");
    const redirectOption = $(".redirect_options");

    function showHideURLOptions() {
      if ($(this).val() === "redirect") {
        redirectOption.removeClass("sm_hide_field");
      } else {
        redirectOption.addClass("sm_hide_field");
      }
    }
    siteMode.on("change", showHideURLOptions);

    // 2.  Tabs setting page
    const allTabs = $(".sm_tabs li");
    const allTabsContent = $(".tab-content");

    function changeTab() {
      let selectedTabID = $(this).attr("data-tab");
      let selectedTabSlug = selectedTabID.replace("tab-", "");

      // remove current class from all tabs and tab content
      allTabs.removeClass("current");
      allTabsContent.removeClass("current");

      // add current class to selected tab and tab content
      $(this).addClass("current");
      $("#" + selectedTabID).addClass("current");

      // update the url
      window.history.pushState(
        "",
        "",
        "?page=site-mode&tab=" + selectedTabSlug
      );
    }
    allTabs.on("click", changeTab);

    // 4.   Show Login URL field
    const loginUrlField = $(".login_url_field");
    const enableLoginIcon = $(".enable_login_icon");

    function enableDisableField(element, field) {
      if (element.is(":checked")) {
        field.removeClass("sm_hide_field");
      } else {
        field.addClass("sm_hide_field");
      }
    }

    enableLoginIcon.on("click", function () {
      enableDisableField(enableLoginIcon, loginUrlField);
    });

    function sendAjaxRequest(selector, action, enctype = false, data = []) {
      const form = document.getElementById(selector);
      const formData = new FormData(form);
      formData.append("action", action);
      formData.append(action, form);
      if (data.length > 0) {
        data.forEach((item) => {
          formData.append(item.name, item.value);
        });
      }

      $.ajax({
        url: ajaxObj.ajax_url,
        dataType: "json",
        method: "post",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        enctype: enctype ? "multipart/form-data" : "",
        success: function (res) {
          if (res?.data?.fresh_installation) {
            const pageLink = res?.data?.page_link;
            $('.sm-template-init-success').show();
            $('.sm-template-next').hide();
            $('.sm-template-next').hide();
            // $('.sm-category-card-wrapper').hide();
            $('.sm-template-card-wrapper').hide();
            $('.sm-step-4').show();
            $('.sm-step-4').addClass('active');
            $('.sm-edit-page-link').attr('href', pageLink.replace('amp;', ''));
          } else {
            setTimeout(function () {
              if (res?.data?.tab === 'general') {
                  if(res?.data?.status) {
                      $(".sm-admin-bar-status").text("Site Mode is Enabled");
                      $(".sm-admin-bar-status").css("background", "red");
                  } else {
                      $(".sm-admin-bar-status").text("Site Mode is Disabled");
                      $(".sm-admin-bar-status").css("background", "lightgrey");
                  }
              }
              $(".save-btn-loader").hide();
              launch_toast(res.success);
            }, 1000);
          }
        },
        error: function (error) {
          setTimeout(function () {
            $(".save-btn-loader").hide();
            // launch_toast(true)
          }, 1000);
        },
      });
    }

    const designPageInit = $("#site-mode-page-init");
    designPageInit.submit(function (e) {
      e.preventDefault();
      sendAjaxRequest("site-mode-page-init", "ajax_site_mode_design_page_init");
    });

    const templateInit = $("#sm-template__initialization");
    templateInit.submit(function (e) {
      e.preventDefault();
      $("#sm-template__initialization .save-btn-loader").show();
      sendAjaxRequest(
        "sm-template__initialization",
        "ajax_site_mode_template_init"
      );
    });

    const formGeneral = $("#site-mode-general");
    formGeneral.submit(function (e) {
      e.preventDefault();
      $("#site-mode-general .save-btn-loader").show();
      sendAjaxRequest("site-mode-general", "ajax_site_mode_general");
    });

    const formSEO = $("#site-mode-seo");
    formSEO.submit(function (e) {
      e.preventDefault();
      $("#site-mode-seo  .save-btn-loader").show();
      sendAjaxRequest("site-mode-seo", "ajax_site_mode_seo", true);
    });

    const formAdvanced = $("#site-mode-advanced");
    formAdvanced.submit(function (e) {
      e.preventDefault();
      $("#site-mode-advanced .save-btn-loader").show();
      sendAjaxRequest(
        "site-mode-advanced",
        "ajax_site_mode_advanced",
        false,
        []
      );
    });

    // Multi Select
    $(".whitelist-pages-multiselect").select2();
  });

  const mobileMenu = document.querySelector(".mobile_menu");
  const smTabs = document.querySelector(".sm_tabs");
  const smTabsList = document.querySelectorAll(".sm_tabs li");
  const menuLabel = document.querySelector(".menu_label");

  if (mobileMenu) {
    mobileMenu.addEventListener("click", function () {
      smTabs.classList.toggle("active_tabs");
    });
  }

  if (window.innerWidth < 768) {
    smTabsList.forEach(function (item) {
      item.addEventListener("click", function () {
        smTabs.classList.remove("active_tabs");
        let tabName = item.getAttribute("data-tab").replace("-", " ");
        tabName = tabName.replace("tab ", "").toLowerCase();
        tabNameChar = tabName.split("");
        let tabLabel =
          tabNameChar[0].toUpperCase() +
          tabNameChar.slice(1).join("").toLowerCase();
        menuLabel.innerText = tabLabel + " Setting";
      });
    });
  }

  $(".template_init_button").on("click", function () {
    $(this).siblings(".template_loading").show();
    const templateId = $(this).attr("data-value");
    const nonce = $("#template_init_field").val();
    const currentTemplate = $(this);

    $.ajax({
      url: ajaxObj.ajax_url,
      dataType: "json",
      method: "post",
      data: {
        action: "ajax_site_mode_template_init",
        template: templateId,
        template_init_field: nonce,
      },
      success: function (res) {
        setTimeout(function () {
          $(".template_card").removeClass("active_template");
          $(currentTemplate)
            .parent(".template_card")
            .addClass("active_template");
          $(".template_loading").hide();
          launch_toast(res.success);
        }, 1000);
      },
      error: function (error) {
        setTimeout(function () {
          $(".template_loading").hide();
          $(".save-btn-loader").hide();
          // launch_toast(true)
        }, 1000);
      },
    });
  });
});
