<?php

namespace Core\View;

class View
{


    public static function make($view, $params = [])

    {


        $baseContent = self::getBaseContent(); // get layouts app

        $viewContent = self::getViewContent($view, params: $params);

        return str_replace("{{content}}", $viewContent, $baseContent);
    }




    //----------------------------------------------------

    protected static function getBaseContent()
    {

        $base_content_path =  view_path()  . "layouts" . DS . "app.blade.php";
        return include_file($base_content_path);

    }
    //----------------------------------------------------

    protected static function getViewContent($view, $is_error = false, $params = [])
    {


        $path_view_content = '';

        if ($is_error) {
            $path_view_content = view_path() . "errors" . DS . '404.blade.php';
        } else {
            $path_view_content = self::handelPathViewContainDot($view);
        }




        return include_file($path_view_content,$params);



    }

    //----------------------------------------------------


    protected static function handelPathViewContainDot($view)
    {

        if (str_contains($view, '.')) {
            $view_path = explode(".", $view);

            $to_path = '';
            foreach ($view_path as $index => $view) {

                $to_path = ($index !== array_key_last($view_path)) ? $to_path . $view . DS : $to_path . $view;
            }

            $path_view_content =  view_path() .  $to_path . ".blade.php";
        } else {
            $path_view_content = view_path() .  $view . ".blade.php";
        }

        return $path_view_content;
    }
    //----------------------------------------------------
    //----------------------------------------------------
    //----------------------------------------------------
    //----------------------------------------------------

}
