<html>
<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="proStyle.css">
</head>
<body>
    <header class="header">
        <a href class="logo"> D & D Products</a>

        <nav class = "navbar">
            <a href="index.php">Home</a>
            <a href="#" class="active">Checkout</a>
            <a href="history.html">History</a>
            <a href="login.html">Login</a>
        </nav>
        <!--Shows item details image and a Buy Button thats it-->
    </header>
      
    <section>
        <div>
            <h1>Checkout</h1>
            <select name ="food_id">
                <option value = "">Select Food</option>
                <?php
                include "server.php";
                $result = $conn->query("select food_id, food_name, current_price from Food");
                while($row = $result ->fetch_assoc()){
                    echo "<option value='{$row['food_id']}' data-price='{$row['current_price']}'>
                        {$row['food_name']} - $" . number_format($row['current_price'], 2) . "
                        </option>";
                }
                $conn->close();
                ?>
            </select>
            <br>
            <label>Quantity:</label>
            <input type="number" name="qty" min="1" value="1" required>
            <label>
                <input type="checkbox" id="drink">
                Drink Included?
              </label>
            <style>
                input[type="checkbox"] {
                  width: 18px;
                  height: 18px;
                }
                </style>
            <br>

            <label>
                <input type="checkbox" id="side">
                Side Included?
              </label>
            <style>
                input[type="checkbox"] {
                  width: 18px;
                  height: 18px;
                }
                </style>
            <br>
            <label>
                <input type="checkbox" id="dessert">
                Dessert Included?
              </label>
            <style>
                input[type="checkbox"] {
                  width: 18px;
                  height: 18px;
                }
                </style>
            <br>
        
            <label for="fname">First name:</label>
            <input type="text" style="height: 40px;" id="fname" name="fname"> <br></br>
            <label for="lname">Last name:</label>
            <input type="text"style="height: 40px;" id="lname" name="lname"> <br></br>
        
            <label for="pnumber">Phone Number:</label>
            <input type="text"style="height: 40px;" id="pNumber" name="pNumber"> <br></br>
            <label for="em">Email</label>
            <input type="text" style="height: 40px;"id="em" name="em">

            <!--Firs name last name shipping address zip city state phone email-->

            <!--This should all be on the left side of the page-->
        </div>
        <div>
<<<<<<< HEAD
            <h1>Payment</h1>
            <div>
                <img src="img/burger3.jpg" height="300" width="300"/>
                <h1 id="total">Total Payment: $0.00 </h1>
            </div>
            <input type="text" style="height: 40px;"placeholder="Enter discount or code"> <!--Put a button here-->
            <button> Buy Now</button>
            <p>Thanks for shopping with D&D Foods!</p>
        </div>
    </section>
=======
  <h1>Payment</h1>
  <div>
    <img src="burger3.jpg" height="300" width="300"/>
    <h1 id="total">Total Payment: $0.00 </h1>
  </div>
>>>>>>> 29fd655 (changes)

  <form id="checkoutForm" action="add_order_item.php" method="post">
    <input type="text" style="height: 40px;" placeholder="Enter discount or code">
    
    <input type="hidden" name="price_each" id="price_each">
    <input type="hidden" name="order_id" id="order_id" value="1">
    
    <button id="buyBtn" type="submit">Buy Now</button>
  </form>

  <p id="thanks"></p>
</div>

    </section>
<!--This script is just for dynamically changing the price-->
    <script>
        // we need the selected food
        const foodSelected = document.querySelector("select[name='food_id']");
        // the quantity
        const qtyInput = document.querySelector("input[name='qty']");
        // is there a drink with it?
        const drinkBox = document.getElementById("drink");
        // is there an side
        const sideBox = document.getElementById("side");
        // we have to adjust the total amount at the third header I believe
        const dessertBox = document.getElementById("dessert");
        const totalPrice = document.getElementById("total");


        // now make the calculation changes
        function updatePrice(){

            const selected = foodSelected.options[foodSelected.selectedIndex];

            const price = parseFloat(selected.dataset.price || 0);

            const qty = parseInt(qtyInput.value || 1);

            let total = price * qty;

            if(drinkBox.checked){
                total += 1.50;
            }
            if(sideBox.checked){
                total += 3.00;
            }
            if(dessertBox.checked){
                total += 5.00;
            }
            totalPrice.textContent = "Total Payment: $" + total.toFixed(2);
        }
        foodSelected.addEventListener("change", updatePrice);
        qtyInput.addEventListener("input", updatePrice);
        drinkBox.addEventListener("change", updatePrice);
        sideBox.addEventListener("change", updatePrice);
        dessertBox.addEventListener("change", updatePrice);


    </script>
    <script>
        // what id you are getting
        const buyBtn = document.getElementById("buyBtn");
        const nameInput = document.getElementById("fname");
        const thanks = document.getElementById("thanks");

        buyBtn.addEventListener("click", () => {
            const name = nameInput.value.trim();
            if(name){
                thanks.textContent = `Thank you for shopping with D&D Foods, ${name}!`;
            } 
        });

        // func

        // event Listener.... they always follow this in JS scripting
    
    </script>
</body>
</html>