<div class="clear"></div>
</div><!--end container -->
<div class="dp-widgets-stra"></div>
<?php
get_sidebar( 'footer' );
?>
<div id="footer"><!-- start #footer -->
<a href="https://n3rds.work" title="<?php _e( 'Theme by WWMS N@W', THEME_TEXT_DOMAIN )?>" ><?php _e( 'PSOURCE', THEME_TEXT_DOMAIN ) ?></a><a href="<?php echo get_option('home'); ?>"><?php _e( 'Copyright', THEME_TEXT_DOMAIN ) ?> &copy;<?php echo gmdate(__('Y')); ?> <?php bloginfo('name'); ?></a><a href="#site-wrapper"><?php _e('Zurück nach oben &uarr;', THEME_TEXT_DOMAIN ); ?></a>
</div><!-- end #footer -->
</div><!-- end #site-wrapper -->
<?php wp_footer(); ?>
</body>
</html>
