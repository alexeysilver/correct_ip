<?php
$correct['ip']         = $_SERVER['REMOTE_ADDR'];
$correct['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

if($_SERVER['HTTP_X_OPERAMINI_PHONE'] <> '') 
{
   $correct['user_agent'] = 'opera mini ('.$_SERVER['HTTP_X_OPERAMINI_PHONE'].')';
}

if($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] <> '') 
{
  $correct['user_agent'] = 'opera mini ('.$_SERVER['HTTP_X_OPERAMINI_PHONE_UA'].')';
}

if($_SERVER['HTTP_DEVICE_STOCK_UA'] <> '') 
{
  $correct['user_agent'] = 'opera mobi ('.$_SERVER['HTTP_DEVICE_STOCK_UA'].')';
}

if(preg_match( '~opera\smini|opera\smobi~i', $correct['user_agent'] ) AND $_SERVER['HTTP_X_FORWARDED_FOR'] <> '') 
{
  if(preg_match('~\,~', $_SERVER['HTTP_X_FORWARDED_FOR'])) 
  {
    $expl = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] );
		$expl = array_map( 'trim', $expl );

		//@todo error alert on if( count($expl) > 2 )  
      
		foreach($expl as $k=>$v) 
    {
			if(substr($v, 0, 3) <> '10.') { $_SERVER['HTTP_X_FORWARDED_FOR'] = $v;}
		}
	}
  
	$correct['ip'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
 }
 
 //@todo error alert on  if(preg_match('~\,~', $_SERVER['HTTP_X_FORWARDED_FOR']))

 if(preg_match('~ovibrowser~i',$user_agent) AND $_SERVER['HTTP_X_FORWARDED_FOR']<>'') 
 {
     $correct['ip'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
 }
 
 if(preg_match('~chrome compression proxy~i', $_SERVER['HTTP_VIA'])) 
 {
 	 if($_SERVER['HTTP_X_FORWARDED_FOR'] != '') 
   {
 	 	$correct['ip'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
 	 }
 }
 
 if($_SERVER['HTTP_X_UCBROWSER_PHONE_UA'] != '') 
 {
     $correct['user_agent'] = 'ucweb ('.$_SERVER['HTTP_X_UCBROWSER_PHONE_UA'].')';

     if($_SERVER['HTTP_X_FORWARDED_FOR'] <> '') 
     {
        $correct['ip'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
     }
 }

 if($_SERVER['HTTP_CLIENTIP'] != '') 
 {
 	$correct['ip'] = $_SERVER['HTTP_CLIENTIP'];
 }
 
 $correct['country'] = geoip_country_code_by_name($correct['ip']);
 $correct['isp'] = geoip_isp_by_name($correct['ip']);
