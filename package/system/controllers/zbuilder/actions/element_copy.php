<?php

class actionZbuilderElementCopy extends cmsAction{

    public function run($bind_id) {

        if(!$this->request->isAjax()){
            return cmsCore::error404();
        }

        $element_bind = $this->model->getElementBind($bind_id);
        if(!$element_bind){
            return cmsCore::error404();
        }

        //получим ids элементы в этой же позиции и блоке
        $pos_block_elements_ids = $this->model
                ->filterEqual('block_id',$element_bind['block_id'])
                ->filterEqual('position',$element_bind['position'])
                ->get('zbuilder_elements_bind',function($item,$model){
                    return $item['id'];
                },false);

        //добавим новый элемент
        $new_element_bind = $element_bind;
        unset($new_element_bind['id']);
        $new_id = $this->model->addElementBind($new_element_bind);

        //id элементов с вновь добавленным для сортировки
        array_splice($pos_block_elements_ids,array_search($element_bind['id'],$pos_block_elements_ids) + 1,0,[$new_id]);

        //отсортируем
        $table_name = 'zbuilder_elements_bind';
        $this->model->reorderByList($table_name, $pos_block_elements_ids);

        $this->cms_template->renderJSON([
            'success' => true
        ]);

    }

}

