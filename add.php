<?php
include_once("xyz.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crudoop";

$con = mysqli_connect($servername, $username, $password, $dbname);

$xyz = new xyz();

if(isset($_POST['submit'])) {   
    $id = $xyz->escape_string($_POST['id']);
    $firstname = $xyz->escape_string($_POST['firstname']);
    $lastname = $xyz->escape_string($_POST['lastname']);
    $email = $xyz->escape_string($_POST['email']);
    $gender = $xyz->escape_string($_POST['gender']);
    $hobbies = $xyz->escape_string($_POST['hobbies']);
    $color = $xyz->escape_string($_POST['color']);
    $description = $xyz->escape_string($_POST['description']);

    $result = $xyz->execute("INSERT INTO data(firstname,lastname,email,gender,hobbies,color,description) VALUES('$firstname','$lastname','$email','$gender','$hobbies','$color','$description')");
}

if (!isset ($_GET['page']) ) {  
    $page = 1;  
} else {  
    $page = $_GET['page'];  
} 

$items = 5;  
$offset = ($page-1) * $items;

$query = "SELECT * FROM data ";
 
if (isset($_GET['all'])) {  
    $search = $_GET['search'];
    $query .= "WHERE firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR email LIKE '%$search%' OR gender LIKE '%$search%' OR hobbies LIKE '%$search%' OR color LIKE '%$search%' OR description LIKE '%$search%'";
} 
$result = mysqli_query($con, $query);  
$numb = mysqli_num_rows($result);  

$number_of_page = ceil ($numb / $items);  

if (isset($_GET['type'])) {
    if ($_GET['type'] == 'up') {
        $value = $_GET['value'];
        $query .= "ORDER BY ".$value." ASC ";
    } else if ($_GET['type'] == 'down') {
        $value = $_GET['value'];
        $query .= "ORDER BY ".$value." DESC ";
    }
}

$query .= "LIMIT " . $offset . ',' . $items;

$result = $xyz->getdata($query);
?>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
 
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    </head>
<body>
    <div class="row">
    <div class="col mt-3">
        <a class="btn btn-info mb-2" href="new.php" style="margin-left: 7px;">New Data</a>
        </div>  
    <div class="col mt-3">
    <form>
    <input type="search" name="search" style="margin-left: 30%;"> 
  
    <button name="all">Search</button>
    </form>  
    <form action="add.php">
    </div>
    </div>  
    <table class="table table-bordered">
        <thead>
    <tr>
        <th>Firstname <a href="add.php?type=up&value=firstname"><img src="arrow-up.png" style="height:14px;"></a>
                    <a href="add.php?type=down&value=firstname"><img src="caret-down.png" style="height:14px;"></a></th>
        <th>Lastname <a href="add.php?type=up&value=lastname"><img src="arrow-up.png" style="height:14px;"></a>
                    <a href="add.php?type=down&value=lastname"><img src="caret-down.png" style="height:14px;"></a></th>
        <th>Email</th>
        <th>Gender</th>
        <th>Hobbies</th>
        <th>Color</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php 
    foreach ($result as $key => $row) 
{    
        echo "<tr>";
        echo "<td>".$row['firstname']."</td>";
        echo "<td>".$row['lastname']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['gender']."</td>";
        echo "<td>".$row['hobbies']."</td>";
        echo "<td><input type='color' value=".$row['color']."></td>";
        echo "<td>".$row['description']."</td>";  
        echo "<td><a class='btn btn-success' href=\"edit.php?id=$row[id]\">Edit</a>
        <a class='btn btn-danger' href=\"delete.php?id=$row[id]\" onClick=\"return confirm('Are you sure that you want to delete?')\">Delete</a></td>";
        echo "</tr>";      
    }
    ?>
    </tbody>
    </table>
</form>
<script>
        function checkDelete(){
            return confirm('Are you sure that you want to delete?');
}
    </script>
</body>
<?php
for ($page = 1; $page <= $number_of_page; $page++) {
    $isActive = isset($_GET['page']) && $_GET['page'] == $page ? "active" : "";
    echo '<ul class="pagination">
    <li class="page-item ' . $isActive . '">
    <a class="page-link btn" href="add.php?page=' . $page . '">
    ' . $page . '</a></li>';
}
?>
</html>