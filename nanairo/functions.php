<?php

//00100 デバイスの切り分け
  /*Mobile_Detectの読み込み*/
  require_once 'assets/Mobile_Detect/Mobile_Detect.php' ;

  // 判別
      // タブレットの場合
      $detect = new Mobile_Detect ;
      if( $detect->isTablet() )
      {
          // 処理
          $browser = 'Tb' ;
          $viewport = '<meta name="viewport" content="width=1280,user-scalable=no">';
          $forBody="tb";
      }
      // スマホの場合
      elseif( $detect->isMobile() )
      {
          // 処理
          $browser = 'Sp' ;
          $viewport = '<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes">';
          $forBody="sp";
      }
      // デスクトップの場合
      else
      {
          // 処理
          $browser = 'Pc';
          $viewport = '<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">';
          $forBody = "pc";
      }

//001900
// jQuery読み込みを停止
function register_common_script() {
  if (!is_admin()){
    $script_dir = get_template_directory_uri();
    wp_deregister_script( 'jquery' );
    wp_enqueue_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js',array(), false, false);
    // wp_enqueue_script( 'cssfx', $script_dir.'/lib/cssfx.min.js', array(), false, false );
    // wp_enqueue_script( 'respondjs', $script_dir.'/lib/respond.min.js',array('jquery'), false, true);
  }
}
add_action('wp_enqueue_scripts','register_common_script');


//00200 cssとjsの読み込み
  function nanairo_scripts()
    {
    global $pattern_file;
    global $browser;
    global $filename;

    //Fundamental CSS & JS
    //ie9
    if ( is_customize_preview() ) {
      wp_enqueue_style( 'nanairo-ie9', get_stylesheet_directory_uri( '/assets/library/css/ie9.css' ), array( 'nanairo-style' ), '1.0' );
      wp_style_add_data( 'nanairo-ie9', 'conditional', 'IE 9' );
    }

    // Load the Internet Explorer 8 specific stylesheet.
    wp_enqueue_style( 'nanairo-ie8', get_stylesheet_directory_uri( '/assets/library/css/ie8.css' ), array( 'nanairo-style' ), '1.0' );
    wp_style_add_data( 'nanairo-ie8', 'conditional', 'lt IE 9' );

    // Load the html5 shiv.
    wp_enqueue_script( 'nanairo-html5', get_stylesheet_directory_uri( '/assets/library/js/html5.js' ), array(), '3.7.3' );
    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );


    //fontawesome
    wp_enqueue_script( 'nanairo-fontawesome', 'https://use.fontawesome.com/9e7b2dca0f.js');

    //wacuCm
    wp_enqueue_style('nanairo-wacuCm', get_stylesheet_directory_uri().'/assets/wacu/css/wacuCm.css' , array('js_composer_front') , '1.0.0' , false);
    wp_enqueue_style('nanairo-wacuPc', get_stylesheet_directory_uri().'/assets/wacu/css/wacuPc.css' , array('nanairo-wacuCm') , '1.0.0' ,'screen and (min-width: 769px)', false);
    wp_enqueue_style('nanairo-wacuTb', get_stylesheet_directory_uri().'/assets/wacu/css/wacuTb.css' , array('nanairo-wacuPc') , '1.0.0' ,'screen and (min-width: 481px) and (max-width:768px)', false);
    wp_enqueue_style('nanairo-wacuSp', get_stylesheet_directory_uri().'/assets/wacu/css/wacuSp.css' , array('nanairo-wacuTb') , '1.0.0' ,'screen and (max-width:480px)', false);

    //wacu load
    //wp_enqueue_style('nanairo-wacu'.$browser , get_stylesheet_directory_uri().'/assets/wacu/css/wacu'.$browser.'.css' , array('nanairo-wacuCm') , '1.0.0' , false);

    //style
    wp_enqueue_style('nanairo-styleCm', get_stylesheet_directory_uri(). '/assets/library/css/style.css' , array('nanairo-wacuCm') , '1.0.0' , false);




    //style load
    //wp_enqueue_style('nanairo-style'.$browser , get_stylesheet_directory_uri(). '/assets/library/css/style' . 'Cm.css' , array('nanairo-styleCm') , '1.0.0' , false);

    //jQuery.js
    wp_enqueue_script('nanairo-jquery3.1.1', 'https://code.jquery.com/jquery-3.1.1.min.js' , array(), '3.1.1', false);

    //jquery.scrollTo
    wp_enqueue_script( 'nanairo-jqueryScrollto', get_theme_file_uri( '/assets/library/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

    //jsPc
    wp_enqueue_script( 'nanairo-jsPc', get_theme_file_uri( '/assets/library/js/jsPc.js' ), array( 'jquery' ), '2.1.2', true );

    //platform.js
    wp_enqueue_script('nanairo-platform', get_stylesheet_directory_uri().'/assets/library/js/platform.js', array(), 'jquery', false);


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }


    //各ページでのCSSの取得
    global $post;

    if ( is_front_page() ) // 固定ページでのトップページの場合
      {
        $frontpagefilename = get_stylesheet_directory() . '/assets/page/frontpage/css/frontpageCm.css';
        if(file_exists($frontpagefilename))
        {
          //echo get_stylesheet_directory_uri() . '/assets/page/frontpage/css/frontpage' . 'Cm.css';
          wp_enqueue_style('style-frontpageCm', get_stylesheet_directory_uri() . '/assets/page/frontpage/css/frontpageCm.css');
          // wp_enqueue_style('style-frontpagePc',get_stylesheet_directory_uri().'/assets/page/frontpage/css/frontpagePc.css' , array() , '1.0.0' , 'screen and (min-width: 769px)' , false);
          // wp_enqueue_style('style-frontpageTb',get_stylesheet_directory_uri().'/assets/page/frontpage/css/frontpageTb.css' , array() , '1.0.0' , 'screen and (min-width: 481px) and (max-width:768px)' , false);
          // wp_enqueue_style('style-frontpageSp',get_stylesheet_directory_uri().'/assets/page/frontpage/css/frontpageSp.css' , array() , '1.0.0' , 'screen and (max-width:480px)' , false);
        }
        else{
        }
      }

    elseif ( is_page() )
      {
      //frontpage以外の固定ページの場合
      $pageSlug = $page = get_page(get_the_ID());
      $slug = $page->post_name;
      $filename = get_stylesheet_directory().'/assets/page/css/'. $slug .  '/css' .'/' . $slug .  'Cm.css';
      $pageSlug = get_page_uri($post->ID);
      $slugfilename = get_stylesheet_directory().'/assets/page/'.$pageSlug .'/css' .'/' .$pageSlug . 'Cm.css';

      if(file_exists($filename))
        {
          wp_enqueue_style('style-eachpageCm',get_stylesheet_directory_uri().'/assets/page/'.$slug . '/css' .'/'  . $slug  . 'Cm.css' , array() , '1.0.0' , false);
          // wp_enqueue_style('style-eachpagePc',get_stylesheet_directory_uri().'/assets/page/'.$slug . '/css' .'/'  . $slug  . 'Pc.css' , array() , '1.0.0' , 'screen and (min-width: 769px)' , false);
          // wp_enqueue_style('style-eachpageTb',get_stylesheet_directory_uri().'/assets/page/'.$slug . '/css' .'/'  . $slug  . 'Tb.css' , array() , '1.0.0' , 'screen and (min-width: 481px) and (max-width:768px)' , false);
          // wp_enqueue_style('style-eachpageSp',get_stylesheet_directory_uri().'/assets/page/'.$slug . '/css' .'/'  . $slug  . 'Sp.css' , array() , '1.0.0' , 'screen and (max-width:480px)' , false);
        }
      // else{
      //孫以降の処理
        $pageSlug = $page = get_page(get_the_ID());

        if($post -> post_parent != 0 )
          {
          $ancestors = array_reverse(get_post_ancestors( $post->ID ));
          foreach($ancestors as $ancestor)
            {
            $slugcss = get_post($ancestor)->post_name;
            if(file_exists($filename))
              {
              wp_enqueue_style('style-child-pageCm', get_stylesheet_directory_uri().'/assets/page/' . $slugcss . '/css' .'/'  . $slugcss .'Cm.css' , array() , '1.0.0' , false);
              // wp_enqueue_style('style-child-pagePc', get_stylesheet_directory_uri().'/assets/page/' . $slugcss . '/css' .'/'  . $slugcss .'Pc.css' , array() , '1.0.0' , 'screen and (min-width: 769px)' , false);
              // wp_enqueue_style('style-child-pageTb', get_stylesheet_directory_uri().'/assets/page/' . $slugcss . '/css' .'/'  . $slugcss .'Tb.css' , array() , '1.0.0' , 'screen and (min-width: 481px) and (max-width:768px)' , false);
              // wp_enqueue_style('style-child-pageSp', get_stylesheet_directory_uri().'/assets/page/' . $slugcss . '/css' .'/'  . $slugcss .'Sp.css' , array() , '1.0.0' , 'screen and (max-width:480px)' , false);
              }
            }
          }
        else
          {
          //トップから見ての子ページの処理
          if(file_exists($filename))
            {
            }
          elseif(file_exists($slugfilename))
            {
              wp_enqueue_style('style-slugfilenameCm', get_stylesheet_directory_uri().'/assets/page/'. get_page_uri($post->ID) .'/css' .'/'  . get_page_uri($post->ID) . 'Cm.css' , array() , '1.0.0' , false);
              // wp_enqueue_style('style-slugfilenamePc', get_stylesheet_directory_uri().'/assets/page/'. get_page_uri($post->ID) .'/css' .'/'  . get_page_uri($post->ID) . 'Pc.css' , array() , '1.0.0' , 'screen and (min-width: 769px)' , false);
              // wp_enqueue_style('style-slugfilenameTb', get_stylesheet_directory_uri().'/assets/page/'. get_page_uri($post->ID) .'/css' .'/'  . get_page_uri($post->ID) . 'Tb.css' , array() , '1.0.0' , 'screen and (min-width: 481px) and (max-width:768px)' , false);
              // wp_enqueue_style('style-slugfilenameSp', get_stylesheet_directory_uri().'/assets/page/'. get_page_uri($post->ID) .'/css' .'/'  . get_page_uri($post->ID) . 'Sp.css' , array() , '1.0.0' , 'screen and (max-width:480px)' , false);
            }
          }
      // }
      }
      elseif ( is_category() )
        {
        //カテゴリの場合の処理（まだ）
        $categories = get_the_category( $post->ID );
        $categorySlug = $categories[0]->slug;
        return $categorySlug;
        }
      else
        {
        return NULL;
        }
      }

  add_action( 'wp_enqueue_scripts', 'nanairo_scripts' );




//00300 「テーマで wp_title() を呼び出すことはできません。」対策
  add_theme_support( 'title-tag' );



//00400 wp_head()の内容で不必要なものを消す
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'rel_canonical');
  remove_action('wp_head', 'index_rel_link');
  remove_action('wp_head', 'parent_post_rel_link', 10, 0);
  remove_action('wp_head', 'start_post_rel_link', 10, 0);
  remove_action('wp_head', 'wp_shortlink_wp_head');
  // Since 4.4
  remove_action('wp_head','wp_oembed_add_discovery_links');
  remove_action('wp_head','rest_output_link_wp_head');





//00500　contents width assign コンテンツ幅（大）の設定
  if ( ! isset( $content_width ) )
  {
    $content_width = 640;
  }



//00600 Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );



//00700 サムネイル
  add_theme_support( 'post-thumbnails' );
  add_image_size( 'thumbnail-profile', 400, 400, true );


//00800 サイドバー
  //top サイドバー追加 v.1.0.5
  add_action( 'widgets_init', 'topSidebar_init' );
    function topSidebar_init() {
        register_sidebar( array(
          'name' => __('TOPページ用サイドバー'),
          'id' => 'topSidebar',
          'description' => __('TOPページ用サイドバーです'),
          'before_widget' => '<aside id="%1$s" class="top-side-bar widget %2$s">',
          'after_widget' => '</aside>',
          'before_title' => '<h3 class="">',
          'after_title' => '</h3>',
        ) );
    }


  //フッター サイドバー01追加
  add_action( 'widgets_init', 'footerSidebar01_init' );
    function footerSidebar01_init() {
        register_sidebar( array(
          'name' => __('フッター用サイドバー01'),
          'id' => 'footerSidebar01',
          'description' => __('フッター用サイドバー01です'),
          'before_widget' => '<aside id="%1$s" class="footer-side-bar widget %2$s">',
          'after_widget' => '</aside>',
          'before_title' => '<div class="">',
          'after_title' => '</h3>',
        ) );
    }

  //フッター サイドバー02追加
  add_action( 'widgets_init', 'footerSidebar02_init' );
    function footerSidebar02_init() {
        register_sidebar( array(
          'name' => __('フッター用サイドバー02'),
          'id' => 'footerSidebar01',
          'description' => __('フッター用サイドバー02です'),
          'description' => __('フッター用サイドバー02です'),
          'before_widget' => '<aside id="%1$s" class="footer-side-bar widget %2$s">',
          'after_widget' => '</aside>',
          'before_title' => '<div class="">',
          'after_title' => '</h3>',
        ) );
    }


  //フッター サイドバー03追加
  add_action( 'widgets_init', 'footerSidebar03_init' );
    function footerSidebar03_init() {
        register_sidebar( array(
          'name' => __('フッター用サイドバー03'),
          'id' => 'footerSidebar01',
          'description' => __('フッター用サイドバー03です'),
          'description' => __('フッター用サイドバー03です'),
          'before_widget' => '<aside id="%1$s" class="footer-side-bar widget %2$s">',
          'after_widget' => '</aside>',
          'before_title' => '<div class=""></div><h3>',
          'after_title' => '</h3>',
        ) );
    }


  //フッター サイドバー04追加
  add_action( 'widgets_init', 'footerSidebar04_init' );
    function footerSidebar04_init() {
        register_sidebar( array(
          'name' => __('フッター用サイドバー04'),
          'id' => 'footerSidebar01',
          'description' => __('フッター用サイドバー04です'),
          'description' => __('フッター用サイドバー04です'),
          'before_widget' => '<aside id="%1$s" class="footer-side-bar widget %2$s">',
          'after_widget' => '</aside>',
          'before_title' => '<div class=""></div><h3>',
          'after_title' => '</h3>',
        ) );
    }





//00900 ファイル実行 ショートコード v.1.0.8
  //[myphp file="test.php"]
  function Include_my_php($params = array())
  {
    extract(shortcode_atts(array('file' => 'default',), $params));
    ob_start();
    include get_theme_root().'/'.get_template()."/$file.php";
    return ob_get_clean();
  }
  add_shortcode('myphp', 'Include_my_php');






//01000　特定のカテゴリのみニュースに出す ショートコード v.1.0.8
// [news2 cat="1" num="10"]
//echo do_shortcode( '[news2 cat="1" num="10"]' );
/* 最新記事リスト */
  function getNewItems2($atts)
  {
    extract(shortcode_atts(array(
        'num' => '',    //最新記事リストの取得数
        'cat' => '',    //表示する記事のカテゴリー指定
    ), $atts));

    global $post;
    $oldpost = $post;

    $myposts = get_posts('numberposts='.$num.'&order=DESC&orderby=post_date&category='.$cat);
    $retHtml = '';

    foreach ($myposts as $post) :
      $content = strip_tags($post->post_content);
      $cat = get_the_category();//カテゴリー
      $catname = $cat[0]->cat_name;//カテゴリー名
      $catslug = $cat[0]->slug;//カテゴリースラッグ
    $category_id = get_cat_ID( $catname );// 指定したカテゴリーの ID を取得
    $category_link = get_category_link( $category_id );// このカテゴリーの URL を取得

    // このカテゴリーの URL を取得
    $category_link = get_category_link( $category_id );
      setup_postdata($post);
    $retHtml .= '<div class="categoryListWrapper honbun">';
    $retHtml .= '<span class="entry-date">'.get_post_time('Y年n月j日').'</span>'; //"Y年n月j日 l H:i:s"
        $retHtml .= '<h2 class="categoryListTitle inlineblockPc"><i class="fa fa-caret-right" aria-hidden="true"></i><a href="'.get_permalink().'">'.the_title("","",false).'</a></h2>';
        //$retHtml .= '<p class="post-content">'.nl2br($content).'</p>';
        //$retHtml.='<p class="more-detail"><a href="'.get_permalink().'">詳しく見る</a></p>';

        $retHtml .= '</div>';
  endforeach;
  $retHtml .= '';
  $post = $oldpost;
  wp_reset_postdata();

  return $retHtml;
  }
add_shortcode('news2', 'getNewItems2');



//01100  パンくずリスト
function breadcrumb(){
  global $post;
  $str ='';

  if(!is_home()&&!is_admin()&&!is_front_page()){ /* !is_admin は管理ページ以外という条件分岐 */
    $str.= '<div id="breadcrumb">';
    $str.= '<ul>';
    $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . home_url('/') .'" class="home" itemprop="url" ><span itemprop="title">HOME</span></a></li>';

    /* 投稿のページ */
    if(is_single()){
      $categories = get_the_category($post->ID);
      $cat = $categories[0];
      if($cat -> parent != 0){
        $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
        foreach($ancestors as $ancestor){
          $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor).'"  itemprop="url" ><span itemprop="title">'. get_cat_name($ancestor). '</span></a></li>';
                  }
      }
      $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($cat -> term_id). '" itemprop="url" ><span itemprop="title">'. $cat-> cat_name . '</span></a></li>';
      $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. overStringSafe($post -> post_title, 30) .'</span></li>';
    }

    /* 固定ページ */
    elseif(is_page()){
      if($post -> post_parent != 0 ){
        $ancestors = array_reverse(get_post_ancestors( $post->ID ));
        foreach($ancestors as $ancestor){
          $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_permalink($ancestor).'" itemprop="url" ><span itemprop="title">'. get_the_title($ancestor) .'</span></a></li>';
                  }
      }
      $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. overStringSafe($post -> post_title, 30) .'</span></li>';
    }

    /* カテゴリページ */
    elseif(is_category()) {
      $cat = get_queried_object();
      if($cat -> parent != 0){
        $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
        foreach($ancestors as $ancestor){
          $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor) .'" itemprop="url" ><span itemprop="title">'. get_cat_name($ancestor) .'</span></a></li>';
        }
      }
      $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. overStringSafe($cat -> name, 30) . '</span></li>';
    }

    /* タグページ */
    elseif(is_tag()){
      $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. single_tag_title( '' , false ). '</span></li>';
    }

    /* 時系列アーカイブページ */
    elseif(is_date()){
      if(get_query_var('day') != 0){
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_year_link(get_query_var('year')). '" itemprop="url" ><span itemprop="title">' . get_query_var('year'). '年</span></a></li>';
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_month_link(get_query_var('year'), get_query_var('monthnum')). '" itemprop="url" ><span itemprop="title">'. get_query_var('monthnum') .'月</span></a></li>';
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. get_query_var('day'). '</span>日</li>';
      } elseif(get_query_var('monthnum') != 0){
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_year_link(get_query_var('year')) .'" itemprop="url" ><span itemprop="title">'. get_query_var('year') .'年</span.</a></li>';
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. get_query_var('monthnum'). '</span>月</li>';
      } else {
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. get_query_var('year') .'年</span></li>';
      }
    }

    /* 投稿者ページ */
    elseif(is_author()){
      $str .='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">投稿者 : '. get_the_author_meta('display_name', get_query_var('author')).'</span></li>';
    }

    /* 添付ファイルページ */
    elseif(is_attachment()){
      if($post -> post_parent != 0 ){
        $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_permalink($post -> post_parent).'" itemprop="url" ><span itemprop="title">'. get_the_title($post -> post_parent) .'</span></a></li>';
      }
      $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . $post -> post_title . '</span></li>';
    }

    /* 検索結果ページ */
    elseif(is_search()){
      $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">「'. get_search_query() .'」で検索した結果</span></li>';
    }

    /* 404 Not Found ページ */
    elseif(is_404()){
      $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">お探しの記事は見つかりませんでした。</span></li>';
    }

    /* その他のページ */
    else{
      $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. wp_title('', false) .'</span></li>';
    }
    $str.='</ul>';
    $str.='</div>';
    }
  echo $str;
  }

//01200 固定ページにカテゴリ付与機能を追加
//  add_action('init', 'add_categories_for_pages');
//
//  function add_categories_for_pages()
//  {
//    register_taxonomy_for_object_type('category', 'page');
//  }
//  add_action('pre_get_posts', 'nobita_merge_page_categories_at_category_archive');
//
//  function nobita_merge_page_categories_at_category_archive($query)
//  {
//    if ($query->is_category == true && $query->is_main_query()) {
//      $query->set('post_type', array('post', 'page', 'nav_menu_item'));
//    }
//  }


//01300 管理バーにログアウトを追加
  function add_new_item_in_admin_bar()
  {
    global $wp_admin_bar;
    $wp_admin_bar->add_menu(array(
  'id' => 'new_item_in_admin_bar',
  'title' => __('ログアウト'),
  'href' => wp_logout_url(),
  ));
  }
  add_action('wp_before_admin_bar_render', 'add_new_item_in_admin_bar');



//01400 5.3-バージョンアップ通知を管理者のみ表示させるようにします。
  function update_nag_admin_only()
  {
    if (!current_user_can('administrator'))
    {
      remove_action('admin_notices', 'update_nag', 3);
    }
  }
  add_action('admin_init', 'update_nag_admin_only');


//01500 tagにIDタグを追加　
    //[body_id]
    //echo do_shortcode( '[body_id]' );
    function body_idFunc()
    {
        if (is_front_page()) {
            $body_id = home;
        } elseif (is_single() || is_page()) {
            $page = get_page(get_the_ID());
            $body_id = $page->post_name;
        } elseif (is_category()) {
            $category = get_the_category();
            $body_id = 'category_'.$category[0]->category_nicename;
        }

        return $body_id;
    }
    add_shortcode('body_id', 'body_idFunc');


//01600 カテゴリーページの「カテゴリー：○○」の「カテゴリー：」を消す
    add_filter('get_the_archive_title', function ($title) {

        if (is_category()) {
            $title = single_cat_title('', false);
        }

        return $title;

    });

//01700 bodyタグのclassにページスラッグを追加する
    function body_classFunc($classes = '')
    {
        if (is_page()) {
            $page = get_page(get_the_ID());
            $classes[] = 'page-'.$page->post_name;
            if ($page->post_parent) {
                $classes[] = 'page-'.get_page_uri($page->post_parent).'-child';
            }
        }

        return $classes;
    }
    add_filter('body_class', 'body_classFunc');



//01800 URLからcategoryを抜く
    add_filter('user_trailingslashit', 'remcat_function');
    function remcat_function($link) {
        return str_replace("/category/", "/", $link);
    }

    add_action('init', 'remcat_flush_rules');
    function remcat_flush_rules() {
        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }

    add_filter('generate_rewrite_rules', 'remcat_rewrite');
    function remcat_rewrite($wp_rewrite) {
        $new_rules = array('(.+)/page/(.+)/?' => 'index.php?category_name='.$wp_rewrite->preg_index(1).'&paged='.$wp_rewrite->preg_index(2));
        $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
    }


//01900 サムネイルサイズの追加設定
  add_image_size('thumb75', 75, 75, true);


//02000 管理画面とフロントの見え方の統一
// add_editor_style( get_stylesheet_directory_uri().'/assets/library/css/editor-style.css');

//02100 ロゴ追加

add_action( 'customize_register', 'theme_customize' );

function theme_customize($wp_customize){

  //画像
  $wp_customize->add_section( 'img_section', array(
    'title' => '画像', //セクションのタイトル
    'priority' => 59, //セクションの位置
    'description' => '画像をアップロードしてください。', //セクションの説明
  ));

    $wp_customize->add_setting( 'logo_img' ); //設定項目を追加
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_img', array(
      'label' => 'ロゴ画像', //設定項目のタイトル
      'section' => 'img_section', //追加するセクションのID
      'settings' => 'logo_img', //追加する設定項目のID
      'description' => 'ロゴ画像を設定してください。', //設定項目の説明
    )));

}

/* テーマカスタマイザーで設定された画像のURLを取得
---------------------------------------------------------- */
//ヘッダーロゴ画像
function get_the_logo_img_url(){
  return esc_url( get_theme_mod( 'logo_img' ) );
}



/*is_mobile
---------------------------------------------------------- */
function is_mobile() {
  $useragents = array(
    'iPhone',          // iPhone
    'iPod',            // iPod touch
    'Android',         // 1.5+ Android
    'dream',           // Pre 1.5 Android
    'CUPCAKE',         // 1.5+ Android
    'blackberry9500',  // Storm
    'blackberry9530',  // Storm
    'blackberry9520',  // Storm v2
    'blackberry9550',  // Storm v2
    'blackberry9800',  // Torch
    'webOS',           // Palm Pre Experimental
    'incognito',       // Other iPhone browser
    'webmate'          // Other iPhone browser
  );
  $pattern = '/'.implode('|', $useragents).'/i';
  return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}


//02200 ヘッダーフッターメニュー処理
register_nav_menus(array(
    'global_menu' => 'グローバルメニュー',
    'SP_global_menu' => 'SPグローバルメニュー',
    'footer_menu' => 'フッターメニュー',
    'SP_footer_menu' => 'SPフッターメニュー'
));


/*カスタマイズ*/



// [news3 num="10"]
//echo do_shortcode( '[news3 num="10"]' );
/* 最新記事リスト */
  function getNewItems3($atts)
  {
    extract(shortcode_atts(array(
        'num' => '',    //最新記事リストの取得数
        'cat' => '',    //表示する記事のカテゴリー指定
    ), $atts));

    global $post;
    $oldpost = $post;

    $myposts = get_posts('numberposts='.$num.'&order=DESC&orderby=post_date&category='.$cat);
    $retHtml = '';

    foreach ($myposts as $post) :
      $content = strip_tags($post->post_content);
      $cat = get_the_category();//カテゴリー
      $catname = $cat[0]->cat_name;//カテゴリー名
      $catslug = $cat[0]->slug;//カテゴリースラッグ
    $category_id = get_cat_ID( $catname );// 指定したカテゴリーの ID を取得
    $category_link = get_category_link( $category_id );    // このカテゴリーの URL を取得

      setup_postdata($post);
    $retHtml .= '<div class="categoryListWrapper honbun">';
    $retHtml .= '<span class="cat">'. '<a href="'.$category_link .'">'. $catname .'</a></span>'; //"Y年n月j日 l H:i:s"
    $retHtml .= '<span class="entry-date">'.get_post_time('Y.n.j').'</span>'; //"Y年n月j日 l H:i:s"
        $retHtml .= '<h2 class="categoryListTitle3 inlineblockPc "><a href="'.get_permalink().'" class="santen">'.the_title("","",false).'</a></h2>';
        //$retHtml .= '<p class="post-content">'.nl2br($content).'</p>';
        //$retHtml.='<p class="more-detail"><a href="'.get_permalink().'">詳しく見る</a></p>';

        $retHtml .= '</div>';
  endforeach;
  $retHtml .= '';
  $post = $oldpost;
  wp_reset_postdata();

  return $retHtml;
  }
add_shortcode('news3', 'getNewItems3');

