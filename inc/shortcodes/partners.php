<?php
function partners_shortcode($atts, $content = null, $tag) {

		$vars = shortcode_atts(array(
			"headline" => "",
			"title" => "Our Partners",
            "bg_title" => "",
			"style" => "grid",//slider,grid
			"bg" => "",//background image
		), $atts);

		ob_start();

		extract($vars);

		$args = array(
	     'post_type' => 'partner',
         'post_parent' => 0,
	     'posts_per_page' => '-1',
	     'orderby' => 'DATE',
	     'order' => 'ASC',
	   );
        $query = new WP_Query($args);

        if($query->have_posts()){
        	if($style == 'grid'){
        		get_partners_grid($query,$vars);
        	}else{
        		get_partners_slider($query,$vars);
        	}
        }
		
		$cont = ob_get_contents();

		ob_end_clean();

		return $cont;
}
add_shortcode('fw_partners','partners_shortcode');

function get_partners_grid($query,$atts){
	
	   extract($atts);//headline,title,bg
	?><section class="news-section alternate">
        <div class="auto-container">
            <div class="sec-title">
                <?php
                  if($headline){
                      echo '<span class="float-text">'.$headline.'</span>';
                  }
                  if($title){
                      echo '<h2>'.$title.'</h2>';
                  }
                ?>
                
            </div>
            <div class="row">
              <?php while($query->have_posts()): $query->the_post();?>
                <!-- News Block -->
                <div class="news-block-two col-lg-2 col-md-3 col-sm-4 col-xs-6">
                    <div class="inner-box">
                        <div class="image-box"><figure class="image"><img src="<?php echo get_the_post_thumbnail_url($post->ID,'medium-wide');?>" alt="<?php the_title();?>" title="<?php the_title();?>"></figure>
                        </div>
                    </div>
                </div>
              <?php endwhile; wp_reset_postdata();?>

            </div>
        </div>
    </section>
	<?php
}

function get_partners_slider($query,$atts){
	
	   extract($atts);//headline,title,bg
	?>
	<section class="clients-section">
        <div class="inner-container">
        	<div class="sec-title">
                <?php
                  if($title){
                      echo '<span class="float-text">'.$title.'</span>';
                  }
                ?>
                
            </div>
            <div class="sponsors-outer">
                <!--Sponsors Carousel-->
                <ul class="sponsors-carousel owl-carousel owl-theme">
                	 <?php while($query->have_posts()): $query->the_post();?>
                        <li class="slide-item">
                        	<figure class="image-box">
                        		<a><img src="<?php echo get_the_post_thumbnail_url($post->ID,'full');?>" title="<?php the_title();?>" alt="<?php the_title();?>">
                        	</a>
	                        </figure>
	                    </li>
                     <?php endwhile;?>
                </ul>
            </div>
        </div>
    </section>
	<?php
}