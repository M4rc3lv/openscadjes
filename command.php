<?php
 $scadfile=$_GET["scad"];
 $cmd=$_GET["command"];

 if($cmd==="convert") {
  $plaatje = basename("$scadfile", ".scad").".png";
  $cmd = getcwd()."/openscad -o './tmp/$plaatje' './library/$scadfile'";
  exec($cmd);

  echo "<img src='tmp/$plaatje' />";
 }
 else if($cmd==="copy") {
  echo file_get_contents("$scadfile");
 }
 else if($cmd==="nemo") {
  exec("nemo '$scadfile'");
 }
?>
