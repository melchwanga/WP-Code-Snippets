<?php
function products_shortcode($atts, $content = null, $tag) {

		$vars = shortcode_atts(array(
			"headline" => "",
			"title" => "",
      "bg_title" => "",
			"style" => "grid",//slider,grid,slider2
			"bg" => "",//background image
		), $atts);

		ob_start();

		extract($vars);

		$args = array(
	     'post_type' => 'service',
       'post_parent' => 0,
	     'posts_per_page' => '-1',
	     'orderby' => 'DATE',
	     'order' => 'ASC',
	   );
    if(is_singular('product')){
      $args['post__not_in'] = array(get_the_ID());
    }
	   $query = new WP_Query($args);

	   if($query->have_posts()){
           if($style == 'slider'){
              fw_get_products_slider($vars,$query);
           }else if($style == 'slider2'){
              fw_get_products_slider2($atts,$query);
           }else{
           	  fw_get_products_grid($vars,$query);
           }	   	  
	   }
		
		$cont = ob_get_contents();

		ob_end_clean();

		return $cont;
}
add_shortcode('fw_services','products_shortcode');

function fw_get_products_slider($atts,$query){

   extract($atts);//headline,title

   ?>
   <div class="section-full bg-white p-t80 p-b50 scale-bg-top scale-bg-bottom">
                <div class="container">
                    <!-- IMAGE CAROUSEL START -->
                    <?php if($title || $headline):?>
                    	<!-- TITLE START -->
                        <div class="section-head text-center">
                            <?php
                               if($title){
                               	  echo '<h2 class="text-uppercase">'.$title.'</h2>
                            <div class="wt-separator-outer">
                                <div class="wt-separator style-square">
                                  <span class="separator-left bg-primary"></span>
                                  <span class="separator-right bg-primary"></span>
                              </div>
                            </div>';
                               }
                               if($headline){
                               	  echo '<p>'.$headline.'</p>';
                               }
                            ?>
                            
                        </div>
                    	<!-- TITLE END -->
                    <?php endif; ?>
                        <!-- CAROUSEL -->
                        <div class="section-content">
                            
                            <div class="owl-carousel Home-services-carousel owl-btn-vertical-center">

                            <?php while($query->have_posts()): $query->the_post();?>
                                <?php global $post;

                                  $args = array(
                                    'post_parent' => get_the_ID(),
                                    'post_status'   => 'publish', 
                                    'post_type' => 'product' 
                                  );
                                  $children = get_children( $args );

                                  if($children && 4==6){
                                     foreach($children as $post){
                                        setup_postdata($post);
                                        get_template_part('template-parts/content','product');
                                     }
                                     wp_reset_postdata();
                                  }else{
                                     get_template_part('template-parts/content','product');
                                  }
                                ?>                                   
                            <?php endwhile; wp_reset_postdata();?>
                               
                            </div>
                        
                        </div>
         		</div>
         	</div>
   <?php
}
function fw_get_products_grid($atts,$query){

   extract($atts);//text_overlay,title,bg
	?><section id="service-section">
            <div class="row1">
                <div class="col-md-4 col-sm-12 col-xs-12 service_img_box pad-righ">
                    <div class="row">
                        <figure class="service_image positionR">
                            <img src="<?php echo $bg;?>" alt=""/>
                        </figure>
                        <div class="service_content">
                            <?php
                              if($text_overlay){
                                  echo '<h1>'.$text_overlay.'</h1>';
                              }
                              if($title){
                                echo '<h2>'.$title.'</h2>';//<h2> <span>Our</span> Services</h2>
                              }
                            ?>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12 service_content_box">
                <div class="row">
                  <div class="border">
                  <?php while($query->have_posts()): $query->the_post();?>
                    <!-- News Block -->
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="service_box text-center">
                            <a href="<?php the_permalink();?>">
                              <i class="fa fa-film" aria-hidden="true"></i>
                              <h3><?php the_title();?></h3>
                            </a>
                            <p><?php the_excerpt();?></p>
                        </div>
                    </div>
                  <?php endwhile; wp_reset_postdata();?>
                  </div>
                </div>
              </div>
            </div>
          </section>       
	   <?php
}

function fw_get_products_slider2($atts,$query){

   extract($atts);//headline,title,bg,bg_title,bg
?>
<section id="services-slider" class="services-section">
        <div class="upper-box" style="background-image: url(<?php echo esc_url($bg);?>);">
            <div class="auto-container">    
                <div class="sec-title text-center light">
                    <?php
                       if($bg_title){
                          echo '<span class="float-text">'.$bg_title.'</span>';
                       }
                       if($title){
                          echo '<h2>'.$title.'</h2>';
                       }
                    ?>                    
                </div>
            </div>
        </div>

        <div class="services-box">
            <div class="auto-container">
                <div class="services-carousel owl-carousel owl-theme">
                  <?php while($query->have_posts()): $query->the_post();?>
                    <!-- Service Block -->
                    <div class="service-block">
                        <div class="inner-box">
                            <div class="image-box">
                                <?php
                                   $img = home_url('wp-content/uploads/2019/01/service-1.jpg');
                                   if(has_post_thumbnail()){
                                     global $post;
                                     $img = get_the_post_thumbnail_url($post->ID,'medium');
                                   }
                                ?>
                                <figure class="image"><a href="<?php the_permalink();?>"><img src="<?php echo $img;?>" alt=""></a></figure>
                            </div>
                            <div class="lower-content">
                                <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                <div class="text"><?php the_excerpt();?></div>
                                <!--<div class="link-box">
                                    <a href="<?php the_permalink();?>">Lorn More <i class="fa fa-long-arrow-right"></i></a>
                                </div>-->
                            </div>
                        </div>
                    </div>
                  <?php endwhile; wp_reset_postdata();?>
                </div>
            </div>
        </div>
    </section>
<?php
}