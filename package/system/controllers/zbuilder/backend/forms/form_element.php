<?php

class formZbuilderElement extends cmsForm {

    public function init($do) {

        $childs = [];
        $childs[] = new fieldString('title', [
                        'title' => 'Название элемента',
                        'rules' => [
                            ['required'],
                            ['max_length', 255],
                            $do == 'add' ? ['unique', 'zbuilder_elements', 'title'] : false
                        ]
                    ]);

        if($do == 'add'){
            $childs[] = new fieldString('type', [
                        'title' => 'Тип элемента',
                        'hint' => 'перед добавление нового типа блока, убедитесь, что вы создали файл templates/modern/controllers/zbuilder/elements/<b>тип_элемента</b>.tpl.php<br>а также файл формы элемента system/controllers/zbuilder/forms/elements_forms/form_<b>тип_элемента</b>.php',
                        'rules' => [
                            ['required'],
                            ['sysname'],
                            ['max_length', 20],
                            $do == 'add' ? ['unique', 'zbuilder_elements', 'type'] : false
                        ]
                    ]);
        }

        return [
            [
                'type' => 'fieldset',
                'childs' => $childs
            ]
        ];

    }

}
