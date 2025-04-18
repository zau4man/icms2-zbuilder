<?php

class actionZbuilderBlocks extends cmsAction {

    use icms\traits\controllers\actions\listgrid;

    public function __construct($controller, $params = []) {

        parent::__construct($controller, $params);

        $this->table_name = 'zbuilder_blocks';
        $this->grid_name  = 'blocks';
        $this->title      = 'Zbuilder блоки';

        $this->tool_buttons = [
            [
                'class' => 'add',
                'title' => LANG_ADD,
                'href'  => $this->cms_template->href_to('blocks_add')
            ]
        ];

        $this->list_callback = function ($model) {

            return $model;
        };
    }

}
