<?php

class fieldElementsubs extends cmsFormField {

    public $is_public  = false;
    public $is_virtual = true;

    //чтобы не затирать полученные ранее sub
    public function store($value, $is_submitted, $old_value = null) {
        return $old_value;
    }

    public function getInput($value) {

        $id = $this->item['id'];
        $name = $this->name;

        $value = is_array($value) ? $value : cmsModel::yamlToArray($value);
        ob_start();
        $template = cmsTemplate::getInstance();
        $template->addControllerCSSFromContext('elementsubs','zbuilder');
        $template->addControllerJSFromContext('elementsubs','zbuilder');
        ?>
        <?php if ($this->title) { ?><label for="<?php echo $this->id; ?>"><?php echo $this->title; ?></label><?php } ?>
        <div elementsubs-field class="elementsubs-field" data-name="<?php echo $name; ?>" data-id="<?php echo $id; ?>">
            <?php
            if ($value) {
                foreach ($value as $key => $value_item) {
                    ?>
            <div elementsubs-item class="elementsubs-field__item d-flex" data-subid="<?php echo $key; ?>">
                <div><?php echo $key; ?> <?php echo $this->subtitle ?? ''; ?></div>
                <a class="elementsubs-field__link elementsubs-field__link_edit ml-2" href="/zbuilder/elementsub_edit">ред.</a>
                <a class="elementsubs-field__link elementsubs-field__link_delete ml-2" href="/zbuilder/elementsub_delete">удалить</a>
            </div>
                <?php }
            }
            ?>
            <div class="elementsubs-field__item d-flex">
                <a class="elementsubs-field__link elementsubs-field__link_add" href="/zbuilder/elementsub_edit">добавить</a>
            </div>
        </div>
        <?php
        return ob_get_clean();

    }
}
