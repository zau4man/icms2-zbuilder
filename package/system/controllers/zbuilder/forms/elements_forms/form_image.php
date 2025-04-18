<?php

class formZbuilderImage extends cmsForm {

    public function init() {

        return array(
            array(
                'type'   => 'fieldset',
                'childs' => array(
                    new fieldImage('image', [
                        'options' => [
                            'sizes' => $this->controller->getImagesPresetsNames()
                        ],
                        'rules' => [
                            ['required']
                        ]
                    ]),
                    new fieldList('size', [
                        'hint' => 'какой размер вывести',
                        'items' => $this->controller->getImagesPresets(),
                        'rules' => [
                            ['required']
                        ]
                    ]),
                    new fieldList('size_full', [
                        'hint' => 'размер при клике',
                        'items' => $this->controller->getImagesPresets(),
                        'rules' => [
                            ['required']
                        ]
                    ]),
                    new fieldString('caption', [
                        'hint' => 'укажите подпись изображения при необходимости'
                    ])
                )
            )
        );

    }

}
