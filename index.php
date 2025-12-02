<?php
    session_start();
    include("server.php");
    if (isset($_POST['Logout'])){
        session_destroy();
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>D & D Foods Menu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="proStyle.css">
</head>

<body class="menu-bg">

    <header class="header">
        <a href="#" class="logo">D & D Foods</a>
        <nav class="navbar">
            <a href="index.php" class="active">Menu</a>
            <a href="checkout.php">Checkout</a>
            <a href="history.php">History</a>

            <?php 
                if (isset($_SESSION['username'])){
                    echo '<div class = "userbox">';
                        echo '<a href="">Hi <strong>'.$_SESSION['username']. '</strong></a>';
                        echo '<form method ="post">';
                            echo '<input type="submit" value="Logout" name="Logout" class="btn btn-danger">';
                        echo '</form>';
                    echo '</div>';
                } else 
                    echo '<a href="login.php">Login</a>';
            ?>
        </nav>
    </header>

    <h2 class="center">Entrees</h2>
    <?php
        $sql = "SELECT * from food WHERE category = 'entree'";
        $food_result = mysqli_query($conn, $sql);
    ?>

    <div class="content">
        <?php
        if (mysqli_num_rows($food_result) > 0){
            $img = [
                'Hamburger' => "https://www.washingtonpost.com/wp-apps/imrs.php?src=https%3A%2F%2Farc-anglerfish-washpost-prod-washpost.s3.amazonaws.com%2Fpublic%2FM6HASPARCZHYNN4XTUYT7H6PTE.jpg?h=982&w=1200",
                'New York Strip' => "https://newyorkprimebeef.com/cdn/shop/files/new-york-prime-beef-steaks-Dry-Aged-USDA-Prime-Boneless-Ny-Strip-Cooked-Horiz.jpg?v=1756232491", 
                'Salad' => "https://nutritionrefined.com/wp-content/uploads/2023/08/homemade-garden-salad-featured.jpg",
                'Chicken Strips' => "https://feedgrump.com/wp-content/uploads/2024/01/dairy-queen-chicken-strips-feature.jpg"
            ];
            while($row = mysqli_fetch_assoc($food_result)){
                echo '<div class = "card">';
                echo '<img src ='. $img[$row['food_name']].' width="100%" >';
                echo '<h3>' . $row['food_name'] .'</h3>';
                echo '<p>Price:$' . $row['current_price'].'</p>';
                echo '<p>Calories:' . $row['calories'].'</p>';
                echo '</div>';
            }
        }
         ?>
    </div>

    <div class="bottom-tables">
        <h2 class="center">Drinks</h2>
         <?php
            $sql = "SELECT * from food WHERE category = 'drink'";
            $drink_result = mysqli_query($conn, $sql);
        ?>

        <div class="content">
        <?php
        if (mysqli_num_rows($drink_result) > 0){
            $img = [
                'Lemonade' => "https://t4.ftcdn.net/jpg/07/01/77/07/360_F_701770789_iUaOh1Bf5BqxVhP1nBXPxjWTBo19y3cO.jpg",
                'Soda' => "https://media.istockphoto.com/id/530428650/photo/cola-glass-with-ice-cubes.jpg?s=612x612&w=0&k=20&c=keqH2KNWHO1sFxtsBfx5EZjyep1CRBHIqwe_ZwxszHc=",
                'Beer' => "https://images.fineartamerica.com/images/artworkimages/mediumlarge/2/pint-glass-of-beer-burazin.jpg",
                'Tea' => "https://www.ohhowcivilized.com/wp-content/uploads/iced-black-tea-recipe.jpg"
            ];
            while($row = mysqli_fetch_assoc($drink_result)){
                echo '<div class = "card">';
                echo '<img src ='. $img[$row['food_name']].' width="70%" style="padding-left:70px" >';
                echo '<h3>' . $row['food_name'] .'</h3>';
                echo '<p>Price:$' . $row['current_price'].'</p>';
                echo '<p>Calories:' . $row['calories'].'</p>';
                echo '</div>';
            }
        }
         ?>
    </div>

        <h2 class="center">Desserts</h2>
          <?php
            $sql = "SELECT * from food WHERE category = 'dessert'";
            $drink_result = mysqli_query($conn, $sql);
        ?>

        <div class="content">
        <?php
        if (mysqli_num_rows($drink_result) > 0){
            $img = [
                'Cake' => "https://redribbonbakeshop.com/cdn/shop/files/RR-Strawberry-Dream-Shopify-slice.png?v=1714605743&width=1080",
                'Banana Split' => "https://www.thespruceeats.com/thmb/3QatTcsVjKeDVCD-rIeUa4fSRAs=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/perfect-banana-split-recipe-305712-hero-01-ef0482a539394da0b5ba64ade0c73b98.jpg",
                'Pie' => "https://media.istockphoto.com/id/184350005/photo/slice-of-apple-pie-on-a-plate-isolalted-on-a-white-background.jpg?s=612x612&w=0&k=20&c=X140KNLW8dnMP8XztKyk3dNSioqY6aZ2VGn3BhRu68s="
            ];
            while($row = mysqli_fetch_assoc($drink_result)){
                echo '<div class = "card">';
                echo '<img src ='. $img[$row['food_name']].' width="70%" style="padding-left:70px" >';
                echo '<h3>' . $row['food_name'] .'</h3>';
                echo '<p>Price:$' . $row['current_price'].'</p>';
                echo '<p>Calories:' . $row['calories'].'</p>';
                echo '</div>';
            }
        }
         ?>
    </div>

    </div>
</body>



</html>