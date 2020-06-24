<div class="container-fluid transparent no-padding">
    <div class="container">
        <?php
            $query = new WP_Query(array('post_type' => 'parceiros', 'numberposts' => 3, 'posts_per_page' => 3,'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1, 'post_status' => 'publish'));
            if ($query->have_posts()) :

                echo "<div class='row transparent carregar_mais'>";

                while ($query->have_posts()) : $query->the_post();

                    ?>
                        <div class="col-12 wrap-spot-parceiros col-lg-4 col-md-6 col-sm-12">
                            <?php get_template_part('template-parts/spot', 'get_post_format()'); ?>
                        </div>
                    <?php

                endwhile;

                echo "</div>";
            endif;
        ?>
        <?php
            if (  $query->max_num_pages > 1 ) {
                ?>
                    <div class="loadmore_div">
                        <div class="loadmore main_btn" id="load_more_id" data-page="2">
                            <svg id="Layer_1" style="enable-background:new 0 0 64 64;fill:#B3383A;" width="25px" height="25px"  version="1.1" viewBox="0 0 64 64" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g id="Icon-Plus" transform="translate(28.000000, 278.000000)"><path class="st0" d="M4-222.1c-13.2,0-23.9-10.7-23.9-23.9c0-13.2,10.7-23.9,23.9-23.9s23.9,10.7,23.9,23.9     C27.9-232.8,17.2-222.1,4-222.1L4-222.1z M4-267.3c-11.7,0-21.3,9.6-21.3,21.3s9.6,21.3,21.3,21.3s21.3-9.6,21.3-21.3     S15.7-267.3,4-267.3L4-267.3z" id="Fill-38"/><polygon class="st0" id="Fill-39" points="-8.7,-247.4 16.7,-247.4 16.7,-244.6 -8.7,-244.6    "/><polygon class="st0" id="Fill-40" points="2.6,-258.7 5.4,-258.7 5.4,-233.3 2.6,-233.3    "/></g></g></svg>
                            <span>Carregar mais</span>
                        </div>
                    </div>
                <?php
            }
        ?>
    </div>
</div>
<style>
    #load_more_id{
		width: 100%;
		text-align: center;
		display: flex;
		align-items: center;
		align-content: center;
        justify-content: center;
        cursor:pointer;
    }
    #load_more_id span {
        color: #B3383A;
        font-weight: bold;
        text-align: center ;
    }
</style>