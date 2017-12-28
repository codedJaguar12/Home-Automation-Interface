
<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'iot');
define('DB_USER','itachi');
define('DB_PASSWORD','root');
$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
session_start();
$q = mysql_query("select count(id) from Device");
$r2=mysql_fetch_array($q) or die(mysql_error());
$r3=$r2['count(id)'];


if (($_SESSION['username']) && !empty($_SESSION['username'] )) {
?>
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link rel='stylesheet' href='css/photo-sphere-viewer.css'>

  <style>
    html, body {
      width: 100%;
      height: 100%;
      overflow: hidden;
      margin: 0;
      padding: 0;
    }
    #photosphere {
      width: 100%;
      height: 100%;
    }

    .psv-button.custom-button {
      font-size: 22px;
      line-height: 20px;
    }
  </style>
</head>
<body>

<div id='photosphere'></div>

<script src='js/three.min.js'></script>
<script src='js/D.min.js'></script>
<script src='js/uevent.min.js'></script>
<script src='js/doT.min.js'></script>
<script src='js/CanvasRenderer.js'></script>
<script src='js/Projector.js'></script>
<script src='js/EffectComposer.js'></script>
<script src='js/RenderPass.js'></script>
<script src='js/ShaderPass.js'></script>
<script src='js/MaskPass.js'></script>
<script src='js/CopyShader.js'></script>
<script src='js/DeviceOrientationControls.js'></script>
<script src='js/photo-sphere-viewer.js'></script>

<script type='text/template' id='pin-content'>

</script>



<script>
var i =<?php echo $r3;?>;
  var PSV = new PhotoSphereViewer({
    panorama: 'pano4.jpg',
    container: 'photosphere',
    
    move_speed:4,
    loading_img: 'loading-anim.gif',
    navbar: [
      'autorotate', 'zoom', 'download', 'markers',
      'spacer-1',
      {
        title: 'Change image',
        className: 'custom-button',
        content: '↻',
        onClick: (function() {
          var i = false;

          
        }())
      }, 
      {
        id: 'disabled',
        title: 'This button is disabled',
        content: '❌',
        enabled: false
      },
      'caption',
      'gyroscope',
      'fullscreen'
    ],
    caption: 'Room</b>',
    longitude_range: [-7*Math.PI/8, 7*Math.PI/8],
    latitude_range: [-3*Math.PI/4, 3*Math.PI/4],
    anim_speed: '-2rpm',
    default_fov: 50,
    fisheye: false,
    move_speed: 1.1,
    time_anim: false,
    gyroscope: true,
    webgl: true,
    transition: {
      duration: 1000,
      loader: true,
      blur: true
    },
    markers: (function(){
      var a = [];


<?php 
for ($i=0;$i<$r3;$i++){
    	$g = (string)$i;
    $result = mysql_query("select * from Device where id=$g")or die(mysql_error());
    $r1 = mysql_fetch_array($result) or die(mysql_error());
    $name1 = $r1['name'];
    $lat = $r1['latitude'];
 	$lon = $r1['longitude'];
    ?>
      a.push({
            id: '#<?php echo $i;   ?>',
            tooltip: '<?php echo $name1; ?>',
            latitude: <?php echo (double)$lat; ?>,
            longitude: <?php echo (double)$lon; ?>,
            image: 'img/pin.png',
            width: 32,
            height: 32,
            anchor: 'bottom center',
            data: {
              deletable: true
            }
          });



<?php
}
?>
   
     
      
   

      


      return a;
    }())
  });

  PSV.on('click', function(e) {

if(i<=7){
    var a=prompt("Enter Device Name");

  
    if (e.marker && !e.marker.isPolygon()) {
      return;
    }
    PSV.addMarker({
      id: '#'+ i,
      tooltip: a,
      longitude: e.longitude,
      latitude: e.latitude,
      image: 'img/pin.png',
      width: 32,
      height: 32,
      anchor: 'bottom center',
      data: {
        deletable: true
      }
    });
 var mark=PSV.getMarker('#' + i);

 var ma ={};
ma['id']=i;
ma['tooltip']=mark.tooltip.content;
ma['latitude']=mark.latitude;
ma['longitude']=mark.longitude;



  $.ajax({
	type:'POST',
      
     url:'saveMarker.php',
     data:{'mdata':JSON.stringify(ma)},
	success: function(msg){
     alert(msg);
return true;
},
     complete: function(){},
     error: function(xhr, textStatus,errorThrown){
       console.log("error");
     return false;
}

});

}else{
alert("You cannot add more devices");
}

    i++;
  });

  PSV.on('select-marker', function(marker) {
    if (marker.data && marker.data.deletable) {
       var s = marker.id;
       var m = s.substring(1,2);

 

  $.ajax({
	type:'POST',
     url:'gpiomanipulate.php',
     data:{mddata:m},
	success: function(msg1){
     alert(msg1);
return true;
},
     complete: function(){},
     error: function(xhr, textStatus,errorThrown){
       console.log("error");
     return false;
}

});

    }
 
  });
</script>

<script>
  document.write('<script src='//' + location.host.split(':')[0] + ':35729/livereload.js' async defer><' + '/script>');
</script>
</body>
</html>
<?php
}
else{
 header ('Location: index.html');
}
?>
