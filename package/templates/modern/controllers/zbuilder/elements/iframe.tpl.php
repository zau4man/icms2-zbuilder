<?php
if (empty($frame)) {
        return false;
    }
    if (!empty($caption)) {
        ?><figure><?php } ?>
        <?php echo $frame; ?>
    <?php if (!empty($caption)) { ?><figcaption>{caption}</figcaption>
        </figure><?php
    }