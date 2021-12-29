<?php
 $scadfile=$_GET["scad"];
 $cmd=$_GET["command"];

 if($cmd==="convert") {
  $plaatje = basename("$scadfile", ".scad").".png";

  // Genereer opnieuw indien plaatje verourderd is of nog niet bestaat
  $openscadtijd = filemtime("./library/$scadfile");
  $aanmaaktijd = filemtime("./tmp/$plaatje");
  if( $aanmaaktijd===false || $openscadtijd>$aanmaaktijd) {
   $cmd = getcwd()."/openscad -o './tmp/$plaatje' './library/$scadfile'";
   exec($cmd);
  }

  echo "<img src='tmp/$plaatje' />";
 }
 else if($cmd==="copy") {
  echo file_get_contents("$scadfile");
 }
 else if($cmd==="nemo") {
  exec("nemo '$scadfile'");
 }
 else if($cmd==="use") {
  $plaatje = basename("$scadfile", ".scad").".png";
  $use = "use <".getcwd()."/$scadfile>;";
  echo $use;
 }
?>
