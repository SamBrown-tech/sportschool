<?php

/**
 * Created by PhpStorm.
 * User: santino
 * Date: 30-3-17
 * Time: 10:57
 */
class App
{

    const ROLE_GUEST = "guest";
    const ROLE_USER = "user";
    const ROLE_ADMIN = "admin";
    const DEBUGGING = true;
    public static $user;

    public static function addError($error){
        self::initErrors();
        array_push($_SESSION['errors'], self::calledBy() . "|". $error);
    }

    private static function initErrors()
    {
        if (!isset($_SESSION['errors'])) {
            $_SESSION['errors'] = [];
        }
    }

    public static function calledBy()
    {
        $trace = debug_backtrace();
        if (count($trace) > 2 && isset($trace[2]['class'])) {
            return $trace[2]['class'];
        }
        else {
            return "page";
        }
    }

    public static function displayErrors(){
        self::initErrors();
        if(!self::hasErrors()){
            return false;
        }
        $html = "";
        foreach (self::getErrors() as $error){
            $html .= "<div class='error' onclick='this.style.visibility = \"hidden\"'>" . explode("|", $error)[1] . "</div>";
        }
        echo $html;
    }

    public static function hasErrors()
    {
        self::initErrors();
        return count($_SESSION['errors']) > 0;
    }

    public static function getErrors()
    {
        self::initErrors();
        $errors = $_SESSION['errors'];
        $_SESSION['errors'] = [];
        return $errors;
    }

    public static function setLoggedInUser($user){
        try {
            if (get_class($user) !== "User") throw new FrameworkException("Supplied variable is not of type User");
            try {
                $_SESSION['id'] = $user->getId();
            } catch (Exception $e) {
                throw new FrameworkException("supplied user is not saved in the database");
            }
            $_SESSION['role'] = $user->getRole();
            self::$user = $user;
        } catch (FrameworkException $e) {
            echo $e->errorMessage();
            die();
        }
    }

    public static function logoutUser(){
        self::$user = null;
        unset($_SESSION['id']);
    }

    public static function getUser(){
        if(!isset($_SESSION['id'])) return false;
        if(!isset(self::$user)){
            self::$user = User::findById($_SESSION['id']);
        }
        return self::$user;
    }

    public static function redirect($page){
        try {
            if (!file_exists("pages/$page.php")) {
                throw new FrameworkException("The page " . $page . " does not exist");
            }
            header("location: ?page=$page");
            die();
        } catch (FrameworkException $e) {
            echo $e->errorMessage();
            die();
        }
    }

    public static function refresh(){
        header("location: ?page=" . self::currentPage());
        die();
    }

    public static function currentPage()
    {
        $actualLink = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        return explode("&", explode("page=", $actualLink)[1])[0];
    }

    public static function link($page){
        try {
            $p = explode("&", $page)[0];
            if (!file_exists("pages/$p.php")) {
                throw new FrameworkException("Page $p does not exist");
            }
            return ' href="?page=' . $page . '" ';
        } catch (FrameworkException $e) {
            echo $e->errorMessage();
            die();
        }
    }

    public static function addFormPopup($title, $form)
    {
        return "document.body.innerHTML += '" . str_replace("'", "\\'", App::formPopup($title, $form)) . "'";
    }

    public static function formPopup($title, $form)
    {
        $popup = "<div class='modal' onclick='this.remove();'>";
        $popup .=   "<div class='popup' onclick='event.stopPropagation()'>";
        $popup .=       "<h1>$title</h1>";
        $popup .=       "<i class='fa fa-times closeCross' onclick='this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode)'></i>";
        $popup .=       "<div class='content'>";

        $popup .=           $form->getHTML();

        $popup .=       "</div>";
        $popup .=   "</div>";
        $popup .= "</div>";
        return $popup;
    }

    public static function camelToNormal($string){
        $newStr = "";
        foreach (str_split($string) as $char){
            $newStr .= (strtolower($char) == $char ? $char : " " . strtolower($char));
        }
        return $newStr;
    }

}
