<?php if (!empty($items)) {
    $this->addControllerCSSFromContext('elements/listiconblocks','zbuilder');
    ?>
    <div class="listiconblocks-list">
        <?php foreach ($items as $item) { ?>
            <div class="listiconblocks-list__item">
                <div class="listiconblocks-list__icon">
                    <?php echo string_replace_svg_icons($item['icon']); ?>
                </div>
                <div class="listiconblocks-list__title">
                    <?php echo $item['title']; ?>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>