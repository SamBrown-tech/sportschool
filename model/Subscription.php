<?php

class Subscription extends Model {

    // Declare properties - The id property is made automatically for every Model
	protected $name;
	protected $price;


	public function __construct(){
	}

	public static function register($name, $price)
	{
		$subscription = new Subscription();
		$subscription->name = $name;
		$subscription->price = $price;

        if ($subscription->save()) {
            return $subscription;
        } else {
            return false;
        }
    }

	protected static function newModel($obj)
	{
		return true;
    }

	// Getters

    public function getName(){
    	return $this->name;
    }

    public function getPrice(){
    	return $this->price;
    }

	// Relations
	public function getUser()
	{
        return $this->hasMany('User');
    }

    // Setters
    public function setName($name) {
      $this->name = $name;
    }
}
?>
