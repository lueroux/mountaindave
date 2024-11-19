<?php
if (is_post_type_archive('zipli_adventure') || is_tax('zipli_adventure_cat')) {
    get_template_part('template-parts/archive-adventure');
}else{
    get_template_part('template-parts/archive-post');
}
