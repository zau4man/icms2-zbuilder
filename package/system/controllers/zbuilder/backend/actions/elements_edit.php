<?php

class actionZbuilderElementsEdit extends cmsAction {

    public function run($element_id = false) {

        return $this->runExternalAction('elements_add', $this->params);

    }

}
