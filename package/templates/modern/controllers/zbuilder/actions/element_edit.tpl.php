<div class="p-2">
    <h4><?php html($element['title']); ?></h4>
<?php

$this->renderForm($form, $data, [
    'action' => $action,
    'submit' => ['title' => 'Сохранить'],
    'method' => 'ajax'
], $errors);

?>
</div>
<?php ob_start(); ?>
<script>
function elementSaved(){
    icms.zbuilder.rerenderElement(<?php echo $id; ?>);
    icms.modal.close();
};
</script>
<?php $this->addBottom(ob_get_clean());