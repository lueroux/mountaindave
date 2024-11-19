<div class="group-item group-style-3">
    <div class="group-inner">
        <div class="group-post-thumbnail">
            <?php if (has_post_thumbnail()) : ?>
                <a class="overlay-link" href="<?php the_permalink() ?>">
                    <?php the_post_thumbnail('medium_large'); ?>
                </a>
            <?php endif; ?>
        </div>
        <div class="group-content">
            <h3 class="group-title delta"><?php the_title(); ?></h3>
            <div class="group-excerpt">
                <?php echo get_the_excerpt(); ?>
            </div>
            <a class="group-more-link style-link" href="<?php the_permalink() ?>"><span><?php echo esc_html__('Learn more', 'zipli'); ?></span><i class="zipli-icon-long-arrow-right"></i></a>
        </div>
    </div>
</div>
