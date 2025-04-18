<?php

function install_package() {

    $core = cmsCore::getInstance();

    //установка компонента
    if (!$core->db->getRowsCount('controllers', "name = 'zbuilder'")) {
        $core->db->query("INSERT INTO `{#}controllers` (`title`, `name`, `slug`, `is_enabled`, `options`, `author`, `url`, `version`, `is_backend`, `is_external`, `files`, `addon_id`) VALUES ('Конструктор блоков Zbuilder', 'zbuilder', NULL, 1, '---\npreset_micro: zbuilder_micro\npreset_normal: zbuilder_normal\npreset_big: zbuilder_big\n', 'Zau4man', 'https://www.zau4man.ru', '1.0.0', 1, NULL, NULL, NULL);");
    }

    if (!$core->db->getRowsCount('widgets', "controller = 'zbuilder' AND `name` = 'bind'")) {
        $core->db->query("INSERT INTO `{#}widgets` (`controller`, `name`, `title`, `author`, `url`, `version`) VALUES
    ('zbuilder', 'bind', 'Бинд блоков', 'Zau4man', 'https://www.zau4man.ru', '1.0.0');");
    }

    //обновление
    $core->db->query("UPDATE `{#}controllers` SET `version` = '1.0.1' WHERE `name` = 'zbuilder';");
    $core->db->query("UPDATE `{#}widgets` SET `version` = '1.0.1' WHERE `controller` = 'zbuilder' AND `name` = 'bind';");

    //доп. таблицы
    $core->db->query("CREATE TABLE IF NOT EXISTS `{#}zbuilder_blocks` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_allowed` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;");
    $core->db->query("CREATE TABLE IF NOT EXISTS `{#}zbuilder_blocks_bind` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `title_hint` varchar(255) DEFAULT NULL,
  `bind` varchar(40) DEFAULT NULL,
  `ordering` int(11) UNSIGNED DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `options` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;");
    $core->db->query("CREATE TABLE IF NOT EXISTS `{#}zbuilder_elements` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_allowed` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;");
    $core->db->query("CREATE TABLE IF NOT EXISTS `{#}zbuilder_elements_bind` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `block_id` int(11) UNSIGNED DEFAULT NULL,
  `position` varchar(40) DEFAULT NULL,
  `ordering` int(11) UNSIGNED DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `options` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;");

    //блоки
    if (!$core->db->getRowsCount('zbuilder_blocks', "type = 'one_column'")) {
        $core->db->query("INSERT INTO `{#}zbuilder_blocks` (`type`, `title`, `description`, `is_allowed`) VALUES ('one_column', 'Одна колонка', NULL, 1);");
    }
    if (!$core->db->getRowsCount('zbuilder_blocks', "type = 'two_columns'")) {
        $core->db->query("INSERT INTO `{#}zbuilder_blocks` (`type`, `title`, `description`, `is_allowed`) VALUES ('two_columns', 'Две колонки', NULL, 1);");
    }
    if (!$core->db->getRowsCount('zbuilder_blocks', "type = 'one_container'")) {
        $core->db->query("INSERT INTO `{#}zbuilder_blocks` (`type`, `title`, `description`, `is_allowed`) VALUES ('one_container', 'Контейнер по центру', NULL, 1);");
    }

    //элементы
    if (!$core->db->getRowsCount('zbuilder_elements', "type = 'h'")) {
        $core->db->query("INSERT INTO `{#}zbuilder_elements` (`type`, `title`, `description`, `is_allowed`) VALUES ('h', 'Заголовок', 'кусок текста в тегах <h1-р5>', 1);");
    }
    if (!$core->db->getRowsCount('zbuilder_elements', "type = 'paragraph'")) {
        $core->db->query("INSERT INTO `{#}zbuilder_elements` (`type`, `title`, `description`, `is_allowed`) VALUES ('paragraph', 'Параграф текста', 'кусок текста в теге <p></p>', 1);");
    }
    if (!$core->db->getRowsCount('zbuilder_elements', "type = 'image'")) {
        $core->db->query("INSERT INTO `{#}zbuilder_elements` (`type`, `title`, `description`, `is_allowed`) VALUES ('image', 'Картинка', NULL, 1);");
    }
    if (!$core->db->getRowsCount('zbuilder_elements', "type = 'button'")) {
        $core->db->query("INSERT INTO `{#}zbuilder_elements` (`type`, `title`, `description`, `is_allowed`) VALUES ('button', 'Кнопка', NULL, 1);");
    }
    if (!$core->db->getRowsCount('zbuilder_elements', "type = 'icon'")) {
        $core->db->query("INSERT INTO `{#}zbuilder_elements` (`type`, `title`, `description`, `is_allowed`) VALUES ('icon', 'Иконка', NULL, 1);");
    }
    if (!$core->db->getRowsCount('zbuilder_elements', "type = 'youtube'")) {
        $core->db->query("INSERT INTO `{#}zbuilder_elements` (`type`, `title`, `description`, `is_allowed`) VALUES ('youtube', 'Видео с youtube', NULL, 1);");
    }
    if (!$core->db->getRowsCount('zbuilder_elements', "type = 'listwork'")) {
        $core->db->query("INSERT INTO `{#}zbuilder_elements` (`type`, `title`, `description`, `is_allowed`) VALUES ('listwork', 'Как мы работаем', NULL, 1);");
    }
    if (!$core->db->getRowsCount('zbuilder_elements', "type = 'form'")) {
        $core->db->query("INSERT INTO `{#}zbuilder_elements` (`type`, `title`, `description`, `is_allowed`) VALUES ('form', 'Форма сайта', NULL, 1);");
    }
    if (!$core->db->getRowsCount('zbuilder_elements', "type = 'quote'")) {
        $core->db->query("INSERT INTO `{#}zbuilder_elements` (`type`, `title`, `description`, `is_allowed`) VALUES ('quote', 'Цитата', NULL, 1);");
    }
    if (!$core->db->getRowsCount('zbuilder_elements', "type = 'images'")) {
        $core->db->query("INSERT INTO `{#}zbuilder_elements` (`type`, `title`, `description`, `is_allowed`) VALUES ('images', 'Галерея картинок', NULL, 1);");
    }
    if (!$core->db->getRowsCount('zbuilder_elements', "type = 'rutube'")) {
        $core->db->query("INSERT INTO `{#}zbuilder_elements` (`type`, `title`, `description`, `is_allowed`) VALUES ('rutube', 'Ролик RUTUBE', NULL, 1);");
    }
    if (!$core->db->getRowsCount('zbuilder_elements', "type = 'iframe'")) {
        $core->db->query("INSERT INTO `{#}zbuilder_elements` (`type`, `title`, `description`, `is_allowed`) VALUES ('iframe', 'Код iframe', NULL, 1);");
    }
    if (!$core->db->getRowsCount('zbuilder_elements', "type = 'listicon'")) {
        $core->db->query("INSERT INTO `{#}zbuilder_elements` (`type`, `title`, `description`, `is_allowed`) VALUES ('listicon', 'Список с иконками', NULL, 1);");
    }

    //пресеты
    if (!$core->db->getRowsCount('images_presets', "name = 'zbuilder_micro'")) {
        $core->db->query("INSERT INTO `{#}images_presets` (`name`, `title`, `width`, `height`, `is_square`, `is_watermark`, `wm_image`, `wm_origin`, `wm_margin`, `is_internal`, `quality`, `gamma_correct`, `crop_position`, `allow_enlarge`, `gif_to_gif`, `convert_format`) VALUES
('zbuilder_micro', 'Конструктор блоков Zbuilder micro', 64, 64, 1, NULL, NULL, 'top-left', 0, NULL, 95, NULL, 2, NULL, 1, NULL);");
    }
    if (!$core->db->getRowsCount('images_presets', "name = 'zbuilder_normal'")) {
        $core->db->query("INSERT INTO `{#}images_presets` (`name`, `title`, `width`, `height`, `is_square`, `is_watermark`, `wm_image`, `wm_origin`, `wm_margin`, `is_internal`, `quality`, `gamma_correct`, `crop_position`, `allow_enlarge`, `gif_to_gif`, `convert_format`) VALUES
('zbuilder_normal', 'Конструктор блоков Zbuilder normal', 400, 400, 1, NULL, NULL, 'top-left', 0, NULL, 95, NULL, 2, NULL, 1, NULL);");
    }
    if (!$core->db->getRowsCount('images_presets', "name = 'zbuilder_big'")) {
        $core->db->query("INSERT INTO `{#}images_presets` (`name`, `title`, `width`, `height`, `is_square`, `is_watermark`, `wm_image`, `wm_origin`, `wm_margin`, `is_internal`, `quality`, `gamma_correct`, `crop_position`, `allow_enlarge`, `gif_to_gif`, `convert_format`) VALUES
('zbuilder_big', 'Конструктор блоков Zbuilder big', 1200, 1200, NULL, NULL, NULL, 'top-left', 0, NULL, 95, NULL, 2, NULL, 1, NULL);");
    }

    return true;
}