<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="proStyle.css">

    <!-- Checkbox style once, globally -->
    <style>
        input[type="checkbox"] {
            width: 18px;
            height: 18px;
        }
    </style>
</head>

<body class="menu-bg">

<header class="header">
    <a href="#" class="logo">D & D Foods</a>
    <nav class="navbar">
        <a href="index.html">Menu</a>
        <a href="#" class="active">Checkout</a>
        <a href="history.php">History</a>
        <a href="login.html">Login</a>
    </nav>
</header>

<!-- ⭐ ONE SINGLE FORM WRAPS BOTH SIDES ⭐ -->
<form id="checkoutForm" action="submit_order.php" method="POST">

<section style="display:flex; justify-content:space-between;">

    <!-- LEFT SIDE -->
    <div style="width:45%;">
        <h1>Checkout</h1>

        <!-- Food Dropdown -->
        <select name="food_id" id="food_id">
            <option value="">Select Food</option>
            <?php
            include "server.php";
            $result = $conn->query("SELECT food_id, food_name, current_price FROM Food");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['food_id']}' data-price='{$row['current_price']}'>
                        {$row['food_name']} - $" . number_format($row['current_price'], 2) . "
                      </option>";
            }
            ?>
        </select>
        <br>

        <!-- Quantity -->
        <label>Quantity:</label>
        <input type="number" name="qty" id="qty" min="1" value="1" required>

        <!-- Add-ons -->
        <label><input type="checkbox" id="drink"> Drink Included?</label><br>
        <label><input type="checkbox" id="side"> Side Included?</label><br>
        <label><input type="checkbox" id="dessert"> Dessert Included?</label><br><br>

        <!-- Full Name -->
        <label for="person_name">Full Name:</label>
        <input type="text" id="person_name" name="person_name" style="height:40px;" required> 
        <br><br>

        <!-- Phone -->
        <label for="pNumber">Phone Number:</label>
        <input type="text" style="height:40px;" id="pNumber" name="pNumber"><br><br>

        <!-- Email -->
        <label for="em">Email</label>
        <input type="text" style="height:40px;" id="em" name="em">

        <!-- Hidden price fields -->
        <input type="hidden" name="price_each" id="price_each_hidden">
        <input type="hidden" name="total_price" id="total_price_hidden">
    </div>

    <!-- RIGHT SIDE -->
    <div style="width:45%;">
        <h1>Payment</h1>

        <div>
            <img src="img/logo.png" height="450" width="450"/>
            <h1 id="total">Total Payment: $0.00</h1>
        </div>

        <!-- BUY BUTTON SUBMITS THE FORM -->
        <button type="submit" id="buyBtn" 
            style="background:#f3c23b; padding:10px 30px; border:1px solid black;">
            Buy Now
        </button>

        <p id="thanks"></p>
    </div>

</section>

</form>

<!-- PRICE UPDATE SCRIPT -->
<script>
    const foodSelected = document.getElementById("food_id");
    const qtyInput = document.getElementById("qty");
    const drinkBox = document.getElementById("drink");
    const sideBox = document.getElementById("side");
    const dessertBox = document.getElementById("dessert");
    const totalPrice = document.getElementById("total");

    function updatePrice() {
        const selected = foodSelected.options[foodSelected.selectedIndex];
        const price = parseFloat(selected.dataset.price || 0);
        const qty = parseInt(qtyInput.value || 1);

        let total = price * qty;

        if (drinkBox.checked) total += 1.50;
        if (sideBox.checked) total += 3.00;
        if (dessertBox.checked) total += 5.00;

        totalPrice.textContent = "Total Payment: $" + total.toFixed(2);

        document.getElementById("price_each_hidden").value = price.toFixed(2);
        document.getElementById("total_price_hidden").value = total.toFixed(2);
    }

    foodSelected.addEventListener("change", updatePrice);
    qtyInput.addEventListener("input", updatePrice);
    drinkBox.addEventListener("change", updatePrice);
    sideBox.addEventListener("change", updatePrice);
    dessertBox.addEventListener("change", updatePrice);
</script>

<!-- THANK YOU MESSAGE -->
<script>
    const buyBtn = document.getElementById("buyBtn");
    const nameInput = document.getElementById("person_name");
    const thanks = document.getElementById("thanks");

    buyBtn.addEventListener("click", () => {
        const name = nameInput.value.trim();
        if(name){
            thanks.textContent = `Thank you for shopping with D&D Foods, ${name}!`;
        }
    });
</script>

</body>
</html>
