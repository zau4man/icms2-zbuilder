<?php

class formZbuilderParagraph extends cmsForm {

    public function init() {

        return array(
            array(
                'type'   => 'fieldset',
                'childs' => array(
                    new fieldHtml('text', [
                        'rules' => [
                            ['required']
                        ]
                    ])
                )
            )
        );

    }

}
