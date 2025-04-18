<?php

class actionZbuilderBlocksEdit extends cmsAction {

    public function run($block_id = false) {

        return $this->runExternalAction('blocks_add', $this->params);

    }

}
