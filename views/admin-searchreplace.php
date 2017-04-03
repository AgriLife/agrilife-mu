<div class="wrap">

	<?php screen_icon(); ?>
	<h2><?php _e( 'Search and Replace', 'agriflex' ); ?></h2>

	<h3>Remove image URL protocol from posts: </h3>
	<textarea name="SQL" style="white-space:pre;" cols="55" rows="10"><?php

		require_once AMU_DIR_PATH . 'includes/Replace.php';
		$replace = new Replace;

		?></textarea>

</div><!-- .wrap -->
