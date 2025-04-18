<?php

class formZbuilderButton extends cmsForm {

    public function init() {

        return array(
            array(
                'type'   => 'fieldset',
                'childs' => array(
                    new fieldString('text', [
                        'hint' => 'текст кнопки',
                        'rules' => [
                            ['required']
                        ]
                    ]),
                    new fieldString('url', [
                        'hint' => 'ссылка',
                        'rules' => [
                            ['required']
                        ]
                    ]),
                    new fieldList('type', [
                        'hint' => 'тип кнопки',
                        'items' => [
                            'btn-primary' => 'Primary',
                            'btn-secondary' => 'Secondary',
                            'btn-success' => 'Success',
                            'btn-danger' => 'Danger',
                            'btn-warning' => 'Warning',
                            'btn-info' => 'Info',
                            'btn-light' => 'Light',
                            'btn-dark' => 'Dark',
                            'btn-link' => 'Link'
                        ],
                        'rules' => [
                            ['required']
                        ]
                    ]),
                    new fieldList('size', [
                        'hint' => 'Размер',
                        'items' => [
                            '' => 'Обычный',
                            'btn-sm' => 'Уменьшенный',
                            'btn-lg' => 'Увеличенный'
                        ]
                    ]),
                    new fieldList('block', [
                        'hint' => 'На всю ширину блока',
                        'items' => [
                            '' => 'Нет',
                            'btn-block' => 'Да'
                        ]
                    ])
                )
            )
        );

    }

}
