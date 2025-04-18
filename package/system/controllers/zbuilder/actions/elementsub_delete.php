<?php

class actionZbuilderElementsubDelete extends cmsAction{

    public function run($id,$sub,$sub_id) {

        if(!$this->isEditor()){
            return cmsCore::error404();
        }

        if(!$this->request->isAjax()){
            return cmsCore::error404();
        }

        //тут нужны проверки bind и block_id

        $this->model->deleteElementsubBind($id,$sub,$sub_id);

        die("<script>icms.zbuilder.elementsubSaved($id);</script>");

    }

}

