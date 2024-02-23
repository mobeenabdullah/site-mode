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

	function loadLoginPageSettings(templateName) {

		const nonce = $("#sm-login-nonce").val();

		$.ajax({
			url: ajaxObj.ajax_url,
			dataType: "json",
			method: "post",
			data: {
				action: "load_site_mode_login_page_settings",
				template: templateName,
				nonce: nonce,
			},
			success: function(res) {

				setTimeout( function() {

					const data = res.data;
					const loginStyles = data?.template_content?.loginStyles;
					const contentHandler = data?.template_content?.loginContentHandler;
					const iframe = document.querySelector("#sm-preview-iframe");
					const contentChangeData = contentHandler ? JSON.parse(contentHandler) : {};
					const loginPageStyles = JSON.parse(loginStyles);

					// loop over object loginPageStyles
					if(Object.keys(loginPageStyles).length > 0) {
						for (const [selector, styles] of Object.entries(loginPageStyles)) {
							if (selector && styles) {
								// loop over object styles
								for (const [property, value] of Object.entries(styles)) {
									if (property && value) {
										// update the value of the editor input field

										if (property === 'background-image') {
											if (value === "url('')") {
												$(`input[data-element="${selector}"][data-property="${property}"]`).val('');
												$('#form_background_type').val('image').trigger('change');
											} else if (value.includes('linear-gradient')) {
												const gradientString = value;
												const gradientRegex = /linear-gradient\((\d+)deg,\s*(#\w+)\s*(\d+%)?,\s*(#\w+)\s*(\d+%)?\)/;
												const match = gradientString.match(gradientRegex);
												const angle = match[1];
												const firstColor = match[2];
												const firstColorLocation = match[3];
												const secondColor = match[4];
												const secondColorLocation = match[5];

												$(`input[data-element="${selector}"][data-property="first-color"]`).val(firstColor);
												$(`input[data-element="${selector}"][data-property="first-color-location"]`).val(firstColorLocation.replace('%', '') || 0);
												$(`input[data-element="${selector}"][data-property="second-color"]`).val(secondColor);
												$(`input[data-element="${selector}"][data-property="second-color-location"]`).val(secondColorLocation.replace('%', '') || 0);
												$(`input[data-element="${selector}"][data-property="angle"]`).val(angle);
												$('#form_gradient_type').val('linear-gradient');
												$('#form_background_type').val('gradient').trigger('change');
											} else if (value.includes('radial-gradient')) {
												const gradientString = value;
												// Define regular expressions for extracting values
												const gradientRegex = /radial-gradient\((\w+),\s*(#\w+)\s*(\d+%)?,\s*(#\w+)\s*(\d+%)?\)/;

												// Match the string against the regular expression
												const match = value.match(gradientRegex);

												if (match) {
													// Extract values from the matched groups
													const firstColor = match[2];
													const firstColorLocation = match[3] || "0%";
													const secondColor = match[4];
													const secondColorLocation = match[5] || "100%";

													$(`input[data-element="${selector}"][data-property="first-color"]`).val(firstColor);
													$(`input[data-element="${selector}"][data-property="first-color-location"]`).val(firstColorLocation.replace('%', '') || 0);
													$(`input[data-element="${selector}"][data-property="second-color"]`).val(secondColor);
													$(`input[data-element="${selector}"][data-property="second-color-location"]`).val(secondColorLocation.replace('%', '') || 0);
													$('#form_gradient_type').val('radial-gradient');
													$('#form_background_type').val('gradient').trigger('change');
												} else {
													$(`input[data-element="${selector}"][data-property="${property}"]`).val(value.replace('url(', '').replace(')', ''));
												}


											} else if (value.includes('px')) {
												$(`input[data-element="${selector}"][data-property="${property}"]`).val(value.replace('px', ''));
											} else {
												$(`input[data-element="${selector}"][data-property="${property}"]`).val(value);
											}
										}
									}
								}
							}
						}

						iframe.contentWindow.postMessage({
								loginStyles: loginStyles,
							},
							"*"
						)
					}

					if (contentChangeData && Object.keys(contentChangeData).length > 0) {
						// loop over object contentHandler
						for (const [selector, content] of Object.entries(contentChangeData)) {
							if(selector && content.value) {
								// update the value of the editor input field
								$(`input[data-element="${selector}"]`).val(content.value);
								// send the message to the iframe to update the content
								iframe.contentWindow.postMessage({
										contentHandler: JSON.stringify({
											[`${selector}`]: {
												"target": content?.target,
												"value": content.value
											}
										}),
									},
									"*"
								)
							}
						}
					}
				}, 1000);

			},
			error: function(error) {
				console.log(error);
			},
		});
	}

	// Go to select template page
	function selectTemplate() {
		const templateLabel = $(this).attr('data-template-label');
		const templateCategory = $(this).attr('data-category-template');
		$('.template__name').html(templateLabel);
		// const templateName = $(this).attr('data-template-name');

		removeElementClass('.wizard__templates-cards--single', 'active');
		$('.wizard__templates-cards--single button span').html('select');
		$(this).parents('.wizard__templates-cards--single').addClass('active');
		$(this).children('span').html('Selected');
		hideElements('.wizard__start, .wizard__content-wrapper, .sm_final_import, .import__actions');
		showElements('.sm_customize_settings, .customize__sidebar-content, .component__settings, .customize__actions');
		addElementClass('.sm-customize', 'active');
		addElementClass('.sm__wizard-wrapper', 'sm_add_scroll');

		const templateName = $(this).parents('.wizard__templates-cards--single').attr('data-category-template');
		let templateSlug = `https://site-mode.com/${templateName}`;

		if('template-9' === templateName || 'template-10' === templateName) {
			templateSlug = `${window.location.origin}/wp-login.php`;
			loadLoginPageSettings(templateName);
		}


		$('#sm-login-preview').hide();
		$('#sm-preview-iframe').attr('src', templateSlug);
		$('#sm-preview-iframe').show();
		$(".sm__templates-components").show();
		$(".sm__login-styles").hide();
		$('.template-components.settings__card').show();


		$('#selected-template-name').val(templateName);
		$('.sm-setting-reset-components').trigger('click');
		$('#color_scheme').val('default').trigger('change');
		removeElementClass('.select_template_btn', 'disabled__customize');
		removeElementAttribute('.select_template_btn', 'disabled', 'disabled');
		$('.loading__template').css('display', 'flex');
		setTimeoutForTemplate();
		if("login" === templateCategory) {
			$(".sm__templates-components").hide();
			$(".form__settings").show();
		} else {
			$(".sm__templates-components").show();
			$(".form__settings").hide();
		}
	}
	$('.select_template').on('click', selectTemplate);

	function setTimeoutForTemplate() {
		setTimeout(
		function() {
				$('#sm-preview-iframe').css('display', 'block');
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
		const templateCategory = $(".template_card.active .select_template").attr('data-category-template');
		$('#selected-template-name').val(templateName);

		let templateSlug = `https://site-mode.com/${templateName}`;

		if('template-9' === templateName || 'template-10' === templateName) {
			templateSlug = `${window.location.origin}/wp-login.php`;
		}
		$('#sm-login-preview').hide();
		$('#sm-preview-iframe').attr('src', templateSlug);
		$('#sm-preview-iframe').show();
		$(".sm__login-styles").hide();
		$(".sm__templates-components").show();

		hideElements('.sm_final_import, .wizard__start, .wizard__content-wrapper, .import__settings, .import__actions');
		showElements('.sm_customize_settings, .component__settings, .customize__actions');
		addElementClass('.sm-customize', 'active');
		addElementClass('.sm__wizard-wrapper', 'sm_add_scroll');
		$('.loading__template').css('display', 'flex');
		setTimeoutForTemplate();
		if("login" === templateCategory) {
			$(".sm__templates-components").hide();
			$(".form__settings").show();
		} else {
			$(".sm__templates-components").show();
			$(".form__settings").hide();
		}
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
			const isLoginPreview = 'template-9' === templateName || 'template-10' === templateName;

			if (!templateName) {
				alert('Please Select Template!');
				return
			}

			const data = {
				action: "ajax_site_mode_template_init",
				template: templateName,
				template_init_field: nonce,
				category: category,
			}

			if(isLoginPreview) {
				data.loginStyles = getLoginPageStyles();
				data.loginContentHandler = JSON.stringify(contentChangeData);
			} else {
				data.colorScheme = colorScheme;
				data.showCountdown = showCountdown;
				data.showSocial = showSocial;
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

	// Refactored function to handle change events
	function handleBackgroundTypeChange(selectorPrefix, selectedType) {

		// Define the class selectors for different background types
		const backgroundTypes = {
			'solid': `${selectorPrefix}_login_background_color`,
			'gradient': `${selectorPrefix}_gradient_background`,
			'image': `${selectorPrefix}_login_background_image`
		};

		// Hide all options first
		Object.values(backgroundTypes).forEach(selector => $(`.${selector}`).hide());

		// Show relevant option based on selectedType
		const showSelector = backgroundTypes[selectedType];
		if (showSelector) {
			$(`.${showSelector}`).show();
		}
	}

	// Event listener for form background type
	$('#form_background_type').on('change', function() {
		const selectedType = $(this).val();
		handleBackgroundTypeChange('form', selectedType);
	});

	// Event listener for body background type
	$('#body_background_type').on('change', function() {
		const selectedType = $(this).val();
		handleBackgroundTypeChange('body', selectedType);
	});

	// login common page styles
	const loginStyles = {
		"body.login #login h1": {
			"width": "100%",
		},
		"body.login #login h1 a": {
			"display": "inline-block",
			"font-size": "0",
			"overflow": "hidden",
			"text-indent": "-9999px",
			"white-space": "nowrap",
			"margin-bottom": "0",
			"background-size": "100%",
		},

		"body.login #login": {
			"display": "flex",
			"flex-direction": "column",
			"align-items": "center",
			"border-width": "1px",
			"border-style": "solid",
			"border-color": "transparent",
			"background-color": "transparent",
		},
		"body.login #login form#loginform": {
			"border-color": "transparent",
			"background-color": "transparent",
			"width": "100%",
			"box-shadow": "none",
			"border": "none",
			"padding": "0",
			"margin": "0",
		},
		"body.login #login #loginform input[type='submit']" : {
			"width": "100%",
		}
	};

	// Apply styles
	for (const selector in loginStyles) {
		const elements = document.querySelectorAll(selector);
		elements.forEach(element => {
			const styles = loginStyles[selector];
			for (const property in styles) {
				element.style[property] = styles[property];
			}
		});
	}

	const generalStylesSelector = [
		"#show_hide_logo",
		"#logo_image_url",
		"#logo_width",
		"#logo_height",
		"#logo_alignment",
		"#form_width",
		"#form_height",
		"#border_color",
		"#border_style",
		"#border_width_top",
		"#border_width_right",
		"#border_width_bottom",
		"#border_width_left",
		"#border_radius_top",
		"#border_radius_right",
		"#border_radius_bottom",
		"#border_radius_left",
		"#form_container_bg",
		"#form_margins_top",
		"#form_margins_right",
		"#form_margins_bottom",
		"#form_margins_left",
		"#form_padding_top",
		"#form_padding_right",
		"#form_padding_bottom",
		"#form_padding_left",
		"#label_text_color",
		"#label_text_size",
		"#label_margins_top",
		"#label_margins_right",
		"#label_margins_bottom",
		"#label_margins_left",
		"#input_bg_color",
		"#input_text_color",
		"#input_text_size",
		"#input_margins_top",
		"#input_margins_right",
		"#input_margins_bottom",
		"#input_margins_left",
		"#input_padding_top",
		"#input_padding_right",
		"#input_padding_bottom",
		"#input_padding_left",
		"#input_border_color",
		"#input_border_style",
		"#input_border_width_top",
		"#input_border_width_right",
		"#input_border_width_bottom",
		"#input_border_width_left",
		"#input_border_radius_top",
		"#input_border_radius_right",
		"#input_border_radius_bottom",
		"#input_border_radius_left",
		"#button_bg_color",
		"#button_text_color",
		"#button_text_size",
		"#button_margins_top",
		"#button_margins_right",
		"#v_margins_bottom",
		"#button_margins_left",
		"#button_padding_top",
		"#button_padding_right",
		"#button_padding_bottom",
		"#button_padding_left",
		"#button_border_color",
		"#button_border_style",
		"#button_border_width_top",
		"#button_border_width_right",
		"#button_border_width_bottom",
		"#button_border_width_left",
		"#button_border_radius_top",
		"#button_border_radius_right",
		"#button_border_radius_bottom",
		"#button_border_radius_left",
		"#button_level"
	];

	const classicStylesSelector = [
		"#form_background_type",
		"#form_bg_img_url",
		"#form_first_color",
		"#form_first_color_location",
		"#form_second_color",
		"#form_second_color_location",
		"#form_gradient_type",
		"#form_gradient_angle",
		"#body_background_type",
		"#background_color",
		"#bg_img_url",
		"#first_color",
		"#first_color_location",
		"#second_color",
		"#second_color_location",
		"#gradient_type",
		"#gradient_angle",
		"#shadow_color",
		"#shadow_horizontal_position",
		"#shadow_vertical_position",
		"#shadow_blur_spread",
	];

	// Apply gradient
	const gradientSelectors = {
		"body.login #login" : {
			"type" : "#form_background_type",
			"bg_color" : "#form_container_bg",
			"img_url" : "#form_bg_img_url",
			"first_color" : "#form_first_color",
			"first_color_location" : "#form_first_color_location",
			"second_color" : "#form_second_color",
			"second_color_location" : "#form_second_color_location",
			"gradient_type" : "#form_gradient_type",
			"gradient_angle" : "#form_gradient_angle"
		},
		"body.login" : {
			"type" : "#body_background_type",
			"bg_color" : "#background_color",
			"img_url" : "#bg_img_url",
			"first_color" : "#first_color",
			"first_color_location" : "#first_color_location",
			"second_color" : "#second_color",
			"second_color_location" : "#second_color_location",
			"gradient_type" : "#gradient_type",
			"gradient_angle" : "#gradient_angle"
		}
	};


	// content selectors
	const contentSelectors = [
		"#username_label",
		"#password_label",
		"#remember_label",
		"#submit_label",
		"#button_text_label",
		"#button_text_label",
		"#lost_pass_text",
		"#back_to_website"
	];

	const shadowSelectors = {
		"body.login #login" : {
			"shadow_color" : "#shadow_color",
			"shadow_x" : "#shadow_horizontal_position",
			"shadow_y" : "#shadow_vertical_position",
			"shadow_blur" : "#shadow_blur_spread",
		}
	}


	const contentChangeData = {};

	// content change handler
	contentSelectors.forEach(function(selector) {
		$(selector).on('change', function() {
			const iframe = document.querySelector("#sm-preview-iframe");
			const element = $(selector).attr('data-element');
			const target = $(selector).attr('data-target');
			const value = $(selector).val();

			if(contentChangeData[element] === undefined) {
				contentChangeData[element] = {};
				contentChangeData[element]['value'] = value;
				contentChangeData[element]['target'] = target;

				if(target === "text") {
					contentChangeData[element]['script'] = `document.querySelector("${element}").innerHTML = '${value}';`
				} else {
					contentChangeData[element]['script'] = `document.querySelector("${element}").${target} = '${value}';`
				}

			} else {
				contentChangeData[element]['value'] = value;
				contentChangeData[element]['target'] = target;
				if(target === "text") {
					contentChangeData[element]['script'] = `document.querySelector("${element}").innerHTML = '${value}';`
				} else {
					contentChangeData[element]['script'] = `document.querySelector("${element}").${target} = '${value}';`
				}
			}

			iframe.contentWindow.postMessage({
					contentHandler: JSON.stringify({
						[`${element}`]: {
							"target": target,
							"value": value
						}
					}),
				},
				"*"
			)
		});

	});


	[...generalStylesSelector, ...classicStylesSelector].forEach(function(selector) {
		$(selector).on('change', function() {
			const allLoginStyles = getLoginPageStyles();
			const iframe = document.querySelector("#sm-preview-iframe");

			iframe.contentWindow.postMessage({
					loginStyles: allLoginStyles,
				},
				"*"
			)
		});
	});

	// get login page styles
	function getLoginPageStyles() {
		const styles = {...loginStyles};
		generalStylesSelector.forEach(function(selector) {
			const property = $(selector).attr('data-property');
			const value = $(selector).val();
			const element = $(selector).attr('data-element');
			let cssUnit = $(selector).attr('data-unit') || '';

			if (property && value && element) {

				if (property && value && element) {
					if( value === 'auto' ) {
						cssUnit = '';
					}
					if (styles[element] === undefined) {
						styles[element] = {};
					}
					if ('background-image' === property) {
						styles[element][property] = `url(${value})`;
					} else {
						styles[element][property] = value + cssUnit;
					}
				}
			}

		});

		for (const gradientSelectorKey in gradientSelectors) {

			const element = gradientSelectorKey;
			const type = $(gradientSelectors[gradientSelectorKey].type).val();

			if(!styles[element]) {
				styles[element] = {};
			}

			if(type === 'gradient') {
				const first_color = $(gradientSelectors[gradientSelectorKey].first_color).val();
				const first_color_location = $(gradientSelectors[gradientSelectorKey].first_color_location).val();
				const second_color = $(gradientSelectors[gradientSelectorKey].second_color).val();
				const second_color_location = $(gradientSelectors[gradientSelectorKey].second_color_location).val();
				const gradient_type = $(gradientSelectors[gradientSelectorKey].gradient_type).val();
				const gradient_angle = $(gradientSelectors[gradientSelectorKey].gradient_angle).val();

				if(gradient_type === 'linear-gradient') {
					styles[element]['background-image'] = `linear-gradient(${gradient_angle}deg, ${first_color} ${first_color_location}%, ${second_color} ${second_color_location}%)`;
				} else {
					styles[element]['background-image'] = `radial-gradient(circle, ${first_color} ${first_color_location}%, ${second_color} ${second_color_location}%)`;
				}
			} else if(type === 'image') {
				const img_url = $(gradientSelectors[gradientSelectorKey].img_url).val();
				styles[element]['background-image'] = `url('${img_url}')`;
			} else {
				const bg_color = $(gradientSelectors[gradientSelectorKey].bg_color).val();
				styles[element]['background-image'] = `url('')`;
				styles[element]['background-color'] = bg_color;
			}
		}

		for (const shadowSelectorKey in shadowSelectors) {
			console.log(shadowSelectorKey);
			const element = shadowSelectorKey;

			if(!styles[element]) {
				styles[element] = {};
			}
			const shadow_color = $(shadowSelectors[shadowSelectorKey].shadow_color).val();
			const shadow_x = $(shadowSelectors[shadowSelectorKey].shadow_x).val();
			const shadow_y = $(shadowSelectors[shadowSelectorKey].shadow_y).val();
			const shadow_blur = $(shadowSelectors[shadowSelectorKey].shadow_blur).val();

			styles[element]['box-shadow'] = `${shadow_x}px ${shadow_y}px ${shadow_blur}px ${shadow_color}`;
		}

		return JSON.stringify(styles);
	}
});
