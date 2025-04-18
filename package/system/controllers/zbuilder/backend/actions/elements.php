<?php

class actionZbuilderElements extends cmsAction {

    use icms\traits\controllers\actions\listgrid;

    public function __construct($controller, $params = []) {

        parent::__construct($controller, $params);

        $this->table_name = 'zbuilder_elements';
        $this->grid_name  = 'elements';
        $this->title      = 'Zbuilder элементы';

        $this->tool_buttons = [
            [
                'class' => 'add',
                'title' => LANG_ADD,
                'href'  => $this->cms_template->href_to('elements_add')
            ]
        ];

        $this->list_callback = function ($model) {

            return $model;
        };
    }

}
