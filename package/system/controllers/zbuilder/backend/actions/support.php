<?php

class actionZbuilderSupport extends cmsAction {

    public function run(){

        $this->cms_template->addBreadcrumb('Поддержите компонент');
        return $this->cms_template->render('backend/support');

    }

}
