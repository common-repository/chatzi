<?php
/*
 Plugin Name: Chatzi
 Description: A super lightweight and easy-to-use plugin for contacting with users in whatsapp.
 Contributors: pouyadaraee, daynaweb
 Tags: whatsapp, chat, persian
 Author: Daynaweb Group
 Author URI: https://daynaweb.ir/
 Plugin URI: https://daynaweb.ir/chatzi/
 Requires at least: 4.0
 Tested up to: 6.4.3
 Version: 1.3
 Stable tag: 1.3
 Requires PHP: 5.6
 Text Domain: chatzi
 Domain Path: /languages
 Copyright: (c) 2022 Daynaweb Group, All rights reserved.
 License: GPLv2 or later
 License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

 function chatzi_load_textdomain() {
   load_plugin_textdomain( 'chatzi', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
 }
 add_action( 'init', 'chatzi_load_textdomain' );

 class ChatziSettings {
 	private $chatzi_settings_options;

 	public function __construct() {
 		add_action( 'admin_menu', array( $this, 'chatzi_settings_add_plugin_page' ) );
 		add_action( 'admin_init', array( $this, 'chatzi_settings_page_init' ) );
 	}

 	public function chatzi_settings_add_plugin_page() {
 		add_options_page(
 			__('Chatzi Settings' , 'chatzi'), // page_title
 			__('Chatzi Settings' , 'chatzi'), // menu_title
 			'manage_options', // capability
 			'chatzi-settings', // menu_slug
 			array( $this, 'chatzi_settings_create_admin_page' ) // function
 		);
 	}

 	public function chatzi_settings_create_admin_page() {
 		$this->chatzi_settings_options = get_option( 'chatzi_settings_option_name' ); ?>

 		<div class="wrap">
 			<h2><?php _e('Chatzi Settings' , 'chatzi') ?></h2>
 			<p></p>
 			<?php settings_errors(); ?>

 			<form method="post" action="options.php">
 				<?php
 					settings_fields( 'chatzi_settings_option_group' );
 					do_settings_sections( 'chatzi-settings-admin' );
 					submit_button();
 				?>
 			</form>
 		</div>
 	<?php }

 	public function chatzi_settings_page_init() {
 		register_setting(
 			'chatzi_settings_option_group', // option_group
 			'chatzi_settings_option_name', // option_name
 			array( $this, 'chatzi_settings_sanitize' ) // sanitize_callback
 		);

 		add_settings_section(
 			'chatzi_settings_setting_section', // id
 			__('Settings' , 'chatzi'), // title
 			array( $this, 'chatzi_settings_section_info' ), // callback
 			'chatzi-settings-admin' // page
 		);

 		add_settings_field(
 			'your_whatsapp_number_including_country_code_without_0_or_0', // id
 			__('Your Whatsapp number including country code without zero or plus' , 'chatzi'), // title
 			array( $this, 'your_whatsapp_number_including_country_code_without_0_or_0_callback' ), // callback
 			'chatzi-settings-admin', // page
 			'chatzi_settings_setting_section' // section
 		);

 		add_settings_field(
 			'default_text_message_1', // id
 			__('Default text message' , 'chatzi'), // title
 			array( $this, 'default_text_message_1_callback' ), // callback
 			'chatzi-settings-admin', // page
 			'chatzi_settings_setting_section' // section
 		);

 		add_settings_field(
 			'widget_title_2', // id
 			__('Widget title' , 'chatzi'), // title
 			array( $this, 'widget_title_2_callback' ), // callback
 			'chatzi-settings-admin', // page
 			'chatzi_settings_setting_section' // section
 		);

 		add_settings_field(
 			'widget_subtitle_3', // id
 			__('Widget subtitle' , 'chatzi'), // title
 			array( $this, 'widget_subtitle_3_callback' ), // callback
 			'chatzi-settings-admin', // page
 			'chatzi_settings_setting_section' // section
 		);

 		add_settings_field(
 			'widget_description_4', // id
 			__('Widget description' , 'chatzi'), // title
 			array( $this, 'widget_description_4_callback' ), // callback
 			'chatzi-settings-admin', // page
 			'chatzi_settings_setting_section' // section
 		);

 		add_settings_field(
 			'chat_title_5', // id
 			__('Chat title' , 'chatzi'), // title
 			array( $this, 'chat_title_5_callback' ), // callback
 			'chatzi-settings-admin', // page
 			'chatzi_settings_setting_section' // section
 		);

 		add_settings_field(
 			'chat_subtitle_6', // id
 			__('Chat subtitle' , 'chatzi'), // title
 			array( $this, 'chat_subtitle_6_callback' ), // callback
 			'chatzi-settings-admin', // page
 			'chatzi_settings_setting_section' // section
 		);

 		add_settings_field(
 			'widget_position_7', // id
 			__('Widget position' , 'chatzi'), // title
 			array( $this, 'widget_position_7_callback' ), // callback
 			'chatzi-settings-admin', // page
 			'chatzi_settings_setting_section' // section
 		);
 	}

 	public function chatzi_settings_sanitize($input) {
 		$sanitary_values = array();
 		if ( isset( $input['your_whatsapp_number_including_country_code_without_0_or_0'] ) ) {
 			$sanitary_values['your_whatsapp_number_including_country_code_without_0_or_0'] = sanitize_text_field( $input['your_whatsapp_number_including_country_code_without_0_or_0'] );
 		}

 		if ( isset( $input['default_text_message_1'] ) ) {
 			$sanitary_values['default_text_message_1'] = sanitize_text_field( $input['default_text_message_1'] );
 		}

 		if ( isset( $input['widget_title_2'] ) ) {
 			$sanitary_values['widget_title_2'] = sanitize_text_field( $input['widget_title_2'] );
 		}

 		if ( isset( $input['widget_subtitle_3'] ) ) {
 			$sanitary_values['widget_subtitle_3'] = sanitize_text_field( $input['widget_subtitle_3'] );
 		}

 		if ( isset( $input['widget_description_4'] ) ) {
 			$sanitary_values['widget_description_4'] = sanitize_text_field( $input['widget_description_4'] );
 		}

 		if ( isset( $input['chat_title_5'] ) ) {
 			$sanitary_values['chat_title_5'] = sanitize_text_field( $input['chat_title_5'] );
 		}

 		if ( isset( $input['chat_subtitle_6'] ) ) {
 			$sanitary_values['chat_subtitle_6'] = sanitize_text_field( $input['chat_subtitle_6'] );
 		}

 		if ( isset( $input['widget_position_7'] ) ) {
 			$sanitary_values['widget_position_7'] = $input['widget_position_7'];
 		}

 		return $sanitary_values;
 	}

 	public function chatzi_settings_section_info() {

 	}

 	public function your_whatsapp_number_including_country_code_without_0_or_0_callback() {
 		printf(
 			'<input class="regular-text" type="text" name="chatzi_settings_option_name[your_whatsapp_number_including_country_code_without_0_or_0]" id="your_whatsapp_number_including_country_code_without_0_or_0" value="%s">',
 			isset( $this->chatzi_settings_options['your_whatsapp_number_including_country_code_without_0_or_0'] ) ? esc_attr( $this->chatzi_settings_options['your_whatsapp_number_including_country_code_without_0_or_0']) : ''
 		);
 	}

 	public function default_text_message_1_callback() {
 		printf(
 			'<input class="regular-text" type="text" name="chatzi_settings_option_name[default_text_message_1]" id="default_text_message_1" value="%s">',
 			isset( $this->chatzi_settings_options['default_text_message_1'] ) ? esc_attr( $this->chatzi_settings_options['default_text_message_1']) : ''
 		);
 	}

 	public function widget_title_2_callback() {
 		printf(
 			'<input class="regular-text" type="text" name="chatzi_settings_option_name[widget_title_2]" id="widget_title_2" value="%s">',
 			isset( $this->chatzi_settings_options['widget_title_2'] ) ? esc_attr( $this->chatzi_settings_options['widget_title_2']) : ''
 		);
 	}

 	public function widget_subtitle_3_callback() {
 		printf(
 			'<input class="regular-text" type="text" name="chatzi_settings_option_name[widget_subtitle_3]" id="widget_subtitle_3" value="%s">',
 			isset( $this->chatzi_settings_options['widget_subtitle_3'] ) ? esc_attr( $this->chatzi_settings_options['widget_subtitle_3']) : ''
 		);
 	}

 	public function widget_description_4_callback() {
 		printf(
 			'<input class="regular-text" type="text" name="chatzi_settings_option_name[widget_description_4]" id="widget_description_4" value="%s">',
 			isset( $this->chatzi_settings_options['widget_description_4'] ) ? esc_attr( $this->chatzi_settings_options['widget_description_4']) : ''
 		);
 	}

 	public function chat_title_5_callback() {
 		printf(
 			'<input class="regular-text" type="text" name="chatzi_settings_option_name[chat_title_5]" id="chat_title_5" value="%s">',
 			isset( $this->chatzi_settings_options['chat_title_5'] ) ? esc_attr( $this->chatzi_settings_options['chat_title_5']) : ''
 		);
 	}

 	public function chat_subtitle_6_callback() {
 		printf(
 			'<input class="regular-text" type="text" name="chatzi_settings_option_name[chat_subtitle_6]" id="chat_subtitle_6" value="%s">',
 			isset( $this->chatzi_settings_options['chat_subtitle_6'] ) ? esc_attr( $this->chatzi_settings_options['chat_subtitle_6']) : ''
 		);
 	}

 	public function widget_position_7_callback() {
 		?> <fieldset><?php $checked = ( isset( $this->chatzi_settings_options['widget_position_7'] ) && $this->chatzi_settings_options['widget_position_7'] === 'up-left' ) ? 'checked' : '' ; ?>
 		<label for="widget_position_7-0"><input type="radio" name="chatzi_settings_option_name[widget_position_7]" id="widget_position_7-0" value="up-left" <?php echo $checked; ?>> <?php _e('Up - Left' , 'chatzi'); ?></label><br>
 		<?php $checked = ( isset( $this->chatzi_settings_options['widget_position_7'] ) && $this->chatzi_settings_options['widget_position_7'] === 'up-right' ) ? 'checked' : '' ; ?>
 		<label for="widget_position_7-1"><input type="radio" name="chatzi_settings_option_name[widget_position_7]" id="widget_position_7-1" value="up-right" <?php echo $checked; ?>> <?php _e('Up - Right' , 'chatzi'); ?></label><br>
 		<?php $checked = ( isset( $this->chatzi_settings_options['widget_position_7'] ) && $this->chatzi_settings_options['widget_position_7'] === 'down-left' ) ? 'checked' : '' ; ?>
 		<label for="widget_position_7-2"><input type="radio" name="chatzi_settings_option_name[widget_position_7]" id="widget_position_7-2" value="down-left" <?php echo $checked; ?>> <?php _e('Down - Left' , 'chatzi'); ?></label><br>
 		<?php $checked = ( isset( $this->chatzi_settings_options['widget_position_7'] ) && $this->chatzi_settings_options['widget_position_7'] === 'down-right' ) ? 'checked' : '' ; ?>
 		<label for="widget_position_7-3"><input type="radio" name="chatzi_settings_option_name[widget_position_7]" id="widget_position_7-3" value="down-right" <?php echo $checked; ?>> <?php _e('Down - Right' , 'chatzi'); ?></label></fieldset> <?php
 	}

 }

 	$chatzi_settings = new ChatziSettings();

  function chatzi_style_script() {
    wp_register_script('chatzi-js', plugins_url('assets/js/main.js', __FILE__), array('jquery'),'1.1', true);
  	wp_register_style('chatzi-css', plugins_url('assets/css/style.css', __FILE__));
  	wp_enqueue_script( 'chatzi-js' );
  	wp_enqueue_style( 'chatzi-css' );
  }
  add_action( 'wp_enqueue_scripts', 'chatzi_style_script' );

function chatzi_render_widget() {
  $chatzi_data = get_option( 'chatzi_settings_option_name' );
  $pos = $chatzi_data['widget_position_7'];

  switch ($pos) {
    case 'up-left':
      $widget_pos_class = 'chatziupleft';
      break;
    case 'up-right':
      $widget_pos_class = 'chatziupright';
      break;
    case 'down-left':
      $widget_pos_class = 'chatzidownleft';
      break;
    default:
      $widget_pos_class = 'chatzidownright';
  }
  ?>
  <div class="chatzi <?php echo esc_attr( $widget_pos_class ); ?>">

    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 33 33" width="33px" height="33px" class="main-whatsapp">
    <g id="surface203594309">
    <path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,100%,100%);fill-opacity:1;" d="M 16.515625 2.75 C 8.945312 2.75 2.78125 8.90625 2.78125 16.476562 C 2.777344 18.898438 3.410156 21.261719 4.613281 23.34375 L 2.75 30.25 L 9.945312 28.550781 C 11.949219 29.644531 14.210938 30.21875 16.507812 30.21875 L 16.511719 30.21875 C 24.082031 30.21875 30.242188 24.0625 30.246094 16.492188 C 30.25 12.820312 28.824219 9.371094 26.230469 6.777344 C 23.636719 4.179688 20.191406 2.75 16.515625 2.75 Z M 16.511719 5.5 C 19.449219 5.5 22.210938 6.644531 24.285156 8.71875 C 26.359375 10.796875 27.5 13.554688 27.496094 16.488281 C 27.496094 22.542969 22.570312 27.46875 16.511719 27.46875 C 14.679688 27.46875 12.863281 27.007812 11.261719 26.136719 L 10.335938 25.632812 L 9.3125 25.871094 L 6.605469 26.511719 L 7.265625 24.058594 L 7.566406 22.957031 L 6.996094 21.96875 C 6.035156 20.308594 5.527344 18.40625 5.53125 16.476562 C 5.53125 10.425781 10.460938 5.5 16.511719 5.5 Z M 11.65625 10.140625 C 11.425781 10.140625 11.054688 10.226562 10.738281 10.570312 C 10.425781 10.914062 9.535156 11.742188 9.535156 13.429688 C 9.535156 15.117188 10.765625 16.75 10.9375 16.980469 C 11.109375 17.207031 13.3125 20.785156 16.800781 22.160156 C 19.699219 23.300781 20.289062 23.074219 20.917969 23.019531 C 21.546875 22.960938 22.949219 22.1875 23.234375 21.386719 C 23.519531 20.585938 23.523438 19.898438 23.4375 19.753906 C 23.351562 19.613281 23.121094 19.527344 22.777344 19.355469 C 22.4375 19.183594 20.75 18.355469 20.433594 18.242188 C 20.121094 18.125 19.890625 18.070312 19.660156 18.414062 C 19.433594 18.757812 18.777344 19.527344 18.574219 19.753906 C 18.375 19.984375 18.175781 20.015625 17.832031 19.84375 C 17.488281 19.671875 16.382812 19.308594 15.070312 18.136719 C 14.050781 17.230469 13.363281 16.109375 13.160156 15.765625 C 12.960938 15.421875 13.144531 15.234375 13.316406 15.0625 C 13.46875 14.910156 13.65625 14.664062 13.828125 14.460938 C 14 14.261719 14.058594 14.117188 14.171875 13.890625 C 14.285156 13.660156 14.226562 13.460938 14.140625 13.289062 C 14.058594 13.117188 13.390625 11.421875 13.085938 10.742188 C 12.828125 10.171875 12.554688 10.160156 12.3125 10.148438 C 12.109375 10.140625 11.882812 10.140625 11.65625 10.140625 Z M 11.65625 10.140625 "/>
    </g>
    </svg>

    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 33 33" width="33px" height="33px" class="close">
    <g id="surface203839995">
    <path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,100%,100%);fill-opacity:1;" d="M 6.863281 5.488281 C 6.300781 5.488281 5.796875 5.824219 5.585938 6.34375 C 5.378906 6.863281 5.5 7.457031 5.902344 7.847656 L 14.554688 16.5 L 5.902344 25.152344 C 5.542969 25.496094 5.398438 26.011719 5.523438 26.492188 C 5.648438 26.972656 6.027344 27.351562 6.507812 27.476562 C 6.988281 27.601562 7.503906 27.457031 7.847656 27.097656 L 16.5 18.445312 L 25.152344 27.097656 C 25.496094 27.457031 26.011719 27.601562 26.492188 27.476562 C 26.972656 27.351562 27.351562 26.972656 27.476562 26.492188 C 27.601562 26.011719 27.457031 25.496094 27.097656 25.152344 L 18.445312 16.5 L 27.097656 7.847656 C 27.503906 7.453125 27.625 6.847656 27.40625 6.324219 C 27.183594 5.804688 26.664062 5.46875 26.097656 5.488281 C 25.742188 5.496094 25.402344 5.648438 25.152344 5.902344 L 16.5 14.554688 L 7.847656 5.902344 C 7.589844 5.636719 7.234375 5.488281 6.863281 5.488281 Z M 6.863281 5.488281 "/>
    </g>
    </svg>

    <div class="wa-chat-box">
      <div class="chatzi_popup_heading">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 33 33" width="42px" height="42px" class="chatzi_popup_heading_whatsapp">
        <g id="surface203594309">
        <path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,100%,100%);fill-opacity:1;" d="M 16.515625 2.75 C 8.945312 2.75 2.78125 8.90625 2.78125 16.476562 C 2.777344 18.898438 3.410156 21.261719 4.613281 23.34375 L 2.75 30.25 L 9.945312 28.550781 C 11.949219 29.644531 14.210938 30.21875 16.507812 30.21875 L 16.511719 30.21875 C 24.082031 30.21875 30.242188 24.0625 30.246094 16.492188 C 30.25 12.820312 28.824219 9.371094 26.230469 6.777344 C 23.636719 4.179688 20.191406 2.75 16.515625 2.75 Z M 16.511719 5.5 C 19.449219 5.5 22.210938 6.644531 24.285156 8.71875 C 26.359375 10.796875 27.5 13.554688 27.496094 16.488281 C 27.496094 22.542969 22.570312 27.46875 16.511719 27.46875 C 14.679688 27.46875 12.863281 27.007812 11.261719 26.136719 L 10.335938 25.632812 L 9.3125 25.871094 L 6.605469 26.511719 L 7.265625 24.058594 L 7.566406 22.957031 L 6.996094 21.96875 C 6.035156 20.308594 5.527344 18.40625 5.53125 16.476562 C 5.53125 10.425781 10.460938 5.5 16.511719 5.5 Z M 11.65625 10.140625 C 11.425781 10.140625 11.054688 10.226562 10.738281 10.570312 C 10.425781 10.914062 9.535156 11.742188 9.535156 13.429688 C 9.535156 15.117188 10.765625 16.75 10.9375 16.980469 C 11.109375 17.207031 13.3125 20.785156 16.800781 22.160156 C 19.699219 23.300781 20.289062 23.074219 20.917969 23.019531 C 21.546875 22.960938 22.949219 22.1875 23.234375 21.386719 C 23.519531 20.585938 23.523438 19.898438 23.4375 19.753906 C 23.351562 19.613281 23.121094 19.527344 22.777344 19.355469 C 22.4375 19.183594 20.75 18.355469 20.433594 18.242188 C 20.121094 18.125 19.890625 18.070312 19.660156 18.414062 C 19.433594 18.757812 18.777344 19.527344 18.574219 19.753906 C 18.375 19.984375 18.175781 20.015625 17.832031 19.84375 C 17.488281 19.671875 16.382812 19.308594 15.070312 18.136719 C 14.050781 17.230469 13.363281 16.109375 13.160156 15.765625 C 12.960938 15.421875 13.144531 15.234375 13.316406 15.0625 C 13.46875 14.910156 13.65625 14.664062 13.828125 14.460938 C 14 14.261719 14.058594 14.117188 14.171875 13.890625 C 14.285156 13.660156 14.226562 13.460938 14.140625 13.289062 C 14.058594 13.117188 13.390625 11.421875 13.085938 10.742188 C 12.828125 10.171875 12.554688 10.160156 12.3125 10.148438 C 12.109375 10.140625 11.882812 10.140625 11.65625 10.140625 Z M 11.65625 10.140625 "/>
        </g>
        </svg>
        <div class="chatzi_popup_title"><?php echo esc_html( $chatzi_data['widget_title_2'] ); ?></div>
        <div class="chatzi_popup_intro"><strong><?php echo esc_html( $chatzi_data['widget_subtitle_3'] ); ?></strong></div>
      </div>
      <div class="chatzi_popup_content">
        <div class="chatzi_popup_notice"><?php echo esc_html( $chatzi_data['widget_description_4'] ); ?></div>
        <div class="chatzi_popup_content_list">
          <div class="chatzi_popup_content_item"><a target="_blank"
              href="https://api.whatsapp.com/send?phone=<?php echo esc_html( $chatzi_data['your_whatsapp_number_including_country_code_without_0_or_0'] ); ?>&text=<?php echo esc_html( $chatzi_data['default_text_message_1'] ); ?>"
              rel="nofollow" class="chatzi_stt">
              <div class="chatzi_popup_avatar"><svg width="48px" height="48px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                  viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                  <path style="fill:#EDEDED;" d="M0,512l35.31-128C12.359,344.276,0,300.138,0,254.234C0,114.759,114.759,0,255.117,0
            S512,114.759,512,254.234S395.476,512,255.117,512c-44.138,0-86.51-14.124-124.469-35.31L0,512z"></path>
                  <path style="fill:#55CD6C;" d="M137.71,430.786l7.945,4.414c32.662,20.303,70.621,32.662,110.345,32.662
            c115.641,0,211.862-96.221,211.862-213.628S371.641,44.138,255.117,44.138S44.138,137.71,44.138,254.234
            c0,40.607,11.476,80.331,32.662,113.876l5.297,7.945l-20.303,74.152L137.71,430.786z"></path>
                  <path style="fill:#FEFEFE;" d="M187.145,135.945l-16.772-0.883c-5.297,0-10.593,1.766-14.124,5.297
            c-7.945,7.062-21.186,20.303-24.717,37.959c-6.179,26.483,3.531,58.262,26.483,90.041s67.09,82.979,144.772,105.048
            c24.717,7.062,44.138,2.648,60.028-7.062c12.359-7.945,20.303-20.303,22.952-33.545l2.648-12.359
            c0.883-3.531-0.883-7.945-4.414-9.71l-55.614-25.6c-3.531-1.766-7.945-0.883-10.593,2.648l-22.069,28.248
            c-1.766,1.766-4.414,2.648-7.062,1.766c-15.007-5.297-65.324-26.483-92.69-79.448c-0.883-2.648-0.883-5.297,0.883-7.062
            l21.186-23.834c1.766-2.648,2.648-6.179,1.766-8.828l-25.6-57.379C193.324,138.593,190.676,135.945,187.145,135.945"></path>
                </svg></div>
              <div class="chatzi_popup_txt">
                <div class="chatzi_member_name"><?php echo esc_html( $chatzi_data['chat_title_5'] ); ?></div>
                <div class="chatzi_member_duty"><?php echo esc_html( $chatzi_data['chat_subtitle_6'] ); ?></div>
              </div>
            </a></div>
        </div>
      </div>
    </div>

  </div>
<?php }
add_action('wp_footer' , 'chatzi_render_widget');
