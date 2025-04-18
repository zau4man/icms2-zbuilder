<?php
class widgetZbuilderBind extends cmsWidget {

    public function run(){

        $bind = $this->getOption('bind');
        $bind_html = cmsCore::getController('zbuilder')->getRenderedBindHtml($bind);

        return array(
            'bind_html'   => $bind_html
        );

    }

}
