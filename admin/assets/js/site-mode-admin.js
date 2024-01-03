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

  $(document).ready(function () {

    const redirectOption = $(".redirect_options");

    function showHideURLOptions() {
      if ($(this).is(":checked")) {
        redirectOption.removeClass("sm_hide_field");
      } else {
        redirectOption.addClass("sm_hide_field");
      }
    }
    $("#sm-redirect").on("click", showHideURLOptions);

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
              if (res?.data?.tab === 'design') {
                  if(res?.data?.status) {
                    $(".sm-admin-bar-status").text("Site Mode is Enabled");
                    $(".sm-admin-bar-status").css("background", "red");
                    $(".sm-admin-bar-status").css("color", "#ffffff");
                  } else {
                    $(".sm-admin-bar-status").text("Site Mode is Disabled");
                    $(".sm-admin-bar-status").css("background", "lightgrey");
                    $(".sm-admin-bar-status").css("color", "black");
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

    const templateInit = $("#sm-template__initialization");
    templateInit.submit(function (e) {
      e.preventDefault();
      $("#sm-template__initialization .save-btn-loader").show();
      sendAjaxRequest(
        "sm-template__initialization",
        "ajax_site_mode_template_init"
      );
    });


    const integrationsGeneral = $("#site-mode-integrations");
    integrationsGeneral.submit(function (e) {
      e.preventDefault();
      $("#site-mode-integrations .save-btn-loader").show();
      sendAjaxRequest("site-mode-integrations", "ajax_site_mode_intergrations");
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
    $(".whitelist_user_role-multiselect").select2();

    // Export to CSV
    $('#exportToCSV').on('click', function() {
      $.ajax({
        url: ajaxurl,
        type: 'post',
        data: {
          action: 'subscribe_export_csv',
        },
        success: function(response) {
          // Trigger file download
          var blob = new Blob([response]);
          var link = document.createElement('a');
          link.href = window.URL.createObjectURL(blob);
          link.download = 'exported_data.csv';
          link.click();
        }
      });
    });

    // Delete spacific entry. window.location.href = window.location.pathname + '?page=site-mode&setting=subscribes&subscribe_page=' + newPage;
    $('.delete_entry').on('click', function() {
      const id = $(this).data('id');
      const nonce = $(this).data('nonce');
      const currentPage = parseInt(getParameterByName('subscribe_page')) || 1; // Get the current page from the URL

      $.ajax({
        url: ajaxurl,
        type: 'post',
        data: {
          action: 'delete_subscribe',
          id: id,
          nonce: nonce,
        },
        success: function(response) {
          response.total_rows = undefined;
          if (response.success) {
            const totalRows = response.total_rows || 0;

            // Check if the current page is empty after the delete operation.
            const isCurrentPageEmpty = totalRows <= 0;

            // Check if the current page is not the first page, and it's empty.
            if (isCurrentPageEmpty) {
              if (currentPage > 1) {
                const newPage = currentPage - 1;
                window.location.href = window.location.pathname + '?page=site-mode&setting=subscribers&subscribe_page=' + newPage;
              } else {
                // If the current page is the first page, reload it
                window.location.reload();
              }
            } else {
              // Stay on the current page as there are remaining entries
              window.location.reload();
            }
          } else {
            alert('Something went wrong.');
          }
        }
      });
    });

    // Helper function to get query parameter by name from the URL
    function getParameterByName(name) {
      const url = window.location.href;
      name = name.replace(/[\[\]]/g, '\\$&');
      const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
          results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return '';
      return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }


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

  /**
   * Manipulates DOM elements based on the specified action.
   *
   * @param {string|jQuery} element - The element(s) to be manipulated.
   * @param {string} action - The action to perform on the element(s) ('hide', 'show', 'addClass', 'removeClass', 'removeAttribute').
   * @param {string} parameter1 - The first parameter specific to the action (e.g., class name or attribute name).
   * @param {string} [parameter2] - The second parameter specific to the action (e.g., attribute value). Optional, used for 'removeAttribute'.
   */

  function manipulateElement(element, action, parameter1, parameter2) {
    switch (action) {
      case 'hide':
        $(element).hide();
        break;
      case 'show':
        $(element).show();
        break;
      case 'addClass':
        $(element).addClass(parameter1);
        break;
      case 'removeClass':
        $(element).removeClass(parameter1);
        break;
      case 'removeAttribute':
        $(element).removeAttr(parameter1, parameter2);
        break;
      default:
        // Handle unsupported actions or errors here
        break;
    }
  }

  /**
   * Handles category filters.
   * This function can be used to filter and display content based on selected categories.
   */
  function categoryFilters () {
    manipulateElement('.template-category-filter', 'removeClass', 'active');
    manipulateElement($(this), 'addClass', 'active');
    const templateCategory = $(this).attr('data-template-category');

    if(templateCategory === 'all') {
      manipulateElement('.template-content-wrapper', 'show');
    } else {
      manipulateElement('.template-content-wrapper', 'hide');
      manipulateElement(`.template-content-wrapper[data-category-name="${templateCategory}"]`, 'show');
    }

    if (templateCategory === 'all') {
      manipulateElement('.sm_clearfilter', 'hide');
    } else {
      manipulateElement('.sm_clearfilter', 'show');
    }
  }
  $('.template-category-filter').on('click', categoryFilters);

  /**
   * Handles display selected category text.
  */
  function changeTextOnClickFilters () {
    var clickedText = $(this).html();
    $('.display_template_name').html(clickedText);
  }
  $('.template-category-filter').on('click', changeTextOnClickFilters);

  /**
   * Handles clear filter functionality.
   */
  function smClearFilters () {
    $('.template-category-filter[data-template-category=all]').trigger('click');
  }
  $('.sm_clearfilter').on('click', smClearFilters);

  /**
   * Handles checkbox functionality.
   */
  function handleCheckboxBehavior() {
    let activePage = '';
    const currentElement = $(this);
    const nonce = $("#setup_action_field").val();
    const category = currentElement.attr('data-category');

    if (currentElement.prop('checked')) {
      if(category == '404') {
        activePage = true;
      } else {
        activePage = currentElement.val();
      }
    }

    $.ajax({
      url: ajaxObj.ajax_url,
      dataType: "json",
      method: "post",
      data: {
        action: "ajax_site_mode_page_setup",
        activePage: activePage,
        setup_action_field: nonce,
        category: category
      },
      success: function (res) {

        if(category === '404') {
          if (currentElement.prop('checked')) {
            manipulateElement('.site-mode-cards--item.sm-template', 'addClass', 'enabled__card');
          } else {
            manipulateElement('.site-mode-cards--item.sm-template', 'removeClass', 'enabled__card');
          }
        } else {
          $('.setup_pages .sm-page-checkbox').not(currentElement).prop('checked', false);
          manipulateElement('.site-mode-cards--item.sm-page', 'removeClass', 'enabled__card');
          if (currentElement.prop('checked')) {
            manipulateElement(currentElement.closest('.site-mode-cards--item.sm-page'), 'addClass', 'enabled__card');
          }
        }
        window.location.reload();
      },
      error: function (error) {
        launch_toast(false);
        console.log(error);
      },
    });
  }

  $('.setup_pages input[type="checkbox"]').click(handleCheckboxBehavior);

  /**
   * Active state for admin sidebar menu
   */
  function getActiveSubMenu () {
    function getUrlParameter(sParam) {
      var sPageURL = window.location.search.substring(1),
          sURLVariables = sPageURL.split('&'),
          sParameterName,
          i;

      for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
          return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
      }
      return false;
    };

    const currentPage = getUrlParameter('page');
    const settingPage = getUrlParameter('setting');
    const menuLinks = $('.wp-submenu-wrap a');

    menuLinks.each(function() {
      const href = $(this).attr('href');
      if ((currentPage && href.includes('page=' + currentPage)) && (settingPage && href.includes('setting=' + settingPage))) {
        $(this).parent().siblings('.wp-first-item').removeClass('current');
        $(this).parent().addClass('current');
      }
    });
  }
  getActiveSubMenu();

});