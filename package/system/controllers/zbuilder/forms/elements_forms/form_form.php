<?php

class formZbuilderForm extends cmsForm {

    public function init() {

        $model = new cmsModel();
        $forms = $model->get('forms',function($item,$model){
            return $item['title'];
        },'name');

        return array(
            array(
                'type'   => 'fieldset',
                'childs' => array(
                    new fieldList('item', [
                        'items' => $forms,
                        'rules' => [
                            ['required']
                        ]
                            ])
                )
            )
        );

    }

}
