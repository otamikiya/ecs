
<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package nanairo
 */

get_header(); ?>

<div id="categoryList" class="container-fluid">

    <div id="twoColumnRightSideBar" class="category-page twoColumnRightSideBar page-template-page-2columnRightSidebar">

		<div id="primary" class="entry-content">
            <main id="main" class="site-main" role="main">
				<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<?php
							the_archive_title( '<h1 class="categoryPageTitle">', '</h1>' );
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
					</header><!-- .page-header -->
                    
					<div class="categoryListContent honbun">
					    <?php
					    /* Start the Loop */
				        while (have_posts()) : the_post();  ?>
							<div class="categoryListWrapper honbun">
					            <span class="entry-date"><?php echo get_the_date(); ?></span>
                                <h2 class="categoryListTitle inlineblockPc">
                                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                        if(mb_strlen($post->post_title, 'UTF-8')>40){
                                            $title= mb_substr($post->post_title, 0, 40, 'UTF-8');
                                            echo $title.'…';
                                        }else{
                                            echo $post->post_title;
                                        }?>
                                    </a>
                                </h2>
								<!-- <h3 class="searchresult_excerpt"><?php //the_excerpt(); ?></h3> -->
							</div><!--/.categoryListWrapper-->
				        <?php endwhile;
                            // the_posts_navigation();
                            // else :
                            // get_template_part( 'template-parts/content', 'none' );
                        endif; ?>
			    	</div><!--/.categoryListContent-->

				</main><!-- /#main -->

			</div><!--/.primary-->

			<!--sidebar-->
			<div id="sidebar">
				<?php
				// if (is_page()) {
				// 	$parent_id = $post->post_parent; // 親ページのIDを取得
				// 	$parent_slug = get_post($parent_id)->post_name; // 親ページのスラッグを取得
				// 	}
					dynamic_sidebar( 'news-sidebar' );
					?>
			</div><!--/.sidebar-->

    	</div><!--/#cagetory-page -->

    </div><!--/.container-fluid-->

<?php

get_footer();
