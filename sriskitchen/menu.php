<?php require_once('header.php'); ?>
<?php require_once 'dbconn.php';

function get_menu_items($mealTime,$menuToFetch, $con) {
$sql = "SELECT menu_items.item_name,menu_items.item_price,item_choices.choice_description FROM menu_items,item_and_menu_group,menu_group,item_choices where (menu_items.id = item_and_menu_group.item_id) and (menu_group.id=item_and_menu_group.group_id) and (item_choices.choice_id=menu_items.item_choice_id) and menu_group.groupDescription = '$mealTime' and item_choices.choice_description = '$menuToFetch'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<span style='color: blue;float: left;font-weight: bold;'>".$row["item_name"]."</span>". "<span style='color: blue;float: right;margin-right: 5px;'>" . $row["item_price"]."$"."</span>"."<br>";
      }
                                        
    } 
else {
    echo "0 results";
      }
}

function get_meals($mealTime,$con) {
$sql = "SELECT meals_types.meal_size,meals_types.meal_description,meals_types.price FROM meals_types,mealsize_and_group,menu_group where (meals_types.id = mealsize_and_group.mealtypeid) and (menu_group.id=mealsize_and_group.groupid) and menu_group.groupDescription = '$mealTime' ";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  "<span style='color: blue;float: left;font-weight: bold;'>".$row["meal_size"]."</span>". "<span style='color: blue;float: right;margin-right: 5px;'>" . $row["price"]."$"."</span>"."<br>". $row["meal_description"]."<br><br>";
      }
                                        
    } 
else {
    echo "0 results";
      }
}


?>

<section class="contentSection">
  <div class="container-fluid">
 <div class="row">
  <div class="container contact-container col-lg-7" style="margin-left:200px; height:550px;border: black 1px solid;">
  <div  id="lunchSection">
   <div class="sectionheading text-center">Lunch Menu<br/><br/>Timings
   <?php require 'dbconn.php';
$sql = "SELECT time_served FROM menu_group where groupDescription='Lunch Menu' ";
$result = $con->query($sql);

if ($result->num_rows > 0) {
if($row = $result->fetch_assoc()){
echo "(" . $row["time_served"] . ")";
}
}
?>
   
   </div>
  
 <hr>
 <div class="col-md-6">
  <div class="sub-heading text-center">Meals</div>
  <div class="scrollcontentfull">
 <table class="table menutable">
<?php 
get_meals("Lunch Menu",$con);

?> 


 </table>
 </div>
 
 </div>
    <div class="col-md-6">
 <div class="sub-heading text-center">Entree Choices</div>
 <table class="table menutable" >
 
<?php 
get_menu_items("Lunch Menu","Entree",$con);

function IsNullOrEmptyString($input){
    return (!isset($input) || trim($input)==='');
}

?> 

 </table>
  <div class="sub-heading text-center">Side Choices</div>
 <table class="table menutable">
 
<?php 
get_menu_items("Lunch Menu","Side",$con);

?> 

 </table> 
 
 
  <div class="sub-heading text-center">Drinks</div>
 <div class="scrollcontent">
 <table class="table menutable">
<?php 
get_menu_items("Lunch Menu","Drinks",$con);

?> 
 </table>
 </div>
 
 </div>
  </div>
  
  
</div>
  <div  class="col-lg-2 contact-container" style="height:500px;margin-left:10px" >
  <marquee behavior="scroll" direction="up" scrollamount="1" loop="-1" style="width:100%;height:100%;padding-left:10px;">
      <?php require 'dbconn.php';
$sql = "SELECT config_value FROM config_references where config_name='scrolltext'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
if($row = $result->fetch_assoc()){
echo "" . $row["config_value"] . "";
}
}
?>
  </marquee>
  </div>
  </div>
  
  <div class="row">
  <div class="container contact-container col-lg-7" style="margin-left:200px; height:500px;border: black 1px solid;">
  <div  id="snackSection">
   <div class="sectionheading text-center">Snack Menu<br/><br/>Timings
   <?php require 'dbconn.php';
$sql = "SELECT time_served FROM menu_group where id=2";
$result = $con->query($sql);

if ($result->num_rows > 0) {
if($row = $result->fetch_assoc()){
echo "(" . $row["time_served"] . ")";
}
}
?>
   
   </div>
  <hr>
 
 <div class="col-md-8 centerTab">
  <table class="table borderless" >
<?php require 'dbconn.php';
$sql = "SELECT item_name, item_description, item_image, item_imageName,item_price FROM getItems where choice_id=1 and groupid=2";
$result = $con->query($sql);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
$desc = $row["item_description"];

echo "<tr class=\"tablerow\">";
echo "<td>" . $row["item_name"]. "";
echo "</td>";
echo "<td>$". $row["item_price"]. "". "</td>";


echo "</tr>";


     }
} else {
     echo "0 results";
}

?> 
 </table>
   <div class="sub-heading text-center">Drinks</div>
 <div class="scrollcontent">
 <table class="table menutable">
<?php 
get_menu_items("Snack Menu","Drinks",$con);

?>  </table>
 </div>
 
 </div>
    
  </div>
  
  
</div>
  
  </div>
  
  <div class="row">
  <div class="container contact-container col-lg-7" style="margin-left:200px; height:500px;border: black 1px solid;">
  <div  id="dinnerSection">
   <div class="sectionheading text-center">Dinner Menu<br/><br/>Timings
   <?php require 'dbconn.php';
$sql = "SELECT time_served FROM menu_group where id=3";
$result = $con->query($sql);

if ($result->num_rows > 0) {
if($row = $result->fetch_assoc()){
echo "(" . $row["time_served"] . ")";
}
}
?>
   
   </div>
  <hr>
 
 <div class="col-md-6">
  <div class="sub-heading text-center">Meals</div>
  <div class="scrollcontentfull">
 <table class="table menutable">
<?php 
get_meals("Dinner Menu",$con);

?> 
 </table>
 </div>
 
 </div>
    <div class="col-md-6" >
 <div class="sub-heading text-center">Entree Choices</div>
 <table class="table menutable">

<?php 
get_menu_items("Dinner Menu","Entree",$con);
?> 

 </table>
  <div class="sub-heading text-center">Side Choices</div>
 <table class="table menutable">
<?php 
get_menu_items("Dinner Menu","Side",$con);
?>
 </table> 
 
 
  <div class="sub-heading text-center">Drinks</div>
 <div class="scrollcontent">
 <table class="table menutable">
<?php 
get_menu_items("Dinner Menu","Drinks",$con);
?>
 </table>
 </div>
 
 </div>
  </div>
  
  
</div>  
  </div> 
  </div>

  <br>
  <br> 
</section>
<!--/#inner-page-->

<?php require_once('footer.php'); ?> 