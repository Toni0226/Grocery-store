(function ($) {

    var zh = $(window).height();
    var zw = $(window).width();
    var shopHeight = zh - 100;
    $(".shop-body").height(shopHeight);
    var mRight = '0px';


    $(".shop-cart").css("right", "0px");
    $(".shop-bottom").css("right", "0px");



    setTotalPrice();

    $(document).on('click', '.shop-show', function () {
        $(".shop-cart").toggle();
    });

    $(document).on('click', '.shop-clear', function () {
        clearCart();
    });

    $(document).on('click', '.plus', function () {
        var itemId = $(this).parents('.shop-item').attr('item-id');
        addCart(itemId);
    });

    $(document).on('change', '.change-qty', function () {
        addCartUp($(this));
    });

    $(document).on('click', '.minus', function () {
        var itemId = $(this).parents('.shop-item').attr('item-id');
        deleteCart(itemId);
    });

    $('.buy').click(function (e) {

        $(".shop-cart").show();
        var itemId = $(this).parents(".menu-item").attr("item-id");

        addCart(itemId);

    });


    $('#cart-pay').click(function (event) {
        location.href = "order_confirm.php";
    });

})(jQuery);


function setTotalPrice() {
    processShopItem();
    var tmp = 0;
    $('.item-price label').each(function () {
        tmp = tmp + parseFloat($(this).text());
    });
    $('.bottom-price label').text(tmp);
    if (tmp == 0) {
        $('.bottom-price label').hide();
        $('.bottom-price').text("Cart is empty");
    } else {

        tmp = tmp.toFixed(2);
        $('.bottom-price').text("Total: $");
        $('.bottom-price').append("<label>" + tmp + "</label>");
    }

    var lc = $('.shop-body').children('.shop-item-wrap').length;
    if (lc < 1) {
        $('.isnull').show();
        $('.bottom-price').css("width", "100%");
        $('.bottom-pay').hide();
    } else {
        $('.isnull').hide();
        $('.bottom-price').css("width", "65%");
        $('.bottom-pay').show();
    }
}



function initCart() {
    var userId = $.cookie('PHPSESSID');
    if (userId) {
        var arrObj = selectAll(userId);
        if (arrObj) {
            for (var i = 0; i < arrObj.length; i++) {
                if (arrObj[i].count == 0) {
                    continue;
                }
                var itemId = arrObj[i].itemId;
                var name = arrObj[i].name;
                var count = arrObj[i].count;
                var price = arrObj[i].price;
                console.log(arrObj[i]); // 查看对象所有属性
                var unit = arrObj[i].unit;
                var uprice = arrObj[i].uprice;
                var photo = arrObj[i].photo;
                var price2 = price * count;
                var htmlTxt = "<div class='shop-item-wrap'>"
                    + "<div class='shop-item' item-id='" + itemId + "'>"
                    + "<div class='item-name fl'><a href='details.php?id=" + itemId + "'><div class='fl'><img src='" + photo + "' width='50' /></div><div  class='fl'>"
                    + name + "<br>"
                    + uprice + "/" + unit +""
                    + "</a></div> </div>"
                    + "<div class='item-price fr' per-price='" + price + "'>"
                    + "$<label>" + price2 + "</label> "
                    + "</div>"
                    + "<div class='item-count fr'>"
                    + "<button class='minus'>-</button>"
                    // + "<input type='number' class='change-qty' value='" + count + "' "
                    + "<input type='number' class='change-qty' value='" + count + "' data-price='" + price + "' data-uprice='" + uprice + "'data-photo='" + photo + "' data-unit='" + unit + "' data-name='" + name + "' data-id='" + itemId + "' "
                    + " maxlength='3' min='0'>"
                    + "<button class='plus'>+</button>"
                    + "</div>"

                    + "</div>"
                    + "</div>";
                $('.shop-body').append(htmlTxt);
            }

            setTotalPrice();
        }

    }
}

function addCartUp(that) {

    var price = that.data('price');
    var uprice = that.data('uprice');
    var photo = that.data('photo');
    var unit = that.data('unit');
    var name = that.data('name');
    var itemId = that.data('id');

    var count = that.val() * 1;
    that.parent().parent().find('.item-price').html(`$<label>${ count * price }</label>`);

    setTotalPrice();

    var userId = $.cookie('PHPSESSID');
    console.log(userId, itemId, name, 1, price, photo, unit, uprice, count)
    if (userId) {
        plusItem(userId, itemId, name, 1, price, photo, unit, uprice, count);
    }
    if (count == 0) {
        that.parent().parent().remove()
    }
}


function addCart(itemId) {

    var obj1 = $(".menu-item[item-id='" + itemId + "']");
    var price = obj1.find('.price').attr("item-price");
    var uprice = obj1.find('.price').attr("item-price");
    var photo = obj1.find('.photo').attr("src");
    console.log(photo)
    if (photo == undefined) {
         photo = obj1.parent().find('img').attr("src");
    }
    var unit = obj1.find('.unit').html();
    var name = obj1.find('.name').text();


    var obj2 = $(".shop-item[item-id='" + itemId + "']");

    if (!obj2.html()) {
        var htmlTxt = "<div class='shop-item-wrap'>"
            + "<div class='shop-item' item-id='" + itemId + "'>"
            + "<div class='item-name fl'><a href='details.php?id=" + itemId + "'><div class='fl'><img src='" + photo + "' width='50' /></div><div  class='fl'>"
            + name + "<br>"
            + uprice + "/" + unit + ""
            + "</div></a>  </div>"
            + "<div class='item-price fr' per-price='" + price + "'>"
            + "$<label>" + price + "</label> "
            + "</div>"
            + "<div class='item-count fr'>"
            + "<button class='minus'>-</button>"
            + "<input type='number' class='change-qty' value='1' data-price='" + price + "' data-uprice='" + uprice + "'data-photo='" + photo + "' data-unit='" + unit + "' data-name='" + name + "'  data-id='" + itemId + "'"
            + " maxlength='3' min='0'>"
            + "<button class='plus'>+</button>"
            + "</div>"

            + "</div>"
            + "</div>";
        $('.shop-body').append(htmlTxt);

    } else {


        var t = obj2.find('.item-count input');

        var count = parseInt(t.val()) + 1;

        t.val(count);

        var perPrice = obj2.find('.item-count').siblings('.item-price').attr("per-price");

        var price = obj2.find('.item-count').siblings('.item-price').find('label');

        console.log(price, 'price2')

        price.text(count * perPrice);
    }

    setTotalPrice();

    var userId = $.cookie('PHPSESSID');
    if (userId) {
        plusItem(userId, itemId, name, 1, price, photo, unit, uprice);
    }
}

function deleteCart(itemId) {

    var obj = $(".shop-item[item-id='" + itemId + "']");
    var t = obj.find('.item-count input');
    var count = parseInt(t.val()) - 1;
    if (count < 0) count = 0;
    t.val(count);

    var perPrice = obj.find('.item-count').siblings('.item-price').attr("per-price");

    var price = obj.find('.item-count').siblings('.item-price').find('label');
    price.text(count * perPrice);

    if (count == 0) {
        obj.parents('.shop-item-wrap').remove();
    }

    setTotalPrice();

    var userId = $.cookie('PHPSESSID');
    if (userId) {
        minusItem(userId, itemId);
    }
}

function clearCart() {

    $('.shop-item-wrap').remove();


    setTotalPrice();

    var userId = $.cookie('PHPSESSID');
    if (userId) {
        removeAllItem(userId);
    }
}



function processShopItem() {
    var shopItemWidth = $(".shop-item").width();
    var itemCountWidth = $(".item-count").width();
    var itemPriceWidth = $(".item-price").width();

    $(".item-name").width("100%");
}

