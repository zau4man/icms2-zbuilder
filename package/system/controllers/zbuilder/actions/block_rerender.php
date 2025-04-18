<?php

class actionZbuilderBlockRerender extends cmsAction{

    public function run($id) {

        if(!$this->isEditor()){
            return cmsCore::error404();
        }

        if(!$this->request->isAjax()){
            return cmsCore::error404();
        }

        $block_bind = $this->model->getBlockBind($id,true);
        if(!$block_bind){
            return cmsCore::error404();
        }

        //тут надо прицепить элементы
        $block_bind = $this->attachElementsToBlock($block_bind);

        $html = $this->getRenderedBlock($block_bind);


        return $this->cms_template->renderJSON([
            'success' => true,
            'html' => $html
        ]);

    }

}

