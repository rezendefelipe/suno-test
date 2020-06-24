<?php get_header(); ?>

<div class="container-fluid center">
    <div class="container center">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-12">
                <?php
                if (have_posts()) :
                    while (have_posts()) :
                        the_post();
                        the_content();
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>