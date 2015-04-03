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
    <script src="/application/assets/js/Notifications.js"></script>
<?php endif; ?>

<script>
    <?php
        $oUser = new User_Model();
        $oUser->attr(['email' => $_SESSION['user']]);

        $iUserId = $oUser->aData['user_id'];
        $sUserType = $oUser->aData['user_type'];

        if($sUserType == 'C'){
            echo 'getUserNotifications();';
        }else{
            echo 'getStaffNotifications();';
        }
    ?>
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

<script type="text/javascript" >
    $(document).ready(function()
    {
        $("#notificationLink").click(function()
        {
            $("#notificationContainer").fadeToggle(300);
            $("#notification_count").fadeOut("slow");
            displayNotificationsList();
            return false;
        });

//Document Click hiding the popup
        $(document).click(function()
        {
            $("#notificationContainer").hide();
        });

//Popup on click
        $("#notificationContainer").click(function()
        {
            return false;
        });

    });
</script>

<script type="text/javascript">
    $('#staff_tab a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    })

    $('#staff_id').change(function (e) {
        var staff_id = $(this).val();
        $.post('/staff/get_single_staff', {staff_id:staff_id}, function (original_data) {
            var data = jQuery.parseJSON(original_data);
            data = data[0];
            $('#role').val(data.staff_role);
            $('#salary').val(data.staff_salary);
            $('#phone').val(data.staff_phone_number);
        })
    })

</script>

</body>
</html>