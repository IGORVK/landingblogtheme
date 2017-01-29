<?php
/**
 * lpg functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lpg
 */



remove_action( 'wp_head', 'feed_links_extra', 3 ); // ссылки доп. фидов (на рубрики)
remove_action( 'wp_head', 'feed_links',       2 ); // ссылки фидов (основные фиды)
// <link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://site.ru/xmlrpc.php?rsd" /> для публикации статей через сторонние сервисы
remove_action( 'wp_head', 'rsd_link'            );
// <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://site.ru/wp-includes/wlwmanifest.xml" /> . Используется клиентом Windows Live Writer.
remove_action( 'wp_head', 'wlwmanifest_link'    );
//remove_action( 'wp_head', 'index_rel_link'      ); // не поддерживается с версии 3.3

add_filter('the_generator', '__return_empty_string'); // Убираем версию WordPress

// 3.0
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 ); // Ссылки на соседние статьи (<link rel='next'... <link rel='prev'...)
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );// Короткая ссылка - без ЧПУ <link rel='shortlink'

// 4.6
remove_action( 'wp_head', 'wp_resource_hints', 2); // Prints resource hints to browsers for pre-fetching, pre-rendering and pre-connecting to web sites.

//remove version wp from links
function wp_version_js_css($src) {
	if (strpos($src, 'ver=' . get_bloginfo('version')))
		$src = remove_query_arg('ver', $src);
	return $src;
}
add_filter('style_loader_src', 'wp_version_js_css', 9999);
add_filter('script_loader_src', 'wp_version_js_css', 9999);







if ( ! function_exists( 'lpg_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function lpg_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on lpg, use a find and replace
		 * to change 'lpg' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'lpg', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'lpg' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'lpg_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
	}
endif;
add_action( 'after_setup_theme', 'lpg_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lpg_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lpg_content_width', 640 );
}
add_action( 'after_setup_theme', 'lpg_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function lpg_scripts() {
	wp_enqueue_style( 'lpg-style', get_stylesheet_uri() );

	wp_enqueue_script( 'lpg-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'lpg-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_style( 'lpg_font_all', '//fonts.googleapis.com/css?family=Open+Sans');

	wp_enqueue_style( 'lpg_post-carousel_style', get_template_directory_uri() . '/css/owl.carousel.min.css');

	wp_enqueue_style( 'lpg_theme-post-carousel_style', get_template_directory_uri() . '/css/owl.theme.default.min.css');

	wp_enqueue_style('lpg_font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');

	wp_enqueue_style( 'lpg_bootstrap_style', get_template_directory_uri() . '/css/bootstrap.min.css');

	wp_enqueue_style( 'style', get_stylesheet_uri());

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js');
	wp_enqueue_script( 'jquery' );

	/* Postcarousel script */
	wp_enqueue_script('lpg_post-carousel_script', get_template_directory_uri() . '/js/owl.carousel.min.js');

	/* Bootstrap script */
	wp_enqueue_script('lpg_bootstrap_script', get_template_directory_uri() . '/js/bootstrap.min.js');
	

	/* scrollreveal */
	wp_enqueue_script('lpg_scrollReveal_script', get_template_directory_uri() . '/js/scrollReveal.js');

	/* smoothscroll */
	wp_enqueue_script('lpg_smoothscroll', get_template_directory_uri() . '/js/jquery.smooth-scroll.js',  '20151215', true);


	wp_enqueue_script('lpg_scroll-main_script', get_template_directory_uri() . '/js/main.js');


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lpg_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * tgm-plugin-activation
 */
require_once get_template_directory() . '/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'lpg_register_required_plugins');


/*--------------------------------------------------------------
# Create widget area for #LPG Widgets
--------------------------------------------------------------*/

/**
 * Register widget area.
 * /**
 * Creates a sidebar
 * @param string|array  Builds Sidebar based off of 'name' and 'id' values.
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lpg_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'lpg' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'lpg' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );


}
add_action( 'widgets_init', 'lpg_widgets_init' );



/*--------------------------------------------------------------
# Our News Widget
--------------------------------------------------------------*/


/**
 * Добавление нового виджета News_Widget.
 */
class News_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		parent::__construct(
			'news_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: news_widget
			'Our News',
			array( 'description' => 'Display News Posts', /*'classname' => 'my_widget',*/ )
		);
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Our News' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 6;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;



		//$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>
		<?php
		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$n = new WP_Query(  array(
			'category_name'       => 'our-news',
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) );

		?>
		<?php


		if ($n->have_posts() ) : while ( $n->have_posts() ) : $n->the_post();
			?>

			<!--post-->

			<div class="bubble ">
				<div class="member-bubble">
					<h2 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>

					<?php the_excerpt(); ?>

					<?php if ( $show_date ) : ?>
						<span class="date"> <?php the_time('j F Y'); ?></span>
					<?php endif; ?>
					<div class="tags"> <?php the_tags('<span>Tags:</span> '); ?></div>
				</div>
				<div class="member">
					<?php the_post_thumbnail('full'); ?>
					<div class="member-np">
						<div><p class="name"><?php the_author(); ?></p></div>
					</div>
				</div>
			</div><!-- /.col-lg-4 -->



		<?php  endwhile; ?>
			<!--post navigation-->
		<?php else: ?>
			<!--no posts found-->
		<?php endif; ?>



		<?php	echo $args['after_widget'];
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_query();
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 6;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>
		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label>
		</p>
		<?php
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		return $instance;
	}

}
// конец класса News_Widget
add_action( 'widgets_init', 'register_default_news_widget' );
// регистрация News_Widget в WordPress
function register_default_news_widget() {
	register_widget( 'News_Widget' );

	$sidebars = array ('our-news' => 'Our News' );

foreach ( $sidebars as $sidebar ) {
	register_sidebar( array(
		'name'          => $sidebar,
		'id'            => $sidebar,
		'description'   => esc_html__( 'Sidebar for page HOME. Contain widget Our News', 'lpg' ),
		'before_widget' => '<div class="container container-about-us ">
					<div class="about-us-heading">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h1 class="widget_title">',
		'after_title'   => '</h1>
                    </div>
         <div class="owl-carousel"  data-scrollreveal="enter left after 0s over 1s">'
	) );
}


	// Okay, now the funny part.

	// We don't want to undo user changes, so we look for changes first.
	$active_widgets = get_option( 'sidebars_widgets' );

	if ( ! empty ( $active_widgets[ $sidebars['our-news'] ] ) )
	{   // Okay, no fun anymore. There is already some content.
		return;
	}
	// The sidebars are empty, let's put something into them.
	// How about a RSS widget and two instances of our demo widget?

	// Note that widgets are numbered. We need a counter:
	$counter = 1;

	// Add a 'demo' widget to the top sidebar …
	$active_widgets[ $sidebars['our-news'] ][0] = 'news_widget-' . $counter;
	// … and write some text into it:
	// … and write some text into it:
	$demo_widget_content[ $counter ] = array ( 'title' => 'Our News','number' => '6', 'show_date' => 'true' );
	update_option( 'widget_news_widget', $demo_widget_content );

	$counter++;

	// Now save the $active_widgets array.
	update_option( 'sidebars_widgets', $active_widgets );
}




/*--------------------------------------------------------------
# Our Services Widget
--------------------------------------------------------------*/


/**
 * Добавление нового виджета Services_Widget.
 */
class Services_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		parent::__construct(
			'services_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: services_widget
			'Our Services',
			array( 'description' => 'Display Services Posts', /*'classname' => 'my_widget',*/ )
		);
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Our Services' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;



		//$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>
		<?php
		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
	/*	*/



		$s = new WP_Query(  array(
			'category_name'       => 'our-services',
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) );
		query_posts('cat=192');
		if ( $s->have_posts() ) : while ($s->have_posts() ) :  $s->the_post();
			?>

			<!--post category our services-->

			<div class="service">
				<?php if ( has_post_thumbnail()) : ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
						<?php the_post_thumbnail('full'); ?>
					</a>
				<?php endif; ?>
				<div class="service-post">
					<h2 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h2>
					<?php the_excerpt() ?>
					<p>
					<?php if ( $show_date ) : ?>
						<span class="date"> <?php the_time('j F Y'); ?></span>
					<?php endif; ?>
					</p>
				</div>
			</div><!-- /.col-lg-4 -->

		<?php  endwhile; ?>
			<!--post navigation-->
		<?php else: ?>
			<!--no posts found-->
		<?php endif; ?>



		<?php	echo $args['after_widget'];
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_query();
}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>
		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label>
		</p>
		<?php
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		return $instance;
	}

}
// конец класса Services_Widget
add_action( 'widgets_init', 'register_default_services_widget' );
// регистрация Services_Widget в WordPress
function register_default_services_widget() {
	register_widget( 'Services_Widget' );


$sidebars = array ('our-services' => 'Our Services' );

foreach ( $sidebars as $sidebar ) {

	register_sidebar(array(
		'name'          => $sidebar,
		'id'            => $sidebar,
		'description'   => esc_html__('Sidebar for page HOME. Contain widget Our Services','lpg'),
		'before_widget' => '<div class="container container-our-services">
					<div class="our-services-heading">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h1 class="widget_title">',
		'after_title'   => '</h1>
                    </div>
         <div class="owl-carousel "  data-scrollreveal="enter left after 0s over 1s">'
	));
}


// Okay, now the funny part.

// We don't want to undo user changes, so we look for changes first.
$active_widgets = get_option( 'sidebars_widgets' );

if ( ! empty ( $active_widgets[ $sidebars['our-services'] ] ) )
{   // Okay, no fun anymore. There is already some content.
	return;
}
// The sidebars are empty, let's put something into them.
// How about a RSS widget and two instances of our demo widget?

// Note that widgets are numbered. We need a counter:
$counter = 1;

// Add a 'demo' widget to the top sidebar …
$active_widgets[ $sidebars['our-services'] ][0] = 'services_widget-' . $counter;
// … and write some text into it:
// … and write some text into it:
$demo_widget_content[ $counter ] = array ( 'title' => "Our Services" );
update_option( 'widget_services_widget', $demo_widget_content );

$counter++;

// Now save the $active_widgets array.
update_option( 'sidebars_widgets', $active_widgets );
}


/*--------------------------------------------------------------
# Our Commercialces Widget
--------------------------------------------------------------*/
/**
 * Добавление нового виджета Commercial_Widget.
 */
class Commercial_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		parent::__construct(
			'commercial_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: commercial_widget
			'Our Commercial',
			array( 'description' => 'Display Commercial Posts', /*'classname' => 'my_widget',*/ )
		);
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Our Commercial' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 3;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;



		//$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>
		<?php
		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		/*	*/



		$c = new WP_Query(  array(
			'category_name'       => 'our-commercial',
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) );?>

		<!-- Indicators -->
		<ol class="carousel-indicators">
			<?php $count=0; if ( $c->have_posts() ) : while ($c->have_posts() ) :  $c->the_post();?>

				<li data-target="#myCarousel" data-slide-to="<?php echo $count; ?>" class="<?php if($count==0) echo ' active'; ?>"></li>

				<?php $count++; endwhile; ?>
				<!--post navigation-->
			<?php else: ?>
				<!--no posts found-->
			<?php  endif; ?>
		</ol>
		<?php $count=1;
		if ( $c->have_posts() ) : while ($c->have_posts() ) :  $c->the_post();
			?>

			<!--post category our commercial-->

			<div class="item  <?php if($count==1) echo ' active'; ?>">
				<?php the_post_thumbnail('full'); ?>
				<div class="container">
					<div class="carousel-caption">
						<h1><?php the_title(); ?></h1>
						<span class="discription"><?php the_excerpt() ?></span>

						<?php if ( $show_date ) : ?>
							<span class="date"> <?php the_time('j F Y'); ?></span>
						<?php endif; ?>

						<p><a class="btn btn-xs btn-primary" href="<?php the_permalink(); ?>" role="button">Read more</a></p>
					</div>
				</div>
			</div><!-- /.col-lg-4 -->
			<?php $count++; endwhile; ?>
			<!--post navigation-->
		<?php else: ?>
			<!--no posts found-->
		<?php endif; ?>



		<?php	echo $args['after_widget'];
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_query();
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>
		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label>
		</p>
		<?php
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		return $instance;
	}

}
// конец класса Commercial_Widget
add_action( 'widgets_init', 'register_default_commercial_widget' );
// регистрация Commercial_Widget в WordPress
function register_default_commercial_widget() {
	register_widget( 'Commercial_Widget' );


	$sidebars = array ('our-commercial' => 'Our Commercial' );

	foreach ( $sidebars as $sidebar ) {

		register_sidebar(array(
			'name'          => $sidebar,
			'id'            => $sidebar,
			'description'   => esc_html__('Sidebar for page HOME. Contain widget Our Commercial','lpg'),
			'before_widget' => '<div class="container container-carousel">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">',
			'after_widget'  => '</div><a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a></div></div>',
			'before_title'  => '<h1 class="widget_title_commercial">',
			'after_title'   => '</h1>'
		));




	}


// Okay, now the funny part.

// We don't want to undo user changes, so we look for changes first.
	$active_widgets = get_option( 'sidebars_widgets' );

	if ( ! empty ( $active_widgets[ $sidebars['our-commercial'] ] ) )
	{   // Okay, no fun anymore. There is already some content.
		return;
	}
// The sidebars are empty, let's put something into them.
// How about a RSS widget and two instances of our demo widget?

// Note that widgets are numbered. We need a counter:
	$counter = 1;

// Add a 'demo' widget to the top sidebar …
	$active_widgets[ $sidebars['our-commercial'] ][0] = 'commercial_widget-' . $counter;
// … and write some text into it:
// … and write some text into it:
	$demo_widget_content[ $counter ] = array ( 'title' => "Our Commercial" );
	update_option( 'widget_commercial_widget', $demo_widget_content );

	$counter++;

// Now save the $active_widgets array.
	update_option( 'sidebars_widgets', $active_widgets );
}




/*--------------------------------------------------------------
# Header Menu
--------------------------------------------------------------*/
register_nav_menu('menu', 'Header Menu');

/*--------------------------------------------------------------
# Thumbnails
--------------------------------------------------------------*/
add_theme_support( 'post-thumbnails' );


/*--------------------------------------------------------------
# Installation plugitns for Theme LPG
--------------------------------------------------------------*/
function lpg_register_required_plugins() {

	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => 'Contact Form for LPG Theme', // The plugin name.
			'slug'               => 'lpg-contact-form', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/lib/plugins/lpg-contact-form.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),


	);

	$config = array(
		'default_path' => '',
		'menu' => 'tgmpa-install-plugins',
		'has_notices' => true,
		'dismissable' => true,
		'dismiss_msg' => '',
		'is_automatic' => false,
		'message' => '',
		'strings' => array(
			'page_title' => __('Install Required Plugins', 'lpg'),
			'menu_title' => __('Install Plugins', 'lpg'),
			'installing' => __('Installing Plugin: %s', 'lpg'),
			'oops' => __('Something went wrong with the plugin API.', 'lpg'),
			'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.','lpg'),
			'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.','lpg'),
			'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.','lpg'),
			'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.','lpg'),
			'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.','lpg'),
			'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.','lpg'),
			'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.','lpg'),
			'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.','lpg'),
			'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins','lpg'),
			'activate_link' => _n_noop('Begin activating plugin', 'Begin activating plugins','lpg'),
			'return' => __('Return to Required Plugins Installer', 'lpg'),
			'plugin_activated' => __('Plugin activated successfully.', 'lpg'),
			'complete' => __('All plugins installed and activated successfully. %s', 'lpg'),
			'nag_type' => 'updated'
		)
	);

	tgmpa($plugins, $config);

}

// Make sure featured images are enabled
add_theme_support( 'post-thumbnails' );

// Add featured image sizes
add_image_size( 'featured-large', 640, 294, true ); // width, height, crop
add_image_size( 'featured-small', 320, 147, true );

// Add other useful image sizes for use through Add Media modal
add_image_size( 'medium-width', 480 );
add_image_size( 'medium-height', 9999, 480 );
add_image_size( 'medium-something', 480, 480 );

// Register the three useful image sizes for use in Add Media modal
add_filter( 'image_size_names_choose', 'wpshout_custom_sizes' );
function wpshout_custom_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'medium-width' => __( 'Medium Width' ),
		'medium-height' => __( 'Medium Height' ),
		'medium-something' => __( 'Medium Something' ),
	) );
}

if (get_option('upload_path')=='wp-content/uploads' || get_option('upload_path')==null) {
	update_option('upload_path','wp-content/themes/lpg/images');
}



include('functions/settings.php');

?>
