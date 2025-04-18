<?php

class formZbuilderListiconItems extends cmsForm {

    public function init() {

        return array(
            array(
                'type'   => 'fieldset',
                'childs' => array(
                    new fieldString('icon', [
                        'title' => 'Иконка',
                        'suffix' => '<a target="_blank" href="' . href_to('admin', 'settings', ['theme', cmsConfig::get('template'), 'icon_list']) . '"><span>выбрать</span></a>',
                    ]),
                    new fieldString('title', [
                        'title' => 'Название пункта',
                        'is_clean_disable' => true,
                    ])
                )
            )
        );

    }

}
