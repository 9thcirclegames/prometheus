<?php
echo $args['before_widget'];
		if ( ! empty( $instance['logo_url'] ) ) {
		  ?>
      <div class="logo 9thcirclegames">
        <a href="<?php echo $instance['link_url']; ?>" title="9th Circle Games" target="_blank">
        <img src="<?php echo $instance['logo_url']; ?>" />
        </a>
      </div>
      <?php
    }
		echo $args['after_widget'];
?>