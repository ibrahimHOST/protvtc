<?php
            include("config.php");
            session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
</head>

<body>
    <div class="center">
        <h1> تسجيل الدخول موظفين</h1>
        <form method="post">
            <div class="txt_field">
                <label for="id">اسم المستخدم</label>
                <span><input type="text"  id="id" name="id"></span>
            </div>
            <div class="txt_field">
                <label for="pass">كلمة المرور</label>
                <span><input type="password"  id="pass" name="pass"></span>
            </div>
            <input type="submit" value="تسجيل الدخول" name="submit">
            <div class="padding"></div>
        </form><?php
                    if(isset($_POST['submit']))
                    {
                        $id = $_POST['id'];
                        $mypassword =$_POST['pass']; 
                            if (!empty($id) && !empty($mypassword)){

                        $sql = "SELECT id,pass FROM emp WHERE 
                        id = '$id' and pass = '$mypassword'";
                        $result=mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result)>0)
                        {
                            $_SESSION['login_user'] = $id;
                            header("location: home_emp.php");
                        }
                        else 
                            echo '<h3 style="color:red;text-align:center;">اسم المستخدم او كلمة المرور المدخلة خطاء</h3>';
                            }
                            else{ echo "<h2 style='color:red;text-align:center;'>يجيب ادخال اسم المستخدم وكلمة المرور للدخول<h2>";}
                }
                ?>
    </div>
</body>

</html>