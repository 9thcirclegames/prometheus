<?php
echo $args['before_widget'];
		  ?>
      <div class="brand-footer">
      <p class="brand-name">9th Circle Games Brands</p> 
      <p class="footer-links">
        <a href="<?php echo $instance['eden_url']; ?>">Eden: Deception</a>
        <a href="<?php echo $instance['woc_url']; ?>">Wisdom of Cthulhu</a>
      </p>
      <ul class="inline-list social">
        <a class="facebook" href="https://www.facebook.com/9thcirclegames"><i class="fa fa-facebook"></i></a>
        <a class="twitter" href="https://twitter.com/9thcirclegames"><i class="fa fa-twitter"></i></a>
        <a class="linkedin" href="https://www.linkedin.com/company/9th-circle-games" target="_blank"><i class="fa fa-linkedin"></i></a>
        <a class="github" href="https://github.com/9thcirclegames" target="_blank"><i class="fa fa-github"></i></a>
      </ul>
    </div>

      <?php
		echo $args['after_widget'];
?>