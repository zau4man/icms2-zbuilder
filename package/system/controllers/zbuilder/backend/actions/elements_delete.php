<?php

class actionZbuilderElementsDelete extends cmsAction {

    use icms\traits\controllers\actions\deleteItem;

    public function __construct($controller, $params = []) {

        parent::__construct($controller, $params);

        $this->table_name  = 'zbuilder_elements';
        $this->success_url = $this->cms_template->href_to('elements');

    }

}
