<?php
session_start();
if (!isset($_SESSION['home'])) {
    echo "<script>alert('Not logged in, please log in first!');location.href='login.php'</script>";
    exit;
}


include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <title>Confirm order</title>
    <script type="text/javascript">
    function validateEmail() {
        var email = document.getElementById('email').value;
        var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!pattern.test(email)) {
            alert('Please enter a valid email address.');
            return false;
        }
        return true;
    }
    </script>
</head>
<body>
<?php
include('nav.php');
?>
<div id="contenter">

<div>
<form onsubmit="return validateEmail();">
        <div class="order-confirm-content">
            <div class="checkout-info">
                <div class="checkout-title">
                    <h2>Order information</h2>
                    <a onclick="JavaScript:history.go(-1);">&lt; Return to shopping cart
                    </a>
                </div>
                <div class="checkout-tablehead">
                    <div class="cell itemname">Products</div><div class="cell itemquantity">Quantity</div><div
                            class="cell itemtotal" style="margin-left: 10px">Subtotal</div>
                </div>
                <ul class="checkout-body">

                </ul>
                <div class="checkout-bottom">
                <span>Actually paid: <a style="color:#f74342;">$</a><a class="checkout-bottom-price">...</a>
                </span>

                </div>
            </div>

            <div class="checkout-content">


                <div class="checkout-select">
                    <h2>Name</h2>

                    <input  required class="liuyan-txt" id="name" name="name"  value="<?php echo $_SESSION['home']['name']?>"  >

                </div>
                <div class="checkout-select">
                    <h2>Phone number</h2>

                    <input  required class="liuyan-txt" id="phone" name="phone"  value="<?php echo $_SESSION['home']['phone']?>"  >

                </div>
                <div class="checkout-select">
                    <h2>Email</h2>

                    <input required class="liuyan-txt" id="email" name="email" value="<?php echo $_SESSION['home']['email']; ?>">


                </div>
                <div class="checkout-select">
                    <h2>Address</h2>

                    <input  required class="liuyan-txt" id="address" name="address"  value="<?php echo $_SESSION['home']['address']?>"  >

                </div>
                <div class="checkout-select">
                    <h2>State</h2>
                    <select id="state" name="state" required>
                        <option value="">Please select the state where you live</option>
                        <option value="New South Wales">New South Wales</option>
                        <option value="South Australia">South Australia</option>
                        <option value="Queensland">Queensland</option>
                        <option value="Tasmania">Tasmania</option>
                        <option value="Victoria">Victoria</option>
                        <option value="Western Australia">Western Australia</option>
                    </select>
                </div>
                <div class="checkout-select">
                    <h2>City</h2>
                    <select id="city" name="city" required>
                        <option value="">Please select a city</option>
                    </select>
                </div>
                <div class="checkout-select">
                    <h2>Payment method</h2>
                    <select name="payment" id="payment" required>
                        <option value="">Please select the payment method</option>
                        <option value="1">Online payment</option>
                        <option value="2">Cash on delivery</option>
                    </select>
                </div>
                <div class="checkout-select">
                    <h2>Note</h2>

                    <input class="liuyan-txt" id="remark" name="remark"  value="" >

                </div>
                <input id="totalqty" name="totalqty"  type="hidden" value="" >
                <div class="checkout-select">

                <div class="commit-btn">Confirm Order</div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        </div>
    </form>
</div>
<?php
include('foot.php');
?>


<script src="js/jquery.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script src="js/cart.lib.js"></script>
<script src="js/cart.js"></script>
<script src="js/order.js"></script>
</body>
</html>
<script>
    var citiesByState = {
        "New South Wales": ["Sydney", "Newcastle", "Wollongong"],
        "South Australia": ["Adelaide", "Mount Gambier", "Port Lincoln"],
        "Queensland": ["Brisbane", "Gold Coast", "Cairns"],
        "Tasmania": ["Hobart", "Launceston", "Devonport"],
        "Victoria": ["Melbourne", "Geelong", "Ballarat"],
        "Western Australia": ["Perth", "Fremantle", "Broome"]
    };

    var stateSelect = document.getElementById('state');
    var citySelect = document.getElementById('city');

    stateSelect.addEventListener('change', function() {
        var selectedState = stateSelect.value;
        var cities = citiesByState[selectedState] || [];

        // 清空城市下拉列表
        citySelect.innerHTML = '<option value="">Please select a city</option>';

        // 填充城市下拉列表
        cities.forEach(city => {
            const option = document.createElement('option');
        option.text = city;
        option.value = city;
        citySelect.add(option);
    });
    });
</script>
