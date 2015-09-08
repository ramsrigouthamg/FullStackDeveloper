<?php require_once('header.php'); ?>
<?php require_once('pageheader.php'); ?> 
<?php
    if(isset($_POST['update']))
    {
        $password = md5($_POST['password']);
        

        $sql = 'UPDATE `admins` SET `password`="'.$password.'" WHERE `username`="admin";';
    if ($con->query($sql)) {
        echo "<div class='bg-success' style='margin-top:10px; padding:10px;'>Password has been updated succesfully.</div>";
    } else {
        echo "<div  style='margin-top:10px; padding:10px;' class='bg-danger'>Sorry, there was an error updating password: $con->error</div>";
    }
}
?>


            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Settings: Change Admin Password</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <form method="post" action="settings.php"> 
            
            New Password: <input type="text" name="password">
            <input class="btn btn-primary" type="submit" name="update" value="Update"> 
            <br><br>
   
            </form>


            <!-- /.row -->
            <div class="row">
                
            </div>
            <!-- /.row -->
<?php require_once('pagefooter.php'); ?> 
<?php require_once('footer.php'); ?> 