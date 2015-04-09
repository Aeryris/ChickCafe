/**
 The MIT License (MIT)

 Copyright (c) 2015 Bartlomiej Kliszczyk

 Permission is hereby granted, free of charge, to any person obtaining a copy
 of this software and associated documentation files (the "Software"), to deal
 in the Software without restriction, including without limitation the rights
 to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 copies of the Software, and to permit persons to whom the Software is
 furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in all
 copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 SOFTWARE.
 */

/**
 * @author Bartlomiej Kliszczyk
 * @date 12-02-2015
 * @version 1.0
 * @license The MIT License (MIT)
 */

var BasketPrototype = {
    getBasket: function (){
        $(document).ready(function () {
            $.ajax({
                method: "POST",
                url: "/basket/basketData",
                dataType: "json"
            })
                .done(function (msg) {
                    console.log(msg);
                    BasketPrototype.displayBasket(msg);
                }).fail(function (msg) {
                    console.log( msg );
                })
                .always(function () {
                    //alert( "complete" );
                });
        });
    },

    addtoBasket: function (itemId){
        $(document).ready(function () {

            $.ajax({
                method: "POST",
                url: "/basket/addToBasket",
                data: {item_id: itemId}
            })
                .done(function (msg) {
                    //console.log("addToBasket");
                }).fail(function () {
                    //alert( "error" );
                })
                .always(function () {
                    //alert( "complete" );
                    BasketPrototype.getBasket();

                });

        });
    },
    removeItem: function (itemId){

        $(document).ready(function () {

            $.ajax({
                method: "POST",
                url: "/basket/removeItem",
                data: {item_id: itemId}
            })
                .done(function (msg) {
                    //console.log("remove item");
                }).fail(function () {
                    //alert( "error" );
                })
                .always(function () {
                    //alert( "complete" );
                    BasketPrototype.getBasket();

                });

        });


    },
    displayBasket: function(data){

        $(document).ready(function(){
            console.log(data.basket);

            var html = [];

            priceSum = 0;

            for(var item in data.basket){
                //console.log(item);
                html.push('<tr><td>'+data.basket[item].item_name+' - <span style="font-size: 9px;">  '+data.basket[item].item_description+'</span></td><td>'+data.basket[item].basket_items_quantity+'</td><td>'+data.basket[item].item_price+'</td></tr>');
                priceWithQuantity = parseFloat(data.basket[item].item_price) * parseFloat(data.basket[item].basket_items_quantity);

                priceSum += parseFloat(priceWithQuantity);
            }

            $('tbody.checkout-items-list').html(html);
            $('.checkout__total').text("£"+parseFloat(priceSum).toFixed(2));

            //$('tbody.checkout-items-list')

        });

    },

    updateQuantity: function(itemId, quantity){

        console.log('Item ID: '+itemId);
        console.log('Quantity: '+quantity);

        $(document).ready(function () {

            $.ajax({
                method: "POST",
                url: "/basket/updateQuantity",
                data: {item_id: itemId, quantity:quantity}
            })
                .done(function (msg) {
                    //console.log("update Quantity");
                }).fail(function () {
                    //alert( "error" );
                })
                .always(function () {
                    //alert( "complete" );
                    BasketPrototype.getBasket();

                });

        });

    },

    updateBasketViewPage: function(){
        $(document).ready(function () {
            $.ajax({
                method: "POST",
                url: "/basket/basketData",
                dataType: "json"
            })
                .done(function (data) {
                    //console.log(data);
                    //BasketPrototype.displayBasket(msg);



                    var html = [];

                    priceSum = 0;
                    preparationTime = 0;



                    for(var item in data.basket){
                        //console.log(item);



                        html.push('<div class="row"><div class="col-xs-2"><img class="img-responsive" src="/food_images/'+data.basket[item].item_img+'"></div> <div class="col-xs-4"> <h4 class="product-name"><strong>'+data.basket[item].item_name+'</strong></h4><h4><small>'+data.basket[item].item_description+'</small></h4> </div> <div class="col-xs-6"> <div class="col-xs-4 text-right"> <h6><strong> '+data.basket[item].item_price+' <span class="text-muted">x</span></strong></h6> </div> <div class="col-xs-2 quantity-basket-item-value"> <input type="text" name="quantity" class="form-control input-sm" value="'+data.basket[item].basket_items_quantity+'" /> </div> <div class="col-xs-4" style="margin-top: -15px;"> <button id="'+data.basket[item].item_id+'" class="update-basket-item-quantity btn"><i class="fa fa-refresh"></i></button> <button id="'+data.basket[item].item_id+'" class="remove-basket-item-quantity btn">   <span class="glyphicon glyphicon-trash"> </span>  </button>  </div> </div> </div><hr>');

                        priceWithQuantity = parseFloat(data.basket[item].item_price) * parseFloat(data.basket[item].basket_items_quantity);
                        priceSum += parseFloat(priceWithQuantity);

                        preparationTimeWithQuantity = parseFloat(data.basket[item].item_preptime) * parseFloat(data.basket[item].basket_items_quantity);
                        preparationTime += parseFloat(preparationTimeWithQuantity);




                    }

                    $('.checkout-total-sum').text(parseFloat(priceSum).toFixed(2));
                    $('.checkout-total-sum-original').text(parseFloat(priceSum).toFixed(2));

                    $('.checkout-total-preparation').text(preparationTime);
                    $('.panel-body').html(html);
                    //$('.checkout__total').text("£"+parseFloat(priceSum).toFixed(2));






                }).fail(function (msg) {
                    console.log( msg );
                })
                .always(function () {
                    //alert( "complete" );
                });
        });
    },

    updateCheckoutPage: function(){
        $(document).ready(function () {
            $.ajax({
                method: "POST",
                url: "/basket/basketData",
                dataType: "json"
            })
                .done(function (data) {
                    //console.log(data);
                    var html = [];

                    priceSum = 0;
                    preparationTime = 0;

                    for(var item in data.basket){
                        //console.log(item);
                        //html.push('<tr><td>'+data.basket[item].item_name+'<span>'+data.basket[item].item_description+'</span></td><td>'+data.basket[item].basket_items_quantity+'</td><td>'+data.basket[item].item_preptime+'</td><td>'+data.basket[item].item_price+'</td></tr>');
                        html.push('<div class="row"><div class="col-xs-2"><img class="img-responsive" src="/food_images/'+data.basket[item].item_img+'"></div> <div class="col-xs-4"> <h4 class="product-name"><strong>'+data.basket[item].item_name+'</strong></h4><h4><small>'+data.basket[item].item_description+'</small></h4> </div> <div class="col-xs-6"> <div class="col-xs-4 text-right"> <h6><strong> '+data.basket[item].item_price+' <span class="text-muted">x</span></strong></h6> </div> <div class="col-xs-2 quantity-basket-item-value"> <input type="text" name="quantity" class="form-control input-sm" value="'+data.basket[item].basket_items_quantity+'" /> </div> <div class="col-xs-4" style="margin-top: -15px; display: none"> <button id="'+data.basket[item].item_id+'" class="update-basket-item-quantity btn"><i class="fa fa-refresh"></i></button> <button id="'+data.basket[item].item_id+'" class="remove-basket-item-quantity btn">   <span class="glyphicon glyphicon-trash"> </span>  </button>  </div> </div> </div><hr>');

                        priceWithQuantity = parseFloat(data.basket[item].item_price) * parseFloat(data.basket[item].basket_items_quantity);
                        priceSum += parseFloat(priceWithQuantity);

                        preparationTimeWithQuantity = parseFloat(data.basket[item].item_preptime) * parseFloat(data.basket[item].basket_items_quantity);
                        preparationTime += parseFloat(preparationTimeWithQuantity);
                    }

                    $('.checkout-total-sum').text(parseFloat(priceSum).toFixed(2));
                    $('.checkout-total-preparation').text(preparationTime);
                    $('.panel-body').html(html);



                }).fail(function (msg) {
                    console.log( msg );
                })
                .always(function () {
                    //alert( "complete" );
                });
        });
    }

};

var Basket  = function Basket(){
    return (Object.create(BasketPrototype));
}





/**
function Basket() {

    this.refreshBasket = function () {

    }

    this.addToBasket = function (itemId) {

        $(document).ready(function () {

            $.ajax({
                method: "POST",
                url: "/basket/addToBasket",
                data: {item_id: itemId}
            })
                .done(function (msg) {
                    console.log("addToBasket");
                }).fail(function () {
                    //alert( "error" );
                })
                .always(function () {
                    //alert( "complete" );
                    this.refreshBasket();

                });

        });
    }

    this.removeFromBasket = function () {

    }


}

 */