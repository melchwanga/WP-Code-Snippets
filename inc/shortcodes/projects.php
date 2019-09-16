<?php
function projects_shortcode($atts, $content = null, $tag) {

		$vars = shortcode_atts(array(
			"text_overlay" => "",
			"title" => "",
			"style" => "slider",//slider,grid
			"bg" => "",//background image
      "id" => "",//project id for gallery
      "columns" => "4",
      "number" => "-1",
		), $atts);

		ob_start();

		extract($vars);

    $args = array(
        'post_type' => 'project',
        'posts_per_page' => '-1',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $query = new WP_Query($args);
    
    if($style == 'slider'){

        fw_get_projects_slider($query,$vars);

    }else{
        fw_get_projects_grid($query,$vars);
    }
		
		$cont = ob_get_contents();

		ob_end_clean();

		return $cont;
}
add_shortcode('fw_projects','projects_shortcode');


function fw_get_projects_slider($query,$vars){
  
   extract($vars);

   ?><section id="featured-section" class="pad-top50 pad-bottom20">
          <?php if($title || $text_overlay):?>
            <div class="container">
                <div class="row">
                    <div class="all_heading positionR">
                        <?php
                           if($text_overlay) echo '<h1>'.$text_overlay.'</h1>';
                           if($title) echo '<h2>'.$title.'</h2>';
                        ?>
                    </div>
                </div>
            </div>
          <?php endif; //var_dump($query);?>
            <div class="featured_video owl-carousel mar-top0 grid" id="video-slider">
              <?php while($query->have_posts()): $query->the_post();?>
                <div class="col-md-12 col-sm-12">
                    <?php get_template_part('template-parts/content',get_post_type());?>
                </div>
              <?php endwhile; wp_reset_postdata();?>
            </div>
        </section>
        <!--//================featured end=============//-->
        <div class="clear"></div>
   <?php
}

function fw_get_projects_grid($query,$vars){
  
   extract($vars);

   ?><section id="featured-section" class="pad-top0 pad-bottom20">
          <?php if($title || $text_overlay):?>
            <div class="container">
                <div class="row">
                    <div class="all_heading positionR">
                        <?php
                           if($text_overlay) echo '<h1>'.$text_overlay.'</h1>';
                           if($title) echo '<h2>'.$title.'</h2>';
                        ?>
                    </div>
                </div>
            </div>
          <?php endif; //var_dump($query);?>
          <div class="container-fluid">
            <div class="featured_video mar-top50 grid row" id="video-grid">
              <?php while($query->have_posts()): $query->the_post();?>
                <div class="col-md-4 col-sm-6">
                    <?php get_template_part('template-parts/content',get_post_type());?>
                </div>
              <?php endwhile; wp_reset_postdata();?>
            </div>
          </div>
      </section>
      <!--//================featured end=============//-->
      <div class="clear"></div>
   <?php
}