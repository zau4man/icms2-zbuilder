<?php if (!empty($items)) {
    $this->addControllerCSSFromContext('elements/listwork','zbuilder');
    $i = 1;
    ?>
    <div class="list-work d-lg-flex">
        <?php foreach ($items as $item) { ?>
            <div class="list-work__item" data-id="<?php echo $i; ?>">
                <div class="list-work__title">
                    <?php html($item['title']); ?>
                </div>
                <div class="list-work__text">
                    <?php html($item['text']); ?>
                </div>
            </div>
        <?php $i++;} ?>
    </div>
<?php }