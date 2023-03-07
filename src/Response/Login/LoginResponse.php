<?php

namespace LeDevoir\PianoIdApiSDK\Response\Login;

use LeDevoir\PianoIdApiSDK\Response\InteractsWithAccessToken;
use LeDevoir\PianoIdApiSDK\Response\PianoIdResponse;

final class LoginResponse extends PianoIdResponse
{
    use InteractsWithAccessToken;
}