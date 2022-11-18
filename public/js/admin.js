function galleryItemDelete(gallery, event) {
    console.log($('#gallery_product_item_img'))
    event.preventDefault()
    $.post('/api/productImageDelete',
    {
        gallery: gallery,
        // _token: $('meta[name="csrf-token"]').attr('content'),
    }, function (gallery) {
        if (gallery.status === 'ok') {
            $('#gallery_product_item_img').remove()
        }
    }, 'json')
}

