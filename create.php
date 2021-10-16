<?php
    require_once 'db_connect.php';

    session_start();
        
    if(isset($_POST['singup'])):

        $name = mysqli_escape_string($connect, $_POST['name']);
        $email = mysqli_escape_string($connect, $_POST['email']);
        $password = mysqli_escape_string($connect, $_POST['password']);

        if(!empty($email) && !empty($password) && !empty($name)):

            // photo upload
            $formats = array("png", "jpeg", "jpg", "gif");
            $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

            if(in_array($extension, $formats)):
                $dir = "img/";
                $tmp = $_FILES['photo']['tmp_name'];
                $new_name = uniqid().".$extension";

                if(move_uploaded_file($tmp, $dir.$new_name)):
                    $message = "Successfully uploaded!";

                    $sql = "INSERT INTO user (name, email, password, photo) VALUES ('$name', '$email', md5('$password'), '$new_name')";

                    $result = mysqli_query($connect, $sql);

                    header('Location: index.php');
                   
                else:
                    $message = "Unable to upload!";
                endif;
            else:
                $message = "Invalid format!";
            endif;
        endif;

            echo $message;

    endif;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sing up </title>
</head>

<body>
    <h2> Sing up </h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        Name: <input type="txt" name="name"><br><br>
        Email: <input type="email" name="email"><br><br>
        Password: <input type="password" name="password"><br><br>
        Photo: <input type="file" name="photo"><br><br>
        <button type="submit" name="singup"> Sing up </button>
        <a href="index.php"> Login. </a>
    </form>
                                                    
</body>
</html>
