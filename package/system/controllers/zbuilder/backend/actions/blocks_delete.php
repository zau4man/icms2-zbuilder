<?php

class actionZbuilderBlocksDelete extends cmsAction {

    use icms\traits\controllers\actions\deleteItem;

    public function __construct($controller, $params = []) {

        parent::__construct($controller, $params);

        $this->table_name  = 'zbuilder_blocks';
        $this->success_url = $this->cms_template->href_to('blocks');

    }

}
