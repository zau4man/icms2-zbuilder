<?php

class formZbuilderElementAdd extends cmsForm {

    public function init() {

        return [
            [
                'type' => 'fieldset',
                'childs' => [
                    new fieldList('type', [
                        'title' => 'Тип элемента',
                        'generator' => function(){
                            $types = cmsCore::getModel('zbuilder')->getAllowedElementsTypes();
                            return array_column($types,'title','type');
                        }
                    ]),
                    new fieldHidden('block_id'),
                    new fieldHidden('position')
                ]
            ]
        ];

    }

}
