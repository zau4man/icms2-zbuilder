<?php

class actionZbuilderBlockAdd extends cmsAction{

    public function run() {

        if(!cmsUser::isAdmin()){
            return cmsCore::error404();
        }

        if(!$this->request->isAjax()){
            return cmsCore::error404();
        }

        //тут нужны проверки bind и block_id

        $bind = $this->request->get('bind','','string');

        $form = $this->getForm('block_add');

        if($this->request->has('csrf_token')){

            $data = $form->parse($this->request, true);
            $errors = $form->validate($this, $data);

            if($errors){

                return $this->cms_template->renderJSON([
                    'errors' => $errors
                ]);

            }else{

                $ordering = $this->model->filterEqual('bind',$bind)->getNextOrdering('zbuilder_blocks_bind');

                //или создаем блок через образец
                if(is_numeric($data['type'])){
                    $block_bind = $this->model->getBlockBind($data['type'],true);
                    $block_bind['ordering'] = $ordering;
                    $this->copyBlock($block_bind, $bind);
                }
                //или создаем новый пустой блок в позиции
                else{
                    $data['ordering'] = $ordering;
                    $this->model->addBlockBind($data);
                }




                return $this->cms_template->renderJSON([
                    'errors' => false,
                    'callback' => 'blockAdded'
                ]);
            }

        }

        return $this->cms_template->render('actions/block_add',[
            'form' => $form,
            'data' => [
                'bind' => $bind
            ],
            'action' => href_to('zbuilder','block_add'),
            'errors' => $errors ?? false
        ]);

    }

}

