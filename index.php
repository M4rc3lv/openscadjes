<html>
 <?php
 function endsWith($string, $endString){   $len = strlen($endString);  if ($len == 0) return true;
  return (substr($string, -$len) === $endString);
 }
 ?>
 <head>
  <link rel="stylesheet" href="client/w3.css">
  <script src="client/jquery-3.6.0.min.js"></script>
  <style>
   .left{
     height:calc(100vh - 40px);
     overflow-y:scroll;
     width:300px;
     line-height:1.8;
     padding-top:10px;
     padding-bottom:10px;
     border-right: solid 1px #ddd;
     scrollbar-color: #ff9800 #ccc;
    }
    .left a {
     display:block!important;
     width:100%;
     padding-left:10px;
    }
    a:hover {
     background-color: #ff9800 !important;
    }
    #plaatje img {
     height:calc(100vh - 40px);
    }
    body {
     background-color:#efefee;
    }
    .m {
     width:1200px;
     border-left: solid 1px #ddd;
     border-right: solid 1px #ddd;
     margin: 0 auto;
     background:white;
    }
  </style>
 </head>
 <body><div class='m'>
  <div class="w3-bar w3-orange w3-padding">
   OpenScadjes
   <span class="w3-orange w3-padding w3-monospace"><?php echo getcwd(); ?></span>
  </div>

   <div class="w3-row">
    <div class="w3-col left w3-monospace" >
     <?php
     $files = array();
     if ($handle = opendir('./library')) {
      while (false !== ($entry = readdir($handle))) {
       if ($entry != "." && $entry != ".." && endsWith($entry,".scad")) {
        $files[] = $entry;
       }
      }
      closedir($handle);
      natcasesort($files);
      foreach($files as $entry) {
       $f=basename($entry, ".scad");
       echo "<a href='#' class='scad' data-file='$entry'>$f</a>";
      }
     }
    ?>
    </div>

    <div class="w3-rest">
     <div class="w3-display-container">
      <div id="plaatje"></div>
      <div id="ButtonDiv" class="w3-display-topleft" style='padding-left:10px;padding-top:10px'>
       <button class="w3-button w3-khaki" id='btnCopy' title='Kopieer Openscad-snippet naar clipboard'>Kopi&euml;ren</button>
       <button class="w3-button w3-khaki" id='btnNemo' title='Toon in Nemo file-manager'>Open in Nemo</button>
       <span id="TxtInfo">Gekopieerd!</span>
      </div>
     </div>
    </div>
   </div>

 <script>
  document.addEventListener("DOMContentLoaded", function(event) {

   $(".scad").click(function(){
    $("#plaatje").load(
     "command.php?command=convert&scad="+encodeURI( $(this).attr("data-file") )
    );
    $("#TxtInfo").hide();
   });

   $("#btnNemo").click(function(){
    let Bestand=$("#plaatje img").attr("src"); // tmp/Cube.png
    Bestand=Bestand.substring(0,Bestand.length-4);
    Bestand = "library/"+Bestand.split('\\').pop().split('/').pop()+".scad";
    $.ajax({url:"command.php?command=nemo&scad="+encodeURI( Bestand )});
   });

   $("#btnCopy").click(function(){
    let Bestand=$("#plaatje img").attr("src"); // tmp/Cube.png
    Bestand=Bestand.substring(0,Bestand.length-4);
    Bestand = "library/"+Bestand.split('\\').pop().split('/').pop()+".scad";
    $.ajax({url:"command.php?command=copy&scad="+encodeURI( Bestand )}).done(function(data){
     navigator.clipboard.writeText(data);
     $("#TxtInfo").show();
    });
   });

  });
 </script>
 </div></body>
</html>
