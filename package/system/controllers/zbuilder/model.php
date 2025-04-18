<?php

class modelZbuilder extends cmsModel {

    public function getBlocksBind($bind) {
        return $this->filterEqual('bind', $bind)->orderBy('ordering','asc')->get('zbuilder_blocks_bind',function($item,$model){
            $item['options'] = cmsModel::yamlToArray($item['options']);
            return $item;
        },'id');
    }

    public function getBlocksElements($block_ids) {
        return $this->filterIn('block_id', $block_ids)->orderBy('ordering','asc')->get('zbuilder_elements_bind',function($item,$model){
            $item['options'] = cmsModel::yamlToArray($item['options']);
            $item['data'] = cmsModel::yamlToArray($item['data']);
            return $item;
        });
    }

    public function getBlocksTypes() {
        return $this->get('zbuilder_blocks');
    }

    public function getAllowedBlocksTypes() {
        return $this->filterEqual('is_allowed', 1)->getBlocksTypes();
    }

    public function addBlockBind($data) {
        return $this->insert('zbuilder_blocks_bind',$data);
    }

    public function deleteBlockBind($bind_id) {
        $this->delete('zbuilder_blocks_bind',$bind_id);
    }

    public function getBlockBind($bind_id) {
        return $this->getItemById('zbuilder_blocks_bind',$bind_id,function($item,$model){
            $item['options'] = cmsModel::yamlToArray($item['options']);
            if(!empty($item['title'])){
                $item['options']['title'] = $item['title'];
            }
            return $item;
        });
    }

    public function saveBlockBind($bind_id, $data) {
        return $this->update('zbuilder_blocks_bind',$bind_id,$data);
    }

    public function getElementsTypes() {
        return $this->get('zbuilder_elements');
    }

    public function getAllowedElementsTypes() {
        return $this->filterEqual('is_allowed', 1)->getElementsTypes();
    }

    public function addElementBind($data) {
        return $this->insert('zbuilder_elements_bind',$data);
    }

    public function deleteElementBind($bind_id) {
        $this->delete('zbuilder_elements_bind',$bind_id);
    }

    public function getElementBind($bind_id) {
        return $this->getItemById('zbuilder_elements_bind',$bind_id,function($item,$model){
            $item['options'] = cmsModel::yamlToArray($item['options']);
            $item['data'] = cmsModel::yamlToArray($item['data']);
            return $item;
        });
    }

    public function saveElementBind($bind_id,$data) {
        return $this->update('zbuilder_elements_bind',$bind_id,[
            'data' => $data
        ]);
    }

    public function getElement($type) {
        return $this->getItemByField('zbuilder_elements','type',$type);
    }

    public function saveBlockBindOptions($bind_id,$options) {
        return $this->update('zbuilder_blocks_bind',$bind_id,[
            'options' => $options
        ]);
    }

    public function saveElementBindOptions($bind_id,$options) {
        return $this->update('zbuilder_elements_bind',$bind_id,[
            'options' => $options
        ]);
    }

    public function saveElementsubBind($bind_id,$sub,$sub_data,$sub_id = false) {

        $element_bind = $this->getElementBind($bind_id,true);
        if($element_bind){
            $data = $element_bind['data'];
            $items = key_exists($sub, $data) ? $data[$sub] : [];
            if($sub_id){
                $items[$sub_id] = $sub_data;
            }else{
                if($items){
                    $items[] = $sub_data;
                }else{
                    $items[1] = $sub_data;
                }

            }
            $data[$sub] = $items;
            $this->saveElementBind($bind_id,$data);
        }
    }

    public function deleteElementsubBind($bind_id,$sub,$sub_id) {

        $element_bind = $this->getElementBind($bind_id,true);
        if($element_bind){
            $data = $element_bind['data'];
            $items = key_exists($sub, $data) ? $data[$sub] : [];
            if($items && $sub_id && !empty($items[$sub_id])){
                cmsCore::getController('zbuilder')->deleteElementImages($items[$sub_id]);
                unset($items[$sub_id]);
                if($items){
                    $data[$sub] = $items;
                }else{
                    unset($data[$sub]);
                }
            }

            $this->saveElementBind($bind_id,$data);
        }
    }

}
