 <?php
//Database connection
$servername="localhost";
$username="root";
$password="";
$dbname="assignment";
$conn = mysqli_connect($servername,$username,$password,$dbname);
?>

<?php
//Data delete to code
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $delete=mysqli_query($conn,"delete from item where id='$id'");
        if ($delete){
            header("location:Item_Report.php");
            die();
        }
    }

?>
<!DOCTYPE html>
<html>
    <head> 
    <title>
            Show Item table</title>
    </head>
    
    <body>
       
    <center>
        <h1>Show Item table</h1>
        <div>
            <li class="Back">
          <a href="index.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Back</span>
          </a>
             </li>
             <br>     
    <div class="cotainer">
        <table border="1"  cellpadding="0" width= "50%"; height: 50%;>

            <tr>
                <th>#</th>
                <th>itemcode</th>
                <th>itemname</th>
                <th>itemcatagary</th>
                <th>itemsubcatagary</th>
                <th>quantity</th>
                <th>unitprice</th>
                <th>Opertaer</th>

        </tr>
        <?php
        //Data Display to code
            $select=mysqli_query($conn, "select * from Item");
            $num=mysqli_num_rows($select);
            if($num>0){
                while($result=mysqli_fetch_assoc($select)){
                    echo"
                        <tr>
                            <td>".$result['id']."</td>
                            <td>".$result['itemcode']."</td>
                            <td>".$result['itemname']."</td>
                            <td>".$result['itemcatagary']."</td>
                            <td>".$result['itemsubcatagary']."</td>
                            <td>".$result['quantity']."</td>
                            <td>".$result['unitprice']."</td>
                            <td>
                                <a href='?id=".$result['id']."' class='opt'>delete</a>
                                <a href='Item.php?id=".$result['id']."' class='opt'>Update</a>
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
