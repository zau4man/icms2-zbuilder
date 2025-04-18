<div class="p-2">
    <h4><?php html($element['title']); ?></h4>
<?php

$this->renderForm($form, $item, [
    'action' => $action,
    'submit' => ['title' => 'Сохранить'],
    'buttons' => [[
        'title' => 'Отменить',
        'name' => 'cancel',
        'onclick' => 'elementsubSaved()'
    ]],
    'method' => 'ajax'
], $errors);

?>
</div>
<?php ob_start(); ?>
<script>
function elementsubSaved(){
    icms.zbuilder.elementsubSaved(<?php echo $id; ?>);
};
</script>
<?php $this->addBottom(ob_get_clean());