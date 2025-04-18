<div class="p-2">
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
function blockAdded(){
    icms.modal.close();
    window.location.reload();
};
</script>
<?php $this->addBottom(ob_get_clean());