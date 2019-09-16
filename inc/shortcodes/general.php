<?php
function fix_block_shortcode($cont,$post_id){
	 // define your shortcodes to filter, '' filters all shortcodes
    $shortcodes = array('fw_slider','fw_section','fw_banner');

    foreach ( $shortcodes as $shortcode ) {

        $array = array (
            '[' . $shortcode => '['.$shortcode.' post_id="'.$post_id.'"',
        );

        $cont = strtr( $cont, $array );
    }
    return $cont;
}
function fix_shortcode_content($cont){

	//$shortcodes = array('fw_slider','fw_section','fw_banner');
	
	$args = array("<br>","<p>","<p></p>");

    foreach ( $args as $arg ) {

        $array = array (
            $arg.'<section' => '<section',
            $arg.'<div' => '<div',
        );

        $cont = strtr( $cont, $array );
    }
    return $cont;
}
add_filter('the_content','fix_shortcode_content',99);

function cta_shortcode($atts, $content = null, $tag) {

	extract(shortcode_atts(array(
		"headline" => get_field('cta_headline','option'), 
		"btn_text" => get_field('cta_button_text','option'),
		"btn_link" => get_field('cta_button_link','option'),
		"bg" => get_field('cta_background_image','option'),
	), $atts));

	if(!$bg) $bg = get_field('cta_bg_image','option');

	ob_start();
	?>
        <section class="cta-section fun-fact-section">
          <div class="outer-box" style="background-image: url(<?php echo esc_url($bg);?>);">
            <div class="auto-container">
                <div class="fact-counter">
                    <div class="row">
                        <!--Column-->
                        <div class="counter-column col-lg-8 wow fadeInUp">
                            <div class="cta-headline">
                                <h3 class="counter-title"><?php echo $headline;?></h3>
                            </div>
                        </div>

                        <!--Column-->
                        <div class="counter-column col-lg-4 wow fadeInUp" data-wow-delay="400ms">
                            <div class="cta-btn">
                                <a href="<?php echo $btn_link;?>" class="theme-btn btn-style-one">
                                    <?php echo $btn_text;?>  <i class="fa fa-angle-double-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
       </section>
	<?php
	$cont = ob_get_contents();
	ob_end_clean();
	return $cont;
}
add_shortcode('fw_cta','cta_shortcode');

function contacts_shortcode($atts, $content = null, $tag) {

	extract(shortcode_atts(array(
		"headline" => "",
		"btn_text" => "",
		"btn_link" => "",
		"bg" => "",
	), $atts));

	//if(!$bg) $bg = get_field('cta_bg_image','option');

	ob_start();

	$contacts = get_field('contact_details','option');

	$classes = array('phone'=>'iconmoon-smartphone-1','email' => 'iconmoon-email','address' => 'iconmoon-travel');
	?>
	  <div class="section-full p-t20 p-b20">
                <div class="container">
                
                	<!-- CONTACT DETAIL BLOCK -->
                    <div class="section-content m-b30">
 
                        <div class="row">
                         <?php foreach($contacts as $item): extract($item);//type,value?>
                            <div class="col-md-4 col-sm-12 m-b30">
                                <div class="wt-icon-box-wraper center p-a30 bg-secondry">
                                    <div class="icon-sm text-white m-b10"><i class="<?php echo $classes[$type];?>"></i></div>
                                    <div class="icon-content">
                                        <h5 class="text-white"><?php echo ucfirst($type);?></h5>
                                        <p class="text-gray-dark"><?php echo $value;?></p>
                                    </div>
                                </div>
                            </div>
                         <?php endforeach; ?>
                        
                        </div>
          
                    </div>
                </div>
            </div>
	<?php
	$cont = ob_get_contents();
	ob_end_clean();
	return $cont;
}
add_shortcode('fw_contacts','contacts_shortcode');

function contact_form_shortcode($atts, $content = null, $tag) {

	extract(shortcode_atts(array(
		"title" => "",
	), $atts));

	//if(!$bg) $bg = get_field('cta_bg_image','option');

	ob_start();
	?><section id="contact" class="contact-section">
        <div class="auto-container">
            
            <!--Form Container-->
            <div class="form-container wow fadeInDown" data-wow-delay="0ms" data-wow-duration="1500ms">
                <div class="title-text"><?php echo $title;?></div>
                
                <!--Form-->
                <div class="form">
                   <?php echo do_shortcode('[contact-form-7 id="81"]');?>
                </div>
            </div>
            
        </div>
    </section>
	<?php
	$cont = ob_get_contents();
	ob_end_clean();
	return $cont;
}
add_shortcode('fw_contact_form','contact_form_shortcode');