<?php if (!empty($caption)) { ?><figure><?php } ?>
    <?php if (!empty($image)) { ?>
        <?php if ($size_full) { ?>
            <a class="ajax-modal" href="<?php echo html_image_src($image, $size_full, true); ?>">
            <?php } ?>
            <?php echo html_image($image, $size, $caption ?? false); ?>
            <?php if ($size_full) { ?>
            </a>
        <?php } ?>
    <?php } ?>
    <?php if (!empty($caption)) { ?><figcaption>{caption}</figcaption>
    </figure><?php
}