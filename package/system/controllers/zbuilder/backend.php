<?php

class backendZbuilder extends cmsBackend {

    public $useDefaultOptionsAction = true;
    public $useOptions = true;

    public function getBackendMenu() {
        return [
            [
                'title' => LANG_OPTIONS,
                'url'   => href_to($this->root_url),
                'options' => [
                    'icon' => 'cog'
                ]
            ],
            [
                'title' => 'Блоки',
                'url'   => href_to($this->root_url, 'blocks'),
                'options' => [
                    'icon' => 'columns'
                ]
            ],
            [
                'title' => 'Элементы',
                'url'   => href_to($this->root_url, 'elements'),
                'options' => [
                    'icon' => 'th'
                ]
            ],
            [
                'title' => 'Поддержка',
                'url'   => href_to($this->root_url, 'support'),
                'options' => [
                    'icon' => 'hands'
                ]
            ]
        ];
    }

}
