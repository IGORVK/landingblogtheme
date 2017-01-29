<?php
class ControlPanel {
// Устанавливаем значения по умолчанию
	var $default_settings = array(
		'phone' => '+38 455 587 175',
		'email' => 'contact@site.com',
		'googlemaps' => 'https://www.google.com/maps/@45.491103,12.6045253,17z',
		'big-call-to-action' => 'Do you get more information?',
	    'small-call-to-action' => 'Want to talk with our customer service to explain their what you need?',
		'btn-label' => 'Get in Touch'
	);
	var $options;

	function ControlPanel() {
		add_action('admin_menu', array(&$this, 'add_menu'));
		if (!is_array(get_option('themadmin')))
			add_option('themadmin', $this->default_settings);
		$this->options = get_option('themadmin');
	}

	function add_menu() {
		add_theme_page('WP Theme Options', 'Theme LPG Options', 8, "themadmin", array(&$this, 'optionsmenu'));
	}

	// Сохраняем значения формы с настройками
	function optionsmenu() {
		if ($_POST['ss_action'] == 'save') {
			$this->options["phone"] = $_POST['cp_phone'];
			$this->options["email"] = $_POST['cp_email'];
			$this->options["googlemaps"] = $_POST['cp_googlemaps'];
			$this->options["facebook"] = $_POST['cp_facebook'];
			$this->options["twitter"] = $_POST['cp_twitter'];
			$this->options["youtube"] = $_POST['cp_youtube'];
			$this->options["instagram"] = $_POST['cp_instagram'];
			$this->options["metrika"] = $_POST['cp_metrika'];
			$this->options["big-call-to-action"] = $_POST['cp_big-call-to-action'];
			$this->options["small-call-to-action"] = $_POST['cp_small-call-to-action'];
			$this->options["btn-label"] = $_POST['cp_btn-label'];
			update_option('themadmin', $this->options);
			echo '<div class="updated fade" id="message" style="background-color: rgb(255, 251, 204); width: 400px; margin-left: 17px; margin-top: 17px;"><p>Settings<strong> saved</strong>.</p></div>';
		}
		// Создаем форму для настроек
		echo '<form action="" method="post" class="themeform">';
		echo '<input type="hidden" id="ss_action" name="ss_action" value="save">';

		print '<div class="cptab"><br />
 <b>Theme LPG Options</b>
 <br />
 <h3>Contacts</h3>
 <p><input placeholder="Phone" style="width:300px;" name="cp_phone" id="cp_phone" value="'.$this->options["phone"].'"><label> - phone</label></p>
 <p><input placeholder="Email" style="width:300px;" name="cp_email" id="cp_email" value="'.$this->options["email"].'"><label> - email</label></p>
 <p><input placeholder="Link Google Maps" style="width:300px;" name="cp_googlemaps" id="cp_googlemaps" value="'.$this->options["googlemaps"].'"><label> - googlemaps</label></p>
 <h3>Social</h3>
 <p><input placeholder="Link Facebook" style="width:300px;" name="cp_facebook" id="cp_facebook" value="'.$this->options["facebook"].'"><label> - facebook</label></p>
 <p><input placeholder="Link Twitter" style="width:300px;" name="cp_twitter" id="cp_twitter" value="'.$this->options["twitter"].'"><label> - twitter</label></p>
 <p><input placeholder="Link youtube" style="width:300px;" name="cp_youtube" id="cp_youtube" value="'.$this->options["youtube"].'"><label> - youtube</label></p>
 <p><input placeholder="Link instagram" style="width:300px;" name="cp_instagram" id="cp_instagram" value="'.$this->options["instagram"].'"><label> - instagram</label></p>
 <h3>Call to action</h3>
 <p><input placeholder="Big call to action" style="width:300px;" name="cp_big-call-to-action" id="cp_big-call-to-action" value="'.$this->options["big-call-to-action"].'"><label> - big-call-to-action</label></p>
 <p><input placeholder="Small call to action" style="width:300px;" name="cp_small-call-to-action" id="cp_small-call-to-action" value="'.$this->options["small-call-to-action"].'"><label> - small-call-to-action</label></p>
 <p><input placeholder="Button label" style="width:300px;" name="cp_btn-label" id="cp_btn-label" value="'.$this->options["btn-label"].'"><label> - btn-label</label></p> 
 <h3>Code in the footer.php</h3>
 <p><textarea placeholder="Здесь можно прописать коды счетчиков или дополнительных скриптов" style="width:300px;" name="cp_metrika" id="cp_metrika">'.stripslashes($this->options["metrika"]).'</textarea><label> - здесь можно прописать коды счетчиков или дополнительных скриптов</label></p>

 </div><br />';
		echo '<input class="button button-primary" type="submit" value="Save Changes" name="cp_save" class="dochanges" />';
		echo '</form>';
	}
}
$cpanel = new ControlPanel();
$mytheme = get_option('themadmin');
?>
<?php
/*****************************************/
/******          WIDGETS     *************/
/*****************************************/
add_action('widgets_init', 'lpg_register_widgets');

function lpg_register_widgets() {


	register_widget('lpg_team_widget');


	$lpg_sidebars = array (  'sidebar-ourteam' => 'sidebar-ourteam' );

	/* Register sidebars */
	foreach ( $lpg_sidebars as $lpg_sidebar ):

		if( $lpg_sidebar == 'sidebar-ourteam' ):

			$lpg_name = __('Our team section widgets', 'lpg');

		else:

			$lpg_name = $lpg_sidebar;

		endif;

		register_sidebar(
			array (
				'name'          => $lpg_name,
				'id'            => $lpg_sidebar,
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>'
			)
		);

	endforeach;

}

/**
 * Add default widgets
 */
add_action('after_switch_theme', 'lpg_register_default_widgets');

function lpg_register_default_widgets() {

	$lpg_sidebars = array ( 'sidebar-ourteam' => 'sidebar-ourteam' );

	$active_widgets = get_option( 'sidebars_widgets' );



	/**
	 * Default Our Team widgets
	 */
	if ( empty ( $active_widgets[ $lpg_sidebars['sidebar-ourteam'] ] ) ):

		$lpg_counter = 1;

		/* our team widget #1 */
		$active_widgets[ 'sidebar-ourteam' ][0] = 'lpg_team-widget-' . $lpg_counter;
		$ourteam_content[ $lpg_counter ] = array ( 'name' => 'Helen Mirten', 'position' => 'Account Manager', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque', 'fb_link' => '#', 'tw_link' => '#', 'gp_link' => '#', 'ln_link' => '#', 'image_uri' => get_template_directory_uri()."/images/team-1.jpg" );
		update_option( 'widget_lpg_team-widget', $ourteam_content );
		$lpg_counter++;

		/* our team widget #2 */
		$active_widgets[ 'sidebar-ourteam' ][] = 'lpg_team-widget-' . $lpg_counter;
		$ourteam_content[ $lpg_counter ] = array ( 'name' => 'Andrew Bird', 'position' => 'Technical Director', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque', 'fb_link' => '#', 'tw_link' => '#', 'gp_link' => '#', 'ln_link' => '#', 'image_uri' => get_template_directory_uri()."/images/team-2.jpg" );
		update_option( 'widget_lpg_team-widget', $ourteam_content );
		$lpg_counter++;

		/* our team widget #3 */
		$active_widgets[ 'sidebar-ourteam' ][] = 'lpg_team-widget-' . $lpg_counter;
		$ourteam_content[ $lpg_counter ] = array ( 'name' => 'Kristen Bell', 'position' => 'Project Manager', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque', 'fb_link' => '#', 'tw_link' => '#', 'gp_link' => '#', 'ln_link' => '#', 'image_uri' => get_template_directory_uri()."/images/team-3.jpg" );
		update_option( 'widget_lpg_team-widget', $ourteam_content );
		$lpg_counter++;

		/* our team widget #4 */
		$active_widgets[ 'sidebar-ourteam' ][] = 'lpg_team-widget-' . $lpg_counter;
		$ourteam_content[ $lpg_counter ] = array ( 'name' => 'Harry Wise', 'position' => 'Business Development', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque. Nunc dapibus, eros at accumsan auctor, felis eros condimentum quam, non porttitor est urna vel neque', 'fb_link' => '#', 'tw_link' => '#', 'gp_link' => '#', 'ln_link' => '#', 'image_uri' => get_template_directory_uri()."/images/team-4.jpg" );
		update_option( 'widget_lpg_team-widget', $ourteam_content );
		$lpg_counter++;

		update_option( 'sidebars_widgets', $active_widgets );

	endif;

}
?>
<?php
/****************************/
/****** team member widget **/
/***************************/

add_action('admin_enqueue_scripts', 'lpg_team_widget_scripts');

function lpg_team_widget_scripts() {

	wp_enqueue_media();

	wp_enqueue_script('lpg_team_widget_script', get_template_directory_uri() . '/js/adpic.js');

}

class lpg_team_widget extends WP_Widget {

	public function __construct() {
		parent::__construct('lpg_team-widget',	__( 'lpg - Team member widget', 'lpg' ));
	}

	function widget( $args, $instance ) {

		extract( $args );

		echo $before_widget;

		?>

		<div class="col-lg-3 col-md-3 col-sm-6 team-box">

			<div class="team-member">

				<?php if ( ! empty( $instance['image_uri'] ) && ( $instance['image_uri'] != 'Upload Image' ) ) { ?>

					<figure class="profile-pic">

						<img src="<?php echo esc_url( $instance['image_uri'] ); ?>"
						     alt="<?php _e( 'Uploaded image', 'lpg' ); ?>"/>

					</figure>
					<?php
				} elseif ( ! empty( $instance['custom_media_id'] ) ) {

					$lpg_team_custom_media_id = wp_get_attachment_image_src( $instance["custom_media_id"] );
					if ( ! empty( $lpg_team_custom_media_id ) && ! empty( $lpg_team_custom_media_id[0] ) ) {
						?>

						<figure class="profile-pic">

							<img src="<?php echo esc_url( $lpg_team_custom_media_id[0] ); ?>"
							     alt="<?php _e( 'Uploaded image', 'lpg' ); ?>"/>

						</figure>

						<?php
					}
				}
				?>

				<div class="member-details">

					<?php if ( ! empty( $instance['name'] ) ): ?>

						<h3 class="dark-text red-border-bottom"><?php echo apply_filters( 'widget_title', $instance['name'] ); ?></h3>

					<?php endif; ?>

					<?php if ( ! empty( $instance['position'] ) ): ?>

						<div
							class="position"><?php echo htmlspecialchars_decode( apply_filters( 'widget_title', $instance['position'] ) ); ?></div>

					<?php endif; ?>

				</div>

				<div class="social-icons">

					<ul>
						<?php
						$lpg_team_target = '_self';
						if ( ! empty( $instance['open_new_window'] ) ):
							$lpg_team_target = '_blank';
						endif;
						?>

						<?php if ( ! empty( $instance['fb_link'] ) ): ?>
							<li><a href="<?php echo apply_filters( 'widget_title', $instance['fb_link'] ); ?>"
							       target="<?php echo $lpg_team_target; ?>"><i
										class="fa fa-facebook"></i></a></li>
						<?php endif; ?>

						<?php if ( ! empty( $instance['tw_link'] ) ): ?>
							<li><a href="<?php echo apply_filters( 'widget_title', $instance['tw_link'] ); ?>"
							       target="<?php echo $lpg_team_target; ?>"><i
										class="fa fa-twitter"></i></a></li>
						<?php endif; ?>

						<?php if ( ! empty( $instance['gp_link'] ) ): ?>
							<li><a href="<?php echo apply_filters( 'widget_title', $instance['gp_link'] ); ?>"
							       target="<?php echo $lpg_team_target; ?>"><i
										class="fa fa-google-plus"></i></a></li>
						<?php endif; ?>

						<?php if ( ! empty( $instance['ln_link'] ) ): ?>
							<li><a href="<?php echo apply_filters( 'widget_title', $instance['ln_link'] ); ?>"
							       target="<?php echo $lpg_team_target; ?>"><i
										class="fa fa-linkedin"></i></a></li>
						<?php endif; ?>

					</ul>

				</div>

				<?php if ( ! empty( $instance['description'] ) ): ?>
					<div class="details">

						<?php echo htmlspecialchars_decode( apply_filters( 'widget_title', $instance['description'] ) ); ?>

					</div>
				<?php endif; ?>

			</div>

		</div>

		<?php

		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['name']            = strip_tags( $new_instance['name'] );
		$instance['position']        = stripslashes( wp_filter_post_kses( $new_instance['position'] ) );
		$instance['description']     = stripslashes( wp_filter_post_kses( $new_instance['description'] ) );
		$instance['fb_link']         = strip_tags( $new_instance['fb_link'] );
		$instance['tw_link']         = strip_tags( $new_instance['tw_link'] );
		$instance['gp_link']         = strip_tags( $new_instance['gp_link'] );
		$instance['ln_link']         = strip_tags( $new_instance['ln_link'] );
		$instance['image_uri']       = strip_tags( $new_instance['image_uri'] );
		$instance['open_new_window'] = strip_tags( $new_instance['open_new_window'] );
		$instance['custom_media_id'] = strip_tags( $new_instance['custom_media_id'] );

		return $instance;

	}

	function form( $instance ) {

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Name', 'lpg' ); ?></label><br/>
			<input type="text" name="<?php echo $this->get_field_name( 'name' ); ?>"
			       id="<?php echo $this->get_field_id( 'name' ); ?>"
			       value="<?php if ( ! empty( $instance['name'] ) ): echo $instance['name']; endif; ?>"
			       class="widefat"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'position' ); ?>"><?php _e( 'Position', 'lpg' ); ?></label><br/>
			<textarea class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name( 'position' ); ?>"
			          id="<?php echo $this->get_field_id( 'position' ); ?>"><?php if ( ! empty( $instance['position'] ) ): echo htmlspecialchars_decode( $instance['position'] ); endif; ?></textarea>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description', 'lpg' ); ?></label><br/>
            <textarea class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name( 'description' ); ?>"
                      id="<?php echo $this->get_field_id( 'description' ); ?>"><?php
	            if ( ! empty( $instance['description'] ) ): echo htmlspecialchars_decode( $instance['description'] ); endif;
	            ?></textarea>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'fb_link' ); ?>"><?php _e( 'Facebook link', 'lpg' ); ?></label><br/>
			<input type="text" name="<?php echo $this->get_field_name( 'fb_link' ); ?>"
			       id="<?php echo $this->get_field_id( 'fb_link' ); ?>"
			       value="<?php if ( ! empty( $instance['fb_link'] ) ): echo $instance['fb_link']; endif; ?>"
			       class="widefat">

		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'tw_link' ); ?>"><?php _e( 'Twitter link', 'lpg' ); ?></label><br/>
			<input type="text" name="<?php echo $this->get_field_name( 'tw_link' ); ?>"
			       id="<?php echo $this->get_field_id( 'tw_link' ); ?>"
			       value="<?php if ( ! empty( $instance['tw_link'] ) ): echo $instance['tw_link']; endif; ?>"
			       class="widefat">
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'gp_link' ); ?>"><?php _e( 'Google plus', 'lpg' ); ?></label><br/>
			<input type="text" name="<?php echo $this->get_field_name( 'gp_link' ); ?>"
			       id="<?php echo $this->get_field_id( 'gp_link' ); ?>"
			       value="<?php if ( ! empty( $instance['gp_link'] ) ): echo $instance['gp_link']; endif; ?>"
			       class="widefat">

		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'ln_link' ); ?>"><?php _e( 'Linkedin link', 'lpg' ); ?></label><br/>
			<input type="text" name="<?php echo $this->get_field_name( 'ln_link' ); ?>"
			       id="<?php echo $this->get_field_id( 'ln_link' ); ?>"
			       value="<?php if ( ! empty( $instance['ln_link'] ) ): echo $instance['ln_link']; endif; ?>"
			       class="widefat">
		</p>
		<p>
			<input type="checkbox" name="<?php echo $this->get_field_name( 'open_new_window' ); ?>"
			       id="<?php echo $this->get_field_id( 'open_new_window' ); ?>" <?php if ( ! empty( $instance['open_new_window'] ) ): checked( (bool) $instance['open_new_window'], true ); endif; ?> ><?php _e( 'Open links in new window?', 'lpg' ); ?>
			<br>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'image_uri' ); ?>"><?php _e( 'Image', 'lpg' ); ?></label><br/>

			<?php

			if ( ! empty( $instance['image_uri'] ) ) :

				echo '<img class="custom_media_image_team" src="' . $instance['image_uri'] . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" alt="' . __( 'Uploaded image', 'lpg' ) . '" /><br />';

			endif;

			?>

			<input type="text" class="widefat custom_media_url_team"
			       name="<?php echo $this->get_field_name( 'image_uri' ); ?>"
			       id="<?php echo $this->get_field_id( 'image_uri' ); ?>"
			       value="<?php if ( ! empty( $instance['image_uri'] ) ): echo $instance['image_uri']; endif; ?>"
			       style="margin-top:5px;">
			<input type="button" class="button button-primary custom_media_button_team" id="custom_media_button_clients"
			       name="<?php echo $this->get_field_name( 'image_uri' ); ?>"
			       value="<?php _e( 'Upload Image', 'lpg' ); ?>" style="margin-top:5px;">
		</p>

		<input class="custom_media_id" id="<?php echo $this->get_field_id( 'custom_media_id' ); ?>"
		       name="<?php echo $this->get_field_name( 'custom_media_id' ); ?>" type="hidden"
		       value="<?php if ( ! empty( $instance["custom_media_id"] ) ): echo $instance["custom_media_id"]; endif; ?>"/>

		<?php

	}

}?>
