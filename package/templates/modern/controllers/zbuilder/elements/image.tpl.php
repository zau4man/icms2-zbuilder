<?php if (!empty($caption)) { ?><figure><?php } ?>
    <?php if (!empty($image)) { ?>
    <a class="ajax-modal" href="<?php echo html_image_src($image, $size_full, true); ?>"><?php echo html_image($image, $size, $caption ?? false); ?></a>
    <?php } ?>
    <?php if (!empty($caption)) { ?><figcaption>{caption}</figcaption>
    </figure><?php
}