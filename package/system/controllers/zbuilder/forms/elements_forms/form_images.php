<?php

class formZbuilderImages extends cmsForm {

    public function init() {

        $options = $this->controller->options;

        return array(
            array(
                'type'   => 'fieldset',
                'childs' => array(
                    new fieldImages('images', [
                        'options' => [
                            'sizes' => $this->controller->getImagesPresetsNames()
                        ],
                        'rules' => [
                            ['required']
                        ]
                            ]),
                    new fieldList('size', [
                        'hint' => 'размер миниатюр',
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
                    ])
                )
            )
        );

    }

}
