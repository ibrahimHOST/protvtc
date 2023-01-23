<?php
    include('session.php');
?>
<html>
<style>
	body {
		margin:0;
		padding:0;
		background-color: white;
		color:white;
		height: 800px;
	}
	label {
			font-size:24px;
			color:white;
	}
	p {
		margin-top:4;
		text-transform:uppercase;
		text-align:left;
	}
	.title {
		background-color:black;
		color:white;
		padding: 20px 25px;
		text-align:right;
	}
	.title-bt {
		padding-right: 50px;
		margin: 4% auto;
		text-align:right;
	}
	.line-center {
		margin:0% 5%;
    }
	.book-film {
		background-color:black;
		border-radius :15px;
		height:280px;
	}	
	.book-film h1 {
		color :white;
		text-align:center;
		padding-top:25px;
		border-bottom:2px solid white;
	}
	.book-it {
		padding:10px 150px;
		text-align:center;
	}
	.f-act{
		padding:15px 10px;
		margin-bottom:10px;
	}
	.input {
		padding:10px;
	}
	.se {
		margin-top:10px;
		padding:10px;
	}
	.sout {
		position: absolute;
		font-size:19px;
		top: 12;
		left: 30;
		text-decoration: none;
		background-color:red;
		padding:15px 15px;
		border-radius :15px;	
	}
	.box_info{
		margin-top:-60px;
		background-color:rgb(248, 248, 255);
		box-shadow:1px 1px 8px black;
		width: 100%;
		height: 650px;
		position: relative;
  		border-radius: 10px;
			overflow: scroll;

	}
	.box_info_tow{
		background-color:black;
		width: 400px;
		height: 150px;
		position:absolute;
  		border-radius: 10px;
	}
	.content{	
		color:black;
		position: absolute;
		padding: 15px 15px;
		right: 0;
	}
	.content table ,tr,td {
		border:1px solid black;
		color:black;
		text-align:center;
		padding:5px;
	}
	.content caption {
		font-size:24px;
	}
	.drob{
		position: absolute;
		padding: 15px 15px;
		text-align:center;
	}

	.sout a {text-decoration: none;color:white;}
</style>
   <body>
   <div class="par">
      <h1 class="title">تخزين الملفات ومشاركتها مع المجموعة</h1> 
	  <div class="sout"><a href = "loguot.php">تسجيل الخروج</a></div>
	</div>
		<div class="line-center">
		<div class="td">
                    <BR></BR>
                    <BR></BR>
					<?php 
					$user =	$_SESSION['login_user'];
						
					$sql = "select groub_id from stud where id ='$user'";
					$resulte = mysqli_query($conn,$sql);
						$row = mysqli_fetch_array($resulte,MYSQLI_ASSOC);
						$chekgr = $row['groub_id'];
						// echo "<h3 style=color:red;font-size:50px;>".$chekgr."</h3><br>";
						if ($chekgr < 1) {
					?>
					<div class="book-film">
					<h1>اختيار المجموعات</h1>
					<div class="book-it">
                        <form method="POST">
							<div class="f-act">
								</div>	
                                <select class="se" name="a[]" id="groubs"><?php
								 $sql = "select * from groub";
                                $resulte = mysqli_query($conn,$sql);
								if (mysqli_num_rows($resulte)>0){
                                while ($row = mysqli_fetch_array($resulte,MYSQLI_ASSOC)){
									$counter = $row['id'];
									echo "<option value='$counter'>".$row['gr_name']."</option>";
								}
							}
								else{
									echo"لايوجد مجموعة قائمة للتسجيل";
								}

								
								?>
                                </select>
						  <input class="input" type="submit" name="sign_gr" value="التسجيل في المجموعة">

						</form>
					</div>
					
				</div>
				<?php 				if (isset($_POST['sign_gr'])){
									$gr_id = 0;
									if (($_POST['a'])){
										foreach($_POST['a'] as $i=>$v){
										$gr_id = $v;
									}
									// echo "<h3 style=color:red;font-size:50px;>".$gr_id."</h3><br>";
									}
									$sql1 = mysqli_query($conn,"select number_of_gr from groub where id = '$gr_id'");
									$row = mysqli_fetch_array($sql1,MYSQLI_ASSOC);
									$num_gr = $row['number_of_gr'];
									// echo "<h3 style=color:red;font-size:50px;>".$num_gr."</h3><br>";
									$sql2 = "select count(*) from stud where groub_id = '$gr_id'";
									$resulte = mysqli_query($conn,$sql2);
									foreach($resulte as $i=>$v){
										$the_nums = $i;
									}
									if ($the_nums <= $num_gr ){
										$idd = $_SESSION['login_user'];
										$sql = "update stud set groub_id ='$gr_id' where id='$idd'";
										$resulte = mysqli_query($conn,$sql);
										header("location: home.php");
									}
									else{
										echo "<h1 style=color:red;font-size:50px;test-align:center;>عذرا المجموعة المراد دخلوها مكتملة</h1><br>";
									}
										
								}
					}else{
						?>
						
						<div class="box_info">
							<div class="content">
								
								<table>
									<caption>تبادل الملفات</caption>
									<tr>
										<td>تاريخ الارسال</td>
										<td>نشر بواسطة</td>
										<td>الملف</td>
									</tr>
									<?php
								
									$stud_id = $user;
									$sql = "select * from stud where id = '$stud_id'";
									$resulte = mysqli_query($conn,$sql);
									$row = mysqli_fetch_array($resulte,MYSQLI_ASSOC);
									$gro_id = $row['groub_id'];
                                    if(mysqli_query($conn,$sql = "select * from groub_tasks where gr_id ='$gro_id'") == true){
										
									
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
						</div>
						<div class="box_info_tow">
							
							<div class="drob">
								<form  method="post" enctype="multipart/form-data">
									<h4>قم بمشاركة الملفات مع مجموعتك</h4>
									<input type="file" name="file">
									<input type="submit" value="Upload file" name="submit">
								</form>
							</div>
						</div>
					</div>

						
						<?php 
					
    					date_default_timezone_set('Asia/Riyadh');
						date_default_timezone_get();
						$uploded_on = date("Y-m-d H:i:s");
						
						$stud_id = $user;
						$sql = "select * from stud where id = '$stud_id'";
						$resulte = mysqli_query($conn,$sql);
						$row = mysqli_fetch_array($resulte,MYSQLI_ASSOC);
						$gr_id = $row['groub_id'];
						$stud_name = $row['name'];
						
						if(isset($_POST['submit'])){
							$filepath = $_FILES["file"]["name"];
							if(move_uploaded_file($_FILES["file"]["tmp_name"],$filepath)){
								// $vw = mysqli_query($conn,"select file_name from groub_tasks where task_id = 2");
								// $row = mysqli_fetch_array($vw);
									$sql="INSERT INTO groub_tasks (file_name, uploded_on,stud_name,stud_id,gr_id)
										VALUES ('$filepath', '$uploded_on','$stud_name','$stud_id','$gr_id')";
								$res = mysqli_query($conn,$sql);
                            header("location: home.php");
							}
							else echo "error";
						}


    
	
					
					}?>
					



   </body>
</html>

