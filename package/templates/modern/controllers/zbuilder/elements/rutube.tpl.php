<?php
if (!empty($url)) {
    $this->controller->loadElementLib('rutube');
    $code = rutubeGetVideoId($url);
    if (!$code) {
        return false;
    }
    if (!empty($caption)) {
        ?><figure><?php } ?>
        <?php echo rutubeGetVideoFrame($code); ?>
    <?php if (!empty($caption)) { ?><figcaption>{caption}</figcaption>
        </figure><?php
    }
}