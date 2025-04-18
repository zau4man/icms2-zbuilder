<?php

class formZbuilderBlockOptions extends cmsForm {

    public function init($block_bind) {

        return [
            [
                'type' => 'fieldset',
                'title' => 'Опции блока',
                'childs' => [
                    new fieldList('tpl', [
                        'title' => 'Шаблон блока',
                        'hint' => 'из папки controllers/zbuilder/blocks',
                        'generator' => function() use($block_bind){
                            $type = $block_bind['type'];
                            return [$type => $type] + cmsTemplate::getInstance()->getAvailableTemplatesFiles('controllers/zbuilder/blocks', $pattern="{$type}_*.*");
                        }
                    ]),
                    new fieldString('class', [
                        'title' => 'CSS класс блока'
                    ]),
                    new fieldString('padding', [
                        'title' => 'Отступы внутри блока',
                        'hint' => 'в виде строки типа 20px 15px 10px 5px'
                    ]),
                    new fieldCheckbox('container_all', [
                        'title' => 'Ограничить по ширине весь блок',
                        'hint' => 'если не отмечено, блок займет всю доступную ширину'
                    ]),
                    new fieldCheckbox('container_content', [
                        'title' => 'Ограничить по ширине контент',
                        'hint' => 'если не отмечено, контент займет всю доступную ширину'
                    ]),
                    new fieldCheckbox('full_width', [
                        'title' => 'Растянуть блок на всю ширину',
                        'hint' => 'для корректной работы опции нужно, чтобы бы блок находился по центру сайта, без сайдбаров, левых/правых колонок и т.п.'
                    ]),
                    new fieldCheckbox('is_bg_color', [
                        'title' => 'Использовать фоновый цвет'
                    ]),
                    new fieldColor('bg_color', [
                        'title' => 'Выберите цвет',
                        'options' => [
                            'opacity' => true
                        ],
                        'visible_depend' => ['is_bg_color' => ['show' => ['1']]]
                    ]),
                    new fieldCheckbox('is_bg_image', [
                        'title' => 'Использовать фоновое изображение'
                    ]),
                    new fieldImage('bg_image', [
                        'title' => 'Загрузите изображение',
                        'options' => [
                            'presets' => ['original']
                        ],
                        'visible_depend' => ['is_bg_image' => ['show' => ['1']]]
                    ]),
                    new fieldString('bg_repeat', [
                        'title' => 'Повторять изображение',
                        'hint' => 'no-repeat, repeat-x, repeat-y, repeat',
                        'default' => 'no-repeat',
                        'visible_depend' => ['is_bg_image' => ['show' => ['1']]]
                    ]),
                    new fieldString('bg_position', [
                        'title' => 'Позиция изображения',
                        'default' => 'center center',
                        'visible_depend' => ['is_bg_image' => ['show' => ['1']]]
                    ]),
                    new fieldString('bg_size', [
                        'title' => 'Размер фона',
                        'hint' => '100%, cover, contain',
                        'default' => 'contain',
                        'visible_depend' => ['is_bg_image' => ['show' => ['1']]]
                    ]),
                ]
            ]
        ];

    }

}
