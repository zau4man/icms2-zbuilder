$(function(){
    $('.elementsubs-field__link').click(function(e){
        e.preventDefault();
        icms.modal.close();
        let bind_id = $(this).closest('[elementsubs-field]').data('id');
        let name = $(this).closest('[elementsubs-field]').data('name');
        let sub_id = $(this).closest('[elementsubs-item]').data('subid');
        let href = $(this).attr('href') + '/' + bind_id + '/' + name;
        if(sub_id){
            href = href + '/' + sub_id;
        }
        icms.modal.openAjax(href);
    });
});