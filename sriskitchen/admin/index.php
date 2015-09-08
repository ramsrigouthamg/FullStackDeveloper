<?php require_once('header.php'); ?>
<?php require_once('pageheader.php'); ?> 
<?php 

if(isset($_GET['delete']))
{
    if(unlink($_GET['delete']))
    {
    echo "<div class='bg-success' style='margin-top:10px; padding:10px;'>The file ". $_GET['delete']. " has been deleted succesfully.</div>";
    }
    else
    {
        echo "<div  style='margin-top:10px; padding:10px;' class='bg-danger'>Sorry, there was an error deleting your file.</div>";
    }
}

if(isset($_POST['submit'])) {
    $target_dir = "../images/home/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<div  style='margin-top:10px; padding:10px;' class='bg-danger'>File is not an image.</div>";
            $uploadOk = 0;
        }

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<div class='bg-success' style='margin-top:10px; padding:10px;'>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</div>";
    } else {
        echo "<div  style='margin-top:10px; padding:10px;' class='bg-danger'>Sorry, there was an error uploading your file.</div>";
    }
}

}

?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Slider Images</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!--  Upload images -->
<h1> Upload Image </h1>
<form action="index.php" method="post" enctype="multipart/form-data">

<p>
Choose an image file to upload:<br><br>
<input type="file" name="fileToUpload" accept="image/gif, image/jpeg, image/png, image/jpg" >
</p>
<div>
<input name="submit" type="submit" value="Upload Image">
</div>
</form>

<hr> 



<div>
    <?php
$images = glob("../images/home/{*.jpg,*.jpeg,*.png}", GLOB_BRACE);
$flag=1;
$noofimages = count($images);
?>
    
     
    
      <div class="row">
        <h2>Current Images </h2>
        <ul class="image-grid">

      <?php
foreach ($images as $image){
        echo '<li><img src="'.$image.'"/>
                 <a class="btn btn-primary" href="index.php?delete='.$image.'"> Delete This Image</a>
                </li>';
}
?>
    </ul>
      </div> 
</div>

   



<!-- Show Images end -->

            <!-- /.row -->
            <div class="row">
                
            </div>
            <!-- /.row -->
<?php require_once('pagefooter.php'); ?> 
<?php require_once('footer.php'); ?> 