<div class="color-border"> </div>
<footer id="footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">Copyright &copy; 2015 Sri's Kitchen.</div>    
    </div>
  </div>
</footer>
<!--/#footer--> 

<script src="js/jquery.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.prettyPhoto.js"></script> 
<script src="js/jquery.isotope.min.js"></script> 
<script src="js/main.js"></script>
 <script src="../../dist/js/bootstrap.min.js"></script>  
 <script>
  $('.carousel').carousel({
   interval: 10000
  });
 </script> 
 <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script>	
	
      function init_map() {
		var myLocation = new google.maps.LatLng(37.410648,-121.945591);
		  
        var mapOptions = {
          center: myLocation,
          zoom: 14
        };
		
		var marker = new google.maps.Marker({
			position: myLocation,
			title:"Sri's Kitchen"});
			
        var map = new google.maps.Map(document.getElementById("map-container"),
            mapOptions);
		
		marker.setMap(map);	

      }
	  
      google.maps.event.addDomListener(window, 'load', init_map);
	  
    </script> 
 
</body>
</html>