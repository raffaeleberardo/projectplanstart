<?php

class Security{

  private $key;

  public function __construct(){
    //creare chiave sicura
    $key = openssl_random_pseudo_bytes (32);
  }

  public function encryptMessage($message){
    $encrypt = openssl_encrypt($message , 'AES256' , $key);
    return $encrypt;
  }

  public function decryptMessage($encryptedMessage){
    $plaintext = openssl_decrypt($encryptedMessage, 'AES256', $key);
    return $plaintext;
  }
}
