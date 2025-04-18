<?php

class formZbuilderH extends cmsForm {

    public function init() {

        return array(
            array(
                'type'   => 'fieldset',
                'childs' => array(
                    new fieldString('text', [
                        'hint' => 'укажите текст внутри тега',
                        'is_clean_disable' => true,
                        'rules' => [
                            ['required']
                        ]
                    ]),
                    new fieldList('type', [
                        'hint' => 'выберите вариант тега заголовка',
                        'items' => [
                            'h1' => 'h1',
                            'h2' => 'h2',
                            'h3' => 'h3',
                            'h4' => 'h4',
                            'h5' => 'h5',
                            'h6' => 'h6'
                        ],
                        'rules' => [
                            ['required']
                        ]
                    ]),
                    new fieldList('align', [
                        'hint' => 'выравнивание',
                        'items' => [
                            '' => 'без',
                            'center' => 'по центру',
                            'right' => 'справа'
                        ]
                    ])
                )
            )
        );

    }

}
