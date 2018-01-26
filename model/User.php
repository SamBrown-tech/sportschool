<?php

class User extends Model {

    //protected $id;
    protected $username;
    protected $password;
    protected $salt;
    protected $name;
    protected $insertion;
    protected $lastname;
    protected $birthday;
    protected $email;
    protected $phone;
    protected $street;
    protected $house_number;
    protected $postal_code;
    protected $role;
    protected $card;

    public function __construct($username = "")
    {
        if($username != "") {
            $this->username = $username;
        }
    }

    public static function login($username, $password) {
        $res = User::findBy('username', $username);

        if (count($res) > 0) {
            $user = $res[0];

            if ($user->checkPassword($password)) {
                App::setLoggedInUser($user);
                return $user;
            }
        }
        return false;
    }

    public static function register($username, $password, $name, $insertion, $lastname, $birthday, $email, $phone, $street, $house_number, $postal_code, $role) {
        $user = new User($username);
        $user->setPassword($password);
        $user->name = $name;
        $user->insertion = $insertion;
        $user->lastname = $lastname;
        $user->birthday = $birthday;
        $user->email = $email;
        $user->phone = $phone;
        $user->street = $street;
        $user->house_number = $house_number;
        $user->postal_code = $postal_code;
        $user->role = $role;

        if ($user->save()) {
            App::setLoggedInUser($user);
            return $user;
        } else {
            return false;
        }
    }

    // Relations

    public function getSportSessions()
	{
        return $this->hasMany('SportSession');
    }

    // Setters

    private function setPassword($password)
    {
        $this->salt = self::generateSalt();
        $this->password = hash('sha256', $password . $this->salt);
    }

    public static function generateSalt()
    {
        return uniqid();
    }

    public static function getLoginForm()
    {
        $form = new Form();
        $form->addField(new FormField("username", "text", "username"));

        return $form->getHTML();
    }

    protected static function newModel($obj)
    {
        $email = $obj->email;
        $existing = User::findBy('email', $email);
        if(count($existing) > 0) return false;

        //Check if user is valid
        return true;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $possible = ['user', 'admin', 'customer'];
        if (array_search($role, $possible)) {
            $this->role = $role;
            return true;
        }
        return false;
    }

    private function checkPassword($password)
    {
        $hash = hash('sha256', $password . $this->salt);
        return ($hash == $this->password);
    }
}
