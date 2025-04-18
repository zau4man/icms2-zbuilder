<div class="p-2">
<?php

$this->renderForm($form, $item, [
    'action' => $action,
    'submit' => ['title' => 'Сохранить'],
    'method' => 'ajax'
], $errors);

?>
</div>
<?php ob_start(); ?>
<script>
function blockSaved(){
    icms.zbuilder.rerenderBlock(<?php echo $id; ?>);
    icms.modal.close();
};
</script>
<?php $this->addBottom(ob_get_clean());