<?php global $mytheme; ?>
<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lpg
 */

?>
<div class="clearfix"></div>
		<footer>
			<div class="container container-footer">

				<div class="col-md-3 col-sm-3 company-details">
					<div class="icon-top red-text">
						<span class="glyphicon glyphicon-map-marker"></span>
					</div>
					<div class="lpg-footer-address">
						<a href="<?php echo $mytheme['googlemaps']; ?>">Company Address</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 company-details">
					<div class="icon-top green-text">
						<span class="glyphicon glyphicon-envelope"></span>
					</div>
					<div class="lpg-footer-email">
						<a href="mailto:<?php echo $mytheme['email']; ?>"><?php echo $mytheme['email']; ?></a>
					</div>
				</div>
				<div class="col-md-3  col-sm-3 company-details"><div class="icon-top blue-text">
						<span class="glyphicon glyphicon-earphone"></span>
					</div>
					<div class="lpg-footer-phone">
						<a href="tel:<?php echo $mytheme['phone']; ?>"><?php echo $mytheme['phone']; ?></a>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 copyright company-details">
					<ul class="nav  nav-footer footer-icons">
						<li><a href="<?php echo $mytheme['facebook']; ?>"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
						<li><a href="<?php echo $mytheme['twitter']; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li><a href="<?php echo $mytheme['youtube']; ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
						<li><a href="<?php echo $mytheme['instagram']; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					</ul>
					<div class="lpg-copyright-box">
						<a class="lpg-copyright" href="#" target="_blank" rel="nofollow">LPG</a>
						<a class="lpg-copyright" href="#" target="_blank" rel="nofollow"> powered by Wordpress </a>
					</div>
				</div>
			</div>
		</footer>

		<?php wp_footer(); ?></div><!-- #page -->
		</body>
</html>
