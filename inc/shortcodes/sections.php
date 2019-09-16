<?php
function fw_section($section,$block_id=''){
    
    $style = $section['style'];

    if($style == 'text-image'){
         fw_image_section($section,$block_id);
    }else if($style == 'floating-image'){
         fw_floating_image_section($section,$block_id);
    }else if($style == 'content-overlay'){
        fw_content_overlay($section,$block_id);
    }
}
function fw_image_section($section,$block_id){
   extract($section);
    $custom_class.=' block-item';
   ?><section id="about-section" class="pad-top100 pad-bottom100">
            <div class="main_aboutus">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
                            <figure>
                                <img src="<?php echo $image;?>" alt="<?php echo $title;?>"/>
                            </figure>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="all_section_heading">
                                <?php
                                  if($text_overlay){
                                     echo '<h1>'.$text_overlay.'</h1>';
                                  }
                                ?>
                                <h2></h2>
                            </div>
                            <div class="aboutus_content">
                                <?php
                                  echo do_shortcode($content);
                                        $k=1;
                                          // var_dump($buttons);
                                           if($buttons && is_array($buttons)){
                                              foreach($buttons as $button){
                                                extract($button);
                                                $class = ($k % 2 ==0) ? 'itg-button light' : 'itg-button';
                                                echo '<a href="'.esc_url($button_link).'" class="'.$class.'">'.$button_text.'</a>';
                                                 $k++;
                                              }
                                           }
                                        ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--//================About end==============//-->
        <div class="clear"></div>
  <?php
}
function fw_floating_image_section($section,$block_id){
    extract($section);//custom_class, section_title,headline,
    $custom_class.=' block-item '.get_post($block_id)->post_name;
    ?><section id="facts-section" class="pad-bottom40 pad-top50 bg-grey <?php echo $custom_class;?>">
            <div class="container">
                <div class="row">
                    <div class="all_heading positionR">
                        <?php
                            if($text_overlay){
                              echo '<h1>'.$text_overlay.'</h1>';
                            }
                            if($title){
                              echo '<h2>'.$title.'</h2>';
                            }
                        ?>
                    </div>
                    <div class="our_facts mar-top50 mar-bottom50">
                      <?php
                        $counter = count($items);

                        $first_half = floor($counter/2);
                      ?>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <?php for($k=0;$k<$first_half; $k++): extract($items[$k]);?>
                            <div class="facts_year <?php echo ($k > 0) ? 'mar-top50' : '';?>">
                                
                                <?php
                                  echo '<h3>'.$title.'</h3>';
                                  echo '<p>'.$message.'</p>';
                                ?>
                            </div>
                          <?php endfor; ?>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <figure class="facts_logo">
                                <img src="<?php echo $image;?>" alt="">
                            </figure>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <?php for($k=$first_half; $k<$counter; $k++): extract($items[$k]);?>
                            <div class="facts_year <?php echo ($k > $first_half) ? 'mar-top50' : '';?>">
                                
                                <?php
                                  echo '<h3>'.$title.'</h3>';
                                  echo '<p>'.$message.'</p>';
                                ?>
                            </div>
                          <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--//================facts end=============//-->
        <div class="clear"></div>
    <?php
}
function fw_content_overlay($section,$block_id){
    extract($section);//custom_class, section_title,background_image,image_overlay,title_overlay,buttons,content,
    $custom_class.=' block-item';
    ?>
      <section id="<?php echo get_post($block_id)->post_name;?>" class="about-section" style="background-image: url(images/background/1.jpg);">
        <div class="auto-container">
            <div class="row no-gutters">
                <!-- Image Column -->
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="title-box wow fadeInLeft" data-wow-delay='1200ms'>
                            <h2><?php echo $title_overlay;?></h2>
                        </div>
                        <div class="image-box">
                            <figure class="alphabet-img wow fadeInRight"><img src="<?php echo $background_image;?>" alt=""></figure>
                            <figure class="image wow fadeInRight" data-wow-delay='600ms'><img src="<?php echo $image_overlay;?>" alt=""></figure>
                        </div>
                    </div>
                </div>

                <!-- Content Column -->
                <div class="content-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft">
                        <div class="content-box">
                            <?php
                              if($section_title){
                                echo '<div class="title">
                                          <h2>'.$section_title.'</h2>
                                      </div>';
                              }
                            ?>
                            <div class="text"><?php echo do_shortcode($content);?></div>
                            <?php if($buttons && !empty($buttons)):?>
                              <div class="link-box">
                                <?php 
                                  foreach($buttons as $btn){
                                    extract($btn);
                                    echo '<a href="'.esc_url($button_link).'" class="theme-btn btn-style-one">'.$button_text.'</a>';
                                  }
                                ?>
                              </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php 
}

function fw_section_tabs($component , $block_id){
    extract($component);//custom_class, section_title,background_image,image_overlay,title_overlay,buttons,content,
    $custom_class.=' block-item';
  ?><section id="<?php echo get_post($block_id)->post_name;?>" class="about-section">
      <div class="auto-container">
          <?php
            if($section_title) echo '<div class="centered-title"><h2>'.$section_title.'</h2></div>';
          ?>
            
            <div class="content-container">
                <!--Tabs Box-->
                <div class="tabs-box">
                  
                    <!--Tab Buttons-->
                    <div class="tab-buttons">
                        <?php
                          $k=1;
                          foreach ($tabs as $tab){
                              # code...
                              $active = ($k == 1) ? 'active-btn' : '';
                              echo '<a class="tab-btn '.$active.'" href="#tab-'.$k.'">'.$tab['title'].'</a>';
                              $k++;
                          }
                        ?>
                       <!-- <a class="tab-btn active-btn" href="#history-tab">History</a>
                        <a class="tab-btn" href="#mission-tab">Mission</a>-->
                    </div>
                    
                    <!--Tabs Content-->
                    <div class="tabs-content">
                      <?php $k=1; foreach($tabs as $tab): extract($tab); $active = ($k == 1) ? 'active-tab' : '';?>
                        <?php
                         // var_dump($tab);
                          $class = ($image) ? '6' : '12 no-image';
                        ?>
                        <!--Tab / Active Tab-->
                        <div class="tab <?php echo $active;?>" id="tab-<?php echo $k;?>">
                          <div class="row clearfix">
                              <!--Content Column-->
                                <div class="column content-column col-md-<?php echo $class;?> col-xs-12">
                                  <div class="inner">
                                   <!-- <div class="bold-text"><??></div>-->
                                        <div class="default-text">
                                          <?php echo do_shortcode($content);?>
                                        </div>    
                                    </div>
                                </div>
                                <?php if($image):?>
                                <!--Image Column-->
                                <div class="column image-column col-md-6 col-xs-12">
                                  <div class="inner">
                                    <figure class="image-box"><img src="<?php echo $image;?>" alt=""></figure>
                                    </div>
                                </div>
                                <?php endif;?>
                                
                            </div>
                        </div>
                      <?php $k++; endforeach; ?>
                        
                    </div>
                    
                </div>
            </div>
            
        </div>
    </section>
  <?php
}
