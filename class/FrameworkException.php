<?php

/**
 * Created by PhpStorm.
 * User: santino
 * Date: 18-10-17
 * Time: 9:51
 */
class FrameworkException extends Exception
{

    public static function errorInit()
    {
        //Also catch errors
        function exception_error_handler($errno = "", $errstr = "", $errfile = "", $errline = "")
        {
            echo FrameworkException::fatalError($errno, $errstr, $errfile, $errline);
            die();
        }

        set_error_handler("exception_error_handler");

        function fatal_handler()
        {

            $error = error_get_last();

            if ($error !== NULL && array_search($error["type"], [E_ERROR, E_COMPILE_ERROR, E_CORE_ERROR]) !== false) {
                $errno = $error["type"];
                $errfile = $error["file"];
                $errline = $error["line"];
                $errstr = $error["message"];

                echo FrameworkException::fatalError($errno, $errstr, $errfile, $errline);
                die();
            }
        }

        register_shutdown_function("fatal_handler");
    }

    public static function fatalError($errno, $errstr, $errfile, $errline)
    {
        return self::message($errstr, [['file' => $errfile, 'line' => $errline]]);
    }

    public static function message($errstr, $traces = [])
    {
        $error = "<div class=exception>";
        $error .= "<div class=innerException>";

        $error .= "<h1>An exception occured</h1>";
        if (App::DEBUGGING) {
            $error .= "<h2>" . $errstr . "</h2>";

            $error .= "<div class=stacktrace>";
            $error .= "<h3>stacktrace:</h3>";


            foreach ($traces as $trace) {
                $filepath = explode("/", $trace['file']);
                $file = end($filepath);
                $line = $trace['line'];
                $func = isset($trace['function']) ? $trace['function'] : false;
                $args = isset($trace['args']) ? $trace['args'] : [];

                $error .= "<div class=trace>";

                $error .= "call to ";
                if ($func !== false) {
                    $error .= "<b>" . $func . "(";
                    foreach ($args as $arg) {
                        if ($arg !== $args[0]) {
                            $error .= ", ";
                        }
                        $error .= var_export($arg, true);
                    }
                    $error .= ")</b> in ";
                }

                $error .= "<b>" . $file . " : " . $line . "</b>";
                $error .= "</div>";
            }

            $error .= "</div>";
        }
        $error .= "</div>";
        $error .= "</div>";

        return $error;
    }

    public function errorMessage()
    {
        //error message
//        $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
//            .': <b>'.$this->getMessage().'</b>';
        return self::message($this->getMessage(), $this->getTrace());

    }
}
