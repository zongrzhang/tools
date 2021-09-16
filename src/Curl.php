<?php

namespace Zongrzhang\Tools;

class Curl
{
    protected $ch;

    protected static $instance;
    protected $options = [
        CURLOPT_TIMEOUT => 20,
        CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_RETURNTRANSFER => 5
    ];

    private function __construct()
    {
        $this->ch = curl_init();
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get($url)
    {
        if (strlen($url) > 5 && strtolower(substr($url, 0, 5)) == "https") {
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        $this->options[CURLOPT_URL] = $url;
        $this->options[CURLOPT_HTTPGET] = 1;

        return $this;
    }

    public function post($url, $params = null)
    {
        if (strlen($url) > 5 && strtolower(substr($url, 0, 5)) == "https") {
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        $this->options[CURLOPT_URL] = $url;
        $this->options[CURLOPT_POST] = 1;

        if ($params != null) {
            if (is_array($params) || is_object($params)) {
                $this->options[CURLOPT_POSTFIELDS] = http_build_query($params);
            } else {
                $this->options[CURLOPT_POSTFIELDS] = $params;
            }
        }

        return $this;
    }

    public function delete($url, $params = null)
    {
        if (strlen($url) > 5 && strtolower(substr($url, 0, 5)) == "https") {
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        $this->options[CURLOPT_URL] = $url;
        $this->options[CURLOPT_CUSTOMREQUEST] = "DELETE";

        if ($params != null) {
            if (is_array($params) || is_object($params)) {
                $this->options[CURLOPT_POSTFIELDS] = http_build_query($params);
            } else {
                $this->options[CURLOPT_POSTFIELDS] = $params;
            }
        }

        return $this;
    }

    public function postJson($url, $params = null)
    {
        $this->options[CURLOPT_URL] = $url;
        $this->options[CURLOPT_POST] = 1;
        if (strlen($url) > 5 && strtolower(substr($url, 0, 5)) == "https") {
            $this->options[CURLOPT_SSL_VERIFYPEER] = false;
            $this->options[CURLOPT_SSL_VERIFYHOST] = false;
        }

        if ($params != null) {
            if (is_array($params) || is_object($params)) {
                $this->options[CURLOPT_POSTFIELDS] = json_encode($params, JSON_UNESCAPED_UNICODE);
            } else {
                $this->options[CURLOPT_POSTFIELDS] = $params;
            }
        }

        return $this;
    }

    public function setOption($option, $value)
    {
        $this->options[$option] = $value;

        return $this;
    }

    public function send()
    {
        curl_setopt_array($this->ch, $this->options);
        $response = curl_exec($this->ch);

        $httpStatusCode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        if (200 !== $httpStatusCode) {
            return false;
        }

        return Json::decode($response);
    }

    public function __destruct()
    {
        curl_close($this->ch);
    }
}