<?php //dump('tyt'); ?>
<div class="zbuilder-panel shadow">
    <div class="zbuilder-panel__toggle">
        <div class="custom-control custom-switch">
        <?php
        $is_toggle = cmsUser::getUPS('zbuilder.show');
        echo html_checkbox('zbuilder-panel__toggle', $is_toggle, 1, ['class' => 'custom-control-input','id' => 'zbuilder_toggle','onclick' => 'document.location = "'. href_to('zbuilder', 'toggle') .'"']); ?>
        <label class="custom-control-label clickable" for="zbuilder_toggle">Показ ред. областей</label>
      </div>
    </div>
</div>