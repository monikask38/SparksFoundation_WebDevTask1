<?php
    include 'connect.php';
 
    if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
    } 
    //$sql = "SELECT * FROM customerinfo" ;
    $sql = "SELECT * FROM accountdetails" ;
    $result = $conn->query($sql);
?>
            
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>    
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
            /* background: -webkit-linear-gradient(to right, #f5fce3, #e1e6d6 ); */
            background: linear-gradient(to right, #f5fce3, #e1e6d6 );
            background-image: url("images/bg.jpg");
            background-repeat: no-repeat;
            background-size: 100% 100%;
            

        }
        .container{      
            padding-top:6px;
            display: block;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
            width: 80%;    
        }
        
         td,th {
              border: 2px solid #fff; 
              padding: 8px;
              font-family: "Trirong", serif;
        }
        #Table{   
            font-family: "Trirong", serif;
            border-collapse: collapse; 
            margin-bottom: 77px;
            margin-top:-38px;
        }
        #Table tr:nth-child(even){ 
            background-color: #8a5d72; 
        }
        #Table tr:nth-child(odd){ 
            background-color: #7a969d; 
        }
        #Table tr:hover{
             background-color: #284b71;
             }
        #Table th {
            padding-top: 12px; 
            padding-bottom: 12px; 
            text-align:left; 
            background-color: #043357; 
            color:white;
            font-family: "Trirong", serif;
        }
        footer {
            background-color:  #144e7d;
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
            <h2 style="font-size: 49px;padding-top: 166px;" >Customer Details</h2>
            <br>                   
            <table id="Table">
                <thead>
                    <tr>
                    <th>SN</th>
                    <th>Account No</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th> Current Balance</th>  
                    </tr>
                </thead>                     
                <?php
                while($row = $result->fetch_assoc()) { 
                ?> 
                <tr>
                    <td><?php echo $row['sno']; ?></td>
                    <td><?php echo $row['accID']; ?></td>
                    
                    <td ><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['balance']; ?></td>
                    
                </tr>
                <?php
                }
                $conn->close();
                ?> 
            </table>
        </div>

    <footer>
        <p> <b>&copy;</b>copyright 2021 <b>&nbsp;Monika kamble</b></p>
    </footer>
</body>
</html>


