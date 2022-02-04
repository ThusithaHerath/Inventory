<?php
$con = mysqli_connect("127.0.0.1","texdcqat_stock_manager","Admin@2021","texdcqat_stockmanagement_db");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }	


  function base64url_encode($data)
    {
      // Encode $data to Base64 string
      $b64 = base64_encode($data);

      // Valid result? Otherwise, return FALSE, as the base64_encode() function does
      if ($b64 === false) {
        return false;
      }

      // Convert Base64 to Base64URL by replacing "+" with "-" and "/" with "_"
      $url = strtr($b64, '+/', '-_');

      // Remove padding character from the end of line and return the Base64URL result
      return rtrim($url, '=');
    }
    function base64url_decode($data, $strict = false)
    {
      // Convert Base64URL to Base64 by replacing "-" with "+" and "_" with "/"
      $b64 = strtr($data, '-_', '+/');

      // Decode Base64 string and return the original data
      return base64_decode($b64, $strict);
    }
 
?>

