<?php 
get_header();
?>
		<div class="content-area">
			<main>
				<div class="centered-container">
				
						<?php 
							// If there are any posts
							if( have_posts() ):

								// Load posts loop
								while( have_posts() ): the_post();
									?>
										<article class="page">
											<h1><?php the_title(); ?></h1>
											<div><?php the_content(); ?></div>
										</article>
									<?php
								endwhile;
							else:
						?>
							<p>Nothing to display.</p>
						<?php endif; ?>
				</div>
			</main>
		</div>
<?php get_footer(); ?>