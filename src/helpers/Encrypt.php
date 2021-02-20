<?php 
class ClsEncrypt{
    public function EncryptData($data, $key) {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('blowfish'));
        $cifrado = openssl_encrypt($data, 'blowfish', $key, 0, $iv);
        return base64_encode($cifrado . '|||' . $iv);
    }
    public function DecryptData($data, $key) {
        $dataIv = explode('|||', base64_decode($data), 2);
        if(count($dataIv) != 2) {
            return false;
        }
        $data = $dataIv[0];
        $iv =  $dataIv[1];
        if(strlen($iv) != openssl_cipher_iv_length('blowfish')) {
            return false;
        }
        return openssl_decrypt($data, 'blowfish', $key, 0, $iv);
    }
}