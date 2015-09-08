<?php require_once('header.php'); ?> 
<?php
if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = 'SELECT username FROM admins where username="'.$username.'" and password="'.$password.'"';
    $result = $con->query($sql);
    if ($result->num_rows == 0)
    {
        echo "<div  style='margin-top:10px; padding:10px;' class='bg-danger'> Login Failed </div>";
    }
     else if ($result->num_rows == 1)
    {
        $_SESSION["admin"] = "true";
        #print_r($_SESSION);
        echo '<meta http-equiv="refresh" content="0; url=index.php">';
        exit();
        
    } else {
            echo "<div  style='margin-top:10px; padding:10px;' class='bg-danger'> Login Failed </div>";
    
    }

}


?>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Administrator Sign In</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="login.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="username" type="text" autofocus required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                </label>
                            </div>

                            <!-- Change this to a button or input when using this as a form -->
                            <input type="submit" class="btn btn-lg btn-success btn-block" name="submit" value="Login" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?> 
