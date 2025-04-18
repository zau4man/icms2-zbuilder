<?php
if (!empty($url)) {
    $this->controller->loadElementLib('youtube');
    $code = youtubeGetYoutubeId($url);
    if (!$code) {
        return false;
    }
    if (!empty($caption)) {
        ?><figure><?php } ?>
        <?php echo youtubeGetVideoFrame($code); ?>
    <?php if (!empty($caption)) { ?><figcaption>{caption}</figcaption>
        </figure><?php
    }
}