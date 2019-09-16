<?php
function fw_testimonials_shortcode($atts, $content = null, $tag) {

		$vars = shortcode_atts(array(
			"title" => get_field('testimonials_title','option'),
			"text_overlay" => get_field('testimonials_text_overlay','option'),
			"bg" => "",//background image
		), $atts);

		ob_start();

    fw_get_testimonials($vars);
		
		$cont = ob_get_contents();

		ob_end_clean();

		return $cont;
}
add_shortcode('fw_testimonials','fw_testimonials_shortcode');

function fw_get_testimonials($vars){

  extract($vars);

  $items = get_field('testimonials','option');

  ?><section id="testimonial-section" class="pad-bottom100 pad-top50 grey-bg">
            <div class="container">
                <div class="row">
                    <div class="all_heading positionR">
                       <?php
                          if($text_overlay){
                            echo '<h1>'.$text_overlay.'</h1>';
                          }
                          if($title){
                            echo '<h2>'.$title.'</h1>';
                          }
                       ?>
                        
                    </div>
                    <div class="col-md-8 col-sm-8 col-lg-8 col-xs-12 col-md-offset-2 col-sm-offset-2">
                        <div class="testimonial owl-carousel mar-top50" id="testimonial-slider">
                          <?php foreach($items as $item): extract($item);?>
                            <div class="item">
                                <div class="testimonial_content">                                    
                                    <p><?php echo $message;?></p>
                                    <h3><?php echo $name;?> <?php if($title)echo '- <span>'.$title.'</span>';?></h3>
                                </div>
                            </div>
                          <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
  <?php
}