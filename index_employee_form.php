<?php
    include("config.php");
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل </title>
</head>

<body>
    <div class="center">
        <h1>تسجيل </h1>
        <form method="post">
            <div class="txt_field">
                <label for="id">اسم المستخدم</label>
                <span><input type="text" required id="id" name="id"></span>
            </div>
            <div class="txt_field">
                <label>الاسم (اختياري)</label>
                <span><input type="text" name="name"></span>
            </div>
            <div class="txt_field">
                <label for="pass">كلمة المرور</label>
                <span><input type="password" required id="pass" name="pass"></span>
            </div>
            <input type="submit" value="تسجيل " name="register">
            <div class="padding"></div>
        </form><?php
        
                    if(isset($_POST['register']))
                    {
                        $id = $_POST['id'];
                        $name = $_POST['name'];
                        $pass = $_POST['pass'];
                        $sqlcheck = "SELECT id FROM user WHERE id = '$id'";
                        $resultcheck = mysqli_query($conn, $sqlcheck); 
                        if (mysqli_num_rows($resultcheck) > 0)
                            {
                                echo '<h1 style="color:red;text-align:center;">اسم المستخدم مسجل مسبقا</h1>';
                            }
                            else
                             {
                                $sql = "INSERT INTO emp(id,name,pass)
                                VALUES('$id','$name','$pass')";
                                $result = mysqli_query($conn, $sql);
                            
                                if ($result == TRUE) 
                                {
                                    //echo "Save Ok<br/>";
                                    header("location: login_emp.php");
                                }
                                else 
                                    echo "Save failed<br/>";
                            }
                    }	
                    mysqli_close($conn);
        ?>
    </div>
</body>

</html>