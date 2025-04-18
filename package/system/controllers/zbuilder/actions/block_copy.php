<?php

class actionZbuilderBlockCopy extends cmsAction{

    public function run($bind_id) {

        if(!$this->request->isAjax()){
            return cmsCore::error404();
        }

        $block_bind = $this->model->getBlockBind($bind_id,true);
        if(!$block_bind){
            return cmsCore::error404();
        }

        $this->copyBlock($block_bind);

        $this->cms_template->renderJSON([
            'success' => true
        ]);

    }

}

