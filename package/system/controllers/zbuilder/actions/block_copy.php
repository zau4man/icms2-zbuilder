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

        //получим элементы этого блока
        $elements_binds = $this->model
                ->filterEqual('block_id',$block_bind['id'])
                ->get('zbuilder_elements_bind');

        //получим ids блоков в этом же бинде
        $bind_blocks_ids = $this->model
                ->filterEqual('bind',$block_bind['bind'])
                ->get('zbuilder_blocks_bind',function($item,$model){
                    return $item['id'];
                },false);

        //добавим новый блок
        $new_block_bind = $block_bind;
        unset($new_block_bind['id']);
        $new_id = $this->model->addBlockBind($new_block_bind);

        //id блоков с вновь добавленным для сортировки
        array_splice($bind_blocks_ids,array_search($block_bind['id'],$bind_blocks_ids) + 1,0,[$new_id]);

        //отсортируем
        $table_name = 'zbuilder_blocks_bind';
        $this->model->reorderByList($table_name, $bind_blocks_ids);

        //добавим копии элементов
        if($elements_binds){
            foreach ($elements_binds as $element_bind){
                unset($element_bind['id']);
                $element_bind['block_id'] = $new_id;
                $this->model->addElementBind($element_bind);
            }
        }

        $this->cms_template->renderJSON([
            'success' => true
        ]);

    }

}

