<?php get_header(); ?>
<!-- Our Commercial
========================================== -->
<?php get_sidebar('top'); ?>
<!-- /.our commercial -->
<!-- Form-get-in-toch
========================================== -->
<div  class="container container-get-in-touch">
	<div  class="row" >
		<div id="anchor1" class="forms_wrap col-lg-4 col-md-5 col-sm-6 col-xs-12" data-scrollreveal="enter left after 0s over 1s">
			<?php echo do_shortcode( '[pirate_forms]' ) ?>
			<div class="forms_clearfix clearfix"></div>
		</div>
	</div>
</div>
<!-- /.form-get-in-touch -->
<!-- Post-page home
========================================== -->
<?php
global $paged;
if(is_home() && $paged == "") : $my_query = new WP_Query('pagename=home'); // тут надо указать название требуемой page
	while ($my_query->have_posts()) : $my_query->the_post(); ?>
		<div class="container container-home-article" >
			<div class="post" data-scrollreveal="enter right after 0s over 1s">
				<h1><?php the_title(); ?></h1>
				<?php the_content(' '); ?>
			</div>
		</div>
	<?php endwhile; ?>
<?php endif; ?><!-- /.post-page home -->
<!-- Your team
========================================== -->
<?php get_sidebar('first-middle'); ?>
<!-- /.your team -->
<!-- Our services
========================================== -->
<?php get_sidebar('middle'); ?>
<!-- /.our services -->
<!-- To-get-in-toch1
========================================== -->
<div  class="container container-jumbotron opacity"  >
	<div class="jumbotron" data-scrollreveal="enter right after 0s over 1s">
			<h1><?php echo $mytheme['big-call-to-action']; ?></h1>
			<p><?php echo $mytheme['small-call-to-action']; ?></p>
			<p class="anchor">
				<a class="btn btn-lg  btn-danger"  value="anchor1"><?php echo $mytheme['btn-label']; ?></a>
			</p>
	</div>
</div>
<!-- /.to-get-in-toch1 -->
<!-- Our clients
========================================== -->
<div class="container container-clients" >
	<?php
	global $paged;
	if(is_home() && $paged == "") :	$my_query = new WP_Query('pagename=our-clients'); // тут надо указать название требуемой page
		while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<div class="row" data-scrollreveal="enter bottom after 0s over 1s">
				<div class="clients-heading">
					<h1><?php the_title(); ?></h1>
				</div>
				<?php the_content(' '); ?>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
<!-- /.our clients -->
<!-- Our News
========================================== -->
<?php get_sidebar(); ?>
<!-- /.Our News -->
<!-- To-get-in-toch2
========================================== -->
<div class="container container-jumbotron">
	<div class="jumbotron" data-scrollreveal="enter right after 0s over 1s">
			<h1><?php echo $mytheme['big-call-to-action']; ?></h1>
			<p><?php echo $mytheme['small-call-to-action']; ?></p>
			<p class="anchor">
				<a class="btn btn-lg  btn-danger" value="anchor1"><?php echo $mytheme['btn-label']; ?></a>
			</p>
	</div>
</div>
<!-- /.to-get-in-toch2 -->
<?php get_footer(); ?>
</div>
