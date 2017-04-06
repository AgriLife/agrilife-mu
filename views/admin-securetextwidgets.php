<div class="wrap">

	<?php screen_icon(); ?>
	<h2><?php _e( 'Secure Text Widgets', 'agriflex' ); ?></h2><?php

		require_once AMU_DIR_PATH . 'includes/Replace.php';
		$replace = new Replace;

	?>
  <div class="updated notice"><p>Your text widgets have been updated to remove image URL protocols.</p></div>

</div><!-- .wrap -->
