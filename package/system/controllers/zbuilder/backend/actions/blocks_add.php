<?php

class actionZbuilderBlocksAdd extends cmsAction {

    use icms\traits\controllers\actions\formItem;

    public function __construct($controller, $params = []) {

        parent::__construct($controller, $params);

        $title = $params ? 'Редактировать блок' : 'Добавить блок';
        $list_url = $this->cms_template->href_to('blocks');

        $this->form_name   = 'block';
        $this->table_name  = 'zbuilder_blocks';
        $this->title       = $title;
        $this->success_url = $this->cms_template->href_to('blocks');

        $this->breadcrumbs = [
            ['Блоки', $list_url],
            $title
        ];

        $this->tool_buttons = [
            [
                'class' => 'save',
                'title' => LANG_SAVE,
                'href'  => 'javascript:icms.forms.submit()'
            ],
            [
                'class' => 'cancel',
                'title' => LANG_CANCEL,
                'href'  => $list_url
            ]
        ];

    }

}
