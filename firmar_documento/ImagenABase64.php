<?php  
  
// Get the image and convert into string 
$img = file_get_contents('https://media.geeksforgeeks.org/wp-content/uploads/geeksforgeeks-22.png'); 
  
// Encode the image string data into base64 
$data = base64_encode($img); 
  
// Display the output 
echo $data; 




