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

$(document).ready(function(){


    /**
     * Ajax Call to basket -> Basket refresh
     */

    console.log('text');



    $('button.add_item_to_basket').click(function(){

        console.log($(this).parent('.current-menus'));
        var menu_name = $(this).parent('.current-menus').closest('.menu-name');
        var item_id = $(this).attr('id');

        //console.log($('button.add_item_to_basket').);

        console.log($(this).data('remain'));
        var remain = $(this).data('remain')-1;

        if($(this).data('remain') == 0){
            alert('You cannot add more, we do not have enough in stock');
            return;
        }

        $(this).data('remain', remain);


        (function() {
            [].slice.call( document.querySelectorAll( '.checkout' ) ).forEach( function( el ) {
                var openCtrl = el.querySelector( '.checkout__button' ),
                    closeCtrls = el.querySelectorAll( '.checkout__cancel' );

                    classie.add( el, 'checkout--active' );

                [].slice.call( closeCtrls ).forEach( function( ctrl ) {
                    ctrl.addEventListener( 'click', function() {
                        classie.remove( el, 'checkout--active' );
                    } );
                } );
            } );
        })();


        Basket().addtoBasket(item_id);

    });


});


$(document).ready(function(){

    /**
     * Ajax Call to basket -> Basket refresh
     */

    Basket().updateBasketViewPage();

    $(document).on('click', '.remove-basket-item-quantity',  function(){

        console.log($(this).parent('.current-menus'));
        var menu_name = $(this).parent('.current-menus').closest('.menu-name');
        var item_id = $(this).attr('id');


        (function() {
            [].slice.call( document.querySelectorAll( '.checkout' ) ).forEach( function( el ) {
                var openCtrl = el.querySelector( '.checkout__button' ),
                    closeCtrls = el.querySelectorAll( '.checkout__cancel' );

                classie.add( el, 'checkout--active' );

                [].slice.call( closeCtrls ).forEach( function( ctrl ) {
                    ctrl.addEventListener( 'click', function() {
                        classie.remove( el, 'checkout--active' );
                    } );
                } );
            } );
        })();


        Basket().removeItem(item_id);
        Basket().updateBasketViewPage();
        Basket().updateCheckoutPage();

    });




});


$(document).ready(function(){

    /**
     * Ajax Call to basket -> Basket refresh
     */

    Basket().updateBasketViewPage();
    Basket().updateCheckoutPage();

    $(document).on('click', '.update-basket-item-quantity',  function(){

        var quantity = $(this).parent().parent().find('input').val();

        var item_id = $(this).attr('id');


        /**(function() {
            [].slice.call( document.querySelectorAll( '.checkout' ) ).forEach( function( el ) {
                var openCtrl = el.querySelector( '.checkout__button' ),
                    closeCtrls = el.querySelectorAll( '.checkout__cancel' );

                classie.add( el, 'checkout--active' );

                [].slice.call( closeCtrls ).forEach( function( ctrl ) {
                    ctrl.addEventListener( 'click', function() {
                        classie.remove( el, 'checkout--active' );
                    } );
                } );
            } );
        })(); */

        Basket().updateQuantity(item_id, quantity);
        Basket().updateBasketViewPage();
        Basket().updateCheckoutPage();

    });




});