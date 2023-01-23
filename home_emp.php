<?php
    include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="homestyle_emp.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة الرئيسية</title>
    <style>
        body{
    margin: 0;
    padding: 0;
  }
  .center{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-100%, -50%);
    height: 500px;
    width: 550px;
    background: rgb(255, 255, 255);
  }
  .center1{
    position: absolute;
    top: 50%;
    left: 40%;
    transform: translate(60%, -50%);
    height: 500px;
    width: 550px;
    background: rgb(255, 255, 255);
  	overflow: scroll;
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
      padding-top: 6px;
      position: absolute;
      right: 30px;
  }
  span input {
      width: 200px;
      height: 20px;
      position: relative;
      right: -90px;
  }
  
  form .txt_field{
    margin: 66px 0;
   position: relative;
   right: 200px;

  }
  form .txt_field1{
    width: 100%;
    height: 350px;
    padding: 0px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #ffffff;
    font-size: 16px;
    resize: none;
    overflow: hidden;
  }
  
  .gr_info {
    border:1px solid black;
    padding: 10px;
    overflow: scroll;

  }
  .gr_info table,tr,td {
    border:2px solid black;
    padding: 10px;

  }
  
  .sub{
    width: 100%;
    height: 50px;
    border: 1px solid;
    background: #d92626;
    border-radius: 25px;
    font-size: 18px;
    color: #ffffff;
    font-weight: 700;
    cursor: pointer;
  } 
  div .padding {
      padding-top: 20px;
  }
    </style>
</head>
<body>
    <div class="center">
        <h1> انشاء المجموعات</h1>
        <form method="post">
            <div class="txt_field">
                <label for="text">اسم المجموعة</label>
                <span><input type="text" id="text" name="gr"></span>
            </div>
            <div class="txt_field">
                <label for="text" >عدد اعضاء المجموعة  </label>
                <span><input type="text"  id="text" name="number"></span>
            </div>
            <input class="sub" type="submit" value=" انشاء" name="create">
            <div class="padding"></div>

            <div class="center1">
                <h1>عرض المجموعات </h1>
                <form method="post">
                    <div class="txt_field1">
                        <?php
                                $sqlchek = "select * from groub";
                                $resulte = mysqli_query($conn,$sqlchek);
                                if (mysqli_num_rows($resulte) >0){
                                    ?>
                        <table style="width:100% ;text-align:center" border='2' method>
                        <form method="POST">
                            <tr>
                                <td>عدد اعضاء المجموعة</td>
                                <td>اسم المجموعة</td>
                                <td>رقم المجموعة</td>
                                <td>لحذف مجموعة</td>
                            </tr> <?php
                                    $sql = "select * from groub";
                                    $rec = array();
                                $resulte = mysqli_query($conn,$sql);
                                while ($row = mysqli_fetch_array($resulte,MYSQLI_ASSOC)){
                                    echo "<tr>";
                                    echo '<td>'.$row['number_of_gr'].'</td>';
                                    echo '<td>'.$row['gr_name'].'</td>';
                                    echo '<td>'.$row['id'].'</td>';
                                    
                                }    
                                    ?><td><input type="text" name="id_gr" placeholder=" للحذف ادخل رقم المجموعة "><input  type="submit" value="حذف" name="delete"></td><?php echo '</tr>';
                                        if (isset($_POST['delete'])){
                                            if ($_POST['id_gr']){
                                            $id_gr = $_POST['id_gr'];
                                            $sql = "delete from groub where id = '$id_gr'";
                                            $resulte = mysqli_query($conn,$sql); 
                                            header("location: home_emp.php");
                                            }
                                            

                                        }
                                    
                                    ?>
                                </form>
                        </table>
                               <?php 
                                     }
                                    else {
                                        ?>
                                        <h3 id="nodata" style="text-align:center; color:rgba(0, 0, 0, 0.6);"> لايوجد مجموعات قائمة</h3>
                                    <?php
                                    }
                               
                               ?> 


                    </div>
                    <div class="padding"></div>
        </form><?php
            if (isset($_POST['create'])){
                if ($_POST['gr']){
                $gr_name = $_POST['gr'];
                $number_of_gr = $_POST['number'];
                $sql = "insert into groub (number_of_gr,gr_name) values ('$number_of_gr','$gr_name')";
                $resulte = mysqli_query($conn,$sql);
                if ($resulte == true){
                    header("location: home_emp.php");
                }
                }

            }
        ?>

    </div>
            <div class="gr_info">
            <from method="post">
                <h3>عرض ملفات المجموعات</h3>
                <select class="se" name="a[]" id="gro">
                    <?php
                    		$sql = "select * from groub";
                            $resulte = mysqli_query($conn,$sql);
							    if (mysqli_num_rows($resulte)>0){
                             while ($row = mysqli_fetch_array($resulte,MYSQLI_ASSOC)){
								$counter = $row['id'];
								echo "<option value='$counter'>".$row['gr_name'].$counter."</option>";
								}
							}
								else{
								}
                    ?>
                </select>
                <input type="submit" name="submit"> 
                <?php
                
                if (isset($_POST["submit"]))
                {
                    if ($_POST["a"]){
            
							foreach($_POST['a'] as $i=>$v){
								$gr_id = $v;
							}
                        $result = mysqli_query($conn,$sql2 = "select * from groub_tasks where gr_id ='$gr_id'");

                                if(mysqli_num_rows($result) > 0){
                                    
                                    ?>
                                    <table>
									<caption>تبادل ملفات المجموعة</caption>
									<tr>
										<td>تاريخ الارسال</td>
										<td>نشر بواسطة</td>
										<td>الملف</td>
									</tr>
									<?php
									$sql = "select * from stud where id = '$gr_id'";
									$resulte = mysqli_query($conn,$sql);
									$row = mysqli_fetch_array($resulte,MYSQLI_ASSOC);
                                    if(mysqli_query($conn,$sql = "select * from groub_tasks where gr_id ='$gr_id'") == true){
										
									
                               		$resulte = mysqli_query($conn,$sql);
                                		while ($row = mysqli_fetch_array($resulte,MYSQLI_ASSOC)){
											
											echo "<tr>";
											echo '<td>'.$row['uploded_on'].'</td>';
											echo '<td>'.$row['stud_name'].'</td>';
											?>
										<td><a href="<?php echo $row['file_name']; ?>" target="_blank" ><?php echo $row['file_name']; ?></a></td>
											 </tr>
											<?php
                                		} 
									}else{
										?>
										<?php
									}
									?>
                                    </table>
                                    
                                    <?php                    

                                }else{
                                    $name = mysqli_query($conn,$sql2 = "select gr_name from groub where id ='$gr_id'");
                                    $row = mysqli_fetch_array($name,MYSQLI_ASSOC);
                                    $name = $row['gr_name'];
                                    echo "<h3 >( ".$name." ) لم تقم بتبادل الملفات</h3>";
                                
                                }
                    }
                }
                
                ?>
            </from>
        </div>
</body>
</html>