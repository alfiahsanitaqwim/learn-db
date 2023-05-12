<?php
session_start();
error_reporting(0);
include('config.php');
if(strlen($_SESSION['id']==0)) {
 header('location:mydb.php');
  } else{


if(isset($_GET['del']))
		  {
		  	$bukuid=$_GET['id'];
		          mysqli_query($con,"delete from buku where id ='$bukuid'");
                  $_SESSION['msg']="data deleted !";
		  }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Manage Book</title>
		<link rel="stylesheet" href="bootstrap.min.css">
		<link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">
	</head>
	<body>
		<div class="main-content" >
			<div class="wrap-content container">
				<section>
					<div class="row">
						<div class="col-sm-8 mt-3">
							<h1 style="text-align-center;"><i class="fa-solid fa-book"></i>Manage Book </h1>
						</div>
					</div>
				</section>
				<div class="container-fluid bg-warning">
					<div class="row">
						<div class="col-md-12">
							<p style="color:red;"><?php echo htmlentities($_SESSION['msg']);?>
						<?php echo htmlentities($_SESSION['msg']="");?></p>	
							<table class="table table-hover" style="border-radius:6px;">
								<thead>
									<tr>
										<th>ID</th>
										<th>Title</th>
										<th>Author</th>
										<th>Publisher</th>
										<th>Total</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sql=mysqli_query($con,"select * from books");
										$cnt=1;
										while($row=mysqli_fetch_array($sql))
										{
									?>
									<tr>
										<td><?php echo $cnt;?>.</td>
										<td><?php echo $row['title'];?></td>
										<td><?php echo $row['author'];?></td>
										<td><?php echo $row['publisher'];?></td>
										<td><?php echo $row['total'];?></td>
										<td >
										<div>
											<!-- Menambah icon dari font awesome -->
										<a href="edit-buku.php?id=<?php echo $row['id'];?>" class="btn" title="Change"><i class="fa fa-pencil"></i></a>
																			
										<a href="manage-buku.php?id=<?php echo $row['id']?>&del=delete" title="Delete" onClick="return confirm('Are you sure you want to delete?')"class="btn"><i class="fa fa-times fa fa-white"></i></a>
										</div>
										</td>
									</tr>
									<?php 
										$cnt=$cnt+1;
									 }?>
									
								</tbody>
							</table>
						</div>
					</div>
					<div class="row text-end">
						<a href="add-buku.php" class="btn">
							<i class="fa-solid fa-circle-plus fa-2xl"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php } ?>