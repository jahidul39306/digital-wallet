<?php
    define("FILEPATH", "data.txt");
    $history = file_get_contents(FILEPATH);
    $history = json_decode($history);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
</head>
<body>
     
    <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
        <h1>Page 2 [Transaction History]</h1>
        <h3>Digital Wallet</h3>
        <P>
        1. <a href="home.php">Home</a>&nbsp;
        2. <a href="history.php">Transaction History</a>&nbsp;
        </P>
        
        <table border = '1'>
            <tr>
                <th>Transaction Category</th>
                <th>To</th>
                <th>Amount</th>
                <th>Transferred On</th>
            </tr>
            <?php
                $totalRecords = 0;
                echo "<p>Total Records: (" .$totalRecords . ")</p>";
                if(!empty($history))
                {
                    foreach($history as $data)
                    {
                        echo "<tr>";
                        echo "<td>";  
                        echo $data -> category;
                        echo "</td>";
                        echo "<td>"; 
                        echo $data -> to;
                        "</td>";
                        echo "<td>"; 
                        echo $data -> amount; 
                        echo"</td>";
                        echo "<td>"; 
                        echo $data -> date; 
                        echo"</td>";
                        echo "</tr>";
                        $totalRecords = $totalRecords + 1;
                    
                    }
                }
                
            
            ?>
        </table>
        
        <br>


    </form>
    
</body>
</html>