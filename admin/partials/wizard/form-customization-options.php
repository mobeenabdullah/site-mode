<div class="component__settings" style="display: block;">
    <div class="component__settings-cover">
        <div class="settings__card">
            <div class="settings__card-title">
                <h2 class="settings_card_heading">Login Form Settings</h2>
            </div>
            <div class="settings__card-options sm__accordion">
                <!-- Logo Options -->
                <div class="settings__card-options-box">
                    <div class="accordion-step">
                        <div class="accordion-step-title">
                            <span class="open_option" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></svg></span>
                            <span class="close_option"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z"></path></svg></span>
                            <h3>Logo Option</h3>
                        </div>
                        <div class="step__content">
                            <div class="step__content-options">
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="show_hide_logo">Hide logo</label>
                                    </div>
                                    <div class="row__option-field">
                                        <select id="show_hide_logo" data-property="display" data-element=".login #login h1">
                                            <option value="block">Yes</option>
                                            <option value="none">No</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Option Row end -->

                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="logo_image_url">Enter image URL</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="url" value="" id="logo_image_url" placeholder="Enter logo url" data-property="background-image" data-element=".login #login h1 a">
                                    </div>
                                </div>
                                <!-- Option Row end -->

                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="logo_width">Logo width</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="logo_width" value="84" data-property="width" data-element=".login #login h1 a" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="logo_height">Logo height</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="logo_height" value="84" data-property="height" data-element=".login #login h1 a" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="logo_alignment">Logo alignment</label>
                                    </div>
                                    <div class="row__option-field">
                                        <select id="logo_alignment" data-property="text-align" data-element=".login #login h1">
                                            <option value="center">Center</option>
                                            <option value="left">Left</option>
                                            <option value="right">Right</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="logo_link">Logo link</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="url" id="logo_link" value="" placeholder="Enter logo link" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="logo_title">Logo title</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="text" id="logo_title" value="" placeholder="Enter logo title" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Logo Options End -->
                <!-- Background Options -->
                <div class="settings__card-options-box">
                    <div class="accordion-step">
                        <div class="accordion-step-title">
                            <span class="open_option" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></svg></span>
                            <span class="close_option"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z"></path></svg></span>
                            <h3>Background Option</h3>
                        </div>
                        <div class="step__content">
                            <div class="step__content-options">
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="body_background_type">Background Type</label>
                                    </div>
                                    <div class="row__option-field">
                                        <select id="body_background_type">
                                            <option value="solid">Solid</option>
                                            <option value="gradient">Gradient</option>
                                            <option value="image">Image</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row__option body_login_background_color" style="display: flex;">
                                    <div class="row__option-label">
                                        <label for="background_color">Background Color</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="color" id="background_color" value="#ffffff" data-property="background-color" data-element=".login">
                                    </div>
                                </div>
                                <!-- Option Row end -->

                                <!-- Option Row start -->
                                <div class="row__option body_login_background_image" style="display: none;">
                                    <div class="row__option-label">
                                        <label for="bg_img_url">Enter image URL</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="url" value="" id="bg_img_url" placeholder="Enter logo url" data-property="background-image" data-element=".login">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <div class="body_gradient_background" style="display: none;">
                                    <!-- Option Row start -->
                                    <div class="row__option">
                                        <div class="row__option-label">
                                            <label for="first_color">First Color</label>
                                        </div>
                                        <div class="row__option-field">
                                            <input type="color" id="first_color" value="#ffffff"  data-property="background-image" data-element=".login">
                                        </div>
                                    </div>
                                    <!-- Option Row end -->
                                    <!-- Option Row start -->
                                    <div class="row__option">
                                        <div class="row__option-label">
                                            <label for="first_color_location">Location</label>
                                        </div>
                                        <div class="row__option-field">
                                            <input type="number" id="first_color_location" value="24%"  data-property="background-image" data-element=".login">
                                        </div>
                                    </div>
                                    <!-- Option Row end -->
                                    <!-- Option Row start -->
                                    <div class="row__option">
                                        <div class="row__option-label">
                                            <label for="second_color">Second Color</label>
                                        </div>
                                        <div class="row__option-field">
                                            <input type="color" id="second_color" value="#000000" data-property="background-image" data-element=".login">
                                        </div>
                                    </div>
                                    <!-- Option Row end -->
                                    <!-- Option Row start -->
                                    <div class="row__option">
                                        <div class="row__option-label">
                                            <label for="second_color_location">Location</label>
                                        </div>
                                        <div class="row__option-field">
                                            <input type="number" id="second_color_location" value="100%" data-property="background-image" data-element=".login">
                                        </div>
                                    </div>
                                    <!-- Option Row end -->
                                    <!-- Option Row start -->
                                    <div class="row__option">
                                        <div class="row__option-label">
                                            <label for="gradient_type">Gradient Type</label>
                                        </div>
                                        <div class="row__option-field">
                                            <select id="gradient_type" data-property="background-image" data-element=".login">
                                                <option value="linear-gradient">Linear</option>
                                                <option value="radial-gradient">Radial</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Option Row end -->
                                    <!-- Option Row start -->
                                    <div class="row__option">
                                        <div class="row__option-label">
                                            <label for="gradient_angle">Angle</label>
                                        </div>
                                        <div class="row__option-field">
                                            <input type="number" id="gradient_angle" value="200" data-property="background-image" data-element=".login">
                                        </div>
                                    </div>
                                    <!-- Option Row end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Background Options End -->
                <!-- Form Container Options -->
                <div class="settings__card-options-box">
                    <div class="accordion-step">
                        <div class="accordion-step-title">
                            <span class="open_option" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></svg></span>
                            <span class="close_option"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z"></path></svg></span>
                            <h3>Form Container</h3>
                        </div>
                        <div class="step__content">
                            <div class="step__content-options">
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="form_width">Width</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="form_width" value="320" data-property="width" data-element="body.login #login" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="form_height">Height</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="form_height" value="auto" data-property="height" data-element="body.login #login" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="border_color">Border Color</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="color" id="border_color" value="200" data-property="border-color" data-element="body.login #login">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="border_style">Border Style</label>
                                    </div>
                                    <div class="row__option-field">
                                        <select class="border_style" id="border_style" data-property="border-style" data-element="body.login #login">
                                            <option value="none">None</option>
                                            <option value="dotted">Dotted</option>
                                            <option value="inset">Inset</option>
                                            <option value="dashed solid">Dashed Solid</option>
                                            <option value="double">Double</option>
                                            <option value="solid">Solid</option>
                                            <option value="dashed">Dashed</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Option Row end -->

                                <!-- Option Row start -->
                                <div class="row__option fields_4_cols">
                                    <div class="row__option-label">
                                        <label for="border_width_top">Border Width</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="border_width_top" value="1" data-property="border-top-width" data-element="body.login #login" data-unit="px">
                                        <input type="number" id="border_width_right" value="1" data-property="border-right-width" data-element="body.login #login" data-unit="px">
                                        <input type="number" id="border_width_bottom" value="1" data-property="border-bottom-width" data-element="body.login #login" data-unit="px">
                                        <input type="number" id="border_width_left" value="1" data-property="border-left-width" data-element="body.login #login" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option fields_4_cols">
                                    <div class="row__option-label">
                                        <label for="border_radius_top">Border Radius</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="border_radius_top" value="5" data-property="border-top-left-radius" data-element="body.login #login" data-unit="px">
                                        <input type="number" id="border_radius_right" value="5" data-property="border-top-right-radius" data-element="body.login #login" data-unit="px">
                                        <input type="number" id="border_radius_bottom" value="5" data-property="border-bottom-right-radius" data-element="body.login #login" data-unit="px">
                                        <input type="number" id="border_radius_left" value="5" data-property="border-bottom-left-radius" data-element="body.login #login" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="shadow_color">Shadow Color</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="color" id="shadow_color" value="200" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="shadow_horizontal_position">Shadow Horizontal Position</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="shadow_horizontal_position" value="200" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="shadow_vertical_position">Shadow Vertical Position</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="shadow_vertical_position" value="200" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="shadow_blur_spread">Shadow Blur/Spread</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="shadow_blur_spread" value="200" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->

                                <!-- Option Row start -->
                                <div class="row__option fields_4_cols">
                                    <div class="row__option-label">
                                        <label for="form_margins_top">Margins</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="text" id="form_margins_top" value="auto" data-property="margin-top" data-element="body.login #login" data-unit="px">
                                        <input type="text" id="form_margins_right" value="auto" data-property="margin-right" data-element="body.login #login" data-unit="px">
                                        <input type="text" id="form_margins_bottom" value="auto" data-property="margin-bottom" data-element="body.login #login" data-unit="px">
                                        <input type="text" id="form_margins_left" value="auto" data-property="margin-left" data-element="body.login #login" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option fields_4_cols">
                                    <div class="row__option-label">
                                        <label for="form_padding_top">Padding</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="form_padding_top" value="0" data-property="padding-top" data-element="body.login #login" data-unit="px">
                                        <input type="number" id="form_padding_right" value="0" data-property="padding-bottom" data-element="body.login #login" data-unit="px">
                                        <input type="number" id="form_padding_bottom" value="0" data-property="padding-right" data-element="body.login #login" data-unit="px">
                                        <input type="number" id="form_padding_left" value="0" data-property="padding-left" data-element="body.login #login" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->


                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form Container Options End-->
                <!-- Form Background Options -->
                <div class="settings__card-options-box">
                    <div class="accordion-step">
                        <div class="accordion-step-title">
                            <span class="open_option" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></svg></span>
                            <span class="close_option"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z"></path></svg></span>
                            <h3>Form Background</h3>
                        </div>
                        <div class="step__content">
                            <div class="step__content-options">
                                <div class="step__content-options">
                                    <!-- Option Row start -->
                                    <div class="row__option">
                                        <div class="row__option-label">
                                            <label for="form_background_type">Background Type</label>
                                        </div>
                                        <div class="row__option-field">
                                            <select id="form_background_type">
                                                <option value="solid">Solid</option>
                                                <option value="gradient">Gradient</option>
                                                <option value="image">Image</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Option Row start -->
                                    <div class="row__option form__background_color" style="display: flex;">
                                        <div class="row__option-label">
                                            <label for="form_container_bg">Background</label>
                                        </div>
                                        <div class="row__option-field">
                                            <input type="color" id="form_container_bg" value="#ffffff" data-property="background-color" data-element="body.login #login">
                                        </div>
                                    </div>
                                    <!-- Option Row end -->

                                    <!-- Option Row start -->
                                    <div class="row__option form_login_background_image" style="display: none;">
                                        <div class="row__option-label">
                                            <label for="form_bg_img_url">Enter image URL</label>
                                        </div>
                                        <div class="row__option-field">
                                            <input type="url" value="" id="form_bg_img_url" placeholder="Enter logo url" data-property="background-image" data-element="body.login #login">
                                        </div>
                                    </div>
                                    <!-- Option Row end -->
                                    <div class="form_gradient_background" style="display: none;">
                                        <!-- Option Row start -->
                                        <div class="row__option">
                                            <div class="row__option-label">
                                                <label for="form_first_color">First Color</label>
                                            </div>
                                            <div class="row__option-field">
                                                <input type="color" id="form_first_color" value="#ffffff"  data-property="background-image" data-element="body.login #login">
                                            </div>
                                        </div>
                                        <!-- Option Row end -->
                                        <!-- Option Row start -->
                                        <div class="row__option">
                                            <div class="row__option-label">
                                                <label for="form_first_color_location">Location</label>
                                            </div>
                                            <div class="row__option-field">
                                                <input type="number" id="form_first_color_location" value="24%"  data-property="background-image" data-element="body.login #login">
                                            </div>
                                        </div>
                                        <!-- Option Row end -->
                                        <!-- Option Row start -->
                                        <div class="row__option">
                                            <div class="row__option-label">
                                                <label for="form_second_color">Second Color</label>
                                            </div>
                                            <div class="row__option-field">
                                                <input type="color" id="form_second_color" value="#000000" data-property="background-image" data-element="body.login #login">
                                            </div>
                                        </div>
                                        <!-- Option Row end -->
                                        <!-- Option Row start -->
                                        <div class="row__option">
                                            <div class="row__option-label">
                                                <label for="form_second_color_location">Location</label>
                                            </div>
                                            <div class="row__option-field">
                                                <input type="number" id="form_second_color_location" value="100%" data-property="background-image" data-element="body.login #login">
                                            </div>
                                        </div>
                                        <!-- Option Row end -->
                                        <!-- Option Row start -->
                                        <div class="row__option">
                                            <div class="row__option-label">
                                                <label for="form_gradient_type">Gradient Type</label>
                                            </div>
                                            <div class="row__option-field">
                                                <select id="form_gradient_type" data-property="background-image" data-element="body.login #login">
                                                    <option value="linear-gradient">Linear</option>
                                                    <option value="radial-gradient">Radial</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Option Row end -->
                                        <!-- Option Row start -->
                                        <div class="row__option">
                                            <div class="row__option-label">
                                                <label for="form_gradient_angle">Angle</label>
                                            </div>
                                            <div class="row__option-field">
                                                <input type="number" id="form_gradient_angle" value="200" data-property="background-image" data-element="body.login #login">
                                            </div>
                                        </div>
                                        <!-- Option Row end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form Background Options End -->
                <!-- Form Labels Options -->
                <div class="settings__card-options-box">
                    <div class="accordion-step">
                        <div class="accordion-step-title">
                            <span class="open_option" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></svg></span>
                            <span class="close_option"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z"></path></svg></span>
                            <h3>Form Labels Styles</h3>
                        </div>
                        <div class="step__content">
                            <div class="step__content-options">
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="label_text_color">Text Color</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="color" id="label_text_color" value="200" data-property="color" data-element="body.login #login label">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="label_text_size">Text Size</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="label_text_size" value="16" data-property="font-size" data-element="body.login #login label" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option fields_4_cols">
                                    <div class="row__option-label">
                                        <label for="label_margins_top">Margins</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="label_margins_top" value="10" data-property="margin-top" data-element="body.login #login label" placeholder="Top" data-unit="px">
                                        <input type="number" id="label_margins_right" value="10" data-property="margin-right" data-element="body.login #login label" placeholder="Right" data-unit="px">
                                        <input type="number" id="label_margins_bottom" value="10" data-property="margin-bottom" data-element="body.login #login label" placeholder="Bottom" data-unit="px">
                                        <input type="number" id="label_margins_left" value="10" data-property="margin-left" data-element="body.login #login label" placeholder="Left" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form Labels Options End -->
                <!-- Form Inputs Options -->
                <div class="settings__card-options-box">
                    <div class="accordion-step">
                        <div class="accordion-step-title">
                            <span class="open_option" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></svg></span>
                            <span class="close_option"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z"></path></svg></span>
                            <h3>Form Inputs</h3>
                        </div>
                        <div class="step__content">
                            <div class="step__content-options">
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="input_bg_color">Background Color</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="color" id="input_bg_color" value="#ffffff" data-property="background-color" data-element="body.login #login #loginform input:not([type='submit'])">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="input_text_color">Text Color</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="color" id="input_text_color" value="#000000" data-property="color" data-element="body.login #login #loginform input:not([type='submit'])">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="input_text_size">Text Size</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="input_text_size" value="16" data-property="font-size" data-element="body.login #login #loginform input:not([type='submit'])" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="input_border_color">Border Color</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="color" id="input_border_color" value="#000000" data-property="border-color" data-element="body.login #login #loginform input:not([type='submit'])">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="input_border_style">Border Style</label>
                                    </div>
                                    <div class="row__option-field">
                                        <select class="input_border_style" id="input_border_style" data-property="border-style" data-element="body.login #login #loginform input:not([type='submit'])">
                                            <option value="solid">Solid</option>
                                            <option value="dotted">Dotted</option>
                                            <option value="dashed">Dashed</option>
                                            <option value="double">Double</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Option Row end -->

                                <!-- Option Row start -->
                                <div class="row__option fields_4_cols">
                                    <div class="row__option-label">
                                        <label for="input_border_width_top">Border Width</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="input_border_width_top" value="1" data-property="border-top-width" data-element="body.login #login #loginform input:not([type='submit'])" data-unit="px">
                                        <input type="number" id="input_border_width_right" value="1" data-property="border-right-width" data-element="body.login #login #loginform input:not([type='submit'])" data-unit="px">
                                        <input type="number" id="input_border_width_bottom" value="1" data-property="border-bottom-width" data-element="body.login #login #loginform input:not([type='submit'])" data-unit="px">
                                        <input type="number" id="input_border_width_left" value="1" data-property="border-left-width" data-element="body.login #login #loginform input:not([type='submit'])" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option fields_4_cols">
                                    <div class="row__option-label">
                                        <label for="input_border_radius_top">Border Radius</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="input_border_radius_top" value="4" data-property="border-top-left-radius" data-element="body.login #login #loginform input:not([type='submit'])" data-unit="px">
                                        <input type="number" id="input_border_radius_right" value="4" data-property="border-top-right-radius" data-element="body.login #login #loginform input:not([type='submit'])" data-unit="px">
                                        <input type="number" id="input_border_radius_bottom" value="4" data-property="border-bottom-right-radius" data-element="body.login #login #loginform input:not([type='submit'])" data-unit="px">
                                        <input type="number" id="input_border_radius_left" value="4" data-property="border-bottom-left-radius" data-element="body.login #login #loginform input:not([type='submit'])" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option fields_4_cols">
                                    <div class="row__option-label">
                                        <label for="input_margins_top">Margins</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="input_margins_top" value="0" data-property="margin-top" data-element="body.login #login #loginform input:not([type='submit'])" placeholder="Top" data-unit="px">
                                        <input type="number" id="input_margins_right" value="0" data-property="margin-right" data-element="body.login #login #loginform input:not([type='submit'])" placeholder="Right" data-unit="px">
                                        <input type="number" id="input_margins_bottom" value="0" data-property="margin-bottom" data-element="body.login #login #loginform input:not([type='submit'])" placeholder="Bottom" data-unit="px">
                                        <input type="number" id="input_margins_left" value="0" data-property="margin-left" data-element="body.login #login #loginform input:not([type='submit'])" placeholder="Left" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option fields_4_cols">
                                    <div class="row__option-label">
                                        <label for="input_padding_top">Paddings</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="input_padding_top" value="10" data-property="padding-top" data-element="body.login #login #loginform input:not([type='submit'])" placeholder="Top" data-unit="px">
                                        <input type="number" id="input_padding_right" value="10" data-property="padding-right" data-element="body.login #login #loginform input:not([type='submit'])" placeholder="Right" data-unit="px">
                                        <input type="number" id="input_padding_bottom" value="10" data-property="padding-bottom" data-element="body.login #login #loginform input:not([type='submit'])" placeholder="Bottom" data-unit="px">
                                        <input type="number" id="input_padding_left" value="10" data-property="padding-left" data-element="body.login #login #loginform input:not([type='submit'])" placeholder="Left" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="input_shadow_color">Shadow Color</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="color" id="input_shadow_color" value="200" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="input_shadow_horizontal_position">Shadow Horizontal Position</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="input_shadow_horizontal_position" value="200" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="input_shadow_vertical_position">Shadow Vertical Position</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="input_shadow_vertical_position" value="200" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="input_shadow_blur_spread">Shadow Blur/Spread</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="input_shadow_blur_spread" value="200" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form Inputs Options End -->
                <!-- Form Button Styles Options -->
                <div class="settings__card-options-box">
                    <div class="accordion-step">
                        <div class="accordion-step-title">
                            <span class="open_option" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></svg></span>
                            <span class="close_option"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z"></path></svg></span>
                            <h3>Button Styles</h3>
                        </div>
                        <div class="step__content">
                            <div class="step__content-options">
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="button_bg_color">Background Color</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="color" id="button_bg_color" value="200" data-property="background-color" data-element="body.login #login #loginform input[type='submit']">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="button_text_color">Text Color</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="color" id="button_text_color" value="200" data-property="color" data-element="body.login #login #loginform input[type='submit']">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="button_text_size">Text Size</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="button_text_size" value="16" data-property="font-size" data-element="body.login #login #loginform input[type='submit']" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="button_level">Button Level</label>
                                    </div>
                                    <div class="row__option-field">
                                        <select value="200" id="button_level" data-property="display" data-element="body.login #login #loginform input[type='submit']">
                                            <option value="inline-block">Default</option>
                                            <option value="block">Full width</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="button_border_color">Border Color</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="button_border_color" value="1" data-property="border-color" data-element="body.login #login #loginform input[type='submit']">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="button_border_style">Border Style</label>
                                    </div>
                                    <div class="row__option-field">
                                        <select class="input_border_style" id="button_border_style" data-property="border-style" data-element="body.login #login #loginform input[type='submit']">
                                            <option value="solid">Solid</option>
                                            <option value="dotted">Dotted</option>
                                            <option value="dashed">Dashed</option>
                                            <option value="double">Double</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Option Row end -->

                                <!-- Option Row start -->
                                <div class="row__option fields_4_cols">
                                    <div class="row__option-label">
                                        <label for="button_border_width_top">Border Width</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="button_border_width_top" value="1" data-property="border-top-width" data-element="body.login #login #loginform input[type='submit']" data-unit="px">
                                        <input type="number" id="button_border_width_right" value="1" data-property="border-right-width" data-element="body.login #login #loginform input[type='submit']" data-unit="px">
                                        <input type="number" id="button_border_width_bottom" value="1" data-property="border-bottom-width" data-element="body.login #login #loginform input[type='submit']" data-unit="px">
                                        <input type="number" id="button_border_width_left" value="1" data-property="border-left-width" data-element="body.login #login #loginform input[type='submit']" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option fields_4_cols">
                                    <div class="row__option-label">
                                        <label for="button_border_radius_top">Border Radius</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="button_border_radius_top" value="4" data-property="border-top-left-radius" data-element="body.login #login #loginform input[type='submit']" data-unit="px">
                                        <input type="number" id="button_border_radius_right" value="4" data-property="border-top-right-radius" data-element="body.login #login #loginform input[type='submit']" data-unit="px">
                                        <input type="number" id="button_border_radius_bottom" value="4" data-property="border-bottom-right-radius" data-element="body.login #login #loginform input[type='submit']" data-unit="px">
                                        <input type="number" id="button_border_radius_left" value="4" data-property="border-bottom-left-radius" data-element="body.login #login #loginform input[type='submit']" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option fields_4_cols">
                                    <div class="row__option-label">
                                        <label for="button_margins_top">Margins</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="button_margins_top" value="0" data-property="margin-top" data-element="body.login #login #loginform input[type='submit']" placeholder="Top" data-unit="px">
                                        <input type="number" id="button_margins_right" value="0" data-property="margin-right" data-element="body.login #login #loginform input[type='submit']" placeholder="Right" data-unit="px">
                                        <input type="number" id="button_margins_bottom" value="0" data-property="margin-bottom" data-element="body.login #login #loginform input[type='submit']" placeholder="Bottom" data-unit="px">
                                        <input type="number" id="button_margins_left" value="0" data-property="margin-left" data-element="body.login #login #loginform input[type='submit']" placeholder="Left" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option fields_4_cols">
                                    <div class="row__option-label">
                                        <label for="button_padding_top">Paddings</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="button_padding_top" value="10" data-property="padding-top" data-element="body.login #login #loginform input[type='submit']" placeholder="Top" data-unit="px">
                                        <input type="number" id="button_padding_right" value="20" data-property="padding-right" data-element="body.login #login #loginform input[type='submit']" placeholder="Right" data-unit="px">
                                        <input type="number" id="button_padding_bottom" value="10" data-property="padding-bottom" data-element="body.login #login #loginform input[type='submit']" placeholder="Bottom" data-unit="px">
                                        <input type="number" id="button_padding_left" value="20" data-property="padding-left" data-element="body.login #login #loginform input[type='submit']" placeholder="Left" data-unit="px">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="button_shadow_color">Shadow Color</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="color" id="button_shadow_color" value="200" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="button_shadow_horizontal_position">Shadow Horizontal Position</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="button_shadow_horizontal_position" value="200" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="button_shadow_vertical_position">Shadow Vertical Position</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="button_shadow_vertical_position" value="200" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option">
                                    <div class="row__option-label">
                                        <label for="button_shadow_blur_spread">Shadow Blur/Spread</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="number" id="button_shadow_blur_spread" value="200" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form Button Styles Options End -->
                <!-- Form Footer Links Options -->
                <div class="settings__card-options-box">
                    <div class="accordion-step">
                        <div class="accordion-step-title">
                            <span class="open_option" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></svg></span>
                            <span class="close_option"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z"></path></svg></span>
                            <h3>Footer Links</h3>
                        </div>
                        <div class="step__content">
                            <div class="step__content-options">
                                <div class="step__content-options">
                                    <!-- Option Row start -->
                                    <div class="row__option">
                                        <div class="row__option-label">
                                            <label for="footer_text_color">Text Color</label>
                                        </div>
                                        <div class="row__option-field">
                                            <input type="color" id="footer_text_color" value="200" data-property="" data-element="">
                                        </div>
                                    </div>
                                    <!-- Option Row end -->
                                    <!-- Option Row start -->
                                    <div class="row__option">
                                        <div class="row__option-label">
                                            <label for="footer_text_size">Text Size</label>
                                        </div>
                                        <div class="row__option-field">
                                            <input type="number" id="footer_text_size" value="200" data-property="" data-element="">
                                        </div>
                                    </div>
                                    <!-- Option Row end -->
                                    <!-- Option Row start -->
                                    <div class="row__option">
                                        <div class="row__option-label">
                                            <label for="footer_alignment">Alignment</label>
                                        </div>
                                        <div class="row__option-field">
                                            <select id="footer_alignment" data-property="" data-element="">
                                                <option value="center">Center</option>
                                                <option value="left">Left</option>
                                                <option value="right">Right</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Option Row end -->
                                    <!-- Option Row start -->
                                    <div class="row__option fields_4_cols">
                                        <div class="row__option-label">
                                            <label for="footer_margins_top">Margins</label>
                                        </div>
                                        <div class="row__option-field">
                                            <input type="number" id="footer_margins_top" value="200" data-property="" data-element="" placeholder="Top">
                                            <input type="number" id="footer_margins_right" value="200" data-property="" data-element="" placeholder="Right">
                                            <input type="number" id="footer_margins_bottom" value="200" data-property="" data-element="" placeholder="Bottom">
                                            <input type="number" id="footer_margins_left" value="200" data-property="" data-element="" placeholder="Left">
                                        </div>
                                    </div>
                                    <!-- Option Row end -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form Footer Links Options End -->

                <!-- Form Text Options -->
                <div class="settings__card-options-box">
                    <div class="accordion-step">
                        <div class="accordion-step-title">
                            <span class="open_option" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M5.536 21.886a1.004 1.004 0 0 0 1.033-.064l13-9a1 1 0 0 0 0-1.644l-13-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .536.886z"></path></svg></span>
                            <span class="close_option"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z"></path></svg></span>
                            <h3>Form Text</h3>
                        </div>
                        <div class="step__content">
                            <div class="step__content-options">
                                <!-- Option Row start -->
                                <div class="row__option field_1_col">
                                    <div class="row__option-label">
                                        <label for="username_label">Username Label</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="text" id="username_label" value="Username or Email Address" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option field_1_col">
                                    <div class="row__option-label">
                                        <label for="password_label">Password Label</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="text" id="password_label" value="Password" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option field_1_col">
                                    <div class="row__option-label">
                                        <label for="remember_label">Remember Me Label</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="text" id="remember_label" value="Remember Me" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option field_1_col">
                                    <div class="row__option-label">
                                        <label for="button_text_label">Button Text</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="text" id="button_text_label" value="Log In" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option field_1_col">
                                    <div class="row__option-label">
                                        <label for="lost_pass_text">Lost Password Text</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="text" id="lost_pass_text" value="Lost your password?" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                                <!-- Option Row start -->
                                <div class="row__option field_1_col">
                                    <div class="row__option-label">
                                        <label for="back_to_website">Back To Website Text</label>
                                    </div>
                                    <div class="row__option-field">
                                        <input type="text" id="back_to_website" value="Back to website" data-property="" data-element="">
                                    </div>
                                </div>
                                <!-- Option Row end -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form Text Options End -->
            </div>
        </div>
    </div>
</div>