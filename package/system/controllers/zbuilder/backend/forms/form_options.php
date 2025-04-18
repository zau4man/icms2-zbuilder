<?php

class formZbuilderOptions extends cmsForm {

    public function init() {

        $presets = cmsCore::getModel('images')->getPresetsList(true);

        return [
            [
                'type'   => 'fieldset',
                'title'  => 'Настройки изображений',
                'childs' => [
                    new fieldList('preset_micro', [
                        'title' => 'Пресет изображений micro',
                        'items' => $presets,
                        'default' => 'zbuilder_micro',
                        'rules' => [
                            ['required']
                        ]
                            ]),
                    new fieldList('preset_normal', [
                        'title' => 'Пресет изображений normal',
                        'default' => 'zbuilder_normal',
                        'items' => $presets,
                        'rules' => [
                            ['required']
                        ]
                            ]),
                    new fieldList('preset_big', [
                        'title' => 'Пресет изображений big',
                        'default' => 'zbuilder_big',
                        'items' => $presets,
                        'rules' => [
                            ['required']
                        ]
                            ]),
                ]
            ]
        ];

    }
}
