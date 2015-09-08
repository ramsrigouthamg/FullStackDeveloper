<?php require_once('header.php'); ?>

<section class="contentSection">
 <div class="container-fluid">
 <div class="row">
  <div class="container contact-container col-lg-7" style="margin-left:200px;height:410px;">
  <h2 style="color:red;font-weight:bold" class="text-center">Curry Express : Daily Dinner Only Service<br/>(Pickup or Delivery)</h2>
    <p class="catContent text-center">Order online before 12pm. Pickup anytime after 4pm.<br/>
               Delivery locations and other details pl. visit. <a href="https://www.srisaifoods.com">www.srisaifoods.com</a>
    </p>
      <h2 style="color:red;font-weight:bold" class="text-center">Catering</h2>
       <p class="catContent text-center">
                                   We will Cater – Any Occasion – Any Size – Any Group<br/>
                                         No Onion No Garlic options available<br/>
                                For details please e-mail: <a href="mailto:order@srisaifoods.com">order@srisaifoods.com</a>
       
       
        </p>
    
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