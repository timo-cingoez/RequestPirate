<?php

/**
 * Class RequestPirate
 * @author Timo Cingöz <timo-cingoez@hotmail.de>
 */
class RequestPirate {
    /**
     * Validate and return the $_GET value for the given key.
     * @param $key
     * @param null $default
     * @param null $validator
     * @return mixed
     */
    public static function get($key, $default = null, $validator = null) {
        $value = $_GET[$key] ?? $default;
        return self::validate($value, $validator);
    }

    /**
     * Validate and return the $_POST value for the given key.
     * @param $key
     * @param null $default
     * @param null $validator
     * @return mixed
     */
    public static function post($key, $default = null, $validator = null) {
        $value = $_POST[$key] ?? $default;
        return self::validate($value, $validator);
    }

    /**
     * Validate and return the $_REQUEST value for the given key.
     * @param $key
     * @param null $default
     * @param null $validator
     * @return mixed
     */
    public static function request($key, $default = null, $validator = null) {
        $value = $_REQUEST[$key] ?? $default;
        return self::validate($value, $validator);
    }

    /**
     * Validate a value based on the validator.
     * @param mixed $value
     * @param mixed $validator filter_list()|is_string(), ...
     * @return mixed
     */
    protected static function validate($value, $validator) {
        if ($validator) {
            if (is_callable($validator)) {
                return $validator($value);
            }
            if (is_string($validator)) {
                $value = filter_var($value, $validator);
            }
        }
        return $value;
    }
}
