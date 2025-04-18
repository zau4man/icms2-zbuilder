<?php

class formZbuilderQuestions extends cmsForm {

    public function init() {

        return array(
            array(
                'type'   => 'fieldset',
                'childs' => array(
                    new fieldElementsubs('items', [
                        'title' => 'Вопросы и ответы',
                        'hint' => 'добавляйте или удаляйте',
                        'subtitle' => 'вопрос/ответ'
                    ])
                )
            )
        );

    }

}
