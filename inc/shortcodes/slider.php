<?php
if ( ! function_exists( 'fw_slider' ) ) :
    function fw_slider($component,$block_id){
        extract($component);//custom_class, slides
    	$custom_class .=' block-item block-'.get_post($block_id)->post_name;
    	?><section id="mainSlider" class="imageSlider slider-pro">
          
          <!-- SLIDES CONTAINER -->
          <div class="sp-slides">

            <!-- SINGLE SLIDE -->
            <div class="sp-slide ">

              

              <img src="img/slide1.jpg" alt="" class="sp-image" data-show-delay="1500" data-horizontal="0%" data-show-offset="500">

              <div class="introDescription sp-layer" data-horizontal="-100%" data-show-transition="right" data-hide-transition="left" data-width="50%" data-show-delay="1200" >

                <article>

                  <h1>#CreateYourSpace</h1>
                  <a href="#">Shop Antarc Office</a>

                </article>

              </div>

              <div class="sp-thumbnail">
          <div class="sp-thumbnail-text">
            <h5>Antarc</h5>
                  <h2>Office</h2>
          </div>
                
          </div>

            </div>
            <!--END  SINGLE SLIDE  -->

            <!-- SINGLE SLIDE -->
            <div class="sp-slide ">

              
              <img src="img/slide2.jpg" alt="" class="sp-image" data-show-delay="1500" data-horizontal="0%" data-show-offset="500">

              <div class="introDescription sp-layer" data-horizontal="-100%" data-show-transition="right" data-hide-transition="left" data-width="50%" data-show-delay="1200" >

                <article>

                  <h1>#CreateYourSpace</h1>
                  <a href="#">Shop Antarc Interiors</a>

                </article>

              </div>

              <div class="sp-thumbnail">
          <div class="sp-thumbnail-text">
            <h5>Antarc</h5>
                  <h2>Interiors</h2>
          </div>
                
          </div>

            </div>
            <!--END  SINGLE SLIDE  -->

            <!-- SINGLE SLIDE -->
            <div class="sp-slide ">


              <img src="img/slide3.jpg" alt="" class="sp-image" data-show-delay="1500" data-horizontal="0%" data-show-offset="500">

              <div class="introDescription sp-layer" data-horizontal="-100%" data-show-transition="right" data-hide-transition="left" data-width="50%" data-show-delay="1200" >

                <article>

                  <h1>#CreateYourSpace</h1>
                  <a href="#">Shop Antarc Innovative Space</a>

                </article>

              </div>

              <div class="sp-thumbnail">
          <div class="sp-thumbnail-text">
            <h5>Antarc</h5>
                  <h2>Innovative Space</h2>
          </div>
                
          </div>

            </div>
            <!--END  SINGLE SLIDE  -->

          </div>
          <!--END  SLIDES CONTAINER -->

        </section>
    	<?php
    }
endif;
?>
