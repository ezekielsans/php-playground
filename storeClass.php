<?php
require_once 'utilitiesClass.php';

class MyStore extends Utilities
{

    private $server = "mysql:host=localhost;dbname=myStore";
    private $user = "root";
    private $pass = "";
    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

    protected $con;

    public function openConnection()
    {

        try {
            $this->con = new PDO($this->server, $this->user, $this->pass, $this->options);
        } catch (PDOException $e) {
            echo "There was an error opening the connection: " . $e->getMessage();
        }

    }
    public function closeConnection()
    {
        $this->con = null;
    }

    public function getUsers()
    {
        //open sql connection
        $this->openConnection();
        //perform native query
        if ($this->con) {
            $stmt = $this->con->prepare("SELECT * FROM members");
            $stmt->execute();

            $users = $stmt->fetchAll();

            $this->closeConnection();

            return $users;

        } else {
            return [];
        }
    }

    public function login()
    {

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = md5($_POST['password']);

            $this->openConnection();
            $statement = $this->con->prepare("SELECT *
                                                  FROM members
                                                  WHERE email =? AND password =?");
            $statement->execute([$email, $password]);
            $user = $statement->fetch();

            $total = $statement->rowCount();

            if ($total > 0) {
                
                echo "<h1 style='text-align:center;margin:3rem'>Welcome {$user['first_name']} {$user['last_name']}!</h1> <br/> <a style='text-align:center;margin:3rem 35rem' href='products.php'>See products<a/> <a style='text-align:center;margin:3rem 35rem' href='logout.php'>logout<a/>";
                header("Location: index.php");
                $this->setUserData($user);
            } else {
                echo "";

            }
            return $total;
        }
    }
    public function setUserData($array)
    {
        if (isset($_SESSION)) {
            session_start();
        }
        $_SESSION['userdata'] = array(
            "fullname" => $array['first_name'] . $array['last_name'],
             "access" => $array['access'],
        );
        return $_SESSION['userdata'];
    }

    public function getUserData()
    {
        if (isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['userdata'])) {
            return $_SESSION['userdata'];
        } else {
            return null;
        }
    }

    public function logout()
    {

        if (isset($_SESSION)) {
            session_start();
        }
        $_SESSION['userdata'] = null;
        unset($_SESSION['userdata']);
    }

    public function checkUserExist($e)
    {

        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $this->openConnection();
        $statement = $this->con->prepare("SELECT *
                                                  FROM members
                                                  WHERE email =?");
        $statement->execute([$email]);
        $total = $statement->rowCount();

        return $total;

    }

    public function addUser()
    {if (isset($_POST['add'])) {

        //declare variables to insert
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $mobileNo = $_POST['mobileNo'];

        if ($this->checkUserExist($email) == 0) {

            $this->openConnection();
            $statement = $this->con->prepare('INSERT INTO members(`email`,`password`,`first_name`,`last_name`,`mobile_no`)
                                              VALUES(?,?,?,?,?)');
            $statement->execute([$email, $password, $firstName, $lastName, $mobileNo]);

        } else {

            echo "<h1>User already exist</h1>";

        }

    }}

    public function checkProductExist($name)
    {

        $this->openConnection();
        $statement = $this->con->prepare("SELECT LOWER('product_name') FROM products WHERE product_name = ?");
        $statement->execute([strtolower($name)]);
        $total = $statement->rowCount();

        return $total;
    }

    public function addProduct()
    {
        if (isset($_POST['addProduct'])) {

            $product_name = $_POST['productName'];
            $product_type = $_POST['productType'];
            $min_stock = $_POST['minStock'];
            echo $product_name, "\n" . $product_type, "\n" . $min_stock;

            if ($this->checkProductExist($product_name) == 0) {

                $this->openConnection();
                $statement = $this->con->prepare("INSERT INTO products (`product_name`, `product_type`, `min_stocks`) VALUES (?,?,?) ");
                $statement->execute([$product_name, $product_type, $min_stock]);

            } else {

                echo "<h1> Product Already Exist</h1>";
            }

        }
    }

    public function getProducts()
    {
        $this->openConnection();
        $statement = $this->con->prepare("SELECT * FROM products");
        $statement->execute();
        $products = $statement->fetchAll();
        $total = $statement->rowCount();

        if ($total > 0) {

            return $products;

        } else {

            return false;
        }

    }

    public function getSingleProduct($id)
    {
        $this->openConnection();
        $statement = $this->con->prepare("SELECT * 
                                          FROM products 
                                          WHERE ID = ?");
        $statement->execute([$id]);
        //query result
        $products = $statement->fetch();
        $total = $statement->rowCount();

        if ($total > 0) {

           
            return $products;
        } else {

            return $this->show404();
        }

    }

    public function addStock()
    {

        if (isset($_POST['add_stock'])) {



            $brand_name = $_POST['brand_name'];
            $product_id = $_POST['product_id'];
            $qty = $_POST['qty'];
            $batch_number = $_POST['batch_number'];
            $added_by = $_POST['added_by'];
        
            $this -> openConnection();
            $statement = $this->con ->prepare('INSERT INTO product_items VALUES(?,?,?,?)');
            $statement->execute([$product_id, $qty, $brand_name,$added_by]);

                //redirect
                header("Location:productDetails.php?id=".$product_id);
        }

    }
}

$store = new MyStore();
