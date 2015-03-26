<?php

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
?>

<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ header.php')); ?>

<div id="wrap">
    <div id="main" class="container clear-top">
        <div class="form-block center-block" style="max-width: 40%;">
            <form class="form-signin" method="post" action="/user/update">
                <h2 class="form-signin-heading">Account settings</h2>
                <label for="inputEmail" class="sr-only">Email address</label>
                <input name="email" type="" id="inputEmail" class="form-control" placeholder="Email address"  value="<?php echo User_Model::user()['user_email'] ?>">
                <label for="inputFirstname" class="sr-only">First name</label>
                <input name="firstname" type="text" id="inputFirstname" class="form-control" value="<?php echo User_Model::user()['user_firstname'] ?>">
                <label for="inputLastname" class="sr-only">Last name</label>
                <input name="lastname" type="text" id="inputLastname" class="form-control" value="<?php echo User_Model::user()['user_lastname'] ?>" >

                <button class="btn btn-lg btn-primary btn-block" type="submit">Update</button>
            </form>
            <div>
                <?php if(isset($errors)) echo $errors ?>
            </div>
        </div>

        <div class="form-block center-block" style="max-width: 40%;">
            <form class="form-signin" method="post" action="/user/update_password">
                <h2 class="form-signin-heading">Password change</h2>
                <label for="inputPassword" class="sr-only">Password</label>
                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" >
                <label for="inputPasswordConfirm" class="sr-only">Password</label>
                <input name="passwordconfirm" type="password" id="inputPasswordConfirm" class="form-control" placeholder="Confrim Password" >

                <button class="btn btn-lg btn-primary btn-block" type="submit">Change password</button>
            </form>
            <div>
                <?php if(isset($errors)) echo $errors ?>
            </div>
        </div>

        <div class="container">



        </div>

    </div>
</div>

<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ footer.php')); ?>
 