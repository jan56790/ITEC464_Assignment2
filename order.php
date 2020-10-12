<!-- SANTOSH SHRESTHA -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="order.css">
    <title>Assignment #1: Order Form</title>
</head>
<body>
    <?php

      $check = false; 
    
      // Function to show message
      function showMessage($type, $message) {
        echo '<div class="'.$type.'-message">'.$message.'</div>';
      }
    
      // States array
      $states = array("AL","AK","AZ","AR","CA","CO","CT","DE","DC","FL","GA","HI","ID","IL","IN","IA","KS","KY","LA","ME","MD","MA","MI","MN","MS","MO","MT","NE","NV","NH","NJ","NM","NY","NC","ND","OH","OK","OR","PA","RI","SC","SD","TN","TX","UT","VT","VA","WA","WV","WI","WY");

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Initialize value from post method
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $street_address = $_POST['street_address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        
        
        if(isset($_POST['same_del']) && $_POST['same_del'] === "Same Delivery") {
          $d_fname = $fname;
          $d_lname = $lname;
          $d_street_address = $street_address;
          $d_city = $city;
          $d_state = $state;
        }
        
        $card_type = $_POST['card_type'];
        $card_number = $_POST['card_number'];

        $exp_month = $_POST['exp_month'];
        $exp_year = $_POST['exp_year'];
        $cvv = $_POST['cvv'];
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];

        $check = true; 

        // Check for  billing address error
        if(empty($fname)){
            $fnameError = 'Firstname is required.';
            $check = false;
        }

        if(empty($lname)){
            $lnameError = 'Lastname is required.';
            $check = false;
        }

        if(empty($street_address)){
            $streetAddressError = 'Street address is required.';
            $check = false;
        }

        if(empty($city)){
            $cityError = 'City is required.';
            $check = false;
        }

        if(empty($state)){
            $stateError = 'State is required.';
            $check = false;
        }

        // Check Delivery address error
        if(!isset($d_fname) && isset($_POST['d_fname']) && empty($_POST['d_fname'])){
            $dfnameError = 'Firstname is required.';
            $check = false;
        }

        if(!isset($d_lname) && isset($_POST['d_lname']) && empty($_POST['d_lname'])){
            $dlnameError = 'Lastname is required.';
            $check = false;
        }

        if(!isset($d_street_address) && isset($_POST['d_street_address']) && empty($_POST['d_street_address'])){
            $dstreetAddressError = 'Street address is required.';
            $check = false;
        }

        if(!isset($d_city) && isset($_POST['d_city']) && empty($_POST['d_city'])){
            $dcityError = 'City is required.';
            $check = false;
        }

        if(!isset($d_state) && isset($_POST['d_state']) && empty($_POST['d_state'])){
            $dstateError = 'State is required.';
            $check = false;
        }

        // Check Payment error
        if(empty($card_number)){
          $cardNumberError = 'Card number is required.';
          $check = false;
        }

        if(empty($cvv)){
            $cvvError = 'CVV is required.';
            $check = false;
        }

        if((strlen($cvv) < 3) || (strlen($cvv) > 4)){
            $cvvLenError = 'CVV must be minimum 3 digits or maximum 4 digits.';
            $check = false;
        }

        // Check Account error
        if(empty($username)){
            $usernameError  = 'Username is required.';
            $check = false;
        }

        if(strlen($username) < 5){
            $usernameLenError = 'Username must be more then 5 characters.';
            $check = false;
        }

        if(empty($password)){
            $passwordError =  'Password is required.';
            $check = false;
        }

        if(empty($repassword)){
            $repasswordError = 'Ensure passwords match.';
            $check = false;
        }

        if($password !== $repassword){
            $passwordMatchError = 'Passwords not matched.';
            $check = false;
        }
      }
    ?>
    <h1>ITEC 464: Assignment #1</h1>
    <img src="Champions Leagu.jpg" alt="champions league photo" width="300px" height="auto">


    
    <?php
    //Display output if every requirements are met.
      if($check){
    ?>

        <fieldset>
        <legend>The form has successfully been submitted. Thank you.</legend>

    <?php

        echo "<br><br><b>BILLING ADDRESS:<b><br>";
        echo "First Name: ".$fname."<br>";
        echo "Last Name: ".$lname."<br>";

        echo "Street Address: ".$street_address."<br>";
        echo "City: ".$city."<br>";
        echo "State: ".$state."<br>";
      
        echo "<br><br><b>DELIVERY ADDRESS:<b><br>";
        $d_fname = $fname;
        echo "First Name: ".$d_fname."<br>";
        $d_lname = $lname;
        echo "Last Name: ".$d_lname."<br>";
        $d_street_address = $street_address;
        echo "Street Address: ".$d_street_address."<br>";
        $d_city = $city;
        echo "City: ".$d_city."<br>";
        $d_state = $state;
        echo "State: ".$d_state."<br>";
    
        echo "<br><br><b>PAYMENT:<b><br>";  
        echo "Card Type: ".$card_type."<br>";
        echo "Card Number: ".$card_number."<br>";
        echo "Expiration Month: ".$exp_month."<br>";
        echo "Expiration Year: ".$exp_year."<br>";
        echo "CVV: ".$cvv."<br>";
        
        echo "<br><br><b>Account:</b><br>";
        echo "Username: ".$username."<br>";
        echo "Password: ".$password."<br>";
        echo "RePassword: ".$repassword."<br>";

    ?>
    
      </fieldset>


    <?php 
      } else
      {
    ?>

    <fieldset>

    <legend><h2 id="billadd">Billing Address</h2></legend>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

    
        
        <label for="fname">First Name: </label>
        <input type="text" id="fname" name="fname" value="<?php echo  (isset($fname) && !empty($fname)) ? $fname : '' ?>"><br>
        <?php 
            if(isset($fnameError) && !empty($fnameError)){
                showMessage('error', $fnameError);
            }
        ?>

        <br>
        <label for="lname">Last Name: </label>
        <input type="text" id="lname" name="lname" value="<?php echo  (isset($lname) && !empty($lname)) ? $lname : '' ?>" ><br>
        <?php 
            if(isset($lnameError) && !empty($lnameError)){
                showMessage('error', $fnameError);
            }
        ?>
        <br>

        <label for="street_address">Street Address: </label>
        <input type="text" id="street_address" name="street_address"  value="<?php echo  (isset($street_address) && !empty($street_address)) ? $street_address : '' ?>"><br>
        <?php 
            if(isset($streetAddressError) && !empty($streetAddressError)){
                showMessage('error', $streetAddressError);
            }
        ?>

        <br>
        <label for="city">City: </label>
        <input type="text" id="city" name="city" value="<?php echo  (isset($city) && !empty($city)) ? $city : '' ?>"><br>
        <?php 
           if(isset($cityError) && !empty($cityError)){
                showMessage('error', $cityError);
            }
        ?>

        <br>
        <label for="state">State: </label>
        <select id="state" name="state">
            <?php
              foreach ($states as $st) {
                $selected = '';
                if(isset($state) && !empty($state) && $st === $state){
                  $selected = 'selected';
                }
                echo '<option value="'.$st.'" '.$selected.'>'.$st.'</option>';
              }
            ?>
        </select> <br>

        <br>

        </fieldset>
        <!-- closing of Billing Address -->

        <br>

        <fieldset>
        <legend><h2 id="del_add">Delivery Address</h2></legend>

        <input type="checkbox" id="same_del" name="same_del" value="Same Delivery" <?php echo (isset($_POST['same_del']) && ($_POST['same_del'] === 'Same Delivery')) ? 'checked': '' ?>>
        <label for="same_del">Same as Billing Address</label> <br><br>

        
        <label for="fname">First Name: </label>
        <input type="text" id="d_fname" name="d_fname" value="<?php echo  (isset($d_fname) && !empty($d_fname)) ? $d_fname : '' ?>"><br>
        <?php 
            if(isset($dfnameError) && !empty($dfnameError)){
                showMessage('error', $dfnameError);
            }
        ?>
        <br>

        <label for="lname">Last Name: </label>
        <input type="text" id="d_lname" name="d_lname" value="<?php echo  (isset($d_lname) && !empty($d_lname)) ? $d_lname : '' ?>"><br>
        <?php 
            if(isset($dlnameError) && !empty($dlnameError)){
                showMessage('error', $dlnameError);
            }
        ?>
         <br>

        <label for="street_address">Street Address: </label>
        <input type="text" id="d_street_address" name="d_street_address" value="<?php echo  (isset($d_street_address) && !empty($d_street_address)) ? $d_street_address : '' ?>"><br>
        <?php 
            if(isset($dstreetAddressError) && !empty($dstreetAddressError)){
                showMessage('error', $dstreetAddressError);
            }
        ?>
        <br>

        <label for="city">City: </label>
        <input type="text" id="d_city" name="d_city" value="<?php echo  (isset($d_city) && !empty($d_city)) ? $d_city : '' ?>"><br>
        <?php 
            if(isset($dcityError) && !empty($dcityError)){
                showMessage('error', $dcityError);
            }
        ?>
        <br>

        <label for="state">State: </label>
        <select id="d_state" name="d_state">
            <?php
              foreach ($states as $st) {
                $selected = '';
                if(isset($d_state) && !empty($d_state) && $st === $d_state){
                  $selected = 'selected';
                }
                echo '<option value="'.$st.'" '.$selected.'>'.$st.'</option>';
              }
            ?>
        </select> <br><br>

        </fieldset>

        <!-- closing of Billing Address -->
        <br>

        <fieldset>
        <legend><h2>Payment</h2></legend>

        <input type="radio" id="visa" name="card_type" value="Visa" checked>
        <label for="visa">Visa</label><br>
        <input type="radio" id="discover" name="card_type" value="Discover">
        <label for="discover">Discover</label><br>
        <input type="radio" id="master_card" name="card_type" value="Master Card">
        <label for="master_card">
        Master Card</label> <br>
        <input type="radio" id="amex" name="card_type" value="Amex">
        <label for="amex">American Express</label> <br><br>

        <label for="card_number">Card Number: </label>
        <input type="text" id="card_number" name="card_number" value="<?php echo  (isset($card_number) && !empty($card_number)) ? $card_number : '' ?>"><br>
            <?php
               if(isset($cardNumberError) && !empty($cardNumberError)){
                showMessage('error', $cardNumberError);
            }
            ?>
        <br>

        <label for="exp_month">Expiration Date: </label>
        <select id="exp_month" name="exp_month">
            <option value="Jan">01</option>
	        <option value="Feb">02</option>
            <option value="Mar">03</option>
            <option value="Apr">04</option>
            <option value="May">05</option>
	        <option value="Jun">06</option>
            <option value="Jul">07</option>
            <option value="Aug">08</option>
            <option value="Sep">09</option>
	        <option value="Oct">10</option>
            <option value="Nov">11</option>
            <option value="Dec">12</option>
        </select>

        <select id="exp_year" name="exp_year">
            <option value="2020">2020</option>
	        <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
	        <option value="2025">2025</option>
        </select><br><br>

        <label for="cvv">CVV: </label>
        <input type="text" id="cvv" name="cvv" value="<?php echo  (isset($cvv) && !empty($cvv)) ? $cvv : '' ?>"><br><br>
        <?php 
            if(isset($cvvError) && !empty($cvvError)){
                showMessage('error', $cvvError);
            }
            if(isset($cvvLenError) && !empty($cvvLenError)){
                showMessage('error', $cvvLenError);
            }
        ?>
        </fieldset>

        <br>

        <fieldset>
        <legend><h2>Create Account</h2></legend>
        <!-- new acoount open -->
        <div class="newaccount">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo  (isset($username) && !empty($username)) ? $username : '' ?>"> <br>
            <?php 
                if(isset($usernameError) && !empty($usernameError)){
                    showMessage('error', $usernameError);
                }

                if(isset($usernameLenError) && !empty($usernameLenError)){
                    showMessage('error', $usernameLenError);
                }
            ?>
            <br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo  (isset($password) && !empty($password)) ? $password : '' ?>"> <br>
              <?php 
            if(isset($passwordError) && !empty($passwordError)){
                showMessage('error', $passwordError);
            }
        ?>
            <br>

            <label for="repassword">Re-Enter Password:</label>
            <input type="password" id="repassword" name="repassword"  value="<?php echo  (isset($repassword) && !empty($repassword)) ? $repassword : '' ?>"> <br>
            <?php 
            if(isset($repasswordError) && !empty($repasswordError)){
                showMessage('error', $repasswordError);
            }

           if(isset($passwordMatchError) && !empty($passwordMatchError)){
                showMessage('error', $passwordMatchError);
            }
        ?>
            <br>
        </div> <!--newaccount closing-->

        </fieldset>
        <br>

        <input type="submit" value="Place Order">

    </form>

    <?php } ?>

    <footer>© Copyright 2020. Santosh Shrestha.</footer>

    <!-- SANTOSH SHRESTHA -->
</body>
</html>