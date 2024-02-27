<?php

include "xyz.php";

$xyz = new xyz();

$id = $xyz->escape_string($_GET['id']);

$result = $xyz->getData("SELECT * FROM data WHERE id='$id'");

foreach ($result as $abc) {
    $firstname = $abc['firstname'];
    $lastname = $abc['lastname'];
    $email = $abc['email'];
    $gender = $abc['gender'];
    $hobbies = $abc['hobbies'];
    $color = $abc['color'];
    $description = $abc['description'];
}

if(isset($_POST['update']))
{   
    $id = $xyz->escape_string($_POST['id']);
    $firstname = $xyz->escape_string($_POST['firstname']);
    $lastname = $xyz->escape_string($_POST['lastname']);
    $email = $xyz->escape_string($_POST['email']);
    $gender = $xyz->escape_string($_POST['gender']);
    $hobbies = $xyz->escape_string($_POST['hobbies']);
    $color = $xyz->escape_string($_POST['color']);
    $description = $xyz->escape_string($_POST['description']);
    
    $result = $xyz->execute("UPDATE data SET firstname='$firstname',lastname='$lastname',email='$email',gender='$gender',hobbies='$hobbies',color='$color',description='$description' WHERE id='$id'");
    if ($result) {
        header("Location:add.php");
    }
}

?>
<html>
<head>  
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5" style="border: 3px solid lightsalmon;border-radius: 16px;padding: 50px;">
    <form name="form1" method="post" action="edit.php">
    <div>
            Firstname: <input type="text" name="firstname" id="firstname" value="<?php echo isset($firstname) ? $firstname : ""; ?>">
            Lastname: <input type="text" name="lastname" id="lastname" value="<?php echo isset($lastname) ? $lastname : ""; ?>">
            <input type="hidden" name="id" id="id" value="<?php echo isset($id) ? $id : ""; ?>">
            Email: <input type="email" name="email" id="email" value="<?php echo isset($email) ? $email : ""; ?>">
        </div>
        <div class="mt-3">
            Gender: <input type="radio" name="gender" value="male" <?php if (isset($gender) && $gender == "male") echo "checked"; ?>> Male
            <input type="radio" name="gender" value="female" <?php if (isset($gender) && $gender == "female") echo "checked"; ?>> Female
        </div>
        <div class="mt-3">
            Hobbies:
        <select name="hobbies" id="hobbies">
        <option value="Cricket" <?php if (isset($hobbies) && $hobbies == "Cricket") echo "checked"; ?>>Cricket</option>
        <option value="Football" <?php if (isset($hobbies) && $hobbies == "Football") echo "checked"; ?>>Football</option>
        <option value="Hockey" <?php if (isset($hobbies) && $hobbies == "Hockey") echo "checked"; ?>>Hockey</option>
        <option value="Boxing" <?php if (isset($hobbies) && $hobbies == "Boxing") echo "checked"; ?>>Boxing</option>
        <option value="Jogging" <?php if (isset($hobbies) && $hobbies == "Jogging") echo "checked"; ?>>Jogging</option>
        </select>
        </div>
        <div class="mt-3">
            Color: <input type="color" name="color" id="color" value="<?php echo isset($color) ? $color : ""; ?>">
        </div>
        <div class="mt-3 mb-3">
            Description: <textarea name="description" id="description" cols="20" rows="2"><?php echo isset($description) ? $description : ""; ?></textarea>
        </div>
            <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
            <button class="btn btn-primary" name="update" value="Update">Update</button> 
    </form>
    </div>
</body>
</html>