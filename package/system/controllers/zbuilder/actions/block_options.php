<?php

class actionZbuilderBlockOptions extends cmsAction{

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

        $form = $this->getForm('block_options',[$block_bind]);

        if($this->request->has('csrf_token')){

            $data = $form->parse($this->request, true);

            $errors = $form->validate($this, $data);

            if($errors){

                return $this->cms_template->renderJSON([
                    'errors' => $errors
                ]);

            }else{

                //если есть имя блока, сохраним его отдельно
                if(!empty($data['title'])){
                    $this->model->saveBlockBind($id, [
                        'title' => $data['title']
                    ]);
                    unset($data['title']);
                }
                $this->model->saveBlockBindOptions($id,$data);

                return $this->cms_template->renderJSON([
                    'errors' => false,
                    'callback' => 'blockSaved'
                ]);
            }

        }

        $data = $block_bind['options'];
        $data['id'] = $id;

        return $this->cms_template->render('actions/block_options',[
            'id' => $id,
            'form' => $form,
            'item' => $data,
            'action' => href_to('zbuilder','block_options', $id),
            'errors' => $errors ?? false
        ]);

    }

}

