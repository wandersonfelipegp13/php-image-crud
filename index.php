<?php
require_once 'db_connect.php';

session_start();

if(isset($_POST['login'])):
    $email = mysqli_escape_string($connect, $_POST['email']);
    $password = mysqli_escape_string($connect, $_POST['password']);
    
    if(!empty($email) && !empty($password)):
        $sql = "SELECT id FROM user WHERE email = '$email'";
        
        $result = mysqli_query($connect, $sql);

        if(mysqli_num_rows($result) > 0):
            $password = md5($password);
            
            $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";

            $result = mysqli_query($connect, $sql);

            if(mysqli_num_rows($result) == 1):
                $data = mysqli_fetch_array($result);
                $_SESSION['login'] = true;
                $_SESSION['user_data'] = $data;
                header('Location: home.php');
            endif;

        endif;

    endif;
endif;


?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login </title>
</head>

<body>
    <h2>Login</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        Email: <input type="email" name="email"><br><br>
        Password: <input type="password" name="password"><br><br>
        <button type="submit" name="login"> Login </button>
        <a href="create.php"> Create an account. </a>
    </form>
                                                    
</body>
</html>



