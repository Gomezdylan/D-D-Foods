<html>
<head>
    <!--Add a thank you at the top for shopping with D-D Foods-->
    <title>Home Page</title>
    <link rel="stylesheet" href="proStyle.css">
</head>
<body>
    <header class="header">
        <a href class="logo"> D & D Foods</a>

        <nav class = "navbar">
            <a href="index.php">Menu</a>
            <a href="checkout.php">Checkout</a>
            <a href="#" class="active">History</a>
            <a href="login.php">Login</a>
        </nav>
        <!--Shows item details image and a Buy Button thats it-->
    </header>
    <section>
        <div>
        <h1>Recently Bought Items</h1>
            <?php
                include "server.php";

                $result = $conn->query("
                    SELECT Food.food_name, Food.category, Food.current_price
                    FROM Order_Items
                    JOIN Food ON Order_Items.food_id = Food.food_id
                    ORDER BY Order_Items.order_items_id DESC
                    LIMIT 2;
                ");

                while ($row = $result->fetch_assoc()) {

                    $image = "";

                    // Switch statement to grab recent items and show the picture
                    switch (strtolower($row['food_name'])) {
                        case "hamburger":
                            $image = "img/burger.jpg";
                            break;

                        case "chicken strips":
                            $image = "img/chicken2.jpeg";
                            break;

                        case "new york strip":
                            $image = "img/steak.jpg";
                            break;

                        case "salad":
                            $image = "img/salad.jpg";
                            break;

                        default:
                            $image = "img/burger.jpg"; // fallback image might get rid of 
                            break;
                    }

                    $food = strtolower($row['food_name']);

                    if ($recommendation_name == "") {  // only set for newest purchase
                        switch ($food) {
                            case "new york strip":
                                $recommendation_name = "Salad";
                                $recommendation_image = "img/salad.jpg";
                                break;
                
                            case "salad":
                                $recommendation_name = "New York Strip";
                                $recommendation_image = "img/steak.jpg";
                                break;
                
                            case "chicken strips":
                                $recommendation_name = "Hamburger";
                                $recommendation_image = "img/burger.jpg";
                                break;
                
                            case "hamburger":
                                $recommendation_name = "Chicken Strips";
                                $recommendation_image = "img/chicken2.jpeg";
                                break;
                        }
                    }


                    // Clean this up and then i think we are good
                    echo "<div class='recent-item'>";
                    echo "<img src='$image' style='width:500px; height:400; border-radius:10px;'><br>";
                    echo "<h3>{$row['food_name']}</h3>";
                    echo "<p>Price: \${$row['current_price']}</p>";
                    echo "</div>";
                }
?>

        </div>
        <div>
        <h1>Recommendation From Your Previous Purchase</h1>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>


        <?php
            if ($recommendation_name !== "") {
                echo "<h2>$recommendation_name</h2>";
                echo "<img src='$recommendation_image' height='500' width='600' style='border-radius:10px;'>";
            } else {
                echo "<p>No recommendations available.</p>";
            }
            ?>
        </div>
    </section>
    
</body>
</html>
