{include file=header.php}

<div id="wrap">
    <div id="main" class="container clear-top">
<div class="form-block center-block" style="max-width: 40%;">
<form class="form-signin" method="post" action="/user/login">
    <h2 class="form-signin-heading">Please sign in</h2>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input name="email" type="" id="inputEmail" class="form-control" placeholder="Email address"  autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" >
    <div class="checkbox">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p>Haven't got an account yet? <a id="register_link" href="register.php">Click here to register for an account.</a></p>
</form>
    <div>
       <?php if(isset($errors)) echo $errors ?>
    </div>
</div>

        <div class="container">





        </div>

</div>
    </div>

