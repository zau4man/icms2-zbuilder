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
                            $controller = cmsCore::getController('zbuilder');
                            $types = $controller->model->getAllowedBlocksTypes();
                            $items = array_column($types,'title','type');
                            $named = $controller->getNamedBlocks();
                            if($named){
                                $items = $items + $named;
                            }
                            return $items;
                        }
                    ]),
                    new fieldHidden('bind')
                ]
            ]
        ];

    }

}
