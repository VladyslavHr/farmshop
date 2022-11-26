function galleryItemDelete(button, gallery_id) {
    console.log(gallery_id)

    $.post('/api/productImageDelete/' + gallery_id,
    {
        // gallery: gallery,
        // _token: $('meta[name="csrf-token"]').attr('content'),
    }, function (gallery) {
        if (gallery.status === 'ok') {
            $(button).closest('.js-gallery-item').remove()
        }
    }, 'json')
}

