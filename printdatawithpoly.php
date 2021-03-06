<!DOCTYPE html>
<html>
<head>
    <title>Simple Leaflet Map</title>

    <meta charset="utf-8" />
    <link   rel="stylesheet"   href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css"   />
    <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script    src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"> </script>
<script>
    
$(document).ready(function(){
    var langi1='';
    var lanti1='';
    getLocation();


  // alert(langi1+' '+lanti1);
$('#submit').click(function(){
    
   
$('#myModal').modal('show');

    
});


function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);

    
  } else { 
      alert( "Geolocation is not supported by this browser.");
   // x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

var map ;
function showPosition(position) {
  //x.innerHTML = "Latitude: " + position.coords.latitude + 
  //"<br>Longitude: " + position.coords.longitude;
  $('#langi').text(position.coords.latitude);
  $('#lanti').text(position.coords.longitude);
  langi1=position.coords.latitude;
  lanti1=position.coords.longitude;
  
map= L.map('map').setView([18.743946,73.481556],13);
      
      mapLink = 
          '<a href="http://openstreetmap.org">OpenStreetMap</a>';
      L.tileLayer(
          'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; ' + mapLink + ' Contributors',
          maxZoom: 18,
          }).addTo(map);
          var marker = L.marker([position.coords.latitude,position.coords.longitude]).addTo(map).on('click', onClick);

          var latlngs16;
          var langi3;
          var lanti3;
  $.getJSON( "fetch.php", function( data ) {
  var items = [];
  $.each( data, function( key, val ) {

var marker = L.marker([val.langi,val.lanti]).addTo(map).bindPopup("<b>Name: </b> "+val.name+"<br /><b> Message:</b>"+val.message+"<br /> ");
  
  addpoly(position.coords.latitude,position.coords.longitude,val.langi,val.lanti);
  //  var polyline = L.polyline(latlngs16, {color: 'red'}).addTo(map);
   // polyline.addTo(map);
   

  });
 
});


  
}


function addpoly(langi1,lanti1,langi,lanti){
  alert(langi1+' '+lanti1+' '+langi+' '+lanti);

  var latlngs16 = [
    [langi1,lanti1],
    [langi,lanti]
];

//  L.polyline(latlngs16, {color: 'red'}).addTo(map);
}


function onClick(e) {
    //alert(this.getLatLng());
    $('#myModal').modal('show');
    alert()

}


$('#fetch').click(function(){
alert('ok');


});

$(document).on('click','#submit1',function(){
var name=$('#name').val();
var message=$('#message').val();
console.log();
alert(name+' '+message+' '+langi1+' '+lanti1);

$.get('http://localhost:8080/try1/dump.php',{
name:name,
message:message,
langi:langi1,
lanti:lanti1
},function(data){
alert(data);
});


});


});



</script>



</head>

<body class="container-fluid">
    <div id="map" style="width: 100%;height:450px;"></div>

    <button type="button"  id="fetch">fetch data</button>
<button type="button" class="btn btn-info " id="submit">Open Modal</button>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" >
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Hi There please write your name and any message for me</h4>
      </div>
      <div class="modal-body">
        <table class="table">
            <thead></thead>
            <tbody>
                    <tr>
                            <td>
                                <h5 id="langi"></h5> 
                            </td>
                            <td>
                                    <h5 id="lanti"></h5> 
                            </td>
            
                        </tr>
            <tr>
                <td>
                    <h5>Name</h5> 
                </td>
                <td>
<input type="text" placeholder="Name" class="form-control" id="name">
                </td>

            </tr>
            <tr>
                <td>
                   <h5>Message</h5> 
                                    </td>
                                    <td>
                    <input type="text" placeholder="message" id="message" class="form-control">
                                    </td>
            </tr>
            <tr>
                <td><input type="button" class="btn btn-secondary" value="Submit" id="submit1"></td>
            </tr>
        </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>

</body>
</html>