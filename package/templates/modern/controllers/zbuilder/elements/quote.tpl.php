<?php
if (isset($text)) {
    $this->addControllerCSS('elements/quote', 'zbuilder');
    ?>
    <div class="block__element__quote">
        <blockquote>
            <div class="row">
                <?php if (!empty($image)) { ?>
                    <div class="col-sm-3 text-center">
                        <?php if (!empty($image)) {
                            echo html_image($image, $size, $author ?? false, ['class' => 'rounded-circle']);
                        } ?>
                    </div>
    <?php } ?>
                <div class="col-sm-9">
                    {text}
                    <small>— <?php html($author); ?></small>
                </div>
            </div>
        </blockquote>
    </div>
<?php
}