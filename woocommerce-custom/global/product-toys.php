<?php
/**
* Template: Toy card
*
* @author  Constant Vasilyev
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
global $is_related;

$this_product_id     	    = $product->get_id();
$this_access              = get_field('product_access', $this_product_id); 
$this_virtual             = $product->get_virtual();
$this_downloadable        = $product->get_downloadable();
$this_title						    = $product->get_title();
$this_permalink 			    = $product->get_permalink();
$this_short_description 	= $product->get_short_description();
$this_description 	      = $product->get_description();
$this_image          	    = $product->get_image_id();
  $image_params = wp_get_attachment_image_src($this_image, "full");
  $image_w = $image_params[1];
  $image_h = $image_params[2];
  $sizes = "".$image_w.", ".$image_h;
$this_thumbnails     	    = $product->get_gallery_image_ids();
$this_price          	    = $product->get_regular_price();
$this_sale_price     	    = $product->get_sale_price();
$this_rating_count   	    = $product->get_rating_count();
$this_review_count   	    = $product->get_review_count();
$this_average        	    = $product->get_average_rating();

// Label 'New'
$this_now                 = strtotime( date( date( 'Y-m-d H:i:s' ) ) );
$this_last_upd_post       = strtotime( date( get_the_modified_date( 'Y-m-d H:i:s' ) ) );
$this_passed_time         = $this_now - $this_last_upd_post;
$this_update_day          = get_theme_mod( 'label_new_product' );

// Get categories
$show_categories          = true;
$this_categories          = get_the_terms( $this_product_id, 'product_cat' );
  $this_last_category     = end( $this_categories );
  $temp_key               = array_search(0, array_column($this_categories, 'parent')); 
  $this_category_name     = $this_categories[$temp_key]->name;

// Get attributes
$this_attr_age_list = $product->get_attribute( 'age-toy' );
$this_attr_gender_list = $product->get_attribute( 'gender' );


// For variable products Regular, Sale and Actual price min and max
$this_product_type        = $product->get_type();
if ( 'variable' === $this_product_type ) :
  $this_min_price           = $product->get_variation_price( 'min' );
  $this_max_price           = $product->get_variation_price( 'max' );
endif;
  
  
// $post_class = "activity";
$post_class = "toy";
$card_color = "white";
$card_shadow = "";
$card_body_custom = "justify-content-start";
$card_img_overlay = false;
$card_image_fill = "false";
$card_body_color = "white";




$card_color_class = $card_color ? "bg-".$card_color : "";
$card_shadow_class = $card_shadow ? "shadow" : "";
echo $card_shadow_class;
$card_class = ["card", $post_class, $card_color_class, $card_shadow_class];
$card_class = implode(" ", $card_class);

$card_body_color_class = $card_body_color ? "bg-".$card_body_color : "";
$card_body_paddings_class = "px-2 px-lg-3";
$card_img_overlay_class = $card_img_overlay ? "card-img-overlay" : "";
$card_body_class = [
  $card_body_custom, 
  $card_body_paddings_class, 
  $card_body_color_class, 
  $card_img_overlay_class
];
$card_body_class = implode(" ", $card_body_class);

$card_image_fill_class = $card_image_fill ? "image-fill" : "image-nofill";
$media_overlay_class = $card_img_overlay ? "media-overlay" : "";
$card_media_class = [$media_overlay_class, $card_image_fill_class];
$card_media_class = implode(" ", $card_media_class);
?>


  <!-- Card -->
<style>
  @media (min-width: 992px) {
    .toy .card-media {
      height: 300px;
    }
    /* .toy .card-media picture {
      display: flex;
      align-items: center;
    }     */
  }
  @media (max-width: 991px) {
    .toy .card-media {
      height: 250px !important;
    }
    /* .toy .card-media picture {
      display: flex;
      align-items: center;
    }     */
  }  
</style>

<div class="<?=$card_class?>">

    <!-- Card Media -->
    <?php if ( $this_image ) : ?>
    <div class="card-media <?=$card_media_class?> has-docket-not" docket-before-not="<?=$sizes;?>">
      <?php if ( $this_permalink ) echo "<a href='" . esc_url($this_permalink) . "'>" ?>
      <picture>
        <?php 
        echo starter_img_func([
          'img_src'   => 'w600',
          'img_sizes' => $starter_img_sizes,
          'img_id'    => $this_image
        ]);
        ?>
      </picture>
      <?php if ( $this_permalink ) echo "</a>" ?>
    </div>
    <?php endif ?>


    <!-- Card Body -->
    <div class="card-body <?=$card_body_class?>">
      <!-- Meta -->
      <?php
      if ( $show_categories ) : ?>
        <div class="entry-meta">
          <span class="has-gray-color has-text-color has-extra-small-font-size">
            <?=esc_html($this_category_name)."&nbsp;"?>
          </span>
        </div>
      <?php endif; ?> 

      <!-- Title -->
      <?php if ( $this_title ) : ?> 
        <div class="card-title mb-0">
          <?php if ( $this_permalink ) echo "<a href='" . esc_url($this_permalink) . "'>" ?>
            <header class="">
              <?=esc_html($this_title)?>
            </header>
          <?php if ( $this_permalink ) echo "</a>" ?>
        </div>
      <?php endif ?>

      <!-- Top categories -->
      <div class="meta">
        <div class="d-flex align-items-center">
          <?php if ($this_attr_age_list) : ?>
            <span class="has-gray-color has-text-color has-extra-small-font-size">
              Age: <span class="badge badge-pill has-blue-background-color has-white-color font-size-unset"><?=$this_attr_age_list?></span>
            </span>
          <?php endif ?>
          <?php if ($this_attr_gender_list) : ?>
            <span>&nbsp;</span>         
            <style>
              .gender-icon svg {
                width: 24px; 
                height: 28px;
                color: var(--wp--preset--color--gray);
              }
            </style>
            <?php if ( strpos($this_attr_gender_list, 'Girl') !== false ) echo '<span class="gender-icon">'.starter_get_svg(array('icon' => 'girl')) . '</span>'; ?>
            <?php if ( strpos($this_attr_gender_list, 'Boy') !== false ) echo '<span class="gender-icon">'.starter_get_svg(array('icon' => 'boy')) . '</span>'; ?>
          <?php endif ?>
        </div>
      </div> 
      
      <!-- Card Footer -->
      <div class="card-footer d-flex w-100 justify-content-between py-3 mt-auto">

        <!-- Price, Add to cart -->
        <div class="price-section w-100 d-flex justify-content-start">

          <!-- Variable Price -->
          <?php if ( 'variable' === $this_product_type ) : ?>
            <?php if ( isset($this_min_price) ) : ?>
              <div class="priceoid my-0">
                <div class="number">
                  <?php echo wc_price( $this_min_price ); if ( isset($this_max_price) ) echo "<span>"."&mdash;".strval($this_max_price)."</span>";?>
                </div>
              </div>
            <?php endif ?>  

          <!-- Else: Simple Price   -->
          <?php else : ?>
              <?php if ( $this_price != 0 ) : ?>
                <div class="priceoid d-flex align-items-end my-0 has-docket-not" docket-before="<?php echo $this_sale_price ? $this_price : '' ?>">
                  <div>
                    <div><del><?php echo $this_sale_price ? $this_price : '' ?></del></div>
                    <div class="number mr-2 mb-1"><?php echo wc_price( $this_sale_price != 0 ? $this_sale_price : $this_price ) ?></div>
                  </div>                  
                  <?php woocommerce_template_loop_add_to_cart( 'btn_class=btn-outline-primary btn btn-block btn-sm' ); ?>
                </div>
              <?php else : ?>
                <div class="priceoid my-0">
                  <!-- free -->
                </div>                  
              <?php endif ?>  
          <?php endif ?>
  
        </div>
        <!-- .price-section -->


			</div>
			<!-- .card-footer -->
      

    </div>
    <!-- .card-body -->
    
    
  </div>
  <!-- .card -->

<!-- </div> -->
<!-- .col -->



<!-- End of Cards component -->	