<?php

class actionZbuilderElementOptions extends cmsAction{

    public function run($id) {

        if(!$this->isEditor()){
            return cmsCore::error404();
        }

        if(!$this->request->isAjax()){
            return cmsCore::error404();
        }

        $element_bind = $this->model->getElementBind($id);
        if(!$element_bind){
            return cmsCore::error404();
        }

        $form = $this->getForm('element_options',[$element_bind]);

        if($this->request->has('csrf_token')){

            $data = $form->parse($this->request, true);

            $errors = $form->validate($this, $data);

            if($errors){

                return $this->cms_template->renderJSON([
                    'errors' => $errors
                ]);

            }else{

                $this->model->saveElementBindOptions($id,$data);

                return $this->cms_template->renderJSON([
                    'errors' => false,
                    'callback' => 'elementSaved'
                ]);
            }

        }

        $data = $element_bind['options'];
        $data['id'] = $id;

        return $this->cms_template->render('actions/element_options',[
            'id' => $id,
            'form' => $form,
            'item' => $data,
            'action' => href_to('zbuilder','element_options', $id),
            'errors' => $errors ?? false
        ]);

    }

}

