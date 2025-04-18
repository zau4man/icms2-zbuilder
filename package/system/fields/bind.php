<?php

class fieldBind extends fieldString {

    public $title       = 'Бинд блоков';
    public $filter_type = false;
    public $sql         = 'varchar(50) NULL DEFAULT NULL';
    public $var_type    = 'string';
    public static $controller = false;

    public function getOptions() {
        return [
            new fieldCheckbox('is_named', [
                'title'   => 'Можно изменять имя поля в записи'
                    ])
        ];

    }

    public function getStringValue($value) {

        return '';

    }

    public function parse($value) {

        if(empty($value)){
            return false;
        }

        if(!self::$controller){
            self::$controller = cmsCore::getController('zbuilder');
        }
        $html = self::$controller->getRenderedBindHtml($value);

        return $html;

    }

    public function afterStore($item, $model, $action) {

        if(!$this->getOption('is_named') && empty($item[$this->name])){
            $table = $model->table_prefix . $item['ctype_name'];
            $model->update($table,$item['id'],[
                $this->name => $item['ctype_name'] . '_' . $item['id']
            ]);
        }

    }

    public function getInput($value) {

        if(!$this->getOption('is_named')){
            return false;
        }

        $this->class = 'string';
        return parent::getInput($value);

    }
}
