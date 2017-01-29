
<?php if( is_home() ){
	dynamic_sidebar( 'our-news' );
}elseif (is_page('our-clients')){

}
else{?>
<aside id="secondary" class="widget-area" role="complementary" data-scrollreveal="enter right after 0s over 1s">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><?php } ?>



