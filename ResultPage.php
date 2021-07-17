<?php

header("Cache-Control: private, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Sun,01 Jun 2001 05:00:00 GMT");
include 'connect.php';
 
    if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
    } 
?>


<html>
<head> 
    <title>Transaction Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <style>
        body {
          padding-top: 60px;
          font-size:18px;
          font-family: "Audiowide", sans-serif;
          background: #f5fce3;
          background: linear-gradient(to right, #080d3a, #e1e6d6);
          background-image: url("images/bg.jpg");
          background-repeat: no-repeat;
          background-size: 100% 100%;
        }
        .center{
          background: linear-gradient(to bottom, #f5fce3, #ad728b);
          padding-top:6px;
          display: block;
          margin-top: 124px;
          margin-left: auto;
          margin-right: auto;
          width: 100%;    
        }
        .center2{
          font-size:10px;
          width:100%;
          color: white;
        }
        table {
          margin: 0 auto; 
        }
        td,th { 
          border: 1px solid #ddd; 
          padding: 8px;
        }
        #Table{   
          font-family: "Trirong", serif;
          border-collapse: collapse;
        }
        #Table tr:nth-child(even){ 
          background-color: #3169a1; 
        }
        #Table tr:nth-child(odd){ 
          background-color: #805875; 
        }
        #Table tr:hover{ 
          background-color: #b5d0eb; 
        }
        #Table th { 
          padding-top: 12px; 
          padding-bottom: 12px; 
          text-align:left; 
          background-color: #043357; 
          color:white; 
        }

    </style>

<script type="text/javascript">
    
    if(window.history.replaceState){
        
        window.history.replaceState(null, null, window.location.href); 
    }
    
</script>
</head>

<body>

<?php include('nav.php'); ?>

<?php 
  if(isset($_POST['form_submitted'])){

      $PAYER_ID = $_POST['payerID'];
      $PAYEE_ID = $_POST['payeeID'];
      $AMOUNT = $_POST['amount'];

      if(empty($PAYER_ID) || empty($PAYER_ID) || empty($AMOUNT)){
        echo "<script> alert('Empty Fields !!');
        window.location.href='Transfer.php';
        </script>";  
        exit() ;           
      }

      if($AMOUNT <=0){
        echo "<script> alert('Amount must be greater than zero !!');
        window.location.href='Transfer.php';
        </script>";  
        exit() ;  
      }

      if(!ctype_digit($AMOUNT) || !ctype_digit($PAYER_ID) || !ctype_digit($PAYEE_ID)){
        echo "<script> alert('Entered value can only contain digit!!');
        window.location.href='Transfer.php';
        </script>";  
        exit() ;  
      }

      $sqlcount = "SELECT COUNT(1) FROM accountdetails where accID='$PAYER_ID'";
      $r =  $conn->query($sqlcount);
      $d = $r->fetch_row();
      if($d[0]<1){
        echo "<script> alert('Sender ID does not exists !!');
        window.location.href='Transfer.php';
        </script>";  
        exit() ;      
      }
    
      $sqlcount = "SELECT COUNT(1) FROM accountdetails where accID='$PAYEE_ID'";
      $r =  $conn->query($sqlcount);
      $d = $r->fetch_row();
      if($d[0]<1){
        echo "<script> alert('Receiver ID does not exists !!');
        window.location.href='Transfer.php';
        </script>";  
        exit() ;      
      }
      
      $sql = "Select * from accountdetails where accID='$PAYER_ID'";       
          if($result = $conn->query($sql)){            
               $row1 = $result->fetch_array(); 
               if($row1['balance']<$AMOUNT){
                echo "<script> alert('Sender does not have required balance !!');
                window.location.href='Transfer.php';
                </script>";  
                exit() ; 
                }  
          }  

   
          echo "<div class ='center'>";
          echo "<div class ='center2'>";
          echo "<h1 style='text-align: center;color:#1c2c53'>Transaction Successfully Completed</h1>
                <p  style='text-align: center; font-size:25px;color:#21741d'>Details of Sender and Receiver <p>
                <table id = 'Table'>
                <tr>
                <th></th>
                <th>Account No</th>
                <th>Name</th>
                <th>Email</th>
               
                </tr>";

          $sql = "Select * from accountdetails where accID='$PAYER_ID'";       
          if($result = $conn->query($sql)){            
               $row1 = $result->fetch_array(); 
                       echo "<tr> 
                            <td> Sender </td>
                            <td>".$row1['accID']."</td>
                            <td>".$row1['name']."</td>
                            <td>".$row1['email']."</td>
                           
                            </tr>";                        
                       $PayerCurrentBalance = $row1['balance'];            
            }
        
          $sql2 = "Select * from accountdetails where accID='$PAYEE_ID'";
          if($result = $conn->query($sql2)){
                $row2 = $result->fetch_array();
                       echo "<tr> 
                            <td> Receiver </td>
                            <td>".$row2['accID']."</td>
                            <td>".$row2['name']."</td>
                            <td>".$row2['email']."</td>
                           
                            </tr>"; 
                        $PayeeCurrentBalance = $row2['balance'];                       
               
               
            }               
            echo "</table>";
            $PayeeCurrentBalance += $AMOUNT;
            $PayerCurrentBalance -= $AMOUNT;
            echo "<br>";
            echo "<table id = 'Table' style='margin-bottom:15px;'>
                    <tr>
                        <th></th>
                        <th>Last Balance</th>
                        <th>Current Balance</th>
                    </tr>
                    <tr>
                        <th>Sender</th>
                        <td style='color:black'>".$row1['balance']."</td>                        
                        <td style='color:black'>".$PayerCurrentBalance."</td>
                    </tr>
                    <tr>
                        <th>Receiver</th>
                        <td style='color:black'>".$row2['balance']."</td>                        
                        <td style='color:black'>".$PayeeCurrentBalance."</td>
                    </tr>";
            echo "</table>";
           
           $updatepayer ="Update accountdetails set balance='$PayerCurrentBalance' where accID='$PAYER_ID'";
           $updatepayee ="Update accountdetails set balance='$PayeeCurrentBalance' where accID='$PAYEE_ID'";

           if($conn->query($updatepayer)==true){
                ?>         
                <script>console.log("SENDER DETAILS UPDATED!!")</script>
                <?php
           }
           else{
                ?>        
                <script>alert("SENDER DETAILS NOT UPDATED!!")</script>
                <?php
           }

           if($conn->query($updatepayee)==true){
                    ?>         
                    <script>console.log("RECEIVER DETAILS UPDATED! ")</script>
                    <?php
            }
            else{
                    ?>        
                    <script>alert("RECEIVER DETAILS NOT UPDATED! ERROR OCCURED!")</script>
                    <?php
            }

            date_default_timezone_set('Asia/Kolkata');           
            $date = date('Y-m-d H:i:s',time());
           
            
            $InsertTransactTable ="Insert into history (payer, payerAcc, payee, payeeAcc, amount, time) values ('$row1[name]','$row1[accID]','$row2[name]','$row2[accID]','$AMOUNT','$date')";

            if($conn->query($InsertTransactTable)==true){
                    ?>         
                    <script>console.log("Record of this transaction saved! ")</script>
                    <?php
            }
            else{
                    ?>        
                    <script>alert("Record of this transaction saved! ERROR OCCURED!")</script>
                    <?php
            }


            echo "<br>";
        echo "</div>";
        echo "</div>";
}else{
      ?>
        <h1 style="color:#000000;text-align:center;"><br><br><br>Details Updated</h1>
      
      <?php
  }
$conn->close();
?>
</body>
</html>
