<?php get_header();?>
  <div class="centered-container">
    <?php 
      if( have_posts() ):
        while( have_posts() ): the_post();
        ?>
          <article>
            <h2><?php the_title(); ?></h2>
            <div><?php the_content(); ?></div>
          </article>
        <?php
        endwhile;
      else: 
        ?>
        <p>Nothing to display.</p>
        <?php
      endif;
  ?>
  </div>
  <?php get_template_part('template-parts/home-page') ?>
<?php get_footer();?>

  