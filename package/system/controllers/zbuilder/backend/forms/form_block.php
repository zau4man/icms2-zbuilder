<?php

class formZbuilderBlock extends cmsForm {

    public function init($do) {

        //dump($do);

        $childs = [];
        $childs[] = new fieldString('title', [
                        'title' => 'Название блока',
                        'rules' => [
                            ['required'],
                            ['max_length', 20],
                            $do == 'add' ? ['unique', 'zbuilder_blocks', 'title'] : false
                        ]
                    ]);

        if($do == 'add'){
            $childs[] = new fieldString('type', [
                        'title' => 'Тип блока',
                        'hint' => 'перед добавление нового типа блока, убедитесь, что вы создали файл templates/modern/controllers/zbuilder/blocks/<b>тип_блока</b>.tpl.php',
                        'rules' => [
                            ['required'],
                            ['sysname'],
                            ['max_length', 20],
                            $do == 'add' ? ['unique', 'zbuilder_blocks', 'type'] : false
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
