<?php
/**
* Block shortcode defined here
*/
function shortcode_blocks($atts, $content = null, $tag) {

	extract(shortcode_atts(array(
		"id" => "",

	), $atts));

	ob_start();

	$blocks = get_posts( array( 'name' => $id,'post_type'=>'block' ) );

	if( $blocks ){
	    //$cont = $blocks[0]->post_content;
	    //$cont = fix_block_shortcode($cont,$blocks[0]->ID);
	    //echo do_shortcode($cont);

	    $block_id = $blocks[0]->ID;
        
        $components = get_field('section',$block_id);

        foreach ($components as $component) {
        	# code...
        	$layout = $component['acf_fc_layout'];

        	if($layout == 'slider'){
        		fw_slider($component , $block_id);
        	}else if($layout == 'row'){
                fw_rows($component , $block_id);
        	}else if($layout == 'section'){
                fw_section($component , $block_id);
        	}else if($layout == 'tabs'){
                fw_section_tabs($component , $block_id);
        	}
        }

	    if(current_user_can('administrator')){
           echo "<div class='block-edit-link'><a target='_blank' href='".get_edit_post_link($blocks[0])."'>Edit ".$blocks[0]->post_title."</a></div>";
	    }
	}else{
		echo "<div class='block-404'><p>Block shortcode is invalid</p></div>";
	}

	$content = ob_get_contents();

	ob_end_clean();

	return $content;
}
add_shortcode('block','shortcode_blocks');