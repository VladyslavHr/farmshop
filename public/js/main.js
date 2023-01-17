var log = console.log

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }

    Livewire.on('urlChange', param => {
        history.pushState(null, null, param);
    })

    Livewire.on('cartTotalCountUpdated', cartTotalCount => {
        $('#cart_total_count').text(cartTotalCount)
    })


function add_button_cart (button, product_id) {

    $(button).attr('disabled', true)

    var form = $(button).closest('.buttons-group-index-product').find('.product-btn-add-to-cart-index')
    // var $quantityInput = $(button).parent().find('.js-btn-add-to-cart')
    // var quantity = $quantityInput.val()
    // var maxValue = $quantityInput.attr('max')
    // var resultValue = Math.min(++quantity,maxValue)
    // $quantityInput.val(resultValue)
    // var productId = $quantityInput.data('productid')

    var cart_product_count = +$(button).find('.cart-count-porduct').text()


    var maxValue = +$(button).attr('max')
    log(cart_product_count, maxValue)


    if (cart_product_count >= maxValue) {
        // log(cart_product_count, maxValue)
        return false
    }



    $.post(form.attr('action'),
        $(form).serialize(),
        function (data) {
            if (data.added) {
                $(button).attr('disabled', false)

                $(button).find('.cart-count-porduct').text(data.count)
                $('#cart_total_count').text(data.cart_total_count)
                toastr.success('Товар додано до кошика!')
            }

        }, 'json')
    }




function remove_cart_item(form, event) {
    event.preventDefault()
    $.post($(form).attr('action'),
    $(form).serialize(),
    function (data) {

        if ($(".cart-product-item")[0]) {
            if (data.status === 'ok') {
                $(form).closest('.cart-product-item').remove()
                $('#cart_total_count').text(data.cart_total_count)
                $('.js-cart-total-sum').text(data.cart_total_sum)
                toastr.warning('Товар видалено з кошика!')

            }
        }else{
            $('.empty-cart').show()
            $(button).hide()
            $('#cart_total_count').text(0)
            toastr.warning('Кошик спорожнено!')
        }

    }, 'json')
}

function clearCart(button) {
        var url = button.name
        $.post(url, {
            _token: $('meta[name="csrf-token"]').attr('content'),
        }, function (data) {
            if (data.status === 'ok') {
                $('.full-cart').remove()
                $('.empty-cart').show()
                $(button).hide()
                $('#cart_total_count').text(0)
                toastr.warning('Кошик спорожнено!')
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
            toastr.success('Кількість товару вдало змінено!')

        }
    }, 'json')
}


function cart_item_minus(button) {
    var $quantityInput = $(button).parent().find('.js-cart-item-quantity')
    var quantity = $quantityInput.val()
    var resultValue = Math.max(--quantity, 1)
    $quantityInput.val(resultValue)
    var productId = $quantityInput.data('productid')
    update_cart(productId, resultValue)
}
function cart_item_plus(button) {
    var $quantityInput = $(button).parent().find('.js-cart-item-quantity')
    var quantity = $quantityInput.val()
    var maxValue = $quantityInput.attr('max')
    var resultValue = Math.min(++quantity,maxValue)
    $quantityInput.val(resultValue)
    var productId = $quantityInput.data('productid')
    update_cart(productId, resultValue)
}

function cart_item_quantity_change(input) {
    var $quantityInput = $(input)
    var quantity = $quantityInput.val()
    var maxValue =  $quantityInput.attr('max')
    var resultValue = Math.max(quantity, 1)
    resultValue = Math.min(resultValue,maxValue)
    $quantityInput.val(resultValue)
    var productId = $quantityInput.data('productid')
    update_cart(productId, resultValue)
}

function update_cart(productId, quantity) {
    $.post('/tovary/updateCart', {
        _token: $('meta[name="csrf-token"]').attr('content'),
        productId,
        quantity,
    }, function (data) {
        if (data.status === 'ok') {
            log()
            $('.product-' +productId).find('.js-cart-product-sum').text(data.sum)
            $('.js-cart-total-sum').text(data.cart_total_sum)
        }
    }, 'json')
}
