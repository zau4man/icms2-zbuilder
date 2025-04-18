<?php

class formZbuilderYoutube extends cmsForm {

    public function init() {

        return array(
            array(
                'type'   => 'fieldset',
                'childs' => array(
                    new fieldString('url', [
                        'hint' => 'укажите ссылку на ролик',
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
