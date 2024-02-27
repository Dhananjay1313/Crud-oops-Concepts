<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
<div class="container mt-5" style="border: 3px solid lightsalmon;border-radius: 16px;padding: 50px;">
    <form action="add.php" id="formdata" method="POST">
        <div>
            Firstname: <input type="text" name="firstname" id="firstname" value="">
            Lastname: <input type="text" name="lastname" id="lastname" value="">
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
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>
<script>
    $('#formdata')[0].reset();
    document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("formdata").reset();
        })
    </script>
</body>
</html>