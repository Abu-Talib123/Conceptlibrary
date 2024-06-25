<?php
 	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Encryption_code
{
	var $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function encrypt_decrypt($action, $string) {
	    $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'Pl@t3fu!0815';
	    $secret_iv = 'C@r3$Ful';

	    // hash
	    $key = hash('sha256', $secret_key);

	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);

	    if( $action == 'encrypt' ) {
	        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	        $output = base64_encode($output);
	    }
	    else if( $action == 'decrypt' ){
	        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	    }

	    return $output;
	}
}
/* End of file encryption_code.php */
/* Location: ./system/applocation/library/encryption_code.php */