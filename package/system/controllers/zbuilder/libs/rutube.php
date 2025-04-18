<?php

function rutubeGetVideoFrameCode() {
    return '<div class="video_wrap embed-responsive embed-responsive-16by9"><iframe class="video_frame embed-responsive-item" src="%s" frameborder="0" allowfullscreen></iframe></div>';

}

function rutubeGetVideoFrame($code) {
    return sprintf(rutubeGetVideoFrameCode(), rutubePrepareFrameLink($code));

}

function rutubePrepareFrameLink($code) {
    return 'https://rutube.ru/play/embed/' . html($code, false);

}

function rutubeGetVideoId($url) {
    $regex = '/rutube\.ru\/video\/([a-z0-9]{25,40})/mi';
    preg_match($regex, $url, $matches);
    return !empty($matches[1]) ? $matches[1] : false;

}

