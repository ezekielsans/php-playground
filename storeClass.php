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
            //get user details
            $user = $statement->fetch();
            //get count
            $total = $statement->rowCount();

            //checker if user exist
            if ($total > 0) {

                //echo "<h1>{$user['first_name']} {$user['last_name']}</h1>";
                $this->setUserData($user);
                header("Location: index.php");
            } else {
                echo "<h1>No email exist</h1>";

            }

            return $total;
        }
    }
    public function setUserData($user)
    {

        //check if session is set
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['userdata'] = array(
            "fullname" => $user['first_name'] . ' ' . $user['last_name'],
            "access" => $user['access'],
        );

        return $_SESSION['userdata'];
    }

    public function getUserData()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['userdata'])) {
            //echo "<h1>{$_SESSION['userdata']}</h1>";
            return $_SESSION['userdata'];
        } else {
            echo "<h1>No user info</h1>";
        }

    }

    public function logout()
    {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['userdata'] = null;
        $_SESSION = [];
        unset($_SESSION['userdata']);
        session_destroy();
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
        $statement = $this->con->prepare("SELECT t1.ID,product_name,product_type,min_stocks,SUM(qty) as total
                                          FROM (SELECT * FROM  products
                                          WHERE products.ID =?)t1
                                          INNER JOIN product_items t2 on t1.ID = t2.product_id");
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

    public function getTotalQty($product_id)
    {

        $this->openConnection();
        $statement = $this->con->prepare("SELECT *,SUM(qty) as total FROM product_items WHERE product_id = ?");
        $statement->execute([$product_id]);
        $product_qty = $statement->fetch();

        return $product_qty['total'];

    }

    public function addStock()
    {

        if (isset($_POST['add_stock'])) {

            $brand_name = $_POST['brand_name'];
            $product_id = $_POST['product_id'];
            $qty = $_POST['qty'];
            $price = $_POST['price'];
            $batch_number = $_POST['batch_number'];
            $added_by = $_POST['added_by'];

            $this->openConnection();
            $statement = $this->con->prepare('INSERT INTO product_items (`product_id`, `qty`, `vendor`, `added_by`) VALUES(?,?,?,?,?)');
            $statement->execute([$product_id, $qty, $price, $brand_name, $batch_number, $added_by]);

            //redirect
            header("Location:productDetails.php?id=" . $product_id);
        }

    }

    public function viewAllStocks($product_id)
    {
        $this->openConnection();
        $statement = $this->con->prepare("SELECT * FROM product_items WHERE product_id = ?");
        $statement->execute([$product_id]);
        $stocks = $statement->fetchAll();
        $total = $statement->rowCount();

        if ($total > 0) {

            return $stocks;

        } else {return false;}

    }
}

$store = new MyStore();
