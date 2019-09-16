<?php
function fw_rows($row,$block_id){
    if($row['style'] == 'featured'){
        featured_row($row,$block_id);
    }else if($row['style'] == 'featured_columns'){
        featured_columns($row,$block_id);
    }
}
function featured_columns($row,$block_id){

    extract($row);//custom_class, section_title,columns,background_image,
    $custom_class.=' block-item';
  ?><section id="<?php echo get_post($block_id)->post_name;?>"  class="fun-fact-and-features <?php echo $custom_class;?>"  style="background-image: url(<?php echo $background_image;?>);">
        <div class="outer-box">
            <div class="auto-container">
                <!-- Features -->
                <div class="features">
                    <div class="row">
                      <?php foreach($columns as $column): extract($column)//content,width,title;?>
                        <!-- Feature Block -->
                        <div class="feature-block col-lg-<?php echo $width?> col-md-<?php echo $width?> col-sm-12">
                            <div class="inner-box">
                                <div class="icon-box"><span class="icon flaticon-decorating"></span></div>
                                <h3><a><?php echo $title;?></a></h3>
                                <div class="text"><?php echo do_shortcode($content);?></div>
                                <!--<div class="link-box"><a href="service-detail.html">Read More</a></div>-->
                            </div>
                        </div>
                      <?php endforeach; ?>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
     <?php
}
function featured_row($row,$block_id){
    extract($row);//custom_class, section_title,columns,background_image,
    $custom_class.=' block-item';
    ?>
        <section id="<?php echo get_post($block_id)->post_name;?>" class="news-section <?php echo $custom_class;?>">
            <div class="auto-container">
                <?php if($section_title || $headline):?>
                  <div class="sec-title">
                      <span class="float-text">Our Approach</span>
                      <h2><?php echo $section_title;?></h2>
                  </div>
                <?php endif; ?>
                  <div class="row">
                      <div class="col-sm-9 sec-content">
                          <p><?php echo $headline;?></p>
                      </div> 
                  </div>
                <div class="row">
                  <?php foreach($columns as $column): extract($column);//title,content,icon_image,width?>
                    <!-- News Block -->
                    <div class="news-block col-lg-3 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="<?php echo $icon_image;?>" alt=""></figure>
                            </div>
                            <div class="caption-box">
                                <h3><a><?php echo $title;?></a></h3>
                                <div class="info">
                                    <?php echo $content;?>
                                </div>
                            </div>
                        </div>
                    </div>
                   <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php
}