<?php
require_once 'db_connect.php';
session_start();

$id = $_SESSION['user_data']['id'];
$photo = $_SESSION['user_data']['photo'];
$password = $_SESSION['user_data']['password'];

if(isset($_POST['update'])):

    $formats = array("png", "jpeg", "jpg", "gif");
    $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

    if(in_array($extension, $formats)):
        $dir = "img/";
        $tmp = $_FILES['photo']['tmp_name'];
        $new_name = uniqid().".$extension";

        if(move_uploaded_file($tmp, $dir.$new_name)):
            $message = "Successfully uploaded!";

            $sql = "UPDATE user SET photo = '$new_name' WHERE id = '$id'";
            $result = mysqli_query($connect, $sql);

            try {
                unlink($dir.$photo);
            } catch (Exception $e) {
                $message = "Can't delete!";
            }

            $sql = "SELECT * FROM user WHERE id = '$id'";
            $result = mysqli_query($connect, $sql);

            $data = mysqli_fetch_array($result);
            $_SESSION['user_data'] = $data;
            $photo = $_SESSION['user_data']['photo'];
            
        else:
            $message = "Unable to upload!";
        endif;
    else:
        $message = "Invalid format!";
    endif;

endif;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title> Home </title>
</head>

<body>
    <div class="container">
        <h2> Perfil </h2><br>
        <img src="img/<?php echo $photo ?>" alt="Perfil photo" class="perfil-img"><br><br>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <input type="file" name="photo"><br><br>
            Name: <input type="text" name="name" value="<?php echo $_SESSION['user_data']['name']?>"><br><br>
            Email: <?php echo $_SESSION['user_data']['email']?><br><br>
            Password: <input type="password" name="password" value=<?php echo $password; ?> ><br><br>
            <button type="submit" name="update" class="btn bg-sucess"> Update </button>
            <button type="submit" name="delete" class="btn bg-alert"> Delete account </button>
        </form>
    </div>                                                    
</body>
</html>
