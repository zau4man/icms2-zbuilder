<?php

class formZbuilderBlockAdd extends cmsForm {

    public function init() {

        return [
            [
                'type' => 'fieldset',
                'title' => 'Добавить блок',
                'childs' => [
                    new fieldList('type', [
                        'title' => 'Тип блока',
                        'generator' => function(){
                            $types = cmsCore::getModel('zbuilder')->getAllowedBlocksTypes();
                            return array_column($types,'title','type');
                        }
                    ]),
                    new fieldHidden('bind')
                ]
            ]
        ];

    }

}
