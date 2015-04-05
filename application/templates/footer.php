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

        console.log(window.location);

        var ignorePathname = ['/user/login',
                              '/',
                              '/menu',
                              '/user/register',
                              '/about',
                              '/contact'];

        var split = window.location.pathname.split('/');

        console.log(ignorePathname);
        console.log('Check');
        console.log(isInArray(window.location.pathname, ignorePathname));
        if(!isAuth && !isInArray(window.location.pathname, ignorePathname)){
            window.location.assign('/user/logout');
        }
    }
    checkAuth();
    setInterval(checkAuth, 1000);

</script>

<script>
    window.FileAPI = {
        debug: true // debug mode
        , staticPath: '/application/assets/js/FileAPI/' // path to *.swf
    };
</script>
<script src="/application/assets/js/FileAPI/FileAPI.min.js"></script>
<script src="/application/assets/js/FileAPI/FileAPI.exif.js"></script>
<script src="/application/assets/js/jquery.fileapi.min.js"></script>
<script src="/application/assets/js/jcrop/jquery.Jcrop.min.js"></script>
<link type="text/css" href="/application/assets/js/jcrop/jquery.Jcrop.min.css" />
<script>
    jQuery(function ($){
        $('#uploader').fileapi({
            url: '/menu/imageUpload',
            accept: 'image/*',
            imageSize: { minWidth: 200, minHeight: 200 },
            elements: {
                active: { show: '.js-upload', hide: '.js-browse' },
                preview: {
                    el: '.js-preview',
                    width: 200,
                    height: 200
                },
                progress: '.js-progress'
            },
            onSelect: function (evt, ui){
                var file = ui.files[0];
                if( !FileAPI.support.transform ) {
                    alert('Your browser does not support Flash :(');
                }
                else if( file ){
                    $('#popup').modal({
                        closeOnEsc: true,
                        closeOnOverlayClick: false,
                        onOpen: function (overlay){
                            $(overlay).on('click', '.js-upload', function (){
                                $.modal().close();
                                $('#userpic').fileapi('upload');
                            });
                            $('.js-img', overlay).cropper({
                                file: file,
                                bgColor: '#fff',
                                maxSize: [$(window).width()-100, $(window).height()-100],
                                minSize: [200, 200],
                                selection: '90%',
                                onSelect: function (coords){
                                    $('#userpic').fileapi('crop', file, coords);
                                }
                            });
                        }
                    }).open();
                }
            }
        });
    });
</script>
<script src="/application/assets/js/jquery.timepicker.js"></script>
<link type="text/css" href="/application/assets/css/jquery.timepicker.css" />
<script>




</script>


<script>



</script>
</body>
</html>