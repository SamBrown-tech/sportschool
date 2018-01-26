<?php

class User extends Model {

    // Declare properties - The id property is made automatically for every Model
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
    protected $iban;
    protected $subscription;
    protected $card;

    public function __construct($username = "")
    {
        if($username != "") {
            $this->username = $username;
        }
    }

    // Login function that asks for varchar parameters and validates
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

    // Asks for all properties that are NN in the database and registers a new user

    public static function register($username, $password, $name, $insertion, $lastname, $birthday, $email, $phone, $street, $house_number, $postal_code, $role, $iban, $subscription) {
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
        $user->iban = $iban;
        $user->subscription = $subscription;

        if ($user->save()) {
            App::setLoggedInUser($user);
            return $user;
        } else {
            return false;
        }
    }

    protected static function newModel($obj)
    {
        $email = $obj->email;
        $existing = User::findBy('email', $email);
        if(count($existing) > 0) return false;

        //Check if user is valid
        return true;
    }

    // Getters

    public function getUsername()
    {
        return $this->username;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getName()
    {
      return $this->name;
    }

    public function getInsertion()
    {
      return $this->insertion;
    }

    public function getLastname()
    {
      return $this->lastname;
    }

    public function getBirthday()
    {
      return $this->birthday;
    }

    public function getEmail()
    {
      return $this->email;
    }

    public function getPhone()
    {
      return $this->phone;
    }

    public function getStreet()
    {
      return $this->street;
    }

    public function getHouse_number()
    {
      return $this->house_number;
    }

    public function getPostal_code()
    {
      return $this->postal_code;
    }

    public function getIban()
    {
      return $this->iban;
    }

    // Relations

    public function getSportSessions()
	{
        return $this->hasMany('SportSession');
    }

    public function getSubscription()
	{
        return $this->belongsTo('Subscription');
    }

    // Setters

    public function setUsername($username)
    {
      $this->username = $username;
    }

    public function setName($name)
    {
      $this->name = $name;
    }

    public function setInsertion($insertion)
    {
      $this->insertion = $insertion;
    }

    public function setLastname($lastname)
    {
      $this->lastname = $lastname;
    }

    public function setBirthday($birthday)
    {
      $this->birthday = $birthday;
    }

    public function setEmail($email)
    {
      $this->email = $email;
    }

    public function setPhone($phone)
    {
      $this->phone = $phone;
    }

    public function setStreet($street)
    {
      $this->street = $street;
    }

    public function setHouse_number($house_number)
    {
      $this->house_number = $house_number;
    }

    public function setPostal_code($postal_code)
    {
      $this->postal_code = $postal_code;
    }

    public function setIban($iban)
    {
      $this->iban = $iban;
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

    // Hashes the password and generates salt

    private function setPassword($password)
    {
        $this->salt = self::generateSalt();
        $this->password = hash('sha256', $password . $this->salt);
    }

    public static function generateSalt()
    {
        return uniqid();
    }

    private function checkPassword($password)
    {
        $hash = hash('sha256', $password . $this->salt);
        return ($hash == $this->password);
    }
}
