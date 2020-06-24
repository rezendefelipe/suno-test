<div class="container-fluid transparent no-padding categories">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>
                    Categorias
                </h3>
                <?php
                    $taxonomy     = 'hotel_category';
                    $orderby      = 'name';  
                    $show_count   = 0;      // 1 for yes, 0 for no
                    $pad_counts   = 0;      // 1 for yes, 0 for no
                    $hierarchical = 0;      // 1 for yes, 0 for no  
                    $title        = '';  
                    $empty        = 0;

                    $args = array(
                        'order'				=> "ASC",
                        'taxonomy'     		=> $taxonomy,
                        'show_count'   		=> $show_count,
                        'pad_counts'   		=> $pad_counts,
                        'hide_empty'   		=> $empty,
                        'parent'			=> 0,
                    );
                    $all_categories = get_categories( $args );
                    ?>
                    <ul>
                        <li class="nav-item category-filter" data-color='#000' id="" class="blue">
                            Todos
                        </li>
                        <?php
                            foreach ($all_categories as $cat) {
                                $color = get_option('taxonomy_'.$cat->term_id)['color_term_meta'];
                                if($cat->category_parent == 0) {
                                    $category_id = $cat->term_id;       
                                    ?>
                                        <li class="nav-item category-filter" data-color="<?=$color?>" id="<?=$cat->slug?>" style="border: 1px solid <?=$color?>;color:<?=$color?>;">
                                            <?=$cat->name?>
                                        </li>
                                    <?php
                                }
                            }
                        ?>
                    </ul>
            </div>
        </div>
    </div>
</div>