<?php
session_start();
ob_start();
error_reporting(0);
$p = $_GET['p'];
include('func/func.php');
$id = $_GET['id'];
if($_SESSION["type"] != ""){
	echo'
	<!DOCTYPE html>
	<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>EMU Security University - Student Portal</title>

		<!-- Custom fonts for this template-->
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
		<!-- Custom styles for this template-->
		<link href="css/sb-admin-2.min.css" rel="stylesheet">
		<link href="css/css.css" type="text/css" rel="stylesheet"/>

	</head>
	<body id="page-top">    
		<div id="wrapper">        
			<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">            
				<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
					<div class="sidebar-brand-text mx-3">Emu Security <sup>Student Portal</sup></div>
				</a>
				<hr class="sidebar-divider my-0">
				<li class="nav-item active">
					<a class="nav-link" href="index.php">
						<i class="fas fa-fw fa-tachometer-alt"></i>
						<span>Dashboard</span></a>
				</li>
				<hr class="sidebar-divider">            
				<div class="sidebar-heading">
					Attendance
				</div>';
				if($p == 6){
					echo'
					<li class="nav-item active">
						<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							<i class="fas fa-fw fa-cog"></i>
							<span>Course List</span>
						</a>						
						<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner rounded">
								<h6 class="collapse-header">Course List</h6>';								
								switch(allTextDecrtptionDes($_userTYPE,$key)){
									case 1:
										$listCourse = read("select * from course as c inner join class as cls on c.course_id=cls.course_id where cls.bin=0 and cls.student_id=".$_userID,2,$connect);							
										break;
									case 2:
										$listCourse = read("select crs.short_name,crs.course_id from class as c inner join student as s on c.student_id=s.student_id inner join course as crs on crs.course_id=c.course_id inner join parent as p on p.parent_id=s.parent_id where p.parent_id=".$_userID." group by crs.course_id",2,$connect);							
										break;
									case 3:
										if(userInformation()[4]){
											$listCourse = read("select * from course where department_id=".userInformation()[2],2,$connect);							
										}else{
											$listCourse = read("select * from course where teacher_id=".$_userID,2,$connect);							
										}										
										break;
									case 4:
										$listCourse = read("select * from course",2,$connect);							
										break;
								}											
								foreach($listCourse as $data){
									if($id == $data['course_id']){
										echo'
										<a class="collapse-item active" href="index.php?p=6&id='.$data['course_id'].'">'.allTextDecrtptionDes($data['short_name'],$key).'</a>';
									}else{
										echo'
										<a class="collapse-item" href="index.php?p=6&id='.$data['course_id'].'">'.allTextDecrtptionDes($data['short_name'],$key).'</a>';
									}								
								}							
							echo'
							</div>
						</div>
					</li>';
				}else{
					echo'
					<li class="nav-item">
						<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							<i class="fas fa-fw fa-cog"></i>
							<span>Course List</span>
						</a>						
						<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner rounded">
								<h6 class="collapse-header">Course List</h6>';
								switch(allTextDecrtptionDes($_userTYPE,$key)){
									case 1:
										$listCourse = read("select * from course as c inner join class as cls on c.course_id=cls.course_id where cls.bin=0 and cls.student_id=".$_userID,2,$connect);							
										break;
									case 2:
										$listCourse = read("select crs.short_name,crs.course_id from class as c inner join student as s on c.student_id=s.student_id inner join course as crs on crs.course_id=c.course_id inner join parent as p on p.parent_id=s.parent_id where p.parent_id=".$_userID." group by crs.course_id",2,$connect);							
										break;
									case 3:
										if(userInformation()[4]){
											$listCourse = read("select * from course where department_id=".userInformation()[2],2,$connect);							
										}else{
											$listCourse = read("select * from course where teacher_id=".$_userID,2,$connect);							
										}										
										break;
									case 4:
										$listCourse = read("select * from course",2,$connect);							
										break;
								}								
								foreach($listCourse as $data){
									echo'
									<a class="collapse-item" href="index.php?p=6&id='.$data['course_id'].'">'.allTextDecrtptionDes($data['short_name'],$key).'</a>';								
								}
							echo'
							</div>
						</div>
					</li>';
				}
				if((($p>0 && $p<6) || ($p == 7)) && (allTextDecrtptionDes($_userTYPE,$key)==4)){
					echo'
					<li class="nav-item active">
						<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
							<i class="fas fa-fw fa-cog"></i>
							<span>Setting</span>
						</a>
						<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner rounded">
								<h6 class="collapse-header">Operations</h6>';
								switch($p){
									case 1:
										echo'
										<a class="collapse-item active" href="index.php?p=1">Student Operations</a>
										<a class="collapse-item" href="index.php?p=2">Course Operations</a>
										<a class="collapse-item" href="index.php?p=3">Teacher Operations</a>
										<a class="collapse-item" href="index.php?p=4">Chair Operations</a>
										<a class="collapse-item" href="index.php?p=7">Department Operations</a>
										<a class="collapse-item" href="index.php?p=5">Administrator Operations</a>
										<a class="collapse-item" href="index.php?p=8">Key Operations</a>';
										break;
									case 2:
										echo'
										<a class="collapse-item" href="index.php?p=1">Student Operations</a>
										<a class="collapse-item active" href="index.php?p=2">Course Operations</a>
										<a class="collapse-item" href="index.php?p=3">Teacher Operations</a>
										<a class="collapse-item" href="index.php?p=4">Chair Operations</a>
										<a class="collapse-item" href="index.php?p=7">Department Operations</a>
										<a class="collapse-item" href="index.php?p=5">Administrator Operations</a>
										<a class="collapse-item" href="index.php?p=8">Key Operations</a>';
										break;
									case 3:
										echo'
										<a class="collapse-item" href="index.php?p=1">Student Operations</a>
										<a class="collapse-item" href="index.php?p=2">Course Operations</a>
										<a class="collapse-item active" href="index.php?p=3">Teacher Operations</a>
										<a class="collapse-item" href="index.php?p=4">Chair Operations</a>
										<a class="collapse-item" href="index.php?p=7">Department Operations</a>
										<a class="collapse-item" href="index.php?p=5">Administrator Operations</a>
										<a class="collapse-item" href="index.php?p=8">Key Operations</a>';
										break;
									case 4:
										echo'
										<a class="collapse-item" href="index.php?p=1">Student Operations</a>
										<a class="collapse-item" href="index.php?p=2">Course Operations</a>
										<a class="collapse-item" href="index.php?p=3">Teacher Operations</a>
										<a class="collapse-item active" href="index.php?p=4">Chair Operations</a>
										<a class="collapse-item" href="index.php?p=7">Department Operations</a>
										<a class="collapse-item" href="index.php?p=5">Administrator Operations</a>
										<a class="collapse-item" href="index.php?p=8">Key Operations</a>';
										break;
									case 5:
										echo'
										<a class="collapse-item" href="index.php?p=1">Student Operations</a>
										<a class="collapse-item" href="index.php?p=2">Course Operations</a>
										<a class="collapse-item" href="index.php?p=3">Teacher Operations</a>
										<a class="collapse-item" href="index.php?p=4">Chair Operations</a>
										<a class="collapse-item" href="index.php?p=7">Department Operations</a>
										<a class="collapse-item active" href="index.php?p=5">Administrator Operations</a>
										<a class="collapse-item" href="index.php?p=8">Key Operations</a>';
										break;
									case 7:
										echo'
										<a class="collapse-item" href="index.php?p=1">Student Operations</a>
										<a class="collapse-item" href="index.php?p=2">Course Operations</a>
										<a class="collapse-item" href="index.php?p=3">Teacher Operations</a>
										<a class="collapse-item" href="index.php?p=4">Chair Operations</a>
										<a class="collapse-item active" href="index.php?p=7">Department Operations</a>
										<a class="collapse-item" href="index.php?p=5">Administrator Operations</a>
										<a class="collapse-item" href="index.php?p=8">Key Operations</a>';
										break;
									case 8:
										echo'
										<a class="collapse-item" href="index.php?p=1">Student Operations</a>
										<a class="collapse-item" href="index.php?p=2">Course Operations</a>
										<a class="collapse-item" href="index.php?p=3">Teacher Operations</a>
										<a class="collapse-item" href="index.php?p=4">Chair Operations</a>
										<a class="collapse-item" href="index.php?p=7">Department Operations</a>
										<a class="collapse-item" href="index.php?p=5">Administrator Operations</a>
										<a class="collapse-item active" href="index.php?p=8">Key Operations</a>';
										break;
									default:
										echo'
										<a class="collapse-item" href="index.php?p=1">Student Operations</a>
										<a class="collapse-item" href="index.php?p=2">Course Operations</a>
										<a class="collapse-item" href="index.php?p=3">Teacher Operations</a>
										<a class="collapse-item" href="index.php?p=4">Chair Operations</a>
										<a class="collapse-item" href="index.php?p=7">Department Operations</a>
										<a class="collapse-item" href="index.php?p=5">Administrator Operations</a>
										<a class="collapse-item" href="index.php?p=8">Key Operations</a>';
										break;
								}
								
							echo'
							</div>
						</div>
					</li>';	
				}else if((allTextDecrtptionDes($_userTYPE,$key)==4)){
					echo'
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
							<i class="fas fa-fw fa-cog"></i>
							<span>Setting</span>
						</a>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner rounded">
								<h6 class="collapse-header">Operations</h6>
								<a class="collapse-item" href="index.php?p=1">Student Operations</a>
								<a class="collapse-item" href="index.php?p=2">Course Operations</a>
								<a class="collapse-item" href="index.php?p=3">Teacher Operations</a>
								<a class="collapse-item" href="index.php?p=4">Chair Operations</a>
								<a class="collapse-item" href="index.php?p=7">Department Operations</a>
								<a class="collapse-item" href="index.php?p=5">Administrator Operations</a> 
								<a class="collapse-item" href="index.php?p=8">Key Operations</a>								
							</div>
						</div>
					</li>';	
				}
				
				
				echo'
			</ul>
			<div id="content-wrapper" class="d-flex flex-column">            
				<div id="content">
					<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
						<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
							<i class="fa fa-bars"></i>
						</button>
						<ul class="navbar-nav ml-auto">
							<li class="nav-item dropdown no-arrow">
								<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
									data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="mr-2 d-none d-lg-inline text-gray-600 small">'.userInformation()[0].'</span>
									<img class="img-profile rounded-circle"
										src="img/undraw_profile.svg">
								</a>
								<!-- Dropdown - User Information -->
								<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
									aria-labelledby="userDropdown">
									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#changePasswordModal">
										<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
										Profile
									</a>                               
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
										<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
										Logout
									</a>
								</div>
							</li>
						</ul>
					</nav>';
					switch($p){
						case 1:
							if(allTextDecrtptionDes($_userTYPE,$key) == 4){							
								echo'
								<div class="container-fluid">
									<!-- Page Heading -->
									<div class="d-sm-flex align-items-center justify-content-between mb-4">
										<h1 class="h3 mb-0 text-gray-800">Student Operations</h1>
									</div>
									<div class="alert alertMessageSuccess" id="alert" role="alert">
										Hello Security Term Project
									</div>
									<!-- Content Row -->
									<div class="row">
										<div class="col-md-12 mb-2">
											<div class="card shadow w-100">
												<div class="card-header">
													Add Student
												</div>
												<div class="card-body">
													<div class="form-row">
														<div class="form-group col-md-6">
															<label for="name">Student Name and Surname</label>
															<input type="text" class="form-control" id="name" placeholder="Harry Potter">
														</div>
														<div class="form-group col-md-6">
															<label for="departments">Department</label>
															<select id="departments" class="form-control">
															</select>
														</div>
														<div class="form-group col-md-6">
															<label for="fatherName">Father Name</label>
															<input type="text" class="form-control" id="fatherName" placeholder="James Potter">
														</div>
														<div class="form-group col-md-6">
															<label for="fatherPhone">Father Phone Number</label>
															<input type="text" class="form-control" id="fatherPhone" placeholder="+905335224562">
														</div>
														<div class="form-group col-md-12">
															<label for="password">Password</label>
															<input type="password" class="form-control" id="password" placeholder="**********">
														</div>
														<div class="form-group col-md-12">
															<label for="address">Address</label>
															<input type="text" class="form-control" id="address" placeholder="1234 Main St">
														</div>
													</div>
													<button type="submit" class="btn btn-primary" style="float:right;" onclick="addStudent()">Save</button>
												</div>
											</div>
										</div>
										<div class="col-md-12 mb-4">
											<div class="card shadow w-100">
												<div class="card-header">
													Student List
												</div>
												<div class="card-body">
													<table class="table">
														<thead>
															<tr>
																<th scope="col">Student Number</th>
																<th scope="col">Student Name</th>
																<th scope="col">Student Department</th>
																<th scope="col">Student Father Name</th>
																<th scope="col">#</th>
															</tr>
														</thead>
														<tbody id="students">													
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>								
								</div>';
							}else{
								header("refresh:0;url=index.php");
							}
							break;
						case 2:
							if(allTextDecrtptionDes($_userTYPE,$key) == 4){							
								echo'
								<div class="container-fluid">
									<!-- Page Heading -->
									<div class="d-sm-flex align-items-center justify-content-between mb-4">
										<h1 class="h3 mb-0 text-gray-800">Course Operations</h1>
									</div>
									<div class="alert alertMessageSuccess" id="alert" role="alert">
										Hello Security Term Project
									</div>
									<!-- Content Row -->
									<div class="row">
										<div class="col-md-12 mb-2">
											<div class="card shadow w-100">
												<div class="card-header">
													Add Course
												</div>
												<div class="card-body">
													<div class="form-row">
														<div class="form-group col-md-6">
															<label for="courseName">Course Name</label>
															<input type="text" class="form-control" id="courseName" placeholder="Security of Software Systems">
														</div>
														<div class="form-group col-md-6">
															<label for="courseShortName">Course Short Name</label>
															<input type="text" class="form-control" id="courseShortName" placeholder="CMSE353">
														</div>
														<div class="form-group col-md-6">
															<label for="departments">Department Name</label>
															<select id="departments" onchange="readCourseInst()" class="form-control">
															</select>
														</div>	
														<div class="form-group col-md-6">
															<label for="courseInst">Course Instructor</label>
															<select id="courseInst" class="form-control">
															</select>
														</div>													
													</div>
													<button type="submit" class="btn btn-primary" style="float:right;" onclick="addCourse()">Save</button>
												</div>
											</div>
										</div>
										<div class="col-md-12 mb-4">
											<div class="card shadow w-100">
												<div class="card-header">
													Course List
												</div>
												<div class="card-body">
													<table class="table">
														<thead>
															<tr>
																<th scope="col">#</th>
																<th scope="col">Course Name</th>
																<th scope="col">Course Short Name</th>		
																<th scope="col">Department Name</th>
																<th scope="col">Course Instructor</th>															
																<th scope="col">#</th>
															</tr>
														</thead>
														<tbody id="courses">													
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>								
								</div>';
							}else{
								header("refresh:0;url=index.php");
							}								
							break;
						case 3:
							if(allTextDecrtptionDes($_userTYPE,$key) == 4){							
								echo'
								<div class="container-fluid">
									<!-- Page Heading -->
									<div class="d-sm-flex align-items-center justify-content-between mb-4">
										<h1 class="h3 mb-0 text-gray-800">Teacher Operations</h1>
									</div>
									<div class="alert alertMessageSuccess" id="alert" role="alert">
										Hello Security Term Project
									</div>
									<!-- Content Row -->
									<div class="row">
										<div class="col-md-12 mb-2">
											<div class="card shadow w-100">
												<div class="card-header">
													Add Teacher
												</div>
												<div class="card-body">
													<div class="form-row">
														<div class="form-group col-md-6">
															<label for="teacherName">Teacher Name</label>
															<input type="text" class="form-control" id="teacherName" placeholder="Professor Albus Dumbledore">
														</div>
														<div class="form-group col-md-6">
															<label for="password">Password</label>
															<input type="password" class="form-control" id="password" placeholder="************">
														</div>	
														<div class="form-group col-md-12">
															<label for="department">Department</label>
															<select id="departments" class="form-control">
															</select>
														</div>													
													</div>
													<button type="submit" class="btn btn-primary" style="float:right;" onclick="addTeacher()">Save</button>
												</div>
											</div>
										</div>
										<div class="col-md-12 mb-4">
											<div class="card shadow w-100">
												<div class="card-header">
													Teacher List
												</div>
												<div class="card-body">
													<table class="table">
														<thead>
															<tr>
																<th scope="col">Teacher ID</th>
																<th scope="col">Teacher Name</th>	
																<th scope="col">Department Name</th>															
																<th scope="col">#</th>
															</tr>
														</thead>
														<tbody id="teachers">																								
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>								
								</div>';	
							}else{
								header("refresh:0;url=index.php");
							}								
							break;
						case 4:
							if(allTextDecrtptionDes($_userTYPE,$key) == 4){
								echo'
								<div class="container-fluid">
									<!-- Page Heading -->
									<div class="d-sm-flex align-items-center justify-content-between mb-4">
										<h1 class="h3 mb-0 text-gray-800">Chair Operations</h1>
									</div>
									<div class="alert alertMessageSuccess" id="alert" role="alert">
										Hello Security Term Project
									</div>
									<!-- Content Row -->
									<div class="row">
										<div class="col-md-12 mb-2">
											<div class="card shadow w-100">
												<div class="card-header">
													Add Chair
												</div>
												<div class="card-body">
													<div class="form-row">
														<div class="form-group col-md-6">
															<label for="departments">Department</label>
															<select id="departments" onchange="readCourseInst()" class="form-control">
															</select>
														</div>	
														<div class="form-group col-md-6">
															<label for="courseInst">Course Instructor</label>
															<select id="courseInst" class="form-control">
															</select>
														</div>												
													</div>
													<button type="submit" class="btn btn-primary" style="float:right;" onclick="addChair()">Save</button>
												</div>
											</div>
										</div>
										<div class="col-md-12 mb-4">
											<div class="card shadow w-100">
												<div class="card-header">
													Chair List
												</div>
												<div class="card-body">
													<table class="table">
														<thead>
															<tr>
																<th scope="col">#</th>
																<th scope="col">Teacher Name</th>															
																<th scope="col">Department</th>
																<th scope="col">#</th>
															</tr>
														</thead>
														<tbody id="chairs">												
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>								
								</div>';	
							}else{
								header("refresh:0;url=index.php");
							}								
							break;
						case 5:
							if(allTextDecrtptionDes($_userTYPE,$key) == 4){
								echo'
								<div class="container-fluid">
									<!-- Page Heading -->
									<div class="d-sm-flex align-items-center justify-content-between mb-4">
										<h1 class="h3 mb-0 text-gray-800">Administrator Operations</h1>
									</div>
									<div class="alert alertMessageSuccess" id="alert" role="alert">
										Hello Security Term Project
									</div>
									<!-- Content Row -->
									<div class="row">
										<div class="col-md-12 mb-2">
											<div class="card shadow w-100">
												<div class="card-header">
													Add Administrator
												</div>
												<div class="card-body">
													<div class="form-row">
														<div class="form-group col-md-6">
															<label for="name">Administrator Name</label>
															<input type="text" class="form-control" id="name" placeholder="Hermione Granger">
														</div>
														<div class="form-group col-md-6">
															<label for="password">Password</label>
															<input type="password" class="form-control" id="password" placeholder="************">
														</div>													
													</div>
													<button class="btn btn-primary" style="float:right;" onclick="addAdministrator()">Save</button>
												</div>
											</div>
										</div>
										<div class="col-md-12 mb-4">
											<div class="card shadow w-100">
												<div class="card-header">
													Administrator List
												</div>
												<div class="card-body">
													<table class="table">
														<thead>
															<tr>
																<th scope="col">Administrator ID</th>
																<th scope="col">Administrator Name</th>															
																<th scope="col">#</th>
															</tr>
														</thead>
														<tbody id="administrators">												
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>								
								</div>';	
							}else{
								header("refresh:0;url=index.php");
							}								
							break;
						case 6:
							echo'
							<div class="container-fluid">
								<div class="row mb-4">
									<div class="col-md-6">
										<h1 class="h3 mb-0 text-gray-800" id="courseNameHeader">Security of Software Systems ( CMSE353 )</h1>
									</div>
									<div class="col-md-6">';
										if(!(allTextDecrtptionDes($_userTYPE,$key) == 3 && !userInformation()[4]) && allTextDecrtptionDes($_userTYPE,$key) == 4){
											echo'
											<button class="btn btn-info float-right ml-2" data-toggle="modal" data-target="#exampleModal" onclick="readStudentList('.$id.')">Add Student</button>
											<button class="btn btn-danger float-right ml-2" data-toggle="modal" data-target="#exampleModal" onclick="readDeleteStudentClassList('.$id.')">Delete Student from Class</button>
											<button class="btn btn-warning float-right ml-2" data-toggle="modal" data-target="#exampleModal" onclick="readAttendanceHistoryModel('.$id.')">Attendance History</button>';
										}else{
											echo'
											<button class="btn btn-info float-right ml-2" data-toggle="modal" data-target="#exampleModal" disabled>Add Student</button>
											<button class="btn btn-danger float-right ml-2" data-toggle="modal" data-target="#exampleModal" disabled>Delete Student from Class</button>
											<button class="btn btn-warning float-right ml-2" data-toggle="modal" data-target="#exampleModal" onclick="readAttendanceHistoryModel('.$id.')">Attendance History</button>';
										}											
									echo'
									</div>															
								</div>			
								
								<div class="row">
									<div class="col-md-12">
										<div class="card shadow">
											<div class="card-header">
												Class List';												
												if(allTextDecrtptionDes($_userTYPE,$key) == 3 && !userInformation()[4]){
													echo'
													<button class="btn btn-success float-right" onclick="addAttendance('.$id.')">Save</button>';
												}else{
													echo'
													<button class="btn btn-success float-right" disabled>Save</button>';
												}
											echo'
											</div>
											<div class="card-body">
												<div class="table-responsive">
													<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
														<thead>
															<tr>
																<th>#</th>
																<th>Student Number</th>
																<th>Name</th>															
																<th>Departmant Name</th>
																<th>Total Attandance</th>
																<th>Attendance</th>															
															</tr>
														</thead>													
														<tbody id="classList">											 
														</tbody>
													</table>
												</div>
											</div>										
										</div>								
									</div>															
								</div>
							</div>';
							break;
						case 7:
							if(allTextDecrtptionDes($_userTYPE,$key) == 4){
								echo'
								<div class="container-fluid">
									<!-- Page Heading -->
									<div class="d-sm-flex align-items-center justify-content-between mb-4">
										<h1 class="h3 mb-0 text-gray-800">Department Operations</h1>									
									</div>
									<div class="alert alertMessageSuccess" id="alert" role="alert">
										Hello Security Term Project
									</div>
									<!-- Content Row -->
									<div class="row">
										<div class="col-md-12 mb-2">
											<div class="card shadow w-100">
												<div class="card-header">
													Add Department
												</div>
												<div class="card-body">
													<div class="form-row">
														<div class="form-group col-md-12">
															<label for="department">Department Name</label>
															<input type="text" class="form-control" id="department" placeholder="Computer Engineering">
														</div>																							
													</div>
													<button type="submit" class="btn btn-primary" style="float:right;" onclick="addDepartmant()">Save</button>
												</div>
											</div>
										</div>
										<div class="col-md-12 mb-4">
											<div class="card shadow w-100">
												<div class="card-header">
													Department List
												</div>
												<div class="card-body">
													<table class="table">
														<thead>
															<tr>
																<th scope="col">#</th>
																<th scope="col">Department Name</th>														
																<th scope="col">#</th>
															</tr>
														</thead>
														<tbody id="departmentsL">																									
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>								
								</div>';	
							}else{
								header("refresh:0;url=index.php");
							}								
							break;
						case 8:
							if(allTextDecrtptionDes($_userTYPE,$key) == 4){
								echo'
								<div class="container-fluid">
									<!-- Page Heading -->
									<div class="d-sm-flex align-items-center justify-content-between mb-4">
										<h1 class="h3 mb-0 text-gray-800">Key Operations</h1>									
									</div>
									<div class="alert alertMessageSuccess" id="alert" role="alert">
										Hello Security Term Project
									</div>
									<!-- Content Row -->
									<div class="row">
										<div class="col-md-12 mb-2">
											<div class="card shadow w-100">
												<div class="card-header">
													Change Key
												</div>
												<div class="card-body">
													<div class="form-row">
														<div class="form-group col-md-12">
															<label for="department">New Key</label>
															<input type="text" class="form-control" id="newKey" placeholder="AABB09182736CCDD">
														</div>																							
													</div>
													<button type="submit" class="btn btn-primary" style="float:right;" onclick="changeKey()">Change</button>
												</div>
											</div>
										</div>										
									</div>								
								</div>';	
							}else{
								header("refresh:0;url=index.php");
							}								
							break;
						default:
							echo'
								<!-- Begin Page Content -->
								<div class="container-fluid">

									<!-- Page Heading -->
									<div class="d-sm-flex align-items-center justify-content-between mb-4">
										<h1 class="h3 mb-0 text-gray-800">CMSE353 Security Term Project</h1>
									</div>

									<!-- Content Row -->
									<div class="row" id="readMainCoursList">						
										
									</div>
								</div>';
							break;
					}
					
				echo'
				</div>
			</div>        
		</div>
		<!-- End of Page Wrapper -->

		<!-- Scroll to Top Button-->
		<a class="scroll-to-top rounded" href="#page-top">
			<i class="fas fa-angle-up"></i>
		</a>

		<!-- Logout Modal-->
		<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						<a class="btn btn-primary" href="func/ajaxControl.php?l=2">Logout</a>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Logout Modal-->
		<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group col-md-12">
							<label for="name">New Password</label>
							<input type="password" class="form-control" id="passwordModal" placeholder="*************">
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						<a class="btn btn-primary" href="#" onclick="changePassword()">Save</a>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content" id="modalC">
				</div>
			</div>
		</div>


		
		<!-- Bootstrap core JavaScript-->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

		<!-- Core plugin JavaScript-->
		<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
		
		<!-- Custom scripts for all pages-->
		<script src="js/sb-admin-2.min.js"></script>
		<script src="js/jquery.js"></script>
		<script src="js/js.js"></script>
		<script type="text/javascript">';
			switch($p){
				case 1:
					echo'
					readDepartmentSelect();
					readStudents();';
					break;
				case 2:
					echo'
					readDepartmentSelect();
					readCourses();				
					readTeacherC();';
					break;
				case 3:
					echo'
					readDepartmentSelect();				
					readTeacher();';
					break;
				case 4:
					echo'
					readDepartmentSelect();	
					readChair();		
					readTeacherC();';
					break;
				case 5:
					echo'
					readAdministrator();';
					break;
				case 6:
					echo'				
					readClassList('.$id.');
					readCourseHeader('.$id.');';
					break;
				case 7:
					echo'
					readDepartment();';
					break;
				case 8:
					break;
				default:
					echo'
					readMainCoursList();';
					break;
			}
		echo'		
		</script>
	</body>

	</html>';
}else{
	header("refresh:0;url=login.php");
}
?>