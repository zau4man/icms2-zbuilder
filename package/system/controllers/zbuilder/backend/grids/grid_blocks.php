<?php

function grid_blocks($controller) {

    $options = [
        'is_sortable'   => false,
        'is_filter'     => false,
        'is_pagination' => false,
        'is_draggable'  => false,
        'show_id'       => false
    ];

    $columns = [
        'id' => [
            'title' => 'id'
        ],
        'title' => [
            'title'    => 'Название',
            'href'     => href_to($controller->root_url, 'blocks_edit', ['{id}']),
            'editable' => []
        ],
        'type' => [
            'title'      => 'Тип'
        ],
        'is_allowed' => [
            'title'        => 'Доступно для добавления',
            'flag' => true,
            'flag_toggle' => href_to($controller->root_url, 'toggle_item', array('{id}', 'zbuilder_blocks', 'is_allowed')),

        ],
    ];

    $actions = [
        [
            'title' => LANG_EDIT,
            'class' => 'edit',
            'href'  => href_to($controller->root_url, 'blocks_edit', ['{id}']),
        ],
        [
            'title'   => LANG_DELETE,
            'class'   => 'delete',
            'href'    => href_to($controller->root_url, 'blocks_delete', ['{id}']),
            'confirm' => 'Внимание! После удаления блок пропадет из списка доступных для добавления. На уже добавленные в бинды блоки это не повлияет'
        ]
    ];

    return [
        'options' => $options,
        'columns' => $columns,
        'actions' => $actions
    ];
}
