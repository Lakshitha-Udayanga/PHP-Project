<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsiive Admin Dashboard | </title>
    <link rel="stylesheet" href="style.css">
  
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">Dashboard</span>
      <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
</nav>
</div> 
    </div>
    <table border="1"  cellpadding="0" width= "90%"; height: 50%;>
      <tr>
        <th>
      <ul class="nav-links">
        <li>
          <a href="Custemer.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Custemer</span>
            
          </a>
        </li>
</th>
      <th>
        <li>
          <a href="Item.php">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Item</span>
          </a>
        </li>
</th>
        <th>
        <li>
          <a href="Invoice.php">
            <i class='bx bx-coin-stack' ></i>
            <span class="links_name">Custemer Invoice report</span>
          </a>
        </li>
</th>
      <th>
        <li>
          <a href="Item_Report.php">
            <i class='bx bx-book-alt' ></i>
            <span class="links_name">Invoice item report</span>
          </a>
        </li>
</th>
        <th>
        <li class="log_out">
          <a href="Admin/login.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
</th>
</tr>
</table>
  </div>
  
        
  </section>

  <script>
    //javascript code
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>

</body>
</html>
