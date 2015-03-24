{include file=header.php}

<div id="wrap">
    <div id="main" class="container clear-top">
        <div class="form-block center-block" style="max-width: 40%;">
            <form class="form-signin" method="post" action="/user/register">
                <h2 class="form-signin-heading">Please register</h2>
                <label for="inputFirstname" class="sr-only">First name</label>
                <input name="firstname" type="text" id="inputFirstname" class="form-control" placeholder="First Name">
                <label for="inputLastname" class="sr-only">Last name</label>
                <input name="lastname" type="text" id="inputLastname" class="form-control" placeholder="Last Name">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input name="email" type="" id="inputEmail" class="form-control" placeholder="Email address"  autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" >
                <label for="inputPasswordConfirm" class="sr-only">Password</label>
                <input name="passwordconfirm" type="password" id="inputPasswordConfirm" class="form-control" placeholder="Confrim Password" >
                <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
                <p>Already registered? <a id="login_link" href="login.php">Click here to login.</a></p>
            </form>
            <div>
                <?php if(isset($errors)) echo $errors ?>
            </div>
        </div>

        <div class="container">





        </div>

    </div>
</div>