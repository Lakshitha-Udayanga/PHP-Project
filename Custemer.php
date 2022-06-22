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
    $title = $_POST['title'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $connumber = $_POST['contactNumber'];
    $distric = $_POST['distric'];

    if(!$conn)
    {
        die("connetion faild" . mysqli_connect_error());
    }
    else
    {
       $query1 = "INSERT INTO customer(title,fname,lname,number,district) VALUES ('$title','$fname','$lname','$connumber','$distric')";

       if(mysqli_query($conn,$query1))
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
        <title> Registration List</title>
        <style>
            body{
                background-color: #ffff;
                width: 100%;
                height:100vh;
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
  
    <body>
        <div class="regform">
         
            <center><h1><b>Custemer Registration List</b></h1></center> <br>

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
             </div>
             <br>
                <div id ="title">
                    <h2 class="Distric">TItle</h2>
                    <select class="Distric" name="title" >
                        <option>Mr</option>
                        <option>Mrs</option>
                        <option>Miss</option>
                        <option>Dr</option>
                    </select> 
                    <br><br>
                <div id ="name">
                    <h2 class="name">Name</h2>
                    <input type="text" class="Fristname" name="fname" placeholder="frist name"   > 
                    <input type="text" class="lastname" name="lname" placeholder="last name" >
                   
                </div>
                <br>
                <div id ="contactnumber">
                    <h2 class="phone">Contact Numbert</h2>
                    <input type="number" class="number" name="contactNumber" placeholder="phone number" >  
                </div>
                <br>
                <div id ="name">
                    <h2 class="Distric">Distric</h2>
                    <select class="Distric" name="distric" >
                        <option>Badulla</option>
                        <option>monaragala</option>
                        <option>Ampara</option>
                        <option>Batticaloa</option>
                        <option>Colombo</option>
                        <option>Galle</option>
                        <option>Gampaha</option>
                        <option>Hambantota</option>
                        <option>Jaffna</option>
                        <option>Kalutara</option>
                        <option>Kandy</option>
                        <option>Kegalle</option>
                        <option>Kilinochchi</option>
                        <option>Kurunegala</option>
                        <option>Mannar</option>
                        <option>Matale</option>
                        <option>Matara</option>
                        <option>Mullaitivu</option>
                        <option>Nuwara Eliya</option>
                        <option>Polonnaruwa</option>
                        <option>Ratnapura</option>
                        <option>Trincomalee</option>
                        <option>Vavuniya</option>
                    </select>   
                </div>
                <br><br>
                    <div id ="button">
                    <input type ="submit" class="btn" value="Submit" name="ok">
                   
                </div>
            </form>
      
        </div>
   
   
    </body>

</html>