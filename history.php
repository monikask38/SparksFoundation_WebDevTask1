<?php
include 'connect.php';

if ($conn->connect_error) { 
  die("Connection failed: " . $conn->connect_error); 
} 
$sql = "SELECT * FROM history" ;
$result = $conn->query($sql);
?>
            
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <style>
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            padding-top: 60px;
            font-size:20px;
            font-family: "Audiowide", sans-serif;
            padding-bottom: 100px;
            background: #f5fce3;
            background: linear-gradient(to right, #f5fce3, #e1e6d6 );
            background-image: url("images/cover12.jpg");
            background-repeat: no-repeat;
            background-size: 100% 100%;

        }
        .container{      
            display: block;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
            width: 80%;   
        }

        td,th { 
            border: 2px solid #000000;
            padding: 6px;
            font-family: "Trirong", serif;
        }
        #Table{   
            font-family: "Trirong", serif;  
            border-collapse: collapse; 
            margin-bottom: 15px;
        }
        #Table tr:nth-child(even){
            background-color: #56728e;
             }
        #Table tr:nth-child(odd){
             background-color: #8a5d72;
             }
        #Table tr:hover{
             background-color: #284b71;
             }
        #Table th { 
            padding-top: 10px; 
            padding-bottom: 10px;
            background-color: #043357; 
            color:white;
            font-family: "Trirong", serif;
            
        }
        footer {
            background-color:  #284b71;
            text-align: center;
            position: absolute;
            left: 0;
            bottom: 0;
            height: 100px;
            width: 100%;
            overflow: hidden;
        }
        p{
        font-family:"Trirong", sans-serif;
      }
    </style>

</head>

<body>
  <?php include('nav.php'); ?>
	<div class="container">
       <h2 style="text-align: inherit;padding-top: 69px;font-size:40px;color: #1c234f;">Transaction History</h2>
       <br>
       <div>
    <table id = "Table">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Sender</th>
                <th>Sender A/C NO</th>
                <th>Receiver</th>
                <th>Receiver A/C NO</th>
                <th>Amount</th>
                <th>Date & Time</th>
            </tr>
        </thead>
        <tbody>
        
        <?php

    while($row = $result->fetch_assoc()) { 
  ?> 
 <tr>
        <td><?php echo $row['sno']; ?></td>
        <td><?php echo $row['payer']; ?></td>
        <td><?php echo $row['payerAcc']; ?></td>
        <td><?php echo $row['payee']; ?></td>
        <td><?php echo $row['payeeAcc']; ?></td>
        <td><?php echo $row['amount']; ?></td>
        <td><?php echo $row['time']; ?></td>

     
        </tr>
 <?php
    }
  
$conn->close();
?> 
</
</table>
    </div>
</div>
<footer>
    <p><b>&copy;</b>Copyright<b> 2021&nbsp;Monika kamble</b></p>
</footer>
<body>

</html>


