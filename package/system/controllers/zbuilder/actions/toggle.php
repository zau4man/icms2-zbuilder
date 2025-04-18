<?php

class actionZbuilderToggle extends cmsAction {

    public function run() {

        if(!cmsUser::isAdmin()){
            cmsCore::error404();
        }

        $is_toggle = cmsUser::getUPS('zbuilder.show');
        cmsUser::setUPS('zbuilder.show', !$is_toggle);
        $this->redirectBack();

    }

}

