<?php

class formZbuilderIcon extends cmsForm {

    public function init() {

        return array(
            array(
                'type'   => 'fieldset',
                'childs' => array(
                    new fieldString('text', [
                        'hint' => 'код иконки в формате {type%icon}',
                        'rules' => [
                            ['required']
                        ]
                    ])
                )
            )
        );

    }

}
