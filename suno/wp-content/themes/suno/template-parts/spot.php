<div class="spot-parceiros">
    <?php $logo = get_post_meta($post->ID, "logo_image", true); ?>
    <?php $link = get_post_meta($post->ID, "link", true); ?>
    <?php $desconto = get_post_meta($post->ID, "desconto", true); ?>
    
    <?php
        if (get_the_post_thumbnail_url()) {
            ?>
                <div class="spot-parceiros-img" style="background-image: url('<?= get_the_post_thumbnail_url() ?>');height: 200px;background-position: center;background-repeat: no-repeat;background-size: cover;">
            <?php
        } else {
            ?>
                <div class="spot-parceiros-img" style="background-image: url('https://via.placeholder.com/250');height: 200px;background-position: center;background-repeat: no-repeat;background-size: cover;">
            <?php
        }
    ?>
    </div>
    <?php
        if (isset($desconto)) {
            ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/discount_img.png" alt="" class="img-discount">
                <div class="spot-parceiros-desconto">
                    <p>
                        <?= $desconto ?>%<br />
                        OFF
                    </p>
                </div>
            <?php
        }
    ?>
    <?php
        if (isset($logo)) {
            ?>
                <div class="spot-parceiros-logo">
                    <img src="<?= $logo ?>" alt="" class="rounded-circle">
                </div>
            <?php
        }
    ?>
    <div class="spot-parceiros-content">
        <div class="spot-parceiros-content_title">
            <h4>
                <?= get_the_title() ?>
            </h4>
            <?php 
                if ($link) {
                    ?>
                        <span class="spot-parceiros-content_link">
                            <a href='<?=$link?>' target="_blank">
                                <?=$link?>
                            </a>
                        </span>
                    <?php
                }
            ?>
        </div>

        <div class="spot-parceiros-excerpt">
            <?= get_the_excerpt() ?>
        </div>
    </div>
</div>