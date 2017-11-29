<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package nanairo
 */


get_header(); ?>


	<div class="container-fluid">
		<!--four-o-four-->
		<div id="four-o-four" class="oneColumn-content-area container1024Pc">
			<main id="main" class="site-main" role="main">
				<div class="entry-content">
					<section class="error-404 not-found">
						<header class="page-header">
							<h1 class="page-title"><?php esc_html_e( 'お探しのページは存在しません', 'nanairo' ); ?></h1>
						</header><!-- .page-header -->

						<div class="page-content">
							<p><?php esc_html_e( '正しいページアドレスをご入力ください', 'nanairo' ); ?></p>
						</div><!-- .page-content -->
					</section><!-- .error-404 -->
				</div>
			</main><!-- #main -->
		</div><!-- #four-o-four -->
	</div><!--container-fluid-->

<?php

global $pattern_file;
get_footer();
