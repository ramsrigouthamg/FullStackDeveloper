<?php require_once('header.php'); ?>

<?php
if(isset($_POST['submit']))
{


		 $to = "order@srisaifoods.com";
         $subject = "Contact form submitted from sriskitchen";
         
         $message = "Here are the details<br/>Subject: ".$_POST['subject'];
         $message.= "<br/>Name: ".$_POST['name']."<br/>Email: ".$_POST['email'];
         $message.= "<br/>Phone: ".$_POST['number'];
         $message.= "<br/>Company: ".$_POST['company'];
         $message.= "<br/>Message: ".$_POST['message'];

         $header = "From:order@srisaifoods.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true )
         {
            echo "<div class='bg-success'>Email sent successfully.</div>";
         }
         else
         {
            echo "<div class='bg-error'>Email sending failed. Please try again!</div>";
         }
}
?>




<section class="contentSection">
 <div class="container-fluid">
 <div class="row">
  <div class="container contact-container col-lg-9" style="margin-left:50px;height:410px;">
  <div class="col-md-6">
  <div id="map-container"  style="height:200px"></div>
  <div>
    <i class="fa fa-map-marker fa-2x"></i> 
    <?php require 'dbconn.php';
$sql = "SELECT config_value FROM config_references where config_name='address'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
if($row = $result->fetch_assoc()){
echo "" . $row["config_value"] . "";
}
$con->close();
}
?>
    
    
    <br /> <i class="fa fa-envelope-o fa-2x"></i>
    <?php require 'dbconn.php';
$sql = "SELECT config_value FROM config_references where config_name='email'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
if($row = $result->fetch_assoc()){
echo "" . $row["config_value"] . "";
}
$con->close();
}
?>
					
					
					<br /> <i class="fa fa-phone fa-2x"></i> 
    <?php require 'dbconn.php';
$sql = "SELECT config_value FROM config_references where config_name='phone'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
if($row = $result->fetch_assoc()){
echo "" . $row["config_value"] . "";
}
$con->close();
}
?>
  </div>
  </div>
    <div id="submitform" class="col-md-6" >   
  <form id="main-contact-form" class="contact-form"
							name="contact-form" method="post" action="contactus.php" enctype="text/plain">
							<div class="col-sm-5 col-sm-offset-1">
								<div class="form-group">
									<label>Name *</label> <input type="text" name="name"
										class="form-control" required="required">
								</div>
								<div class="form-group">
									<label>Email *</label> <input type="email" name="email"
										class="form-control" required="required">
								</div>
								<div class="form-group">
									<label>Phone</label> <input type="number" name="number" class="form-control">
								</div>
								<div class="form-group">
									<label>Company Name</label> <input type="text" name="company"
										class="form-control">
								</div>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
									<label>Subject *</label> <input type="text" name="subject"
										class="form-control" required="required">
								</div>
								<div class="form-group">
									<label>Message *</label>
									<textarea name="message" id="message" required
										class="form-control" rows="8"></textarea>
								</div>
								<div class="form-group">
									<button type="submit" name="submit"
										class="btn btn-primary btn-lg">Send
										Message</button>
								</div>
							</div>
						</form>
						</div>
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
