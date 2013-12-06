<?php
function numberFixAU($number){

 $number_org = $number;
 // Replace all charators that are not a number.
 $number = preg_replace('/[^\d]/', '', $number);
 //$number = ereg_replace("[^0-9]", "",$number); // Another way to do same thing as above... This is no loner best way though. ereg_replace no longer up to date PHP function.

 // Number is not International format, and still beings with leading 0.
 if(substr($number,0,1) == '0') {
  $number = "61" . substr($number,1);
 }

 // Number is incorrect format, and has not had leading 0 removed but has had 61 put in front, fix incorrect number.
 if(substr($number,0,3) == '610') {
  $number = "61" . substr($number,3);
 }

 // Make number international Australian format...
 if(substr($number,0,2) != '61') {
  $number = "61" . $number;
 }

 // Check to make sure it is now International format but correct digit length and valid Australian number.
	$valid = preg_match('/^(61(2|3|4|7|8))?\d{8}$/', $number) 
		|| preg_match('/^611(3|8)00\d{6}$/', $number)
		|| preg_match('/^6113\d{4}$/', $number);

 // If number was valid AU number return phone number.
 if($valid == true) {
  return $number;
 }
 // If number was not valid AU number return false.
 else {
  return false;
 }

}


// This function is used to turn number back into Australian format with leading 0 and 10 digit number.
function numberFixAULocal($number){

 $number_org = $number;
 $number = numberFixAU($number);

 // Turn number into local format, leading 0 or 1, 10 digit number etc, or 13 number 6 digit.
 // Check if number is 13-1300/1800 number, if so do not add leading 0.
 if(substr($number,0,2) == '611') {
  $number = substr($number,2);
 }
 // Else just remove the 61 and add leading 0, all other numbers.
 else {
  $number = "0" . substr($number,2);
 }

 // Check to make sure it is now Austrailan Local format but correct digit length and valid Australian number.
	$valid = preg_match('/^(0(2|3|4|7|8))?\d{8}$/', $number) 
		|| preg_match('/^1(3|8)00\d{6}$/', $number)
		|| preg_match('/^13\d{4}$/', $number);

 // If number was valid AU number return phone number.
 if($valid == true) {
  return $number;
 }
 // If number was not valid AU number return false.
 else {
  return false;
  //return('BAD FORMAT');
 }
}
?>