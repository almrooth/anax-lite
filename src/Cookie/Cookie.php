<?php

namespace Talm\Cookie;

class Cookie
{
    private $expire;

    public function __construct($time = 86400*30)
    {
        $this->expire = time() + $time;
    }

    public function has($key)
    {
        return array_key_exists($key, $_COOKIE);
    }

    public function set($key, $value)
    {
        setcookie($key, $value, $this->expire);
    }

    public function get($key, $default = false)
    {
        return (self::has($key)) ? $_COOKIE[$key] : $default;
    }

    public function delete($key)
    {
        if (self::has($key)) {
            unset($_COOKIE[$key]);
        }
    }

    public function dump()
    {
        var_dump($_COOKIE);
    }

    public function destroy()
    {
        foreach ($_COOKIE as $key => $value) {
            setcookie($key, $value, time()-3600);
        }
    }
}
