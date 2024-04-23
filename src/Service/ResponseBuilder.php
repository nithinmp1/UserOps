<?php

namespace App\Service;

class ResponseBuilder
{
    private $jsonData;
    private $config;
    private $filesystem;

    public function __construct($config, $filesystem)
    {
        $this->filesystem = $filesystem;
        $this->config = $config;
    }

    function create($message) {

        $this->loadTPL();

        $this->render($message);

        return $this->jsonData; 
    }

    function render($message) {
        $this->jsonData->status = str_replace("{{status}}", $message['status'], $this->jsonData->status);
        $this->jsonData->message = str_replace("{{message}}", $message['message'], $this->jsonData->message);
        $this->jsonData->data = str_replace("{{data}}", json_encode(isset( $message['data'])?$message['data']:[]), $this->jsonData->data);
        $this->jsonData->metadata->timestamp = str_replace("CURRENTTIMESTAMP", date($this->config['date_format'], time()), $this->jsonData->metadata->timestamp);
        $this->jsonData->metadata->version = str_replace("VERSION", $this->config['version'], $this->jsonData->metadata->version);
    }
    private function loadTPL(){
        $contents = '';
        if ($this->filesystem->fileExists($this->config['response_template'])) {
            $contents = $this->filesystem->read($this->config['response_template']);
        }
        
        $this->jsonData = json_decode($contents);
    }
}
