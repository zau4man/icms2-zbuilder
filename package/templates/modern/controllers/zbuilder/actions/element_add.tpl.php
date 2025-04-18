<div class="p-2">
    <h4>Добавить элемент</h4>
<?php

$this->renderForm($form, $data, [
    'action' => $action,
    'submit' => ['title' => 'Добавить'],
    'method' => 'ajax'
], $errors);

?>
</div>
<?php ob_start(); ?>
<script>
function elementAdded(form,result){
    icms.zbuilder.addElementHtml(<?php echo $block_id; ?>, '<?php echo $position; ?>', result.html);
    icms.modal.close();
    icms.modal.openAjax(icms.zbuilder.options.element_edit_url + '/' + result.element_id);
};
</script>
<?php $this->addBottom(ob_get_clean());