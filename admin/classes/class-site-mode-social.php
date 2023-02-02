<?php

/**
 * Responsible for plugin menu
 *
 * @link       https://https://mobeenabdullah.com
 * @since      1.0.0
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for plugin menu
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.0.0
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Site_Mode_Social extends Settings {

        protected $show_social;
        protected $facebook;
        protected $twitter;
        protected $linkedin;
        protected $youtube;
        protected $instagram;
        protected $pinterest;
        protected $quora;
        protected $behance;
		protected $social_content;

		public function __construct() {
			$this->option_name = 'site_mode_social';

			$social_content     =   $this->get_data('site_mode_social');

			$this->show_social  =   isset($social_content['show-social-icons']) ? $social_content['show-social-icons'] : '';
			$this->facebook     =   isset($social_content['fb']) ? $social_content['fb'] : '';
			$this->twitter      =   isset($social_content['twitter']) ? $social_content['twitter'] : '';
			$this->linkedin     =   isset($social_content['linkedin']) ? $social_content['linkedin'] : '';
			$this->youtube      =   isset($social_content['youtube']) ? $social_content['youtube'] : '';
			$this->instagram    =   isset($social_content['instagram']) ? $social_content['instagram'] : '';
			$this->pinterest    =   isset($social_content['pintrest']) ? $social_content['pintrest'] : '';
			$this->quora        =   isset($social_content['quora']) ? $social_content['quora'] : '';
			$this->behance      =   isset($social_content['behance']) ? $social_content['behance'] : '';
			$this->sort_social_content();

			print_r($this->social_content);
		}

    public function ajax_site_mode_social() {

	    $this->verify_nonce('social-custom-message', 'social-settings-save');

        $data = [
            'show-social-icons'   => sanitize_text_field($_POST['show-social-icons']),
            'fb'                  => [
	            'content'   =>     sanitize_text_field($_POST['fb']),
	            'order'     =>     sanitize_text_field($_POST['fb_order']),
            ],
            'twitter'             => [
	            'content'   =>     sanitize_text_field($_POST['twitter']),
	            'order'     =>     sanitize_text_field($_POST['tw_order']),
            ],
            'linkedin'            => [
	            'content'   =>     sanitize_text_field($_POST['linkedin']),
	            'order'     =>     sanitize_text_field($_POST['linkedin-order']),
            ],
            'youtube'             => [
	            'content'   =>     sanitize_text_field($_POST['youtube']),
	            'order'     =>     sanitize_text_field($_POST['youtube-order']),
            ],
            'instagram'           => [
	            'content'   =>     sanitize_text_field($_POST['instagram']),
	            'order'     =>     sanitize_text_field($_POST['instagram-order']),
            ],
			'pintrest'            => [
	            'content'   =>     sanitize_text_field($_POST['pinterest']),
	            'order'     =>     sanitize_text_field($_POST['pinterest-order']),
			],
			'quora'               => [
	            'content'   =>     sanitize_text_field($_POST['quora']),
	            'order'     =>     sanitize_text_field($_POST['quora-order']),
			],
			'behance'             => [
	            'content'   =>     sanitize_text_field($_POST['behance']),
	            'order'     =>     sanitize_text_field($_POST['behance-order']),
			],
        ];

        return $this->save_data($this->option_name, $data);
        die();
    }

	public function sort_social_content () {
		$social_media = [
			[
				'label' => 'Facebook',
				'key' => 'fb',
				'value' => $this->facebook['content'],
				'order_key' => 'fb_order',
				'order_value' => $this->facebook['order'],
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z"></path></svg>'
			],
			[
				'label' => 'Twitter',
				'key' => 'twitter',
				'value' => $this->twitter['content'],
				'order_key' => 'tw_order',
				'order_value' => $this->twitter['order'],
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.645 8.645 0 0 1-2.019 2.083z"></path></svg>'
			],
			[
				'label' => 'Linkedin',
				'key' => 'linkedin',
				'value' => $this->linkedin['content'],
				'order_key' => 'linkedin-order',
				'order_value' => $this->linkedin['order'],
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><circle cx="4.983" cy="5.009" r="2.188"></circle><path d="M9.237 8.855v12.139h3.769v-6.003c0-1.584.298-3.118 2.262-3.118 1.937 0 1.961 1.811 1.961 3.218v5.904H21v-6.657c0-3.27-.704-5.783-4.526-5.783-1.835 0-3.065 1.007-3.568 1.96h-.051v-1.66H9.237zm-6.142 0H6.87v12.139H3.095z"></path></svg>'
			],
			[
				'label' => 'Youtube',
				'key' => 'youtube',
				'value' => $this->youtube['content'],
				'order_key' => 'youtube-order',
				'order_value' => $this->youtube['order'],
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M21.593 7.203a2.506 2.506 0 0 0-1.762-1.766C18.265 5.007 12 5 12 5s-6.264-.007-7.831.404a2.56 2.56 0 0 0-1.766 1.778c-.413 1.566-.417 4.814-.417 4.814s-.004 3.264.406 4.814c.23.857.905 1.534 1.763 1.765 1.582.43 7.83.437 7.83.437s6.265.007 7.831-.403a2.515 2.515 0 0 0 1.767-1.763c.414-1.565.417-4.812.417-4.812s.02-3.265-.407-4.831zM9.996 15.005l.005-6 5.207 3.005-5.212 2.995z"></path></svg>'
			],
			[
				'label' => 'Instagram',
				'key' => 'instagram',
				'value' => $this->instagram['content'],
				'order_key' => 'instagram-order',
				'order_value' => $this->instagram['order'],
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M11.999 7.377a4.623 4.623 0 1 0 0 9.248 4.623 4.623 0 0 0 0-9.248zm0 7.627a3.004 3.004 0 1 1 0-6.008 3.004 3.004 0 0 1 0 6.008z"></path><circle cx="16.806" cy="7.207" r="1.078"></circle><path d="M20.533 6.111A4.605 4.605 0 0 0 17.9 3.479a6.606 6.606 0 0 0-2.186-.42c-.963-.042-1.268-.054-3.71-.054s-2.755 0-3.71.054a6.554 6.554 0 0 0-2.184.42 4.6 4.6 0 0 0-2.633 2.632 6.585 6.585 0 0 0-.419 2.186c-.043.962-.056 1.267-.056 3.71 0 2.442 0 2.753.056 3.71.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.042 1.268.055 3.71.055s2.755 0 3.71-.055a6.615 6.615 0 0 0 2.186-.419 4.613 4.613 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.186.043-.962.056-1.267.056-3.71s0-2.753-.056-3.71a6.581 6.581 0 0 0-.421-2.217zm-1.218 9.532a5.043 5.043 0 0 1-.311 1.688 2.987 2.987 0 0 1-1.712 1.711 4.985 4.985 0 0 1-1.67.311c-.95.044-1.218.055-3.654.055-2.438 0-2.687 0-3.655-.055a4.96 4.96 0 0 1-1.669-.311 2.985 2.985 0 0 1-1.719-1.711 5.08 5.08 0 0 1-.311-1.669c-.043-.95-.053-1.218-.053-3.654 0-2.437 0-2.686.053-3.655a5.038 5.038 0 0 1 .311-1.687c.305-.789.93-1.41 1.719-1.712a5.01 5.01 0 0 1 1.669-.311c.951-.043 1.218-.055 3.655-.055s2.687 0 3.654.055a4.96 4.96 0 0 1 1.67.311 2.991 2.991 0 0 1 1.712 1.712 5.08 5.08 0 0 1 .311 1.669c.043.951.054 1.218.054 3.655 0 2.436 0 2.698-.043 3.654h-.011z"></path></svg>'
			],
			[
				'label' => 'Pinterest',
				'key' => 'pinterest',
				'value' => $this->pinterest['content'],
				'order_key' => 'pinterest-order',
				'order_value' => $this->pinterest['order'],
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M5.077 9.457c0-.778.136-1.513.404-2.199a5.63 5.63 0 0 1 1.121-1.802 7.614 7.614 0 0 1 1.644-1.329 7.513 7.513 0 0 1 2.002-.844 8.57 8.57 0 0 1 2.185-.281c1.139 0 2.199.241 3.182.721a6.021 6.021 0 0 1 2.391 2.094c.614.915.919 1.95.919 3.104 0 .692-.068 1.369-.207 2.031a8.28 8.28 0 0 1-.646 1.913 6.605 6.605 0 0 1-1.082 1.617 4.723 4.723 0 0 1-1.568 1.114 4.962 4.962 0 0 1-2.045.417c-.489 0-.977-.115-1.459-.346-.482-.23-.828-.546-1.036-.951-.073.281-.173.687-.306 1.218-.128.53-.214.872-.252 1.027-.04.154-.114.411-.222.767a5.183 5.183 0 0 1-.281.769l-.344.674a7.98 7.98 0 0 1-.498.838c-.181.262-.405.575-.672.935l-.149.053-.099-.108c-.107-1.133-.162-1.811-.162-2.035 0-.663.079-1.407.235-2.233.153-.825.395-1.862.72-3.109.325-1.246.511-1.979.561-2.196-.229-.467-.345-1.077-.345-1.827 0-.599.187-1.16.562-1.688.376-.526.851-.789 1.427-.789.441 0 .783.146 1.028.439.246.292.366.66.366 1.109 0 .476-.158 1.165-.476 2.066-.318.902-.476 1.575-.476 2.022 0 .453.162.832.486 1.129a1.68 1.68 0 0 0 1.179.449c.396 0 .763-.09 1.104-.271a2.46 2.46 0 0 0 .849-.733 6.123 6.123 0 0 0 1.017-2.225c.096-.422.17-.823.216-1.2.049-.379.07-.737.07-1.077 0-1.247-.396-2.219-1.183-2.915-.791-.696-1.821-1.042-3.088-1.042-1.441 0-2.646.466-3.611 1.401-.966.932-1.452 2.117-1.452 3.554 0 .317.048.623.139.919.089.295.186.53.291.704.104.171.202.338.291.492.09.154.137.264.137.33 0 .202-.053.465-.16.79-.111.325-.242.487-.4.487-.015 0-.077-.011-.185-.034a2.21 2.21 0 0 1-.979-.605 3.17 3.17 0 0 1-.659-1.022 6.986 6.986 0 0 1-.352-1.169 4.884 4.884 0 0 1-.132-1.153z"></path></svg>'
			],
			[
				'label' => 'Quora',
				'key' => 'quora',
				'value' => $this->quora['content'],
				'order_key' => 'quora-order',
				'order_value' => $this->quora['order'],
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M12.555 17.025c-.624-1.227-1.354-2.465-2.781-2.465-.271 0-.546.046-.795.157l-.484-.967c.59-.509 1.544-.911 2.77-.911 1.908 0 2.889.922 3.667 2.094.459-1.001.678-2.354.678-4.03 0-4.188-1.308-6.336-4.366-6.336-3.014 0-4.318 2.148-4.318 6.336 0 4.164 1.305 6.291 4.318 6.291.478 0 .913-.051 1.311-.169zm.747 1.461a7.977 7.977 0 0 1-2.059.274c-4.014 0-7.941-3.202-7.941-7.858C3.303 6.203 7.229 3 11.243 3c4.081 0 7.972 3.179 7.972 7.903 0 2.628-1.226 4.763-3.007 6.143.572.861 1.157 1.436 1.988 1.436.899 0 1.261-.687 1.328-1.236h1.167c.07.73-.301 3.754-3.574 3.754-1.989 0-3.035-1.146-3.822-2.496l.007-.018z"></path></svg>'
			],
			[
				'label' => 'Behance',
				'key' => 'behance',
				'value' => $this->behance['content'],
				'order_key' => 'behance-order',
				'order_value' => $this->behance['order'],
				'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M7.803 5.731c.589 0 1.119.051 1.605.155.483.103.895.273 1.243.508.343.235.611.547.804.939.187.387.28.871.28 1.443 0 .62-.14 1.138-.421 1.551-.283.414-.7.753-1.256 1.015.757.219 1.318.602 1.69 1.146.374.549.557 1.206.557 1.976 0 .625-.119 1.162-.358 1.613a3.11 3.11 0 0 1-.974 1.114 4.315 4.315 0 0 1-1.399.64 6.287 6.287 0 0 1-1.609.206H2V5.731h5.803zm-.351 4.972c.48 0 .878-.114 1.192-.345.312-.228.463-.604.463-1.119 0-.286-.051-.522-.151-.707a1.114 1.114 0 0 0-.417-.428 1.683 1.683 0 0 0-.597-.215 3.609 3.609 0 0 0-.697-.061H4.71v2.875h2.742zm.151 5.239c.267 0 .521-.023.76-.077.241-.052.455-.136.637-.261.182-.12.332-.283.44-.491.109-.206.162-.475.162-.798 0-.634-.179-1.085-.533-1.358-.355-.27-.831-.404-1.414-.404H4.71v3.39h2.893zm8.565-.041c.367.358.896.538 1.584.538.493 0 .919-.125 1.278-.373.354-.249.57-.515.653-.79h2.155c-.346 1.072-.871 1.838-1.589 2.299-.709.463-1.572.693-2.58.693-.702 0-1.334-.113-1.9-.337a4.033 4.033 0 0 1-1.439-.958 4.37 4.37 0 0 1-.905-1.485 5.433 5.433 0 0 1-.32-1.899c0-.666.111-1.289.329-1.864a4.376 4.376 0 0 1 .934-1.493c.405-.42.885-.751 1.444-.994a4.634 4.634 0 0 1 1.858-.362c.754 0 1.413.146 1.979.44a3.967 3.967 0 0 1 1.39 1.182c.363.493.622 1.058.783 1.691.161.632.217 1.292.171 1.983h-6.431c.001.704.238 1.371.606 1.729zm2.812-4.681c-.291-.322-.783-.496-1.385-.496-.391 0-.714.065-.974.199a1.97 1.97 0 0 0-.62.491 1.772 1.772 0 0 0-.328.628 2.82 2.82 0 0 0-.111.587h3.982c-.058-.624-.272-1.085-.564-1.409zm-3.918-4.663h4.989v1.215h-4.989z"></path></svg>'
			]
		];

		usort($social_media, function($a, $b) {
			$aVal = isset($a['order_value']) ? $a['order_value'] : 8;
			$bVal = isset($b['order_value']) ? $b['order_value'] : 8;
			return intval($aVal) - intval($bVal);
		});

		$this->social_content = $social_media;
	}


      public function render() {
          $this->display_settings_page('social');
      }
}


