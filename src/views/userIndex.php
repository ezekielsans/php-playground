<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="/css/userIndex.css">
</head>
<body>
    <header>
        <div class="navbar">

            </div>
            this is the nav
            <a href="login.php">logout</a>
            <a href="userCart.php">My Cart</a>
    </header>

<h1 style="text-align:center;margin-top:1rem">HELLO USER</h1>
    

<?php 
       include "../../components/footer.component.php";
        echo callFooter();
    ?>


</body>
</html>