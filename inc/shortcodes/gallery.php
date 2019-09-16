<?php
//[fw_gallery_masonry]
function fw_gallery_shortcode($atts, $content = null, $tag){

		extract(shortcode_atts(array(
		  "title" => "",
		  "number" => "6",
		  "filters" => "1",
		  "portfolio_id" => "",//portfolio id
		  "all_button" => "1",
		), $atts));

		$galleries = get_posts(array('post_type' => 'gallery','orderby' => 'DATE','order' => 'DESC'));

	  ob_start();
	  ?>
	   <?php if($galleries):?>
			<section id="main-gallery" class="gallery-section">
				<div class="outer-container">
							<?php if($title):?>
								<!--<div class="centered-title"><h2><?php echo $title;?></h2></div>	-->
								<div class="lined-title"><h2><?php echo $title;?></h2></div>							
						    <?php endif; ?>
						    <?php if(count($galleries)>1 && 5==4):?>
						    	<div class="gallery-filter row desktop">
									<div class="filters-desktop col-12 col-sm-12">';
	                                    <ul class="masonry-filter">
	                                    	<?php  
	                                    	echo '<li><a class="active" href="#" data-filter="">All</a></li>';
                                               foreach($galleries as $gallery){
                                               	  echo '<li><a href="#" data-filter=".'.$gallery->post_name.'">'.$gallery->post_title.'</a></li>';
                                               }
	                                    
	                                    	?>
	                                    </ul>
	                                </div>
								</div>
						    <?php endif;?>
							<div class="gallery row">
                               <ul id="lightgallery" class="list-unstyled row">
								<?php foreach($galleries as $gallery):?>
									<?php
									   $images = get_field('photos',$gallery->ID);
                                       foreach($images as $image):
											?>
											<?php
		                                      $src=$image['url'];
		                                      $image_id=$image['ID'];
											?>
											<li class="col-xs-6 col-sm-4 col-md-3 <?php echo $gallery->post_name;?>" data-src="<?php echo $src;?>" data-sub-html="<h4><?php echo $image['title']; ?></h4><p><?php echo $image['description']; ?></p>">
	                    <a href="#">
	                    	<?php echo wp_get_attachment_image($image_id,'full',array('class'=>'img-responsive'));?> 
	                    </a>
	                </li>
											
								   <?php endforeach;?>
                                <?php endforeach; ?>
								</ul>
				   </div>
				</div>
			</section>
						
        <?php endif;?>
	  <?php
	  $content = ob_get_contents();
	  ob_end_clean();
	  return $content;
	
}
add_shortcode("fw_gallery","fw_gallery_shortcode");