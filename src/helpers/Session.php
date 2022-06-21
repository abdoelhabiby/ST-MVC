<?php

namespace Core\helpers;

class Session
{

    protected const FLASH_KEY = "messages_flash";

    public function __construct()
    {
        $messages_flash = $_SESSION[self::FLASH_KEY] ?? [];

        foreach ($messages_flash as $key =>  $values) {

            $messages_flash[$key]['previos'] = true;
        }


        $_SESSION[self::FLASH_KEY] =  $messages_flash ?? [];
    }



    public function flash($key, $value)
    {

        $_SESSION[self::FLASH_KEY][$key] = ['previos' => false, 'value' => $value];

        $flashes = $_SESSION[self::FLASH_KEY] ?? [];

        // dd($flashes);

    }



    public function __destruct()
    {
        $messages_flash = $_SESSION[self::FLASH_KEY] ?? [];

        foreach ($messages_flash as $key =>  $values) {

            if($messages_flash[$key]['previos'] == true ){
                
              unset($messages_flash[$key]);
            }
        }

        $_SESSION[self::FLASH_KEY] =  $messages_flash ?? [];
        


    }




}
