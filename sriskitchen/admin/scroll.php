<?php require_once('header.php'); ?>
<?php require_once('pageheader.php'); ?>
<?php
    if(isset($_POST['update']))
    {
        $textMsg = $_POST['scroll'];
        $textMsg = htmlspecialchars($textMsg);

        $sql = 'UPDATE `config_references` SET `config_value`="'.$textMsg.'" WHERE `config_name`="scrolltext";';
    if ($con->query($sql)) {
        echo "<div class='bg-success' style='margin-top:10px; padding:10px;'>Scroll text has been updated succesfully.</div>";
    } else {
        echo "<div  style='margin-top:10px; padding:10px;' class='bg-danger'>Sorry, there was an error updating: $con->error</div>";
    }
}

$sql = "SELECT config_value FROM config_references where config_name='scrolltext'";
$result = $con->query($sql);
$scroll_msg = "";
if ($result->num_rows > 0) {
if($row = $result->fetch_assoc()){
    $scroll_msg= $row["config_value"];
}
$con->close();
}
?> 

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Scroll Message</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<form method="post" action="scroll.php"> 
   
    <textarea name="scroll" rows="10" cols="80"> <?php echo $scroll_msg ?></textarea>
   <br><br>
   
   <input class="btn btn-primary" type="submit" name="update" value="Update"> 
</form>



            <!-- /.row -->
            <div class="row">
                
            </div>
            <!-- /.row -->
<?php require_once('pagefooter.php'); ?> 
<?php require_once('footer.php'); ?> 