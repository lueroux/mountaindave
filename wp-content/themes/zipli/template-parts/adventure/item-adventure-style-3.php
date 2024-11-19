<div class="adventure-item adventure-style-3">
    <div class="adventure-inner">
        <div class="adventure-post-thumbnail-parent">
            <div class="adventure-post-thumbnail">
                <?php if (has_post_thumbnail()) : ?>
                    <a class="overlay-link" href="<?php the_permalink() ?>"><?php the_post_thumbnail('medium_large'); ?></a>
                <?php endif; ?>
            </div>
        </div>
        <div class="adventure-content">
            <?php zipli_adventure_item_get_price(get_the_ID()); ?>
            <h4 class="adventure-title gamma"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <?php zipli_adventure_item_get_meta(get_the_ID()); ?>
            <div class="adventure-excerpt">
                <?php echo get_the_excerpt(); ?>
            </div>
            <a class="adventure-more-link" href="<?php the_permalink() ?>"><span><?php echo esc_html__('Learn more', 'zipli'); ?></span><i class="zipli-icon-long-arrow-right"></i></a>
        </div>
    </div>
</div>
