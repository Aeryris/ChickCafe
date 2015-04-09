<footer class="footer">

  <div class="container">

    <p class="text-muted"> Codename Cookie</p>
  </div>
    <a href="http://www.w3.org/html/logo/">
        <img src="http://www.w3.org/html/logo/badge/html5-badge-h-css3-semantics.png" width="165" height="64" alt="HTML5 Powered with CSS3 / Styling, and Semantics" title="HTML5 Powered with CSS3 / Styling, and Semantics">
    </a>
</footer>


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
            setNotificationsRead();
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
        setInterval(displayNotificationsList, 1000);

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
    });

    function isInArray(value, array) {
        return array.indexOf(value) > -1;
    }

    function checkAuth(){

        var isAuth = <?php echo (isset($_SESSION['ak']) && $_SESSION['ak'] == sha1(md5($_SESSION['user']))) ?>

        //console.log(window.location);

        var ignorePathname = ['/user/login',
                              '/',
                              '/menu',
                              '/user/register',
                              '/about',
                              '/contact'];

        var split = window.location.pathname.split('/');

        //console.log(ignorePathname);
        //console.log('Check');
        //console.log(isInArray(window.location.pathname, ignorePathname));
        if(!isAuth && !isInArray(window.location.pathname, ignorePathname)){
            window.location.assign('/user/logout');
        }
    }
    checkAuth();
    setInterval(checkAuth, 1000);

</script>

<script src="/application/assets/js/jquery.timepicker.js"></script>

<script>

    $(function() {
        $('form.require-validation').bind('submit', function(e) {
            var $form         = $(e.target).closest('form'),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'].join(', '),
                $inputs       = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid         = true;

            $errorMessage.addClass('hide');
            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault(); // cancel on first error
                }
            });
        });
    });


</script>

<script src="/application/assets/js/card.js"></script>
<script>

    var card = new Card({
        // a selector or DOM element for the form where users will
        // be entering their information
        form: 'form', // *required*
        // a selector or DOM element for the container
        // where you want the card to appear
        container: '.card-wrapper', // *required*

        //formSelectors: {
        //    numberInput: 'number', // optional — default input[name="number"]
        //    expiryInput: 'expiry', // optional — default input[name="expiry"]
         //   cvcInput: 'cvc', // optional — default input[name="cvc"]
         //   nameInput: 'name' // optional - defaults input[name="name"]
       // },

        width: 200, // optional — default 350px
        formatting: true, // optional - default true

        // Strings for translation - optional
        messages: {
            validDate: 'expiry\ndate', // optional - default 'valid\nthru'
            monthYear: 'mm/yyyy' // optional - default 'month/year'
        },

        // Default values for rendered fields - optional
        values: {
            number: '•••• •••• •••• ••••',
            name: 'Full Name',
            expiry: '••/••',
            cvc: '•••'
        },

        // if true, will log helpful messages for setting up Card
        debug: false // optional - default false
    });
</script>
<script>

</script>


</body>
</html>