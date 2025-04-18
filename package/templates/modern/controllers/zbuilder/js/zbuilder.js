var icms = icms || {};
icms.zbuilder = icms.zbuilder || {};

icms.zbuilder = (function($){

    var _this = this;

    this.sortables = [];
    this.options = {
        reorder_url: '',
        block_add_url: '',
        block_delete_url: '',
        element_edit_url: '',
        element_rerender_url: '',
        element_add_url: '',
        element_delete_url: ''
    };

    this.setOptions = function(options){
        Object.assign(this.options,options);
    };

    this.startSortable = function(){
        $(document).find('div[zbuilder-elements]').each(function(i,item){
            _this.sortables.push(Sortable.create(item, {
                group: 'elements',
                draggable: 'div[zbuilder-element]',
                handle: 'div[zbuilder-element-move]',
                chosenClass: 'zbuilder-chosen-element',
                animation: 150,
                delay: 200,
                delayOnTouchOnly: true,
                onEnd: function(evt){
                    //console.log(evt.item);
                    //console.log(evt.newIndex);
                    //console.log(evt.to);
                    let list = [];
                    let position = $(evt.to).attr('zbuilder-elements-position');
                    let block_id = $(evt.to).closest('[zbuilder-block]').attr('zbuilder-block-id');
                    $(evt.to).find('[zbuilder-element]').each(function(i,item){
                        list.push($(item).attr('zbuilder-element-id'));
                    });
                    $.post(_this.options.reorder_url + '/elements',{
                        position: position,
                        block_id: block_id,
                        list: list
                    },function(result){
                        if(result.success){
                            toastr.success('Порядок элементов сохранен');
                        }
                    },'json');
                }
        }));
        });
        $(document).find('div[zbuilder-blocks]').each(function(i,item){
            _this.sortables.push(Sortable.create(item,{
                group: 'blocks',
                draggable: 'div[zbuilder-block]',
                handle: 'div[zbuilder-block-move]',
                chosenClass: 'zbuilder-chosen-block',
                animation: 150,
                delay: 200,
                delayOnTouchOnly: true,
                onEnd: function(evt){
                    let list = [];
                    let bind = $(evt.to).attr('zbuilder-blocks-bind');
                    $(evt.to).find('[zbuilder-block]').each(function(i,item){
                        list.push($(item).attr('zbuilder-block-id'));
                    });
                    $.post(_this.options.reorder_url + '/blocks',{
                        bind: bind,
                        list: list
                    },function(result){
                        if(result.success){
                            toastr.success('Порядок блоков сохранен');
                        }
                    },'json');
                }
            }));
        });
    };

    this.onDocumentReady = function(){

        _this.startSortable();
        _this.startListenPanel();

    };

    this.startListenPanel = function(){
        $('[zbuilder-main]').on('click','[zbuilder-blocks-add]',function(e){
            e.preventDefault();
            let bind = $(this).closest('[zbuilder-blocks]').attr('zbuilder-blocks-bind');
            icms.modal.openAjax(_this.options.block_add_url,{
                bind: bind
            });
        });
        $('[zbuilder-main]').on('click','[zbuilder-block-delete]',function(e){
            e.preventDefault();
            if(!confirm('Вы уверены? Блок удалится полностью со всеми элементами')){
                return false;
            }
            let block = $(this).closest('[zbuilder-block]');
            let block_id = block.attr('zbuilder-block-id');
            $.get(_this.options.block_delete_url + '/' + block_id, {}, function(result){
                if(result.success){
                    window.location.reload();
                }
            },'json');
        });
        $('[zbuilder-main]').on('click','[zbuilder-elements-add]',function(e){
            e.preventDefault();
            let position = $(this).closest('[zbuilder-elements]').attr('zbuilder-elements-position');
            let block_id = $(this).closest('[zbuilder-block]').attr('zbuilder-block-id');
            icms.modal.openAjax(_this.options.element_add_url + '/' + block_id + '/' + position,{});
        });
        $('[zbuilder-main]').on('click','[zbuilder-element-edit]',function(e){
            e.preventDefault();
            let el_id = $(this).closest('[zbuilder-element]').attr('zbuilder-element-id');
            icms.modal.openAjax(_this.options.element_edit_url + '/' + el_id);
        });
        $('[zbuilder-main]').on('click','[zbuilder-element-delete]',function(e){
            e.preventDefault();
            if(!confirm('Вы уверены? Элемент будет удален из блока')){
                return false;
            }
            let element = $(this).closest('[zbuilder-element]');
            let element_id = element.attr('zbuilder-element-id');
            $.get(_this.options.element_delete_url + '/' + element_id, {}, function(result){
                if(result.success){
                    element.remove();
                }
            },'json');
        });
        $('[zbuilder-main]').on('click','[zbuilder-block-options]',function(e){
            e.preventDefault();
            let block = $(this).closest('[zbuilder-block]');
            let block_id = block.attr('zbuilder-block-id');
            icms.modal.openAjax(_this.options.block_options_url + '/' + block_id);
        });
        $('[zbuilder-main]').on('click','[zbuilder-element-options]',function(e){
            e.preventDefault();
            let element = $(this).closest('[zbuilder-element]');
            let element_id = element.attr('zbuilder-element-id');
            icms.modal.openAjax(_this.options.element_options_url + '/' + element_id);
        });
    };

    this.rerenderElement = function(element_id){
        $.get(_this.options.element_rerender_url + '/' + element_id, {}, function(result){
            if(result.success){
                $('[zbuilder-element-id='+element_id+']').replaceWith(result.html);
                _this.restartJS();
            }
        },'json');

    };

    this.rerenderBlock = function(block_id){
        $.get(_this.options.block_rerender_url + '/' + block_id, {}, function(result){
            if(result.success){
                $('[zbuilder-block-id='+block_id+']').replaceWith(result.html);
                _this.restartJS();
            }
        },'json');

    };

    this.addElementHtml = function(block_id,position,html){
        $('[zbuilder-block-id=' + block_id + ']').find('[zbuilder-elements-position='+position+']').append(html);
    };

    this.restartJS = function(){
        $('.ajax-modal').addClass('ajax-modal-ready');
        icms.modal.bind('a.ajax-modal');
        _this.startSortable();
    };

    this.elementsubSaved = function(element_id){
        icms.modal.close();
        icms.modal.openAjax(_this.options.element_edit_url + '/' + element_id);
    };

    return this;
}).call(icms.zbuilder,jQuery);