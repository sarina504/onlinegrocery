<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title id=title>Foods</title>
    <link rel = "icon" href ="img/logo.jpg" type = "image/x-icon">
    <style>
    #cont {
        min-height : 578px;
    }
    </style>
</head>
<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php require 'partials/_nav.php' ?>

    <div class="container my-4" id="cont">
        <div class="row jumbotron">
        <?php
            $foodId = $_GET['foodid'];
            $sql = "SELECT * FROM `food` WHERE foodId = $foodId";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $foodName = $row['foodName'];
            $foodPrice = $row['foodPrice'];
            $foodDesc = $row['foodDesc'];
            $foodCategorieId = $row['foodCategorieId'];
        ?>
        <script> document.getElementById("title").innerHTML = "<?php echo $foodName; ?>"; </script> 
        <?php
        echo  '<div class="col-md-4">
                <img src="/Onlinefood/img/pizza-'.$foodId. '.jpg" width="249px" height="262px">
            </div>
            <div class="col-md-8 my-4">
                <h3>' . $foodName . '</h3>
                <h5 style="color: #ff0000">Rs. '.$foodPrice. '/-</h5>
                <p class="mb-0">' .$foodDesc .'</p>';

                if($loggedin){
                    $quaSql = "SELECT `itemQuantity` FROM `viewcart` WHERE foodId = '$foodId' AND `userId`='$userId'";
                    $quaresult = mysqli_query($conn, $quaSql);
                    $quaExistRows = mysqli_num_rows($quaresult);
                    if($quaExistRows == 0) {
                        echo '<form action="partials/_manageCart.php" method="POST">
                              <input type="hidden" name="itemId" value="'.$foodId. '">
                              <button type="submit" name="addToCart" class="btn btn-primary my-2">Add to Cart</button>';
                    }else {
                        echo '<a href="viewCart.php"><button class="btn btn-primary my-2">Go to Cart</button></a>';
                    }
                }
                else{
                    echo '<button class="btn btn-primary my-2" data-toggle="modal" data-target="#loginModal">Add to Cart</button>';
                }
                echo '</form>
                <h6 class="my-1"> View </h6>
                <div class="mx-4">
                    <a href="viewfoodList.php?catid=' . $foodCategorieId . '" class="active text-dark">
                    <i class="fas fa-qrcode"></i>
                        <span>All foods</span>
                    </a>
                </div>
                <div class="mx-4">
                    <a href="index.php" class="active text-dark">
                    <i class="fas fa-qrcode"></i>
                        <span>All Category</span>
                    </a>
                </div>
            </div>'
        ?>
        </div>
    </div>

    <?php require 'partials/_footer.php' ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>
</html>