<?php

function youtubeGetVideoFrameCode() {
    return '<div class="video_wrap embed-responsive embed-responsive-16by9"><iframe class="video_frame embed-responsive-item" src="%s" frameborder="0" allowfullscreen></iframe></div>';

}

function youtubeGetVideoFrame($code) {
    return sprintf(youtubeGetVideoFrameCode(), youtubePrepareFrameLink($code));

}

function youtubePrepareFrameLink($code) {
    return '//www.youtube.com/embed/' . html($code, false);

}

function youtubeGetYoutubeId($url) {
    $regex = '/(?:youtube(?:-nocookie)?\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/mi';
    preg_match($regex, $url, $matches);
    return !empty($matches[1]) ? $matches[1] : false;

}

