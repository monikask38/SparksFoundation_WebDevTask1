<?php
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
            padding-top: 10px;
            font-size:20px;
            font-family: "Trirong", serif;
            background: #f5fce3;
            background: linear-gradient(to right, #c33075,#583d72 );
            background-image: url("images/cover1.png");
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
        .transferMoney{
            margin-top: 74px;
            color:#1c234f;
            background: linear-gradient(to bottom, #c33075, #583d72);
            padding: 40px;
            position:fixed;
            top:50%;
            left:61%;
            transform: translate(-50%, -50%);
            width:66%;
            height:383px;
            margin-left: -143px;
        }
        hr{
            color: #c54141;
            border: 3px solid #252546;
          }
        input[type="submit" i]{
             background-color:#1a3413;
             font-family: 'Baloo Da 2', cursive;
             font-weight: 600;
             color: #ffffff;
             padding:10px;
         }
         input[type="submit" i]:hover{
             background-color:#3b0840;
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

<div class = 'transferMoney'>
    <h1>Transfer Money</h1>
    <hr>
    <form name="myForm" action="ResultPage.php"  onsubmit="return validateForm()" method="post" style="font-size: 151px;">
        <table id="table1" style="font-size: 20px;font-weight: 600;color: #ffffff;">
        <tr>
            <td>Sender Account No</td>
            <td><input type="number" name="payerID"  min=100 required><td>
        </tr>
        <tr>
            <td>Receiver Account No</td>
            <td><input type="number" name="payeeID" min=100 required ><td>
        </tr>
        <tr>
            <td>Amount(Rs.)</td>
            <td><input type="number" name="amount" min=1 required><td>
        </tr>
        <tr>
            <td><input type= "hidden" name= "form_submitted" value="1"></td>
            <td> <input type="submit" value="SEND MONEY"><td>
        </tr>
       
        </table>
    </form>
</div>

 <script>
 
 function validateForm() {
            var x = document.forms["myForm"]["payerID"].value;
            var y = document.forms["myForm"]["payeeID"].value;
            var z = document.forms["myForm"]["amount"].value;
            var regex=/^[0-9]+$/;

            
            if (x == "" || y=="" || z=="") {
                alert("Fill it!!");
                return false;
            }

            //var num = z>0?1:-1;
            if((Math.sign(z)==-1)||(Math.sign(z)==-0)||z==0){
                alert("Enter a valid amount to do transaction");
                return false;
            }
            if(isNaN(z)|| !x.match(regex)|| !y.match(regex) ||!z.match(regex)){
                alert("Enter correct input!");
                return false;
            }
        }
            
 </script>
</body>
</html>
