<?php

class zbuilder extends cmsFrontend {

    protected $useOptions = true;
    public static $is_templated = false;

    public function before($action_name) {

        parent::before($action_name);

        //только editor имеет доступ к экшенам
        if(!$this->isEditor()){
            return cmsCore::error404();
        }

        return true;

    }

    public function attachElementsToBlocks($blocks_bind,$elements_bind) {

        if(!$elements_bind){
            return $blocks_bind;
        }

        foreach ($elements_bind as $element_bind){
            $bl_id = $element_bind['block_id'];
            if(!empty($blocks_bind[$bl_id])){
                $element_bind['html'] = $this->getRenderedElement($element_bind);
                $pos = $element_bind['position'];
                $blocks_bind[$bl_id]['elements'][$pos][] = $element_bind;
            }
        }

        return $blocks_bind;

    }

    public function attachElementsToBlock($block_bind) {

        $elements_bind = $this->model->getBlocksElements([$block_bind['id']]);
        if(!$elements_bind){
            return $block_bind;
        }

        foreach ($elements_bind as $element_bind){
            $element_bind['html'] = $this->getRenderedElement($element_bind);
            $pos = $element_bind['position'];
            $block_bind['elements'][$pos][] = $element_bind;
        }

        return $block_bind;

    }

    public function getRenderedBlocks($blocks,$bind) {

        $html = '';

        if($blocks){
            foreach ($blocks as $block){
                $html .= $this->getRenderedBlock($block);
            }
        }

        if($this->isShowEditor()){
            $html = $this->addEditorBlocksLayout($html,$bind);
        }

        return $html;

    }

    public function getBlockTplFileName($block) {

        if(!empty($block['options']['tpl'])){
            if($this->cms_template->getTemplateFileName('controllers/zbuilder/blocks/' . $block['options']['tpl'],true)){
                return $block['options']['tpl'];
            }
        }
        return $block['type'];

    }

    public function getRenderedBlock($block) {

        $tpl = $this->getBlockTplFileName($block);
        $html = $this->cms_template->getRenderedChild('blocks/'.$tpl);
        $matches_count = preg_match_all('/\{([a-z0-9_\-]+)\}/i', $html, $positions);
        if($matches_count){
            $positions_keys = array_unique($positions[1]);
            $data = $this->getBlockReplaceData($block,$positions_keys);
            $html = str_replace(array_keys($data), array_values($data), $html);

        }

        $html = $this->addContainerLayout($html,$block,'content');
        $html = $this->addContainerBgLayout($html,$block);
        $html = $this->addContainerLayout($html,$block,'all');
        if($this->isShowEditor()){
            $html = $this->addEditorBlockLayout($html,$block);
        }else{
            $html = $this->addBlockLayout($html,$block);
        }

        return $html;
    }

    public function getBlockReplaceData($block,$positions_keys) {

        $data = [];

        foreach ($positions_keys as $position){
            $pos_name = '{' . $position . '}';//должно быть в скобочках для удобной замены
            $data[$pos_name] = '';
            if(!empty($block['elements'])){
                if(!empty($block['elements'][$position])){
                    foreach ($block['elements'][$position] as $el){
                        $data[$pos_name] .= $el['html'];
                    }
                }
            }

            //тут добавим обертку, если смотрит редактор
            if($this->isShowEditor()){
                $data[$pos_name] = $this->addEditorElementsLayout($data[$pos_name],$position);
            }

        }

        return $data;

    }

    public function getElementTplFileName($element) {

        if(!empty($element['options']['tpl'])){
            if($this->cms_template->getTemplateFileName('controllers/zbuilder/elements/' . $element['options']['tpl'],true)){
                return $element['options']['tpl'];
            }
        }
        return $element['type'];

    }

    public function getRenderedElement($element) {

        $element['data'] = cmsModel::yamlToArray($element['data']);
        $element['data']['bind_id'] = $element['id'];
        $element['data']['opts'] = $this->getOptions();
        $tpl = $this->getElementTplFileName($element);
        $html = $this->cms_template->getRenderedChild('elements/'.$tpl,$element['data']);

        $matches_count = preg_match_all('/\{([a-z0-9_\-]+)\}/i', $html, $positions);
        if($matches_count){
            $positions_keys = array_unique($positions[1]);
            $data = $this->getElementReplaceData($element,$positions_keys);
            $html = str_replace(array_keys($data), array_values($data), $html);
        }

        if($this->isShowEditor()){
            $html = $this->addEditorElementLayout($html,$element);
        }else{
            $html = $this->addElementLayout($html,$element);
        }

        return $html;

    }

    public function getElementReplaceData($element,$positions_keys) {

        $data = [];

        foreach ($positions_keys as $position){
            $pos_name = '{' . $position . '}';//должно быть в скобочках для удобной замены
            $data[$pos_name] = '';
            if(!empty($element['data'])){
                if(!empty($element['data'][$position])){
                    $data[$pos_name] = $element['data'][$position];
                }
            }
        }

        return $data;

    }

    public function isEditor() {
        return cmsUser::isAdmin();
    }

    public function isShowEditor() {
        return cmsUser::isAdmin() && cmsUser::getUPS('zbuilder.show');
    }

    public function addEditorElementLayout($html,$element) {
        $class = $this->prepareElementClass($element);
        $style = $this->prepareElementStyle($element);
        return '<div zbuilder-element zbuilder-element-id="'. $element['id'] .'" class="zb-element' . $class . '"' . $style . '><div zbuilder-element-content class="zb-element__content">' . $html . '</div><div zbuilder-element-panel class="zb-element__panel"><div zbuilder-element-move class="zb-element__move" title="Переместить элемент"></div><div zbuilder-element-options class="zb-element__options" title="Опции элемента"></div><div zbuilder-element-edit class="zb-element__edit" title="Редактировать элемент"></div><div zbuilder-element-delete class="zb-element__delete" title="Удалить элемент"></div></div></div>';
    }

    public function addElementLayout($html,$element) {
        $class = $this->prepareElementClass($element);
        $style = $this->prepareElementStyle($element);
        if(!$class && !$style){
            return $html;
        }
        return '<div class="' . $class . '"' . $style . '>' . $html . '</div>';
    }

    public function addEditorElementsLayout($html,$position) {
        return '<div zbuilder-elements zbuilder-elements-position="'. $position .'" class="zb-elements">' . $html . '<div zbuilder-elements-panel class="zbuilder-elements__panel"><div zbuilder-elements-add class="zbuilder-elements__add" title="Добавить элемент"></div></div></div>';
    }

    public function addEditorBlockLayout($html,$block) {
        $class = $this->prepareMainBlockClass($block);
        return '<div zbuilder-block zbuilder-block-id="'. $block['id'] .'" class="blocks__item blocks__item_'. $block['bind'] . $class . ' zb-block"><div zbuilder-block-content class="zb-block__content">' . $html . '</div><div zbuilder-block-panel class="zb-block__panel"><div zbuilder-block-move class="zb-block__move" title="Переместить блок"></div><div zbuilder-block-options class="zb-block__options" title="Опции блока"></div><div zbuilder-block-delete class="zb-block__remove" title="Удалить блок"></div></div></div>';
    }

    public function addEditorBlocksLayout($html,$bind) {
        return '<div zbuilder-blocks zbuilder-blocks-bind="'. $bind .'" class="zb-blocks">' . $html . '<div zbuilder-blocks-panel class="zbuilder-blocks__panel"><div zbuilder-blocks-add class="zbuilder-blocks__add" title="Добавить блок"></div></div></div>';
    }

    public function addBlockLayout($html,$block) {
        $class = $this->prepareMainBlockClass($block);
        return '<div class="blocks__item blocks__item_'. $block['bind'] . $class . '">' . $html . '</div>';
    }

    /**
     * Добавляет обертку содержимого блока, если есть отступы или фон
     * @param string $html
     * @param string $block
     * @return string
     */
    public function addContainerBgLayout($html,$block) {
        $style = $this->prepareBlockStyle($block);
        if(!$style){
            return $html;
        }
        return '<div class="container_bg"'. $style .'>' . $html . '</div>';
    }

    /**
     * Добавляет обертку div.container если блок растянут по ширине принудительно
     * @param string $html
     * @param string $block
     * @return string
     */
    public function addContainerLayout($html,$block,$type) {

        if(empty($block['options'])){
            return $html;
        }

        $options = $block['options'];

        if(($type === 'all') && empty($options['container_all'])){
            return $html;
        }

//        dump($type,false);
//        dump($options);

        if($type === 'content'){
            if(empty($options['container_content']) && empty($options['full_width'])){
                return $html;
            }
        }

        return '<div class="container">' . $html . '</div>';
    }

    public function deleteBlockBind($bind_id) {

        $block_bind = $this->model->getBlockBind($bind_id);
        if(!$block_bind){
            return;
        }

        //удалим привязанные к блоку элементы
        $block_elements_binds = $this->model->getBlocksElements([$bind_id]);
        foreach ($block_elements_binds as $element_bind){
            $this->deleteElementBind($element_bind['id']);
        }

        //удалим саму привязку блока
        $this->model->deleteBlockBind($bind_id);
    }

    public function deleteElementBind($bind_id) {

        $element_bind = $this->model->getElementBind($bind_id);
        if(!$element_bind){
            return;
        }

        //потрем фотки, если таковые есть в тексте элемента
        $this->deleteElementImages($element_bind['data']);

        //удалим саму привязку элемента
        $this->model->deleteElementBind($bind_id);

    }

    public function deleteElementImages($data) {
        if(is_array($data)){
            $data = cmsModel::arrayToYaml($data);//чтобы искать в строке
        }
        $images = [];
        $pattern = '/\b\w+\.(?:jpg|jpeg|png|webp)\b/i';
        if(preg_match_all($pattern, $data, $matches)){
            $images = array_merge($images,$matches[0]);
        }
        if($images){
            foreach ($images as $image){
                $files = $this->model->filterEqual('name',$image)->get('uploaded_files');
                if($files){
                    foreach ($files as $file){
                        if(strpos($data, $file['path']) !== false){
                            $this->model_files->deleteFile($file['id']);
                        }
                    }
                }
            }
        }
    }

    public function hasForm($type,$prefix) {
        $prefix = 'forms/' . $prefix . '_';
        $form_file = $this->cms_config->root_path.'system/controllers/zbuilder/' . $prefix . 'forms/form_'.$type.'.php';
        return file_exists($form_file);
    }

    public function loadElementLib($lib) {
        $lib_file = cmsConfig::get('root_path') . 'system/controllers/zbuilder/libs/' . $lib . '.php';
        if (is_readable($lib_file)) {
            include_once $lib_file;
        }
    }

        public function getRenderedBindHtml($bind) {

        $template = cmsTemplate::getInstance();
        $template->setContext(cmsCore::getController('zbuilder'));

        $blocks_bind = $this->model->getBlocksBind($bind);
        if($blocks_bind){
            $blocks_bind_ids = array_column($blocks_bind, 'id');
            $elements_bind = $this->model->getBlocksElements($blocks_bind_ids);
            $blocks_elements = $this->attachElementsToBlocks($blocks_bind,$elements_bind);
        }
        $html = $this->getRenderedBlocks($blocks_elements ?? false,$bind);

        $is_show = $this->isShowEditor();
        if (!self::$is_templated) {
            if ($is_show) {
                $show_html = $this->addShowHtml();
            }
            if($this->isEditor()){
                $editor_html = $this->addEditorHtml();
            }
            $this->addViewerHtml();
            self::$is_templated = true;
        }

        $bind_html = $this->cms_template->getRenderedChild('bind', [
            'bind' => $bind,
            'html' => $html,
            'is_show' => $is_show,
            'show_html' => $show_html ?? '',
            'editor_html' => $editor_html ?? ''
        ]);

        $template->restoreContext();

        return $bind_html;
    }

    public function addShowHtml() {

        $this->cms_template->addControllerJS('sortable.min');
        $this->cms_template->addControllerJS('zbuilder');
        ob_start(); ?>
        <script>
        icms.zbuilder.setOptions({
            reorder_url: '<?php echo href_to('zbuilder', 'reorder'); ?>',
            block_add_url: '<?php echo href_to('zbuilder', 'block_add'); ?>',
            block_delete_url: '<?php echo href_to('zbuilder', 'block_delete'); ?>',
            block_options_url: '<?php echo href_to('zbuilder', 'block_options'); ?>',
            block_rerender_url: '<?php echo href_to('zbuilder', 'block_rerender'); ?>',
            element_edit_url: '<?php echo href_to('zbuilder', 'element_edit'); ?>',
            element_rerender_url: '<?php echo href_to('zbuilder', 'element_rerender'); ?>',
            element_add_url: '<?php echo href_to('zbuilder', 'element_add'); ?>',
            element_delete_url: '<?php echo href_to('zbuilder', 'element_delete'); ?>',
            element_options_url: '<?php echo href_to('zbuilder', 'element_options'); ?>'
        });
        </script>
        <?php
        $this->cms_template->addBottom(ob_get_clean());

        return '';

    }

    public function addViewerHtml() {

        $this->cms_template->addControllerCSS('viewer');

    }

    public function addEditorHtml() {

        $this->cms_template->addControllerCSS('editor');
        return $this->cms_template->render('panel');

    }

    public function prepareElementClass($element) {

        if(empty($element['options'])){
            return '';
        }

        $classes = [];
        $options = $element['options'];
        if(!empty($options['class'])){
            $classes[] = $options['class'];
        }

        return ' ' . implode(' ', $classes);

    }

    public function prepareElementStyle($element) {

        if(empty($element['options'])){
            return '';
        }

        $styles = [];
        $options = $element['options'];

        if(!empty($options['padding'])){
            $styles[] = 'padding: ' . $options['padding'] . ';';
        }

        return ' style="' . implode(' ', $styles) . '"';

    }


    public function prepareMainBlockClass($block) {

        if(empty($block['options'])){
            return '';
        }

        $classes = [];
        $options = $block['options'];

        if(!empty($options['class'])){
            $classes[] = $options['class'];
        }

        if(!empty($options['full_width'])){
            $classes[] = 'blocks__item_fullwidth';
        }

        return ' ' . implode(' ', $classes);

    }

    public function prepareBlockStyle($block) {

        if(empty($block['options'])){
            return '';
        }

        $styles = [];
        $options = $block['options'];

        if(!empty($options['is_bg_color']) || !empty($options['is_bg_image'])){
            $style = 'background:';
            if(!empty($options['bg_color'])){
                $style .= ' ' . $options['bg_color'];
            }
            if(!empty($options['bg_image'])){
                $style .= ' url(' . html_image_src($options['bg_image'],'original',true) . ')';
            }
            if(!empty($options['bg_repeat'])){
                $style .= ' ' . $options['bg_repeat'];
            }
            if(!empty($options['bg_position'])){
                $style .= ' ' . $options['bg_position'];
            }
            if(!empty($options['bg_size'])){
                $style .= '/' . $options['bg_size'];
            }
            $style .= ';';
            $styles[] = $style;
        }
        if(!empty($options['padding'])){
            $styles[] = 'padding: ' . $options['padding'] . ';';
        }

        if(!$styles){
            return '';
        }

        return ' style="' . implode(' ', $styles) . '"';

    }

    public function getImagesPresetsNames() {

        $presets = $this->getImagesPresets();
        return array_keys($presets);

    }

    public function getImagesPresets() {

        $start = ['small' => 'Маленький','normal' => 'Нормальный','big' => 'Большой','original' => 'Оригинальный'];
        $names = [];
        foreach ($start as $key => $title) {

            $name = empty($this->getOption('preset_'.$key)) ? $key : $this->getOption('preset_'.$key);
            $names[$name] = $title;

        }

        return $names;

    }

}

