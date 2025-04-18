<?php

class formZbuilderElementOptions extends cmsForm {

    public function init($element_bind) {

        return [
            [
                'type' => 'fieldset',
                'title' => 'Опции элемента',
                'childs' => [
                    new fieldList('tpl', [
                        'title' => 'Шаблон блока',
                        'hint' => 'из папки controllers/zbuilder/elements',
                        'generator' => function() use($element_bind){
                            $type = $element_bind['type'];
                            return [$type => $type] + cmsTemplate::getInstance()->getAvailableTemplatesFiles('controllers/zbuilder/elements', $pattern="{$type}_*.*");
                        }
                    ]),
                    new fieldString('class', [
                        'title' => 'CSS класс элемента'
                    ]),
                    new fieldString('padding', [
                        'title' => 'Отступы внутри элемента',
                        'hint' => 'в виде строки типа 20px 15px 10px 5px'
                    ])
                ]
            ]
        ];

    }

}
