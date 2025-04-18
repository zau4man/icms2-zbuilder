<?php

class actionZbuilderElementAdd extends cmsAction{

    public function run($block_id,$position) {

        if(!cmsUser::isAdmin()){
            return cmsCore::error404();
        }

        if(!$this->request->isAjax()){
            return cmsCore::error404();
        }

        //тут нужны проверки $block_id и $position

        $form = $this->getForm('element_add');

        if($this->request->has('csrf_token')){

            $data = $form->parse($this->request, true);
            $errors = $form->validate($this, $data);

            if($errors){

                return $this->cms_template->renderJSON([
                    'errors' => $errors
                ]);

            }else{

                $data['ordering'] = $this->model
                        ->filterEqual('block_id',$block_id)
                        ->filterEqual('position',$position)
                        ->getNextOrdering('zbuilder_elements_bind');
                $data['id'] = $this->model->addElementBind($data);
                $data['data'] = [];
                $html = $this->getRenderedElement($data);

                return $this->cms_template->renderJSON([
                    'errors' => false,
                    'callback' => 'elementAdded',
                    'html' => $html,
                    'element_id' => $data['id']
                ]);
            }

        }

        return $this->cms_template->render('actions/element_add',[
            'form' => $form,
            'block_id' => $block_id,
            'position' => $position,
            'data' => [
                'block_id' => $block_id,
                'position' => $position
            ],
            'action' => href_to('zbuilder','element_add', [$block_id,$position]),
            'errors' => $errors ?? false
        ]);

    }

}

