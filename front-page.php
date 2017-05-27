<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <?php the_post_thumbnail('full'); ?>

    <div id="page_content" class="home win_height" role="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-8 middle_content win_height">
                    <div class="inner_content">
                        <h1><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4 home_sidebar middle_content win_height">
                    <div class="inner_content">
                        Register Side
                    </div>
                </div>
            </div>
        </div>
    </div>
    Guygg

<?php endwhile; else : ?>
    <p><?php _e( 'Sorry, no pages matched your criteria.', 'cs' ); ?></p>
<?php endif; ?>


<?php get_footer(); ?>
