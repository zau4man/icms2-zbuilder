<?php

class formZbuilderQuote extends cmsForm {

    public function init() {

        $options = $this->controller->options;
        $sizes = [
            $options['preset_micro'] => 'Маленький',
            $options['preset_normal'] => 'Обычный',
            $options['preset_big'] => 'Большой'
        ];

        return array(
            array(
                'type'   => 'fieldset',
                'childs' => array(
                    new fieldImage('image', [
                        'options' => [
                            'sizes' => [$options['preset_micro'],$options['preset_normal'],$options['preset_big']]
                        ],
                        'rules' => [
                            ['required']
                        ]
                    ]),
                    new fieldList('size', [
                        'hint' => 'какой размер вывести?',
                        'items' => $sizes,
                        'rules' => [
                            ['required']
                        ]
                    ]),
                    new fieldString('author', [
                        'title' => 'Автор цитаты',
                        'rules' => [
                            ['required']
                        ]
                            ]),
                    new fieldHtml('text', [
                        'title' => 'Текст цитаты',
                        'rules' => [
                            ['required']
                        ]
                            ])
                )
            )
        );

    }

}
