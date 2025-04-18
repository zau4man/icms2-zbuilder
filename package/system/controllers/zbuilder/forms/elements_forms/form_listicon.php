<?php

class formZbuilderListicon extends cmsForm {

    public function init() {

        return array(
            array(
                'type'   => 'fieldset',
                'childs' => array(
                    new fieldElementsubs('items', [
                        'title' => 'Элементы списка',
                        'hint' => 'добавляйте или удаляйте элементы списка',
                        'subtitle' => 'преимущество'
                    ])
                )
            )
        );

    }

}
