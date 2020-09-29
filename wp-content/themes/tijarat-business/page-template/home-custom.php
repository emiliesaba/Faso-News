<?php
/**
 * Template Name: Home Custom Page
 */
get_header(); ?>

<main id="main" role="main">
  <?php do_action( 'tijarat_business_before_slider' ); ?>

  <?php if( get_theme_mod('tijarat_business_slider_arrows', false) != '' || get_theme_mod( 'tijarat_business_enable_disable_slider', false) != ''){ ?>
    <section id="slider">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="<?php echo esc_attr(get_theme_mod('tijarat_business_slider_speed', 3000)); ?>"> 
        <?php $tijarat_business_slider_pages = array();
          for ( $count = 1; $count <= 4; $count++ ) {
            $mod = intval( get_theme_mod( 'tijarat_business_slide_page' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $tijarat_business_slider_pages[] = $mod;
            }
          }
          if( !empty($tijarat_business_slider_pages) ) :
          $args = array(
            'post_type' => 'page',
            'post__in' => $tijarat_business_slider_pages,
            'orderby' => 'post__in'
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
        ?>
        <div class="carousel-inner" role="listbox">
          <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
          <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
            <?php the_post_thumbnail(); ?>
            <div class="carousel-caption">
              <div class="inner_carousel">
                <?php if( get_theme_mod('tijarat_business_slider_title',true) != ''){ ?>
                  <h1><?php the_title();?></h1>
                <?php } ?>
                <?php if( get_theme_mod('tijarat_business_slider_content',true) != ''){ ?>
                  <p><?php $excerpt = get_the_excerpt(); echo esc_html( tijarat_business_string_limit_words( $excerpt, esc_attr(get_theme_mod('tijarat_business_slider_excerpt_number','20')))); ?></p>
                <?php } ?>
                <?php if (get_theme_mod( 'tijarat_business_slider_button',true) != '' || get_theme_mod( 'tijarat_business_show_hide_slider_button',true) != ''){ ?>
                  <?php if( get_theme_mod('tijarat_business_slider_button_text','READ MORE') != ''){ ?>
                    <div class ="readbutton">
                      <a href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('tijarat_business_slider_button_text','READ MORE'));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('tijarat_business_slider_button_text','READ MORE'));?></span></a>
                    </div>
                  <?php } ?>
                <?php } ?>
              </div>
            </div>
          </div>
          <?php $i++; endwhile; 
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
        <div class="no-postfound"></div>
          <?php endif;
        endif;?>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Previous','tijarat-business' );?></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Next','tijarat-business' );?></span>
        </a>
      </div> 
      <div class="clearfix"></div>
    </section> 
  <?php }?> 

  <?php do_action( 'tijarat_business_after_slider' ); ?>

  <?php if( get_theme_mod('tijarat_business_about_page') != ''){ ?>
    <section id="about">
      <div class="container">
        <?php $tijarat_business_slider_pages = array();
          $mod = absint( get_theme_mod( 'tijarat_business_about_page'));
          if ( 'page-none-selected' != $mod ) {
            $tijarat_business_slider_pages[] = $mod;
          }
        if( !empty($tijarat_business_slider_pages) ) :
          $args = array(
            'post_type' => 'page',
            'post__in' => $tijarat_business_slider_pages,
            'orderby' => 'post__in'
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post(); ?>
              <div class="about-text">
                <div class="row">
                  <div class="col-lg-9 col-md-9">
                    <h2><?php the_title(); ?></h2>
                    <p><?php $excerpt = get_the_excerpt(); echo esc_html( tijarat_business_string_limit_words( $excerpt,20 ) ); ?></p>
                  </div>
                  <div class="col-lg-3 col-md-3">
                    <div class ="aboutbtn">
                      <a href="<?php the_permalink(); ?>"><?php esc_html_e('ABOUT US','tijarat-business'); ?><span class="screen-reader-text"><?php esc_html_e( 'ABOUT US','tijarat-business' );?></span></a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
          <?php else : ?>
              <div class="no-postfound"></div>
          <?php endif;
        endif;
        wp_reset_postdata()?>
          <div class="clearfix"></div> 
      </div>
    </section>
  <?php }?>

  <?php do_action( 'tijarat_business_after_about' ); ?>

  <?php if( get_theme_mod('tijarat_business_service_title') != '' || get_theme_mod('tijarat_business_service_text') != '' || get_theme_mod('tijarat_business_service_category') != ''){ ?>
    <section id="our-services">
      <div class="container">
        <div class="service">
          <div class="row">
            <div class="col-lg-3 col-md-12">
              <?php if( get_theme_mod('tijarat_business_service_title') != ''){ ?>
                <h3 class="animated fadeInDown"><?php echo esc_html(get_theme_mod('tijarat_business_service_title','')); ?></h3>
              <?php }?>
            </div>
            <div class="col-lg-9 col-md-12">
              <div class="description">
                <?php if( get_theme_mod('tijarat_business_service_text') != ''){ ?>
                  <p><?php echo esc_html(get_theme_mod('tijarat_business_service_text','')); ?></p>
                <?php }?> 
              </div>
            </div>
          </div>
          <div class="row">
            <?php 
            $tijarat_business_catData = get_theme_mod('tijarat_business_service_category');
              if($tijarat_business_catData){              
                $page_query = new WP_Query(array( 'category_name' => esc_html( $tijarat_business_catData ,'tijarat-business')));?>
                <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
                <div class="col-lg-4 col-md-4">
                  <div class="box">
                    <?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?>
                    <div class="box-content">
                      <h4><?php the_title(); ?></h4>
                      <p><?php $excerpt = get_the_excerpt(); echo esc_html( tijarat_business_string_limit_words( $excerpt,8) ); ?></p>
                      <div class ="aboutbtn">
                        <a href="<?php the_permalink(); ?>"><?php esc_html_e('READ MORE','tijarat-business'); ?><span class="screen-reader-text"><?php esc_html_e( 'READ MORE','tijarat-business' );?></span></a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endwhile;
              wp_reset_postdata();
            }
            ?>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </section>
  <?php }?>

  <?php do_action( 'tijarat_business_after_sevices' ); ?>

  <div class="container">
    <?php while ( have_posts() ) : the_post();?>
      <?php the_content(); ?>
    <?php endwhile; // End of the loop.
    wp_reset_postdata(); ?>
  </div>
</main>

<?php get_footer(); ?>