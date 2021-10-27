<?php
namespace App\Safa\Classes;

use App\Safa\Interfaces\Classes\ParseInterface;

class RequestParse implements ParseInterface{

    protected function init($url = null)
    {
        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $this->options() );
        $content = curl_exec( $ch );
        curl_close( $ch );
        return $content;

    }

    public function output(string $url = null): object
    {
        return json_decode($this->init($url));
    }

    protected function options(){
        return array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_USERAGENT      => $_SERVER['HTTP_USER_AGENT'], // who am i
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false,     // Disabled SSL Cert checks
        );
    }

}
