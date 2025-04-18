<?php

class actionZbuilderReorder extends cmsAction {

    public function run($type) {

        if(!cmsUser::isAdmin()){
            return cmsCore::error404();
        }

        if(!$this->request->isAjax()){
            return cmsCore::error404();
        }

        if(!in_array($type, ['blocks','elements'])){
            return cmsCore::error404();
        }

        $table_name = 'zbuilder_' . $type . '_bind';

        $list = $this->request->get('list',false,'array');

        //тут нужны проверки содержимого list и position и block_id и bind !!!!

        //сортировка
        $this->model->reorderByList($table_name, $list);

        //смена позиции элемента
        if($this->request->has('position')){
            $position = $this->request->get('position','','string');
            $block_id = $this->request->get('block_id','','integer');
            if(!$this->validate_sysname($position) || !is_numeric($block_id)){
                return cmsCore::error404();
            }
            if($position && $block_id){
                $this->model->filterIn('id',$list)->updateFiltered($table_name,[
                    'position' => $position,
                    'block_id' => $block_id
                ]);
            }
        }

        //смена бинда блока
        if($this->request->has('bind')){
            $bind = $this->request->get('bind','','string');
            if(!$this->validate_sysname($bind)){
                return cmsCore::error404();
            }
            if($bind){
                $this->model->filterIn('id',$list)->updateFiltered($table_name,[
                    'bind' => $bind
                ]);
            }
        }


        $this->cms_template->renderJSON([
            'success' => true
        ]);

    }

}

