<?php
/**
 * API Library for EXPERIAN reports.
 * User: Samuel Irwin
 * Date: 28/08/2021
 * Time: 4:34 AM
 */

namespace SamuelIrwin\Experian;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class ExperianApi
{
    private $username;
    private $password;
    private $serviceURL;


    public function __construct($username, $password, $serviceUrl) {
        $this->username     =   $username;
        $this->password     =   $password;
        $this->serviceURL   =   $serviceUrl;
    }

    public function generateJSONFromArray($data)
    {
        $format = [
            'request' => $data
        ];
        
        return json_encode($format);
    }

    public function getReport($requestXML, $command='report', $sendXML=true)
    {
        $client     =   new Client(['verify' => false]);

        $response =  $client->post(
            $this->serviceURL . '/' . $command,
            [
                'auth'      =>  [$this->username, $this->password],
                'headers'   =>  [
                    'Content-Type'  =>  'application/xml',
                    'Accept'        =>  'application/xml',
                ],
                'body'      =>  $requestXML,
                'debug'     =>  false
            ]
        );
        //Hey Siri, can you make this useful?
        if ($response->getStatusCode() != 200)
        {
            return false;
        }
        $xml        =   simplexml_load_string($response->getBody()->getContents());
        if ($sendXML)
        {
            return $xml->asXML();
        }
        $json       =   json_encode($xml);
        $reportData =   ($sendXML) ? $json : json_decode($json,true);

        return $reportData;

    }

    public function getJSONReport($requestJSON, $command='json', $sendJSON=true)
    {
        $client     =   new Client(['verify' => false]);

        $response =  $client->post(
            $this->serviceURL . '/' . $command,
            [
                'auth'      =>  [$this->username, $this->password],
                'headers'   =>  [
                    'Content-Type'  =>  'application/json',
                    'Accept'        =>  'application/json',
                ],
                'body'      =>  $requestJSON,
                'debug'     =>  false
            ]
        );
        //Hey Siri, can you make this useful?
        if ($response->getStatusCode() != 200)
        {
            return false;
        }

        
        $json = $response->getBody()->getContents();

        $reportData =   ($sendJSON) ? $json : json_decode($json,true);

        return $reportData;

    }

}