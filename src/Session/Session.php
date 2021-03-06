<?php

namespace Talm\Session;

class Session
{
    private $name;

    /**
     * Constructor
     *
     * @param string $name (optional) The name of the session
     * @return void
     */
    public function __construct($name = "DEFAULT_SESSION")
    {
        $this->name = $name;
    }

    /**
     * Start a new session
     * 
     * @return void
     */
    public function start()
    {
        session_name($this->name);

        if (!empty(session_id())) {
            session_destroy();
        }
        session_start();
    }

    /**
     * Check if key exists in session
     *
     * @param string $key
     * @return void
     */
    public function has($key)
    {
        return array_key_exists($key, $_SESSION);
    }

    /**
     * Set a session variable
     *
     * @param string $key The key in session
     * @param mixed $value The value to set $key to
     * @return void
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Return value if exists in session
     *
     * @param string $key The key to get from session
     * @param boolean $default (optional) Return value if not found
     * @return mixed The session variable if exists, else $default
     */
    public function get($key, $default = false)
    {
        return (self::has($key)) ? $_SESSION[$key] : $default;
    }

    /**
     * Destroys the session
     *
     * @return void
     */
    public function destroy()
    {
        session_destroy();
    }

    /**
     * Delete variable from session if exists
     *
     * @param string $key The key to delete from session
     * @return void
     */
    public function delete($key)
    {
        if (self::has($key)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Dump the session
     *
     * @return void
     */
    public function dump()
    {
        var_dump($_SESSION);
    }
}
