# Introduction
Please take note that __This is not a fully functional MVC!__

# Setting up the environment
When you set up a new website, follow these steps.

#### Create a database
You should first create an empty database. Remember the name.

#### Configure your connection
You now have a database. Go to the `core/DB.php` file and edit the following variables to match your database:
```php
private $servername = "localhost";
private $username = "";
private $password = "";
private $database = "";
```

Just... \*sigh\*. Just edit the connection info. Don't do anything else with this file. The Model and App class use it.




#### Userdetails
```php
__username - password__;
santino = user1234;
user2 = user1234;
benno = admin123;
```
