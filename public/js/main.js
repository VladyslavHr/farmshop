function add_button_cart (button, product_id) {

    var form = $(button).closest('.buttons-group-index-product').find('.product-btn-add-to-cart-index')

    $.post(form.attr('action'),
        $(form).serialize(),
        function (data) {
            if (data.added) {
                // find('.cart-count-porduct').$(++product_id)
                $(button).find('.cart-count-porduct').text(data.count)
                $('#cart_total_count').text(data.cart_total_count)
            }

        }, 'json')
    }

function remove_button_cart(form, event) {
    event.preventDefault()
    $.post($(form).attr('action'),
    $(form).serialize(),
    function (data) {
        if (data.status === 'ok') {
            $(form).closest('.cart-product-item').remove()
            $('#cart_total_count').text(data.cart_total_count)
        }

    }, 'json')
}
function clearCart(button) {

        var url = button.name
        $.post(url, {
            _token: $('meta[name="csrf-token"]').attr('content'),
        }, function (data) {
            if (data.dtatus === 'ok') {
                $('cart-product-item').remove()
                $('#cart_total_count').text(0)
            }
        })

}


function cart_input_quantity() {
    // var select_from = $(data)
    // var select_to = $(data)
    var cart_quantity = $('#cart_quantity')
    // var select_to = $('#select_to')

    var quant = cart_quantity.val()
    // var destination_to = select_to.val()

    $.post('/api/getDestinationStops',
    {
        q: quant,
        // to: destination_to,
    }, function function_name(data) {
        if (data.status === 'ok') {
            $('#destination_result').html(data.destination_view)
        }
    }, 'json')
}
