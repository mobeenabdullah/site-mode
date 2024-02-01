jQuery(function($) {

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

	const templateCategory = $('.template-category-filter').attr('data-template-category');

	if (templateCategory === 'all') {
		hideElements('.sm_clearfilter')
	} else {
		showElements('.sm_clearfilter')
	}

	function categoryFilters() {
		removeElementClass('.template-category-filter', 'active');
		addElementClass($(this), 'active');
		const templateCategory = $(this).attr('data-template-category');
		if (templateCategory === 'all') {
			showElements('.template-content-wrapper');
		} else {
			hideElements(`.template-content-wrapper`);
			showElements(`.template-content-wrapper[data-category-name="${templateCategory}"]`);
		}
		if (templateCategory === 'all') {
			hideElements('.sm_clearfilter')
		} else {
			showElements('.sm_clearfilter')
		}
	}
	$('.template-category-filter').on('click', categoryFilters);

	function smClearFilters() {
		$('.template-category-filter[data-template-category=all]').trigger('click');
	}

	$('.sm_clearfilter').on('click', smClearFilters);

	// Choose page type
	function choosePageType() {
		hideElements('.wizard__start, .sm_customize_settings, .sm_final_import, .component__settings, .customize__actions, .import__actions');
		showElements('.wizard__content-wrapper');
		addElementClass('.sm-select-template', 'active');
		const categoryName = $('.sm__card-radio:checked').val();

		if (categoryName === '404' || categoryName === 'login') {
			$('.template-components.settings__card').hide();
		} else {
			$('.template-components.settings__card').show();
		}

		$(`.template-category-filter[data-template-category = ${categoryName}]`).trigger('click');

	}
	$('.choose_page_type').on('click', choosePageType);

	$('.setup-button').on(
		"click",
		function() {
			const cat = $(this).attr('data-template-category');
			$('.sm__card-radio').prop('checked', false);
			$(`.sm__card-radio[value = ${cat}]`).prop('checked', true);
			choosePageType();
			$(`.template-category-filter[data-template-category = ${cat}]`).trigger('click');
		}
	);

	// Back to wizard start page
	function backToWizardStart() {
		hideElements('.wizard__content-wrapper, .sm_final_import, .sm_customize_settings, .component__settings, .customize__actions, .import__actions');
		showElements('.wizard__start');
		removeElementClass('.sm-select-template', 'active');
		removeElementClass('.sm__wizard-wrapper', 'sm_add_scroll');
	}
	$('.back_wizard_start').on('click', backToWizardStart);

	// Go to select template page
	function selectTemplate() {
		const templateLabel = $(this).attr('data-template-label');
		$('.template__name').html(templateLabel);
		const templateName = $(this).attr('data-template-name');

		removeElementClass('.wizard__templates-cards--single', 'active');
		$('.wizard__templates-cards--single button span').html('select');
		$(this).parents('.wizard__templates-cards--single').addClass('active');
		$(this).children('span').html('Selected');
		hideElements('.wizard__start, .wizard__content-wrapper, .sm_final_import, .import__actions');
		showElements('.sm_customize_settings, .customize__sidebar-content, .component__settings, .customize__actions');
		addElementClass('.sm-customize', 'active');
		addElementClass('.sm__wizard-wrapper', 'sm_add_scroll');

		$template_name = $(this).parents('.wizard__templates-cards--single').attr('data-category-template');
		const isLoginPreview = 'template-9' === $template_name || 'template-10' === $template_name;

		if(isLoginPreview) {
			$('#sm-preview-iframe').hide();
			$('#sm-login-preview').show();
		} else {
			$('#sm-login-preview').hide();
			$('#sm-preview-iframe').attr('src', `https://site-mode.com/${$template_name}`);
			$('#sm-preview-iframe').show();
		}

		$('#selected-template-name').val($template_name);
		$('.sm-setting-reset-components').trigger('click');
		$('#color_scheme').val('default').trigger('change');
		removeElementClass('.select_template_btn', 'disabled__customize');
		removeElementAttribute('.select_template_btn', 'disabled', 'disabled');
		$('.loading__template').css('display', 'flex');
		setTimeoutForTemplate(isLoginPreview);
	}
	$('.select_template').on('click', selectTemplate);

	function setTimeoutForTemplate(isLoginPreview = false) {
		setTimeout(
			function() {

				if(isLoginPreview) {
					$('#sm-preview-iframe').css('display', 'none');
					$('#sm-login-preview').css('display', 'block');
				} else {
					$('#sm-login-preview').css('display', 'none');
					$('#sm-preview-iframe').css('display', 'block');
				}
				$('.loading__template').css('display', 'none');
			},
			2000
		);
	}

	// Go to customize template page
	function customizeTemplate() {
		const templateLabel = $(this).attr('data-template-label');
		$('.template__name').html(templateLabel);
		const templateName = $(this).attr('data-template-name');
		$('#selected-template-name').val(templateName);
		const isLoginPreview = 'template-9' === $template_name || 'template-10' === $template_name;


		if(isLoginPreview) {
			$('#sm-preview-iframe').hide();
			$('#sm-login-preview').show();
		} else {
			$('#sm-login-preview').hide();
			$('#sm-preview-iframe').attr('src', `https://site-mode.com/${templateName}`);
			$('#sm-preview-iframe').show();
		}

		hideElements('.sm_final_import, .wizard__start, .wizard__content-wrapper, .import__settings, .import__actions');
		showElements('.sm_customize_settings, .component__settings, .customize__actions');
		addElementClass('.sm-customize', 'active');
		addElementClass('.sm__wizard-wrapper', 'sm_add_scroll');
		$('.loading__template').css('display', 'flex');
		setTimeoutForTemplate(isLoginPreview);
	}
	$('.select_template_btn').on('click', customizeTemplate);
	// Back to select template page
	function backToSelectTemplate() {
		hideElements('.wizard__start, .import__actions, .sm_final_import, .sm_customize_settings, .component__settings, .customize__actions');
		showElements('.wizard__content-wrapper');
		removeElementClass('.sm-customize', 'active');
		removeElementClass('.sm__wizard-wrapper', 'sm_add_scroll');
	}
	$('.template-init-back').on('click', backToSelectTemplate);
	// Go to import template page
	function startImportingTemplate() {
		hideElements('.customize__template, .customize__sidebar-content, .wizard__start, .wizard__content-wrapper, .component__settings, .customize__actions');
		showElements('.sm_final_import, .import__actions');
		addElementClass('.sm-import', 'active');
		addElementClass('.sm__wizard-wrapper', 'sm_add_scroll');
	}
	$('.start_importing').on('click', startImportingTemplate);
	// Back to custom template page
	function backTemplateCustomize() {
		// hideElements('.wizard__start, .wizard__content-wrapper, .import__actions, .sm_final_import');
		// showElements('.customize__template, .sm_customize_settings, .component__settings, .customize__actions');
		hideElements('.wizard__start, .wizard__content-wrapper, .sm_final_import, .import__actions');
		showElements('.sm_customize_settings, .customize__sidebar-content, .component__settings, .customize__actions');
		removeElementClass('.sm-import', 'active');
		addElementClass('.sm__wizard-wrapper', 'sm_add_scroll');
	}
	$('.template-back-customize').on('click', backTemplateCustomize);
	// Post message to iframe
	$('#show-countdown').on('change', sendPostMessage);
	$('#show-subscribe').on('change', sendPostMessage);
	$('#show-social').on('change', sendPostMessage);
	$('#color_scheme').on('change', sendPostMessage)

	function sendPostMessage() {
		const iframe = document.querySelector("#sm-preview-iframe");
		const showSocial = document.getElementById("show-social").checked;
		const showCountdown = document.getElementById("show-countdown").checked;
		const colorScheme = document.getElementById("color_scheme").value;
		iframe.contentWindow.postMessage({
				hideCountdown: !showCountdown,
				hideSocialIcons: !showSocial,
				colorScheme: colorScheme
			},
			"*"
		)
	}

	function getParameterByName(name, url) {
		if (!url) {
			url = window.location.href;
		}
		name = name.replace(/[\[\]]/g, "\\$&");
		var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
			results = regex.exec(url);
		if (!results) {
			return null;
		}
		if (!results[2]) {
			return '';
		}
		return decodeURIComponent(results[2].replace(/\+/g, " "));
	}

	const templateParam = getParameterByName('template');
	const cat = getParameterByName('cat');
	if (templateParam) {
		$('.choose_page_type').trigger('click');
		$(`.template_card[data-category-template = "${templateParam}"] .select_template`).trigger('click');
	}
	// AJAX Functionality for import template
	$('.import-template').on(
		'click',
		function() {
			const showSocial = document.getElementById("show-social").checked;
			const showCountdown = document.getElementById("show-countdown").checked;
			const add_subscriber = document.getElementById("show-subscribe-field").checked
			const category = $(".sm__card-radio:checked").val()
			const nonce = $("#template_init_field").val();
			const templateName = $('#selected-template-name').val();
			const subscriber_email = $('#sm-subscribe-email').val();
			const colorScheme = $('#color_scheme').val();

			if (!templateName) {
				alert('Please Select Template!');
				return
			}

			const data = {
				action: "ajax_site_mode_template_init",
				template: templateName,
				template_init_field: nonce,
				showSocial: showSocial,
				showCountdown: showCountdown,
				category: category,
				colorScheme: colorScheme,
			}

			if (add_subscriber && subscriber_email) {
				data.subscriber_email = subscriber_email;
			}

			$.ajax({
				url: ajaxObj.ajax_url,
				dataType: "json",
				method: "post",
				data: data,
				beforeSend: function() {
					$('#importing__popup').css('display', 'flex');
					$('.error__content').hide();
					$('.thank__you-content').hide();
				},
				success: function(res) {
					setTimeout(
						function() {
							const newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page=site-mode&setting=dashboard';
							window.history.pushState({
								path: newurl
							}, '', newurl);
							$('#importing__popup').css('display', 'flex');
							$('.import__content').hide();
							$('.error__content').hide();
							$('.thank__you-content').show();
							$('.sm-modal-success-message').html(`Your ${res.data.template_name} page is ready. Now you can view the page or start customizing it.`)
							$('.sm-modal-content-text .outline_btn').attr('href', res.data?.page_link?.replace('amp;', ''));
							if(res.data.template_name === '404') {
								$('.buttons__wrapper').hide();
							}
						},
						1000
					);
				},
				error: function(error) {
					setTimeout(
						function() {
							$('#importing__popup').css('display', 'flex');
							$('.import__content').hide();
							$('.thank__you-content').hide();
							$('.error__content').show();
						},
						1000
					);
				},
			});
		}
	);
	// Reset to default options functionality
	function handleSettingsClick() {
		const $parentOfAction = $(this).closest('.settings__card');

		if ($(this).hasClass('sm-setting-reset-components')) {
			const $checkboxes = $parentOfAction.find(".settings__card-options--field input[type='checkbox']");
			$checkboxes.prop(
				'checked',
				function() {
					const checkboxValue = $(this).val();
					return checkboxValue === '1' || checkboxValue === 'true';
				}
			);
		} else if ($(this).hasClass('setting__label')) {
			// Toggle checkbox click on labels
			const $checkbox = $(this).siblings('.settings__card-options--field').find("input[type='checkbox']");
			$checkbox.prop(
				'checked',
				function(_, checked) {
					return !checked;
				}
			);
		}
		sendPostMessage();
	}

	$('.setting__label, .sm-setting-reset-components').on('click', handleSettingsClick);
	// On select change fonts/colors
	function setupSelectAndPresets(selectId, presetBoxesClass) {
		$(presetBoxesClass).hide();
		var selectedOption = $(selectId).val();
		$(presetBoxesClass + '[data-preset="' + selectedOption + '"]').show();

		$(selectId).change(
			function() {
				$(presetBoxesClass).hide();
				var selectedOption = $(this).val();
				$(presetBoxesClass + '[data-preset="' + selectedOption + '"]').show();
			}
		);
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
		} else {
			// sidebar.slideLeft(300);
			$('.sm_full_screen').css('display', 'flex');
			$('.sm_exit_full_screen').css('display', 'none');
		}

	}
	$('.sm_full_screen, .sm_exit_full_screen').on('click', toggleSidebar);
	updateSubscribeBoxDisplay();
	$('#show-subscribe-field').change(
		function() {
			updateSubscribeBoxDisplay();
		}
	);
	$('.subscribe_label').click(
		function() {
			$('.subscribe_box').toggle();
			// Change the checkbox value
			$('#show-subscribe-field').prop(
				'checked',
				function(_, checked) {
					return !checked; // Toggle the checkbox value
				}
			);

		}
	);

	function updateSubscribeBoxDisplay() {
		if ($('#show-subscribe-field').is(':checked')) {
			$('.subscribe_box').show();
		} else {
			$('.subscribe_box').hide();
		}
	}
	var initialText = $('.template-category-filter:first').html();
	$('.display_template_name').html(initialText);
	$('.template-category-filter').on(
		'click',
		function() {
			var clickedText = $(this).html();
			$('.display_template_name').html(clickedText);
		}
	)

	// Skip wizard

	$(".close_wizard_btn").on(
		"click",
		function() {
			const nonce = $("#template_init_field").val();

			$.ajax({
				url: ajaxObj.ajax_url,
				dataType: "json",
				method: "post",
				data: {
					action: "ajax_site_mode_skip_wizard",
					template_init_field: nonce,
				},
				success: function(res) {
					const newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page=site-mode';
					window.history.pushState({
						path: newurl
					}, '', newurl);
					location.reload();
				},
				error: function(error) {
					const newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page=site-mode';
					window.history.pushState({
						path: newurl
					}, '', newurl);
					location.reload();
				},
			});
		}
	);

	// Login Page Steps
	/*
	$(".accordion-step h3").on("click", function() {
		// Close all step__content elements
		$('.step__content').slideUp('fast');

		// Open the step__content next to the clicked h3 if it is not already open
		if ($(this).next('.step__content').is(":hidden")) {
			$(this).next('.step__content').slideDown('fast');
		}
	});
	*/
	// Initially hide all accordion contents
	$('.step__content').hide();

	// Initially set icons to 'open' state
	$('.open_option').show();
	$('.close_option').hide();

	$(".accordion-step .accordion-step-title").on("click", function() {
		// Reference the current accordion step
		let currentStep = $(this).closest('.accordion-step');

		// Check if the content of the current step is already open
		if (currentStep.find('.step__content').is(":hidden")) {
			// Close all open contents
			$('.step__content').slideUp('fast');

			// Reset all icons to 'open' state
			$('.open_option').show();
			$('.close_option').hide();

			// Open the clicked content
			currentStep.find('.step__content').slideDown('fast');

			// Change the icon of the current step to 'close' state
			currentStep.find('.open_option').hide();
			currentStep.find('.close_option').show();
		} else {
			// Close the current content
			currentStep.find('.step__content').slideUp('fast');

			// Change the icon of the current step back to 'open' state
			currentStep.find('.open_option').show();
			$('.close_option').hide();
		}
	});

	// Initially hide gradient and image options
	$('.login_background_image, .gradient_background').hide();

	// Set 'solid' as the default selected option
	$('#body_background_type, #form_background_type').val('solid');

	// Handle change event on background_type select element
	$('#body_background_type, #form_background_type').on('change', function() {
		// Get the selected value
		var selectedType = $(this).val();

		// Hide all option rows
		$('.body_login_background_color, .body_login_background_image, .body_gradient_background',).hide();
		$('.form_login_background_color, .form_login_background_image, .form_gradient_background',).hide();

		// Show relevant options based on selected value
		if (selectedType === 'solid') {
			$('.body_login_background_color').show();
			$('.form_login_background_color').show();
		} else if (selectedType === 'gradient') {
			$('.body_gradient_background').show();
			$('.form_gradient_background').show();
		} else if (selectedType === 'image') {
			$('.body_login_background_image').show();
			$('.form_login_background_image').show();
		}
	});

	const stylesSelector = [
		"#show_hide_logo",
		"#logo_image_url",
		"#logo_width",
		"#logo_height",
		"#logo_alignment",
		"#body_background_type",
		"#background_color",
		"#bg_img_url",
		"#first_color",
		"#first_color_location",
		"#second_color",
		"#second_color_location",
		"#gradient_type",
		"#gradient_angle",
		"#form_background_type",
		"#form_background_color",
		"#form_bg_img_url",
		"#form_first_color",
		"#form_first_color_location",
		"#form_second_color",
		"#form_second_color_location",
		"#form_gradient_type",
		"#form_gradient_angle",
	];


	/*
	// Gradient Implementation
	const backgroundType = $('#background_type').val();

	if (backgroundType === 'gradient') {

		const gradientType = $('#gradient_type').val();
		const firstColor = $('#first_color').val();
		const secondColor = $('#second_color').val();
		const firstColorLocation = $('#first_color_location').val();
		const secondColorLocation = $('#second_color_location').val();
		let gradientValue = '';

		if (gradientType === 'linear-gradient') {
			const angle = $('#gradient_angle').val() + 'deg';
			gradientValue = `${gradientType}(${angle}, ${firstColor} ${firstColorLocation}%, ${secondColor} ${secondColorLocation}%)`;
		} else if (gradientType === 'radial-gradient') {
			gradientValue = `${gradientType}(circle, ${firstColor} ${firstColorLocation}%, ${secondColor} ${secondColorLocation}%)`;
		}

		loginStyles['.login']['background-image'] = gradientValue;
	}

	*/



	stylesSelector.forEach(function(selector) {

		$(selector).on('change', function() {
			const loginStyles = {
				"#login h1 a": {
					"display": "inline-block",
					"font-size": "0",
					"overflow": "hidden",
					"text-indent": "-9999px",
					"white-space": "nowrap",
					"margin-bottom": "0",
					"background-size": "100%",
				},
				"#loginform": {
					"border:": "none",
					"background": "transparent",
				}
			};

			stylesSelector.forEach(function(selector) {
				const property = $(selector).attr('data-property');
				const value = $(selector).val();
				const element = $(selector).attr('data-element');
				const cssUnit = $(selector).attr('data-unit') || '';

				if (property && value && element) {
					if(loginStyles[element] === undefined) {
						loginStyles[element] = {};
						if('background-image' === property) {
							loginStyles[element][property] = `url(${value})`;
						} else {
							loginStyles[element][property] = value + cssUnit;
						}
					} else {
						if('background-image' === property) {
							loginStyles[element][property] = `url(${value})`;
						} else {
							loginStyles[element][property] = value + cssUnit;
						}
					}
				}

			});

			const iframe = document.querySelector("#sm-preview-iframe");

			iframe.contentWindow.postMessage({
				loginStyles: loginStyles
			}, "*");

		});
	});


});