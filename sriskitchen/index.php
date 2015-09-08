
<?php require_once('header.php'); ?>

<section class="contentSection">
 <div class="container-fluid">
 <div class="row">
  <div class="container contact-container col-lg-7" style="margin-left:200px;height:410px;">
   <div id="myCarousel" class="carousel slide center-block" data-ride="carousel" style="width:100%">
    <?php
$imageDir = "images/home/";
$images = glob("images/home/{*.jpg,*.jpeg,*.png}", GLOB_BRACE);
$flag=1;
$noofimages = count($images);
?>
    
      <!-- Indicators -->
      <ol class="carousel-indicators">
      
             
            <?php
foreach ($images as $image){
echo '<li data-target="#myCarousel" data-slide-to="' . $imageCount++ . '" class="' .($flagTemp?' active':''). '"></li>';
$flagTemp=0;
}
?>
      </ol>
    
      <div class="carousel-inner" role="listbox">
      <?php
foreach ($images as $image){
echo '<div class="item' .($flag?' active':''). '">'.PHP_EOL."\t\t";
echo '<img src="'.$image.'" style="min-width:100%;min-height:100%;max-height:100%;max-width:100%" /></div>'.PHP_EOL."\t";
$flag=0;
}
?>
      </div>

    </div><!-- /.carousel -->
  </div>
  <div  class="col-lg-2 contact-container" style="height:410px;margin-left:10px" >
  <marquee behavior="scroll" direction="up" scrollamount="1" loop="-1" style="width:100%;height:100%;padding-left:10px;">
      <?php require 'dbconn.php';
$sql = "SELECT config_value FROM config_references where config_name='scrolltext'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
if($row = $result->fetch_assoc()){
echo "" . $row["config_value"] . "";
}
$con->close();
}
?>
  </marquee>
  </div>
  </div>
  </div>
  <!--/.container--> 
  <br>
  <br>
</section>
<!--/#inner-page-->
<?php require_once('footer.php'); ?> 
