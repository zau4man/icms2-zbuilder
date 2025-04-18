<?php

class actionZbuilderElementsAdd extends cmsAction {

    use icms\traits\controllers\actions\formItem;

    public function __construct($controller, $params = []) {

        parent::__construct($controller, $params);

        $title = $params ? 'Редактировать элемент' : 'Добавить элемент';
        $list_url = $this->cms_template->href_to('elements');

        $this->form_name   = 'element';
        $this->table_name  = 'zbuilder_elements';
        $this->title       = $title;
        $this->success_url = $this->cms_template->href_to('elements');

        $this->breadcrumbs = [
            ['Элементы', $list_url],
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
