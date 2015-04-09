<?php
/**
 * Created by PhpStorm.
 * User: bartek
 * Date: 09/04/15
 * Time: 23:03
 */

?>
<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ header.php')); ?>

<div class="container">
    <br />
    <br />
    <div class="row">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked admin-menu">
                <li   ><a class="" href="/user/dashboard">Home</a></li>
                <li><a class="" href="/menu/all">Menus list</a></li>
                <li ><a  href="/ingredients/view">Ingredients list</a></li>
                <li><a class="" href="/food/view">Foods list</a></li>
                <li><a class="" href="/order/all">Orders list</a></li>
                <li><a class="" href="/menu/add">Add menu</a></li>
                <li><a class="" href="/ingredients/add">Add Ingredient</a></li>
                <li><a class="" href="/food/add">Add Food</a></li>
                <li><a class="" href="/staff/staff">Staff Dashboard</a></li>
                <li><a class="" href="/customer/index">Customer discounts</a></li>
                <li><a class="" href="/staff/report">Reports</a></li>
                <?php if (Acl_Core::allow([ACL::ACL_OWNER])) { ?>
                    <li><a class="" href="/owner/owner">Backup/Restore Database</a></li>
                    <li  class="active "><a class="btn-primary" href="/owner/restore">Restore Database</a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-md-10 well admin-content" id="home" style="padding-left: 0px;">

            <script>



                $(document).ready(function(){

                    /** $('#sure').on('click', function(){

                        var sure = prompt('Are you sure that you want restore the database ? If yes, please type in word "RESTORE" and press OK');

                        console.log(sure);

                        if(sure == 'RESTORE'){
                            console.log('Perform restore');
                            $('#backupform').submit();
                        }

                        return false;

                    }); */


                });
            </script>

            <div id="wrap">
                <div id="main" class="container clear-top">

                    <div class="container">
                        <h3>Restore Database</h3>

                        <h4><a class="btn btn-sm btn-primary" href="/staff/manager">Go back</a></h4>

                        <form action="/owner/restore" method="post" id="backupform" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="dbbackup">Database backup file (.sql)</label>
                                <input type="file" value="" class="form-control" name="dbbackup" />
                            </div>
                            <button name="submit" type="submit" id="sure" class="btn btn-warning">Backup</button>

                        </form>


                        <div>
                            <?php
                            if(isset($error)) echo $error;
                            ?>
                            </div>

            </div>

        </div> <!--- admin end -->

    </div>
            <div style="padding-bottom: 40px">

            </div>

        </div>

<br />
<br />
<br />
<br />
<br />
<br />


        <br />

        <br />

        <br />
        <br />

<?php include(str_replace(' ','','/Users/bartek/Documents/Development/Web/University/ChickCafe/application/templates/ footer.php')); ?>