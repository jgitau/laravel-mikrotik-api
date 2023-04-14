<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Http;
use App\Models\Setting;

class Tiny
{
    private $tinyHost = "http://localhost";
    private $tinyPort;
    private $url;

    private $internalErr = 'Something went wrong. Please try again later';
    private $routerosPermissionsError = 'Not Enough Permissions';
    private $duplicateError = 'Already Exists';
    private $headers;
    private $options = ['timeout' => 20];

    public function __construct()
    {
        $this->tinyPort = env('MGL_TINY_PORT', '');
        $this->url = $this->tinyHost . ':' . $this->tinyPort;
        $this->headers = $this->buildHeaders();
    }

    public function getJson($endpoint)
    {
        $response = Http::withHeaders($this->headers)->get($this->url . $endpoint, $this->options);

        return $this->processReply($response);
    }

    public function postJson($endpoint, $data)
    {
        $response = Http::withHeaders($this->headers)->post($this->url . $endpoint, $data, $this->options);

        return $this->processReply($response);
    }

    public function putJson($endpoint, $data)
    {
        $response = Http::withHeaders($this->headers)->put($this->url . $endpoint, $data, $this->options);

        return $this->processReply($response);
    }

    public function delete($endpoint)
    {
        $response = Http::withHeaders($this->headers)->delete($this->url . $endpoint, $this->options);

        return $this->processReply($response);
    }

    private function processReply($response)
    {
        $statusCode = $response->status();

        if ($statusCode == 500) {
            $body = $response->body();
            if (strpos($body, $this->routerosPermissionsError) === true) {
                $error = 'Please check your username permissions';
            } elseif (strpos($body, $this->duplicateError) === true) {
                $error = 'Item already exists';
            } else {
                $error = $body;
            }
            return ['error' => $error, 'status_code' => $statusCode];
        } elseif ($statusCode == 400) {
            $error = 'Validation error';
            return ['error' => $error, 'status_code' => $statusCode];
        }

        return ['body' => json_decode($response->body()), 'status_code' => $statusCode];
    }

    private function buildHeaders()
    {
        $mikrotikIp = Setting::where('key', 'mikrotik_ip')->first()->value ?? '0';
        $mikrotikApiPort = Setting::where('key', 'mikrotik_api_port')->first()->value ?? '0';
        $mikrotikApiUsername = Setting::where('key', 'mikrotik_api_username')->first()->value ?? '0';
        $mikrotikApiPassword = Setting::where('key', 'mikrotik_api_password')->first()->value ?? '0';

        return [
            'Mikrotik-IP' => $mikrotikIp,
            'Mikrotik-API-Port' => $mikrotikApiPort,
            'Mikrotik-API-Username' => $mikrotikApiUsername,
            'Mikrotik-API-Password' => $mikrotikApiPassword
        ];
    }
}
