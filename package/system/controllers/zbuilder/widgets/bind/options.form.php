<?php

class formWidgetZbuilderBindOptions extends cmsForm {

    public function init() {

        return array(

            array(
                'type' => 'fieldset',
                'title' => LANG_OPTIONS,
                'childs' => array(

                    new fieldString('options:bind', array(
                        'title' => 'Имя позиции',
                        'hint' => 'Если не указано, будет автоматически заполнено по bind виджета',
                        'rules' => [
                            ['required'],['sysname']
                        ]
                    ))

                )
            )

        );

    }

}
