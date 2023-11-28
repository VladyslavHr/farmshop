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


$('#discount_value').hide()
$('#total_sum_without_discount').hide()

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
    // log(cart_product_count, maxValue)s

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
                // $('#cart_total_count').text(data.cart_total_count)
                $('#fixed_cart_link').removeClass('d-none')
                $('.cart-count').text(data.cart_total_count)
                toastr.success('Товар додано до кошика!')
            }

        }, 'json')
    }

function remove_cart_item(form, event) {
    event.preventDefault()
    $.post($(form).attr('action'),
    $(form).serialize(),
    function (data) {
        if (data.status === 'ok') {
            $(form).closest('.cart-product-item').remove()
            $(form).closest('.cart-product-item-small').remove()
            $('#cart_total_count').text(data.cart_total_count)
            $('.js-cart-total-sum').text(data.cart_total_sum)

            if ($(".cart-product-item").length ) {
                toastr.warning('Товар видалено з кошика!')
                $('.cart-count').text(data.cart_total_count)
            }else{
                $('.full-cart').remove()
                $('.full-cart-small-screen').remove()
                $('.cart-header-btn-clean').remove()
                $('.empty-cart').show()
                // $('#cart_total_count').text(0)
                $('.cart-count').text(data.cart_total_count)
                $('#fixed_cart_link').addClass('d-none')
                // toastr.error('Кошик спорожнено!')
            }

            if ( $(".cart-product-item-small").length) {
                // toastr.warning('Товар видалено з кошика!')
                $('.cart-count').text(data.cart_total_count)
            }else{
                $('.full-cart').remove()
                $('.full-cart-small-screen').remove()
                $('.cart-header-btn-clean').remove()
                $('.empty-cart').show()
                // $('#cart_total_count').text(0)
                $('.cart-count').text(data.cart_total_count)
                $('#fixed_cart_link').addClass('d-none')
                toastr.error('Кошик спорожнено!')
            }
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
                $('.full-cart-small-screen').remove()
                $('.empty-cart').show()
                $(button).hide()
                // $('#cart_total_count').text(0)
                $('.cart-count').text(0)
                $('#fixed_cart_link').addClass('d-none')
                toastr.error('Кошик спорожнено!')
            }
        })

}

function savePromoCode(promoCode) {
    localStorage.setItem('promoCode', promoCode);
  }

// Функция для восстановления значения промокода из localStorage
function restorePromoCode() {
    var promoCode = localStorage.getItem('promoCode');
    if (promoCode) {
    $('#promo_code_input').val(promoCode);
    }
}

$(document).ready(function() {
    restorePromoCode();
});



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
    var promoCode = $('#promo_code_input').val();
    update_cart(productId, resultValue, promoCode)
}
function cart_item_plus(button) {
    var $quantityInput = $(button).parent().find('.js-cart-item-quantity')
    var quantity = $quantityInput.val()
    var maxValue = $quantityInput.attr('max')
    var resultValue = Math.min(++quantity,maxValue)
    $quantityInput.val(resultValue)
    var productId = $quantityInput.data('productid')
    var promoCode = $('#promo_code_input').val();
    update_cart(productId, resultValue, promoCode)
}

function cart_item_quantity_change(input) {
    var $quantityInput = $(input)
    var quantity = $quantityInput.val()
    var maxValue =  $quantityInput.attr('max')
    var resultValue = Math.max(quantity, 1)
    resultValue = Math.min(resultValue,maxValue)
    $quantityInput.val(resultValue)
    var productId = $quantityInput.data('productid')
    var promoCode = $('#promo_code_input').val();
    update_cart(productId, resultValue, promoCode)
}


function cart_promo_code(input) {
    var $promoCodeInput = $(input);
    var promoCode = $promoCodeInput.val(); // Получаем значение промокода из поля ввода
    savePromoCode(promoCode); // Сохраняем значение промокода
    var productId = $promoCodeInput.data('productid') // Получаем значение идентификатора продукта из скрытого поля с id="productId"
    var quantity = $('.js-cart-item-quantity').val();

    update_cart(productId, quantity, promoCode); // Передаем значения в функцию update_cart()
}

function update_cart(productId, quantity, promoCode) {
    log(promoCode),
    $.post('/tovary/updateCart', {
        _token: $('meta[name="csrf-token"]').attr('content'),
        productId,
        quantity,
        promo_code: promoCode, // Добавляем промокод в запрос
    }, function (data) {
        log(data)
        if (data.status === 'ok') {
            $('.product-' +productId).find('.js-cart-product-sum').text(data.sum)
            $('.js-cart-total-sum').text(data.cart_total_sum)

            $('#total_sum_without_discount').show().text(data.totalSumWithoutDiscount)
        }
        if (data.promo_code === 'ok') {
            $('#discount_value').show()
        }
    }, 'json')
}


function choose_self_shipping(){

    if ($('#check_self_shipping').is(":checked")) {
        $("#delivery_new_post_choose").hide();
        $("#delivery_ukr_post_choose").hide();
    }else{
        $("#delivery_new_post_choose").show();
        $("#delivery_ukr_post_choose").show();
    }
}

function check_input_new_post() {

    var inputValues =  $('#delivery_new_post_choose input').map(function(){
        return this.value
    }).get().join('')

    // log(inputValues)

    if (inputValues) {
        $('#check_self_shipping').parent().hide()
        // $('#check_self_shipping').parent().hide()
    }else{
        $("#check_self_shipping").parent().show()
        // $("#check_self_shipping").parent().show()
    }
}

$(document).ready(function() {
    // Проверка и инициализация при загрузке страницы
    if ("{{ auth()->user()->selfship }}" == "1") {
        $('#check_self_shipping').prop('checked', true);
    }
    choose_self_shipping(); // Вызов функции для установления начального состояния

    // Другие инициализации или обработчики событий
});

function check_input_ukr_post() {
    var inputValues = $('#delivery_ukr_post_choose input').map(function(){
        return this.value
    }).get().join('')

    if (inputValues) {
        $('#check_self_shipping').attr('disabled', true)
        $('#delivery_new_post_choose input').attr('disabled', true).addClass('disabled')
    }else{
        $("#check_self_shipping").attr('disabled', false)
        $("#delivery_new_post_choose input").attr('disabled', false).removeClass('disabled')
    }
}

