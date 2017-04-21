<div class="wrap">

	<?php screen_icon(); ?>
	<h2><?php _e( 'Secure Content', 'agriflex' ); ?></h2>
	<h3>SQL commands to secure every site's "siteurl" and "home" settings</h3>
	<textarea cols="60" rows="15"><?php

		require_once AMU_DIR_PATH . 'includes/Replace.php';
		$replace = new Replace;

	?></textarea>
  <div class="updated notice"><p>Your text widgets have been updated to remove image URL protocols.</p></div>

</div><!-- .wrap -->
