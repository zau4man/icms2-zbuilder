<?php

class actionZbuilderElementRerender extends cmsAction{

    public function run($id) {

        if(!cmsUser::isAdmin()){
            return cmsCore::error404();
        }

        if(!$this->request->isAjax()){
            return cmsCore::error404();
        }

        $element_bind = $this->model->getElementBind($id);
        if(!$element_bind){
            return cmsCore::error404();
        }

        $html = $this->getRenderedElement($element_bind);


        return $this->cms_template->renderJSON([
            'success' => true,
            'html' => $html
        ]);

    }

}

