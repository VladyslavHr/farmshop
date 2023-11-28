<?php

namespace  App\Http\Classes;

use Illuminate\Support\ServiceProvider;
use App\Models\{User};


class UserCrypt extends ServiceProvider
{
    public static function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public static function base64_encode_url($string) {
        return str_replace(['+','/','='], ['-','_',''], base64_encode($string));
    }

    public static function base64_decode_url($string) {
        return base64_decode(str_replace(['-','_'], ['+','/'], $string));
    }

    public static function encryptedId($orderId)
    {
        $textToEncrypt = $orderId;
        $password = '3sc3RLrpd17WF';
        $key = substr(hash('sha256', $password, true), 0, 32);
        $cipher = 'aes-256-gcm';
        $iv_len = openssl_cipher_iv_length($cipher);
        $tag_length = 16;
        $iv = openssl_random_pseudo_bytes($iv_len);
        $tag = ""; // will be filled by openssl_encrypt

        $ciphertext = openssl_encrypt($textToEncrypt, $cipher, $key, OPENSSL_RAW_DATA, $iv, $tag, "", $tag_length);
        $encrypted = self::base64_encode_url($iv.$ciphertext.$tag);

        // dump($encrypted);

        return $encrypted;
    }

    public static function decriptedId($encrypted)
    {
        $textToDecrypt = $encrypted;
        $encrypted = self::base64_decode_url($textToDecrypt);
        $password = '3sc3RLrpd17WF';
        $key = substr(hash('sha256', $password, true), 0, 32);
        $cipher = 'aes-256-gcm';
        $iv_len = openssl_cipher_iv_length($cipher);
        $tag_length = 16;
        $iv = substr($encrypted, 0, $iv_len);
        $ciphertext = substr($encrypted, $iv_len, -$tag_length);
        $tag = substr($encrypted, -$tag_length);

        $decrypted = openssl_decrypt($ciphertext, $cipher, $key, OPENSSL_RAW_DATA, $iv, $tag);

        // dd($decrypted);

        return $decrypted;
    }
}
