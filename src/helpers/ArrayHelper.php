<?php

namespace Core\helpers;

use ArrayAccess;

class ArrayHelper
{

    public static function only(array $array,  $keys)
    {

        return array_intersect_key($array, array_flip((array) $keys));
    }


    // ---------------------------------------------------

    public static function accessible($value)
    {
        // return is_array($value) ;
        return is_array($value) || $value instanceof ArrayAccess;
    }


    // ---------------------------------------------------

    public static function exists($array, $key)
    {

        if ($array instanceof ArrayAccess) {
            return $array->offsetExists($key);
        }


        return array_key_exists($key, $array);
    }
    // ---------------------------------------------------


    public static function has($array, $keys)
    {
        // he doing that for "config.database.dbconnection......"

        if (is_null($keys)) {
            return false;
        }

        //-----cast key to array---

        $keys = (array) $keys;

        if (empty($keys)) {
            return false;
        }


        $sub_array = $array;

        foreach ($keys as $key) {

            if (static::exists($array, $key)) {
                /**
                 * check if found in first kyes 
                 * like search(key2) => [ 'key1' => [],'key2 => []]
                 * if found continue
                 * mean stop this loop and next loop.
                 */
                continue;
            }

            //---------------else----------

            //------explode the key value if has separetior

            foreach (explode(".", $key) as $subkey) {

                //--------------check the key if exixt to check inside him
                //--------------fuckink mr:shelby---- canot forget this error take 2 hours &&

                if (static::accessible($sub_array) && static::exists($sub_array, $subkey)) {
                    $sub_array = $sub_array[$subkey];
                } else {
                    return false;
                }
            }
        }

        return true;
    } //-end of method has


    // ------------------------------------------

    public static function last(array $array, callable $callback = null, $default = null)
    {

        if (is_null($callback)) {
            return empty($array) ? value($default) : end($array);
        }

        return self::first(array_reverse($array), $callback);
    }
    // ------------------------------------------d

    public static function first(array $array, callable $callback = null, $default = null)
    {

        if (is_null($callback)) {
            if (empty($array)) {
                return value($default);
            }


            foreach ($array as $key => $value) {
                return  $value;
            }
        }

        foreach ($array as $key => $value) {

            if (call_user_func($callback, $value, $key)) {

                return  $value;
            }
        }


        return value($default);
    }

    // ------------------------------------------d

    public static function forget(&$array, $keys)

    {

        $orginal = &$array;

        $keys = (array)$keys;

        if (!count($keys)) {
            return false;
        }


        foreach ($keys as $key) {

            if (self::exists($array, $key)) {
                unset($array[$key]);

                continue;
            }


            $parts = explode('.', $key);



            while (count($parts) > 1) {

                $part = array_shift($parts);

                if (isset($array[$part]) && is_array($array[$part])) {
                    $array = &$array[$part];
                } else {

                    continue;
                }
            }

            //when count equal 1 its meean this the last unset it

            unset($array[array_shift($parts)]);
        }

        return $orginal;
    }
    // ------------------------------------------d

    public static function except($array, $keys)
    {
        return static::forget($array, $keys);
    }
    // ------------------------------------------d
    // ------------------------------------------d

    public static function flatten($array, $depth = INF)
    {
        $result = [];

        foreach ($array as $item) {
            if (!is_array(($item))) {
                $result[] = $item;
            } elseif ($depth == 1) {
                $result = array_merge($result, array_values($item));
            } else {
                $result = array_merge($result, static::flatten($item, $depth - 1));
            }
        }

        return $result;
    }

    // ------------------------------------------d

    public static function set($array, $key, $value)
    {

        $orginal = &$array;

        if (!static::accessible($array)) {
            //---its not array
            return $array;
        }

        if (static::exists($array, $key)) {
            $array[$key] = value($value);

            return $array;
        }


        if (is_null($key)) {
            return $array;
        }


        if (!str_contains($key, '.')) {
            return $array[$key] ? $array[$key] = value($value) : $array;
        }

      


        $parts = explode(".", $key);

        while (count($parts) > 1) {
            $part = array_shift($parts);

            if (isset($array[$part]) && is_array($array[$part])) {
                $array = &$array[$part];
            } else {

                continue;
            }
        }
        

        $elpart = array_shift($parts);

        if(isset($array[$elpart])){
            $array[$elpart] = $value;
        }

       
        return $array;

    }
    // ------------------------------------------d

    public static function get($array, $key, $default = null)
    {
        if (!static::accessible($array)) {
            //---its not array
            return value($default);
        }

        if (static::exists($array, $key)) {
            return $array[$key];
        }


        if (is_null($key)) {
            return $array;
        }


        if (!str_contains($key, '.')) {
            return $array[$key] ?? value($default);
        }

        foreach (explode(".", $key) as $part) {
            if (static::accessible($array[$part]) && static::exists($array, $part)) {
                $array = $array[$part];
            } else {
                return value($default);
            }
        }

        return $array;
    }
    // ------------------------------------------d


    public static function unset($array,$key)
    {
       return static::set($array,$key,null);
    }

    // ------------------------------------------d
    // ------------------------------------------d



} //---------end of classs
