<?php

class formZbuilderQuestionsItems extends cmsForm {

    public function init() {

        return array(
            array(
                'type'   => 'fieldset',
                'childs' => array(
                    new fieldString('question', [
                        'title' => 'Вопрос'
                    ]),
                    new fieldText('answer', [
                        'title' => 'Ответ'
                    ])
                )
            )
        );

    }

}
