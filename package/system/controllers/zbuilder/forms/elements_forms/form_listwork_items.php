<?php

class formZbuilderListworkItems extends cmsForm {

    public function init() {

        return array(
            array(
                'type'   => 'fieldset',
                'childs' => array(
                    new fieldString('title', [
                        'title' => 'Название пункта'
                    ]),
                    new fieldString('text', [
                        'title' => 'Текст пункта'
                    ])
                )
            )
        );

    }

}
