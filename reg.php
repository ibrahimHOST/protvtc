<?php
    include("config.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل</title>
</head>
    <style>
        body{
  margin: 0;
  padding: 0;
  height: 100vh;
}
.center{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  height: 500px;
  width: 550px;
  background: rgb(238, 235, 235);
  box-shadow: 10px 10px 15px rgba(0,0,0,0.05);
}
.center h1{
  text-align: center;
  padding: 20px 0;
  border-bottom: 1px solid rgb(0, 0, 0);
}
.center form{
  padding: 0 40px;
  box-sizing: border-box;
}
label {
    position: relative;
    left: 400px;
}
span {
    display: block;
    padding-top: 5px;
    position: absolute;
    right: 40px;
}
span input {
    width: 200px;
    height: 20px;
}

form .txt_field{
  margin: 50px 0;
}



input[type="submit"]{
  width: 100%;
  height: 50px;
  border: 1px solid;
  background: #2691d9;
  border-radius: 25px;
  font-size: 18px;
  color: #e9f4fb;
  font-weight: 700;
  cursor: pointer;
} 
div .padding {
    padding-top: 20px;
}
    </style>
<body>
    <div class="center">
        <h1>تسجيل</h1>
        <form method="post">
            <div class="txt_field">
                <label for="id">الرقم الاكاديمي</label>
                <span><input type="text" required id="id" name="id"></span>
            </div>
            <div class="txt_field">
                <label for="name">اسم المستخدم</label>
                <span><input type="text" required id="name" name="name"></span>
            </div>
            <div class="txt_field">
                <label for="email">البريد الاالكتروني</label>
                <span><input type="email" required id="email" name="email"></span>
            </div>
            <div class="txt_field">
                <label for="pass">كلمة المرور</label>
                <span><input type="password" required id="pass" name="pass"></span>
            </div>
            <input type="submit" value="تسجيل" name="register">
        </form><?php
        
                    if(isset($_POST['register']))
                    {
                        $id = $_POST['id'];
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $pass = $_POST['pass'];
                        $sqlcheck = "SELECT id FROM user WHERE id = '$id'";
                        $resultcheck = mysqli_query($conn, $sqlcheck); 
                        if (mysqli_num_rows($resultcheck) > 0)
                            {
                                echo '<h1 style="color:red;text-align:center;">الرقم الاكاديمي او الايميل مسجلة مسبقا</h1>';
                            }
                            else
                             {
                                $sql = "INSERT INTO stud(id,email,name,pass)
                                VALUES('$id','$email','$name','$pass')";
                                $result = mysqli_query($conn, $sql);
                            
                                if ($result == TRUE) 
                                {
                                    //echo "Save Ok<br/>";
                                    header("location: login.php");
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