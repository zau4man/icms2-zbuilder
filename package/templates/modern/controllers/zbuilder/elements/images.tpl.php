<?php
if(isset($images)){
    $this->addControllerCSSFromContext('elements/images', 'zbuilder');
    ?>

    <div class="">
        <div class="tpl-images row no-gutters">
            <?php
            foreach ($images as $image) {
                ?>
                <div class="tpl-images__item col-6 col-md-3">
                    <a class="img-images d-block" href="<?php echo html_image_src($image, $size_full, true); ?>"><?php echo html_image($image, $size); ?></a>
                </div>
            <?php }
            $this->addBottom('<script>$(function() { icms.modal.bindGallery(".img-images"); });</script>');
            ?>
        </div>
    </div>


<?php }