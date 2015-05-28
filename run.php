<?php
/**
 * Class Tester
 */
class Tester
{
    public $response = null;
    public $httpCode = 0;
    public $url = null;

    /**
     * @param $url
     * @param $params
     * @return array
     */
    public function send($url, $params)
    {

        $request = $this->url . $url;
        // Generate curl request
        $session = curl_init($request);
        // Tell curl to use HTTP POST
        $userAgent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.81 Safari/537.36';
        curl_setopt($session, CURLOPT_USERAGENT, $userAgent );
        curl_setopt($session, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($session, CURLOPT_POST, true);
        // Tell curl that this is the body of the POST
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
        return  strpos($this->response, $text);
    }

    /**
     * Get json string
     * @param $params
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
        return $code === $this->httpCode;
    }

    /**
     * @param $url
     */
    public function setUrl($url)
    {
        $this->url  = $url;
    }
}

$tester = new \Tester();
$tester->setUrl('http://betfaq.re');
$tester->send('/profile/login/', [
    'email' => 'prototypenk@gmail.com',
    'password'  => 123456786,
]);
//
$tester->seeText('Ваш аккаунт');
echo $tester->seeResponseCode(200);

$tester->send('/dsdsd', []);
echo $tester->seeResponseCode(404);


$bb = $tester->send('/subscribe/save/', [
    'email' => 'dssd' . rand(100, 1000).'@mail.ru',
]);

$tester->seeText('{"model":{"error":false,"message"');
$res = preg_match('~\{(?:[^{}]|(?R))*\}~',  $bb[0], $responce);
print_r(json_decode($responce[0], true));



//print_r(json_decode($ndfd[0]));
//print_r($tester->send('/vip', []));
//echo $tester->seeText('Прогнозы на футбол, теннис и хоккей');
