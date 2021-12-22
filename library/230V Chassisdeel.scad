230V_chassisdeel();

module 230V_chassisdeel() {
 difference() {
  cube([27,20,10]);
  translate([0,15,-1]) rotate([0,0,45]) cube([7.5,7.5,12]);
  translate([27,15,-1]) rotate([0,0,45]) cube([7.5,7.5,12]);
 }
}