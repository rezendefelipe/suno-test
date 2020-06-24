<?php //Template name: ajax_parceiros ?>
<?php
    if (isset($_POST['cat'])) {
        if ($_POST['cat'] !== "") {
            $args = array(
                'post_type' => 'parceiros', 
                'numberposts' => -1, 
                'posts_per_page' => -1, 
                'paged' => $_POST['page'], 
                'post_status' => 'publish', 
                'tax_query' => array(
                    array(
                        'taxonomy' => 'hotel_category',
                        'field' => 'slug',
                        'terms' => $_POST['cat'],
                    ),
                )
            );
        } else {
            $args = array(
                'post_type' => 'parceiros', 
                'numberposts' => 3, 
                'posts_per_page' => 3,
                'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1, 
                'post_status' => 'publish'
            );
        }
    } else {
        $args = array(
            'post_type' => 'parceiros', 
            'numberposts' => 3, 
            'posts_per_page' => 3, 
            'paged' => $_POST['page'],
            'post_status' => 'publish'
        );
    }
    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            ?>
                <div class="col-12 wrap-spot-parceiros col-lg-4 col-md-6 col-sm-12">
                    <?php get_template_part('template-parts/spot', 'get_post_format()'); ?>
                </div>
            <?php
        endwhile;
    endif;
?>