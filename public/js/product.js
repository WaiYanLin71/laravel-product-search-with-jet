//this is not jquery
//this is jet +__+
W('#price').on('click',function(
    {
        hasClass,
        removeClass,
        addClass,
        html
    })
    {
    if(hasClass('btn-danger')){
        html('Filter Price by desc')
        removeClass('btn-danger')
        return W('#sort-by-price').val('desc')
    }
    html('Filter Price by asc')
    addClass('btn-danger')
    W('#sort-by-price').val('asc')
})


W('#free_search').on('input',function(){
    W('#brand').val('')
})

W('#brand').on('change',function({value}){
    W('#free_search').val('');
    let categories = `<option value="">Search by Category</option>`
    let id = value;
    if(!id) return W('#category').html(categories)
    W('#category').attr('disabled','true')
    WJet.get(`/api/brands/${id}/categories`)
    .done(res =>  { 
        res.categories.forEach(function(c){
            categories += `<option value="${c.id}">${c.name}</option>`
        })
        W('#category').html(categories)
        W('#category').attrRemove('disabled')
    })
    .fail(e => {
        W('#category').attrRemove('disabled')
    })
})

W('.quantity').WFor(function({el}){
    W(el).on('click',function({el}){
        W('.quantity').WFor(function({el}){
            el.checked =false;
        })
       el.checked = true
    })
})

