<?php

namespace Babilonia\Infrastructure\JWT;

use Firebase\JWT\JWT;

class TokenGenerator
{
    private $secretKey = '123456';
    private $tokenDurationInMinutes = 30;
    private $hashType = 'HS256';


    public static function generate($data):array
    {
        $tokenGenerator = new TokenGenerator();

        return $tokenGenerator->trueGenerate($data);


    }

    private function trueGenerate($data):array
    {
        return [
            'token' => JWT::encode($this->generatePayload($data), $this->secretKey),
            'duration' => 60*$this->tokenDurationInMinutes,
            'type' => 'Bearer'
        ];
    }

    private function generatePayload($data):array
    {
        return [
            'iss' => 'http://localhost:8000',
            'iat' => time(),
            'exp' => time() + (60*$this->tokenDurationInMinutes),
            'user' => $data
        ];
    }

    public static function getPayload(string $token)
    {
        $tokenGenerator = new TokenGenerator();

        return $tokenGenerator->trueGetPayload($token);
    }

    private function trueGetPayload(string $token)
    {
        return JWT::decode($token, $this->secretKey, [$this->hashType]);
    }
}