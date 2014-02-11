<html>
<head>
<title>Test correct ip</title>
</head>
<body>
<pre>
<?php
include 'correct_ip.php';

$srv = array();
foreach($_SERVER as $key=>$value) {
  if(substr($key, 0, 4) !== 'HTTP' && substr($key, 0, 6) !== 'REMOTE')    continue;
    $srv[$key] = $value;
}
print print_r($correct, true);
print print_r($srv, true);
print geoip_country_name_by_name($_SERVER['REMOTE_ADDR']) .' '. geoip_isp_by_name($_SERVER['REMOTE_ADDR']);

?>
</pre>
</body>
</html>
