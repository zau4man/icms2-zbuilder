<?php

class formZbuilderRutube extends cmsForm {

    public function init() {

        return array(
            array(
                'type'   => 'fieldset',
                'childs' => array(
                    new fieldString('url', [
                        'hint'  => 'укажите ссылку на видео',
                        'rules' => [
                            ['required']
                        ]
                            ]),
                    new fieldString('caption', [
                        'hint' => 'подпись под видео',
                            ])
                )
            )
        );

    }
}
