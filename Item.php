<?php
//Database connection
$servername="localhost";
$username="root";
$password="";
$dbname="assignment";
$conn = mysqli_connect($servername,$username,$password,$dbname);
?>

<?php
//Add data in to the database
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $icode = $_POST['itemcode'];
    $iname = $_POST['itemname'];
    $icatagary = $_POST['itemcatagary'];
    $subcatagary = $_POST['itemsubcatagary'];
    $quantity = $_POST['quantity'];
    $uprice = $_POST['unitprice'];

    if(!$conn)
    {
        die("connetion faild" . mysqli_connect_error());
    }
    else
    {
        //SQL query= insert to data in the table

       $query3 = "INSERT INTO item(itemcode,itemname,itemcatagary,itemsubcatagary,quantity,unitprice) VALUES ('$icode','$iname','$icatagary','$subcatagary','$quantity','$uprice')";

       if(mysqli_query($conn,$query3))
       {
        echo "Data Added Successfully";
       }
       else
       {
        echo "Data Added Unsuccesfully";
       }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register Item details List</title>
        <style>
            body{
                background-color:whitesmoke;
            }
        input{
            width: 40%;
            height: 5%;
            border:1px;
            bordere-radius: 05px;
            padding: 10px 15px 8px 15px;
            margin:10px 05px 15px 05px;
            box-shadow:1px 1px 2px 1px grey;

        }
        </style>

    </head>

    <body bg-color="blue">
       
        <div class="regform">
         
            <center> <h1>Register Item details List</h1><br> </center>

        </div>
        <div class="main">
           
            <form action="<?php echo($_SERVER["PHP_SELF"]);?>" method="POST" style="background-color: lightblue">
            <div>
            <li class="Back">
          <a href="index.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Back</span>
          </a>
             </li>
             </div><br>

                <div id ="icode">
                    <h2 class="code">Item Code</h2>
                    <input type="text" class="code" name="itemcode" placeholder="Item Code"> <br> <br>  
                </div>
                <div id ="iname">
                    <h2 class="name">Item Name</h2>
                    <input type="name" class="name" name="itemname" placeholder="Item Name">  
                </div>
                <br>
                <div id ="icatagary">
                    <h2 class="catagary">Item catagary</h2>
                    <select class="catagary"  name="itemcatagary">
                        <option>Music instrument</option>
                        <option>kichan product</option>
                        <option>Book product</option>
                    </select>
                    
                </div>
                <div id ="supcatagary">
                    <h2 class="catagary">Item Sup Catagary</h2>
                    <select class="supcatagary" name="itemsubcatagary">
                        <option>Base Gitar</option>
                        <option>Vayalin</option>
                        <option>Pad</option>
                        <option>Naval book</option>
                        <option>Chidren Story</option>
                        <option>Genaral book</option>
                    </select>
                    
                </div>
                <div id ="quantity">
                    <h2 class="Quantity">Quantity</h2>
                    <input type="number" class="name" name="quantity" placeholder="Quantity">  
                </div>
                <div id ="uprice">
                    <h2 class="price">Unit price</h2>
                    <input type="number" class="name" name="unitprice" placeholder="Unit price">  
                </div>
                
                <br><br>
                    <div id ="button">
                    <input type ="submit" class="btn" value="Submit" name="ok">
                </div>
            </form>
      
        </div>
   
    </body>

</html>