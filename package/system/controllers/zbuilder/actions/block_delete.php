<?php

class actionZbuilderBlockDelete extends cmsAction{

    public function run($bind_id) {

        if(!cmsUser::isAdmin()){
            return cmsCore::error404();
        }

        if(!$this->request->isAjax()){
            return cmsCore::error404();
        }

        //тут нужны проверки bind и block_id

        $this->deleteBlockBind($bind_id);

        $this->cms_template->renderJSON([
            'success' => true
        ]);

    }

}

