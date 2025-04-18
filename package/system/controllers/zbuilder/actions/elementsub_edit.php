<?php

class actionZbuilderElementsubEdit extends cmsAction{

    public function run($id,$sub,$sub_id = false) {

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

        $form_name = $element_bind['type'] . '_' . $sub;

        if(!$this->hasForm($form_name,'elements')){

            return $this->cms_template->render('info',[
                'text' => 'У данного блока нет настроек'
            ]);

        }

        $element = $this->model->getElement($element_bind['type']);

        $form = $this->getForm($form_name,[],'forms/elements_');

        if($this->request->has('csrf_token')){

            $data = $form->parse($this->request, true);
            $errors = $form->validate($this, $data);

            if($errors){

                return $this->cms_template->renderJSON([
                    'errors' => $errors
                ]);

            }else{

                $this->model->saveElementsubBind($id,$sub,$data,$sub_id);

                return $this->cms_template->renderJSON([
                    'errors' => false,
                    'callback' => 'elementsubSaved'
                ]);
            }

        }

        $data = $element_bind['data'];
        $item = false;
        $items = key_exists($sub, $data) ? $data[$sub] : false;

        if($items && $sub_id && !empty($items[$sub_id])){
            $item = $items[$sub_id];
        }

        return $this->cms_template->render('actions/elementsub_edit',[
            'id' => $id,
            'element' => $element,
            'form' => $form,
            'item' => $item,
            'action' => href_to('zbuilder','elementsub_edit', [$id, $sub, $sub_id]),
            'errors' => $errors ?? false
        ]);

    }

}

