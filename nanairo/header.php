<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php if (is_mobile()) { ?>
  <meta name="format-detection" content="telephone=no,address=no,email=no">
  <?php } else {
}?>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <script>
    document.body.className += " " + platform.name.replace(/ |\/|\./g, "-") + " b" + platform.version.replace(/ |\/|\./g, "-") + " " + platform.os.family.replace(/ |\/|\./g, "-") + " o" + platform.os.version.replace(/ |\/|\./g, "-");
    if (!/(iOS|Android)/.test(document.body.className)) {
      document.body.className += " Pc ";
    }

  </script>
  <header id="masthead" class="site-header flexPc" role="banner">
    <div class="site-branding">
      <?php

          if ( is_front_page() || is_home() ) : //topページの場合、サイト名をH1にする ?>

        <h1 class="site-title">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

              <?php
                $get_the_logo_img_url = get_the_logo_img_url();
                $description = get_bloginfo( 'description', 'display' );

                if(empty($get_the_logo_img_url)){//ロゴ未設定時
                  bloginfo( 'name' );
                  }
                else{//ロゴ設定時
                  echo '<img src="'. get_the_logo_img_url() . '" alt="' . $description . '" />';
                  }
              ;?>
              </a>
        </h1>

        <?php else ://topページ以外の場合 ?>

        <p class="site-title">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

              <?php

              $tempIMG=get_the_logo_img_url();
              if (empty($tempIMG)){
                bloginfo( 'name' );
              }
              else{
                echo' <img src="' . get_the_logo_img_url() .'" alt="" />';
              }
              ?>


              </a>
        </p>

        <?php endif;

          $description = get_bloginfo( 'description', 'display' );
          if ( $description || is_customize_preview() ) : ?>
        <p class="site-description">
          <?php echo $description; ?>
        </p>
        <?php endif;
        ?>
    </div>
    <!-- .site-branding -->
     <div id="globalmenu">
      <div class="menuInner">
        <!--menu-->
        <?php wp_nav_menu( array(
          'theme_location'=>'global_menu',
          'container' => 'div',
          'menu_class'    =>'',
          'items_wrap'    =>'<ul id="main-nav" class="menu flex fac_centerPc">%3$s</ul>'));
        ?>
     </div>
    </div>

  </header>
  <!-- .site-header -->
