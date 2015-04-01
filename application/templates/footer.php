<footer class="footer">
  <div class="container">
    <p class="text-muted"> Codename Cookie</p>
  </div>
</footer>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="/application/assets/js/jquery-1.11.2.min.js"><\/script>')</script>
<script src="/application/assets/js/bootstrap.min.js"></script>

<script src="/application/assets/js/jquery.confirm.min.js"></script>
<script>

    var jumboHeight = $('.jumbotron').outerHeight();
    function parallax(){
        var scrolled = $(window).scrollTop();
        $('.bg').css('height', (jumboHeight-scrolled) + 'px');
    }

    $(window).scroll(function(e){
        parallax();
    });

</script>
<?php if(Auth_Core::init()->isAuth()): ?>
<script src="/application/assets/js/classie.js"></script>
<script>
    (function() {
        [].slice.call( document.querySelectorAll( '.checkout' ) ).forEach( function( el ) {
            var openCtrl = el.querySelector( '.checkout__button' ),
                closeCtrls = el.querySelectorAll( '.checkout__cancel' );

            openCtrl.addEventListener( 'click', function(ev) {
                ev.preventDefault();
                classie.add( el, 'checkout--active' );
            } );

            [].slice.call( closeCtrls ).forEach( function( ctrl ) {
                ctrl.addEventListener( 'click', function() {
                    classie.remove( el, 'checkout--active' );
                } );
            } );
        } );
    })();
</script>
<script src="/application/assets/js/Basket.js"></script>
<script src="/application/assets/js/getBasket.js"></script>
<script src="/application/assets/js/addToBasket.js"></script>
<?php endif; ?>

<script>
    $(document).ready(function(){
        $(".confirm").confirm(/** {
            text: "You will be redirected to the payment page, do you want to proceed?",
            title: "Confirmation required",
            confirm: function(button) {
                //delete();
            },
            cancel: function(button) {
                // nothing to do
            },
            confirmButton: "Pay",
            cancelButton: "Go back",
            post: true,
            confirmButtonClass: "btn-danger",
            cancelButtonClass: "btn-default",
            dialogClass: "modal-dialog modal-lg" // Bootstrap classes for large modal
        }*/);
    });
</script>



</body>
</html>