<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function crypto_rand_secure($min, $max){
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd >= $range);
    return $min + $rnd;
}

function getToken($length){
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max)];
    }

    return $token;
}

if ( ! function_exists('read_more'))
{
	function read_more($string,$limit=100)
	{
		$string = trim(preg_replace('/\s+/', ' ', $string));
		$string = trim(preg_replace('/\t+/', '', $string));
		$string = str_replace('&nbsp;','',$string);
		$length = strlen(strip_tags($string));
		if ($length>$limit){

		    $isi_string = htmlentities(strip_tags($string)); // membuat paragraf pada isi berita dan mengabaikan tag html
		    $isi = substr($isi_string,0,$limit); // ambil sebanyak 220 karakter
		    $isi = substr($isi_string,0,strrpos($isi," ")).' ... '; // potong per spasi kalimat

			return $isi;
		}
		else {
			return strip_tags($string);
		}
	}
}

if ( ! function_exists('goExplode'))
{
	function goExplode($string,$delimiter="-",$result=0) {
	    $var 	= explode($delimiter, $string);
	    if($result==0){
	    	return $var[0];
	    }

	    if(!isset($var[$result])){
	    	return;
	    }

	    return $var[$result];
	}
}

if ( ! function_exists('gRecaptcha')){

	function gRecaptcha($type=null)
	{

		if($type=="show"){
			$show = '<div class="g-recaptcha" data-sitekey="'.getenv('GOOGLE_RECAPTCHA_SITE').'"></div>';
			return $show;
		}
		$secret = getenv('GOOGLE_RECAPTCHA_SECRET');
	    $gRecaptcha = $_POST['g-recaptcha-response'];
	    $gRecaptcha = "https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$_POST['g-recaptcha-response'];
	    $response = file_get_contents($gRecaptcha);
	    $responseData = json_decode($response);

	    if(!isset($_POST['g-recaptcha-response'])){
	    	return false;
	    }


	    if($responseData->success){
	        return true;
	    }else{
	        return false;
	    }
	}
}

if ( ! function_exists('remove_file'))
{
	function remove_file($path){
		if(file_exists($path)){
			if(unlink($path)){
				return true;	
			}
			return false;
		}

		return false;
	}
}

if (!function_exists('default_image_for')){
	function default_image_for($type=null){
		switch ($type) {
			case 'all':
				return 'uploads/images/placeholder/food.png';
				break;
			case 'man':
			    return 'uploads/images/placeholder/avatar.png';
				break;
			case 'women':
			    return 'uploads/images/placeholder/women.png';
			break;
			default:
				return 'uploads/images/placeholder/basic.png';
				break;
		}
	}
}

if ( ! function_exists('seo'))
{
	function seo($s) {
	    $c = array (' ');
	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
	    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
	    $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
	    return $s;
	}
}