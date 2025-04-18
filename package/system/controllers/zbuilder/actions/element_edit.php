<?php

class actionZbuilderElementEdit extends cmsAction{

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

        if(!$this->hasForm($element_bind['type'],'elements')){

            return $this->cms_template->render('info',[
                'text' => 'У данного элемента нет настроек'
            ]);

        }

        $element = $this->model->getElement($element_bind['type']);

        $data = $element_bind['data'];
        $data['id'] = $id;

        $form = $this->getForm($element_bind['type'],[],'forms/elements_');

        if($this->request->has('csrf_token')){

            $data = $form->parse($this->request, true, $data);
            $errors = $form->validate($this, $data);

            if($errors){

                return $this->cms_template->renderJSON([
                    'errors' => $errors
                ]);

            }else{

                $this->model->saveElementBind($id, $data);

                return $this->cms_template->renderJSON([
                    'errors' => false,
                    'callback' => 'elementSaved'
                ]);
            }

        }

        return $this->cms_template->render('actions/element_edit',[
            'id' => $id,
            'element' => $element,
            'form' => $form,
            'data' => $data,
            'action' => href_to('zbuilder','element_edit', $id),
            'errors' => $errors ?? false
        ]);

    }

}

