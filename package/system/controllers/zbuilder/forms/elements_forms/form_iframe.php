<?php

class formZbuilderIframe extends cmsForm {

    public function init() {

        return array(
            array(
                'type'   => 'fieldset',
                'childs' => array(
                    new fieldText('frame', [
                        'hint'  => 'укажите код frame<br>например, код iframe карты Яндекс можно получить на <a target="_blank" href="https://yandex.ru/map-constructor">yandex.ru/map-constructor</a>',
                        'rules' => [
                            ['required']
                        ]
                            ]),
                    new fieldString('caption', [
                        'hint' => 'подпись под frame',
                            ])
                )
            )
        );

    }
}
