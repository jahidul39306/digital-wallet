<?php
    $category;
    $to = "";
    $amount;
    $categoryErr = $toErr = $amountErr = "";
    $hasErr = false;
    $msg = "";
    define("FILEPATH", "data.txt");

    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        if($_POST["category"] === "select a value")
        {
            $categoryErr = "Select a category";
            $hasErr = true;
        }

        if(empty($_POST["amount"]) || $_POST["amount"] < 1)
        {
            $amountErr = "Invalid Amount";
            $hasErr = true;
        }
        if(empty($_POST["to"]))
        {
            $toErr = "Invalid phone number";
            $hasErr = true;
        }

        if(!$hasErr)
        {
            $category = $_POST["category"];
            $amount = $_POST["amount"];
            $to = $_POST["to"];

            $data = json_decode(file_get_contents(FILEPATH));
            $data[] = array("category" => $category, "to" => $to, "amount" => $amount, "date" => date("Y-m-d") ." ". date("h:i:sa"));
            $data = json_encode($data, JSON_PRETTY_PRINT);
            file_put_contents(FILEPATH, $data);
            $msg = "Transaction Successful";
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
<form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
        <h1>Page 1 [Home]</h1>
        <h3>Digital Wallet</h3>
        <P>
        1. <a href="home.php">Home</a>&nbsp;
        2. <a href="history.php">Transaction History</a>&nbsp;
        </P>
        <h3>Fund Transfer:</h3>

        
        <label for = "category">Category: </label>
        <select id = "category" name = "category">
            <option value = "select a value">Select a value</option>
            <option value = "mobile_recharge">Mobile Recharge</option>
            <option value = "send_money">Send Money</option>
            <option value = "merchant_pay">Merchant Pay</option>
        </select>
        <span class = "error"><?php echo "*" . $categoryErr; ?></span>
        <br><br>
        <label for = "to">To: </label>
        <input type = "tel" id = "to" name = "to" value = "<?php echo $to; ?>" pattern = "[0-9]{11}">
        <span class = "error"><?php echo "*" . $toErr; ?></span>
        <br><br>
        <label for = "amount">Amount: </label>
        <input type = "number" id = "amount" name = "amount" value = "<?php echo $amount; ?>">
        <span class = "error"><?php echo "*" . $amountErr; ?></span>
        <br><br>
        <input type = "submit" value = "Submit">
        <br><br>
        <p><?php echo $msg; ?></p>
    </form>

</body>
</html>