<?php
//Database connection
$servername="localhost";
$username="root";
$password="";
$dbname="assignment";
$conn = mysqli_connect($servername,$username,$password,$dbname);
?>



<?php
//Code to Delete a Data
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $delete=mysqli_query($conn,"delete from customer where id='$id'");
        if ($delete){
            header("location:Invoice.php");
            die();
        }
    }

?>
<!DOCTYPE html>
<html>
    <head> 
    <title>
            Show Custemer table</title>
    </head>
    
    <body>
        <center>
        <h1>Show Custemer table</h1>
        <div>
            <li class="Back">
          <a href="index.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Back</span>
          </a>
             </li>
             <br>
    <div class="cotainer">
        <table border="2"  cellpadding="0" width= "50%"; height: 50%;>

            <tr>
                <th>#</th>
                <th>title</th>
                <th>fname</th>
                <th>lname</th>
                <th>number</th>
                <th>district</th>
                <th>Opertaer</th>

        </tr>
        <?php
            $select=mysqli_query($conn, "select * from customer");
            $num=mysqli_num_rows($select);
            if($num>0){
                while($result=mysqli_fetch_assoc($select)){
                    echo" 
                        <tr>
                            <td>".$result['id']."</td>
                            <td>".$result['title']."</td>
                            <td>".$result['fname']."</td>
                            <td>".$result['lname']."</td>
                            <td>".$result['number']."</td>
                            <td>".$result['district']."</td>
                            <td>
                                <a href='?id=".$result['id']."' class='opt'>delete</a>
                                <a href='Custemer.php?id=".$result['id']."' class='opt'>Update</a>
                            </td>
                            </tr>
                                    "; 
                }
            }

        ?>
        </table>
        </ center>
</body>
</html>
