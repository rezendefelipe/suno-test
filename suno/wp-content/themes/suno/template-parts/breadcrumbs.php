<nav class="breadcrumb-site">
    <ul class="breadcrumb-site-list">
        <li class="breadcrumb-site-list_item first <?php if (is_front_page()) {echo " active";}?>">
            <a href='<?php echo esc_url( home_url( '/' ) ); ?>'>
                Home
            </a>
        </li>
        <li class="breadcrumb-site-list_item <?php if (!is_front_page()) {echo " active";}?>" aria-current="page">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/breadcrumb_img.png" alt="breadcrumb">
            <a href='<?php echo esc_url( home_url( '/beneficios' ) ); ?>'>
                Benefícios exclusivos para assinantes
            </a>
        </li>
    </ul>
</nav>