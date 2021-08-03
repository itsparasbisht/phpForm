<?php 

include('config.php');

$errors = ['name' => '', 'email' => '', 'phone' => '', 'gender' => '', 'languages' => ''];

$name = $email = $phone = $gender = '';
$languages = [];

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if(!empty($_POST['name'])){
        if(preg_match('/^[a-zA-Z\s]+$/', $_POST['name'])){
            $name = $_POST['name'];
            $errors['name'] = "";
        }
        else{
            $errors['name'] = "enter a valid name";
        }
    }
    else{
        $errors['name'] = "name is required";
    }

    if(!empty($_POST['email'])){
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $email = $_POST['email'];
            $errors['email'] = "";
        }
        else{
            $errors['email'] = "enter a valid email id";
        }
    }
    else{
        $errors['email'] = "email is required";
    }

    if(!empty($_POST['phone'])){
        if(preg_match('/^[\d]{10}$/', $_POST['phone'])){
            $phone = $_POST['phone'];
            $errors['phone'] = "";
        }
        else{
            $errors['phone'] = "enter a valid 10 digit phone no.";
        }
    }
    else{
        $errors['phone'] = "phone no. is required";
    }

    if(isset($_POST['gender'])){
        $gender = $_POST['gender'];
    }
    else{
        $errors['gender'] = "please, select your option";
    }

    if(isset($_POST['languages'])){
        $languages = $_POST['languages'];
    }
    else{
        $errors['languages'] = "select your options";
    }

    if(array_filter($errors)){
        
    }
    else{
        $langs = implode(',', $languages);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $langs = mysqli_real_escape_string($conn, $langs);

        $sql = "INSERT INTO enrolled (name, email, phone, gender, languages) VALUES ('$name', '$email', '$phone', '$gender', '$langs')";
        if(mysqli_query($conn, $sql)){
            header('Location: home.php');
        }
        else{
            echo "query error: ". mysqli__error($conn);
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form action="index.php" method="POST" autocomplete="off">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name) ?>">
            <p class="error"><?php echo $errors['name']; ?></p>

            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($email) ?>">
            <p><?php echo $errors['email']; ?></p>

            <label for="phone">Phone No.</label>
            <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($phone) ?>">
            <p><?php echo $errors['phone']; ?></p>

            <label for="gender">Gender</label>

            <div class="genders">
                <label for="male">Male</label>
                <input type="radio" name="gender" id="male" value="male" <?php if($gender == 'male') echo "checked"; ?>>
                <label for="female">Female</label>
                <input type="radio" name="gender" id="female" value="female" <?php if($gender == 'female') echo "checked"; ?>>
                <label for="others">Others</label>
                <input type="radio" name="gender" id="others" value="others" <?php if($gender == 'others') echo "checked"; ?>>
            </div>
            <p><?php echo $errors['gender']; ?></p>

            <label for="languages">Languages</label>

            <div class="stacks">
                <label for="javascript">Javascript</label>
                <input type="checkbox" name="languages[]" id="javascript" value="javascript" <?php if(in_array("javascript", $languages)) echo "checked"; ?>>
                <label for="c++">C++</label>
                <input type="checkbox" name="languages[]" id="c++" value="c++" <?php if(in_array("c++", $languages)) echo "checked"; ?>>
                <label for="php">PHP</label>
                <input type="checkbox" name="languages[]" id="php" value="php" <?php if(in_array("php", $languages)) echo "checked"; ?>>
                <label for="python">Python</label>
                <input type="checkbox" name="languages[]" id="python" value="python" <?php if(in_array("python", $languages)) echo "checked"; ?>> <br>
                <label for="java">Java</label>
                <input type="checkbox" name="languages[]" id="java" value="java" <?php if(in_array("java", $languages)) echo "checked"; ?>>
            </div>
            <p><?php echo $errors['languages']; ?></p>

            <div class="btn-group">
                <input type="submit" class="btn" value="submit" name="submit">
            </div>
            
        </form>

        <div class="container__img">
            <img src="illus.svg" alt="">
        </div>

        <div class="container__moto">
            <h1>take your <b>leap.</b></h1>
        </div>
    </div>
</body>
</html>