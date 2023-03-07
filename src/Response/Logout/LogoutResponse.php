<?php

namespace LeDevoir\PianoIdApiSDK\Response\Logout;

use LeDevoir\PianoIdApiSDK\Response\PianoIdResponse;

class LogoutResponse extends PianoIdResponse
{
    public string $jti;

    /**
     * @return string
     */
    public function getJti(): string
    {
        return $this->jti;
    }

    /**
     * @param string $jti
     * @return LogoutResponse
     */
    public function setJti(string $jti): LogoutResponse
    {
        $this->jti = $jti;
        return $this;
    }
}