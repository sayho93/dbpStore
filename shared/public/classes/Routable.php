<?php
include_once "../bases/Databases.php";

//$file_server_path = realpath(__FILE__);
//$server_path = str_replace(basename(__FILE__), "", $file_server_path);
//$server_path = str_replace("/public/classes/", "", $server_path);
//include_once $server_path . "/bases/Databases.php";

class Routable extends Databases {

    var $lastCall;

    function response($returnCode, $returnMessage, $data = "", $extra = ""){
        $resultJson = Array(
            "api" => $this->lastCall,
            "code" => $returnCode,
            "message" => $returnMessage,
            "data" => $data,
            "extra" => $extra
        );

        return ($resultJson);
    }

    function getData($actionUrl, $request=array()){
        $url = $actionUrl . "?" . http_build_query($request, '', '&');
        $curl_obj = curl_init();
        curl_setopt($curl_obj, CURLOPT_URL, $url);
        curl_setopt($curl_obj, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl_obj, CURLOPT_RETURNTRANSFER, true);
        return  (curl_exec($curl_obj));
    }

    function postData($actionUrl, $postData){
        $curl_obj = curl_init();
        curl_setopt($curl_obj, CURLOPT_URL, $actionUrl);
        curl_setopt($curl_obj, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl_obj, CURLOPT_POST, true);
        curl_setopt($curl_obj, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_obj, CURLOPT_POSTFIELDS, $postData);
        return  (curl_exec($curl_obj));
    }

    function encryptAES($str){
        $res = openssl_encrypt($str, "AES-256-CBC", AES_KEY_256, 0, AES_KEY_256);
        return $res;
    }

    function decryptAES($str){
        $res = openssl_decrypt($str, "AES-256-CBC", AES_KEY_256, 0, AES_KEY_256);
        return $res;
    }

}

?>
