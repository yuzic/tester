<?php
/**
 * Class Tester
 */
class Tester
{
    public $response = null;
    public $httpCode = 0;
    public $url = null;
    public $urlLast = null;

    /**
     * Посылаем запросы на сервер
     * @param string  $url
     * @param array $params
     * @param bool $isGet
     * @return array
     */
    public function send($url, $params = [], $isGet = false)
    {
        $this->urlLast = $url;
        $request = 'http://' . $this->url . $url;
        // Generate curl request
        $session = curl_init($request);
        // Tell curl to use HTTP POST
        $userAgent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.81 Safari/537.36';
        curl_setopt($session, CURLOPT_USERAGENT, $userAgent );
        curl_setopt($session, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($session, CURLOPT_POST, true);
        // Tell curl that this is the body of the POST
        if ($isGet) {
            curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'GET');
        }
        curl_setopt($session, CURLOPT_POSTFIELDS, $params);
        // Tell curl not to return headers, but do return the response
        curl_setopt($session, CURLOPT_HEADER, false);
        // Tell PHP not to use SSLv3 (instead opting for TLS)
        //curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        // obtain response
        $response = curl_exec($session);
        $httpcode = curl_getinfo($session, CURLINFO_HTTP_CODE);
        curl_close($session);

        $this->response = $response;
        $this->httpCode = $httpcode;

        return [$response, $httpcode];
    }

    /**
     * Search string
     * @param $text
     * @return bool|int
     */
    public function seeText($text)
    {
        return  $this->stdout(strpos($this->response, $text));
    }

    /**
     * Get json string
     * @param $params
     * @return bool
     */
    public function seeJson($params)
    {
        preg_match('~\{(?:[^{}]|(?R))*\}~',  $this->response, $jsonText);
        $json = json_encode($jsonText, true);
        $isTrue = true;
        foreach ($params as $key  => $val) {
            if ($params[$key] !== $json[$key]) {
                $isTrue = false;
            }
        }

        return $isTrue;
    }

    /**
     * Get Http code Status
     * @param int $code
     */
    public function seeResponseCode($code)
    {
        return $this->stdout($code === $this->httpCode, ' -- status: '.$code);
    }

    /**
     * @param $url
     */
    public function setUrl($url)
    {
        $this->url  = $url;
    }

    public function stdout($bool, $status = null)
    {
        $lengthSpace = 90 - strlen($this->urlLast . $status);
        if ($bool > 0){
            Helper_Console::stdoutColor($this->urlLast . $status . str_repeat(' ', $lengthSpace) ."Ok\n", 32);
        } else {
            Helper_Console::stdoutColor($this->urlLast . $status . str_repeat(' ', $lengthSpace) . "Fail\n", Helper_Console::FG_RED);
        }

    }
}