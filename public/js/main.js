function add_button_cart (button, product_id) {
    // log(button)
    // java script
    // if (button.classList.contains('text-secondary')) {

    // }
    // jquery
    // if ($(button).hasClass('text-danger')) {
    // var form = $(button).closest('.product-btn-add-to-cart-index').find('.js-remove-compare-form')
    // }else{
    //     var form = $(button).closest('.product-btn-add-to-cart-index').find('.js-add-compare-form')
    // }

    var form = $(button).closest('.buttons-group-index-product').find('.product-btn-add-to-cart-index')


    // log($(button).hasClass('text-danger'))
    // log(form.attr('action'))
    $.post(form.attr('action'),
        $(form).serialize(),
        function (data) {
            if (data.added) {
                // find('.cart-count-porduct').$(++product_id)
            }else{

            }

        }, 'json')
    }

function remove_button_cart(form, event) {
    event.preventDefault()
    // vehicle-item
    $.post($(form).attr('action'),
    $(form).serialize(),
    function (data) {
        if (!data.added) {
            $(form).closest('.cart-product-item').remove()
        }

    }, 'json')
}

// // button oncklick
// // remove_all_compare({{ route('removeCompare', 999)}})
// function remove_all_compare(route) {
//     $.post(route,
//         {
//             remove_all_compare: 1,
//             _token: $('meta[name="csrf-token"]').attr('content'),
//         },
//     function (data) {
//         if (data.status && data.status === 'ok') {
//             $('.vehicle-item').remove()
//         }

//     }, 'json')
// }
