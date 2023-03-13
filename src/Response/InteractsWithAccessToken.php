<?php

namespace LeDevoir\PianoIdApiSDK\Response;

trait InteractsWithAccessToken
{
    public string $accessToken = '';
    public string $tokenType = '';
    public string $refreshToken = '';
    public int $expiresIn = 0;
    public bool $emailConfirmationRequired = false;
    public bool $extendExpiredAccessEnabled = false;
    public bool $registration = false;

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     * @return InteractsWithAccessToken
     */
    public function setAccessToken(string $accessToken): static
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    /**
     * @param string $tokenType
     * @return InteractsWithAccessToken
     */
    public function setTokenType(string $tokenType): static
    {
        $this->tokenType = $tokenType;
        return $this;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    /**
     * @param string $refreshToken
     * @return InteractsWithAccessToken
     */
    public function setRefreshToken(string $refreshToken): static
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    /**
     * @param int $expiresIn
     * @return InteractsWithAccessToken
     */
    public function setExpiresIn(int $expiresIn): static
    {
        $this->expiresIn = $expiresIn;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEmailConfirmationRequired(): bool
    {
        return $this->emailConfirmationRequired;
    }

    /**
     * @param bool $emailConfirmationRequired
     * @return InteractsWithAccessToken
     */
    public function setEmailConfirmationRequired(bool $emailConfirmationRequired): static
    {
        $this->emailConfirmationRequired = $emailConfirmationRequired;
        return $this;
    }

    /**
     * @return bool
     */
    public function isExtendExpiredAccessEnabled(): bool
    {
        return $this->extendExpiredAccessEnabled;
    }

    /**
     * @param bool $extendExpiredAccessEnabled
     * @return InteractsWithAccessToken
     */
    public function setExtendExpiredAccessEnabled(bool $extendExpiredAccessEnabled): static
    {
        $this->extendExpiredAccessEnabled = $extendExpiredAccessEnabled;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRegistration(): bool
    {
        return $this->registration;
    }

    /**
     * @param bool $registration
     * @return InteractsWithAccessToken
     */
    public function setRegistration(bool $registration): static
    {
        $this->registration = $registration;
        return $this;
    }
}