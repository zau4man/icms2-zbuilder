<?php
if(!empty($item)){
    $forms = cmsCore::getController('forms');
    echo $forms->parseShortcode("{forms:$item}");
}