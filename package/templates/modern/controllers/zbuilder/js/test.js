$(function(){
    sortables = [];
    $('div[zbuilder-elements]').each(function(i,item){
        sortables.push(Sortable.create(item, {
            group: 'elements',
            draggable: 'div[zbuilder-element]',
            handle: 'div[zbuilder-element-mover]',
            chosenClass: 'zbuilder-chosen-element',
            animation: 150,
            delay: 500,
            delayOnTouchOnly: true
    }));
    });
    $('div[zbuilder-blocks]').each(function(i,item){
        sortables.push(Sortable.create(item,{
            group: 'blocks',
            draggable: 'div[zbuilder-block]',
            handle: 'div[zbuilder-block-mover]',
            chosenClass: 'zbuilder-chosen-block',
            animation: 150,
            delay: 500,
            delayOnTouchOnly: true
        }));
    });
});