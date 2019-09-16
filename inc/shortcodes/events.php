<?php
function events_shortcode($atts, $content = null, $tag) {

		$vars = shortcode_atts(array(
			"headline" => "",
			"title" => "",
		), $atts);

		ob_start();

		$args = array(
	     'post_type' => 'event',
	     'posts_per_page' => '-1',
	     'meta_key' => 'event_dates',
	     'orderby' => 'meta_value',
	     'order' => 'ASC',
	   );
	   $query = new WP_Query($args);

	   if($query->have_posts()){

	   	  fw_get_events($vars,$query);
	   }
		
		$cont = ob_get_contents();

		ob_end_clean();

		return $cont;
}
add_shortcode('fw_events','events_shortcode');

function fw_get_events($atts,$query){

	   extract($atts);//headline,title

	   ?>
	    <div class="blog-classic-section">
	    	<div class="auto-container">
	    		<?php
	              while($query->have_posts()){
	              	 $query->the_post();
	                 get_template_part('template-parts/content','event');
	              }
	              wp_reset_postdata();
	    		?>
	    	</div>
	    </div>
	   <?php
}