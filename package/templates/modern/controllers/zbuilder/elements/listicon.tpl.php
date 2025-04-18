<?php if (!empty($items)) {
    $this->addControllerCSSFromContext('elements/listicon','zbuilder');
    ?>
    <div class="listicon-list">
        <?php foreach ($items as $item) { ?>
            <div class="listicon-list__item">
                <div class="listicon-list__icon">
                    <?php echo string_replace_svg_icons($item['icon']); ?>
                </div>
                <div class="listicon-list__title">
                    <?php echo $item['title']; ?>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>