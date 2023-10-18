<?php
ob_start();
include('func.php');
$l  = secureData($_GET['l']);
$i = secureData($_GET['i']);
$r = secureData($_GET['r']);
$u = secureData($_GET['u']);
switch($l){
	case 1:
		$studentNumber = secureData($_POST['studentNumber']);
		$password = secureData($_POST['password']);
		try{
			echo login($studentNumber,$password,$connect);
		}catch(Exception $e){
			echo "There is a problem. Please try again later.";
		}
		break;
	case 2:
		if(logout() == 1){
			header("refresh:0;url=../index.php");
		}
		break;
	default:
		break;
}
switch($i){
	case 1:
		$department = secureData($_POST['department']);		
		try{
			addDepartment($department,$connect);
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
	case 2:
		$name = secureData($_POST['name']);		
		$department = secureData($_POST['departments']);
		$fatherName = secureData($_POST['fatherName']);
		$fatherPhone = secureData($_POST['fatherPhone']);
		$address = secureData($_POST['address']);
		$password = secureData($_POST['password']);	
		try{
			addStudent($name,$department,$fatherName,$fatherPhone,$address,$password,$connect);
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
	case 3:
		$courseName = secureData($_POST['courseName']);		
		$courseShortName = secureData($_POST['courseShortName']);
		$departments = secureData($_POST['departments']);	
		$courseInst = secureData($_POST['courseInst']);		
		try{
			addCourse($courseName,$courseShortName,$departments,$courseInst,$connect);
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
	case 4:	
		$teacherName = secureData($_POST['teacherName']);		
		$password = secureData($_POST['password']);
		$department = secureData($_POST['department']);		
		try{
			echo addTeacher($teacherName,$password,$department,$connect);
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
	case 5:
		$teacher = secureData($_POST['teacher_id']);		
		$department = secureData($_POST['department']);	
		try{
			addChair($teacher,$department,$connect);
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
	case 6:
		$name = secureData($_POST['name']);		
		$password = secureData($_POST['password']);	
		try{
			echo addAdministrator($name,$password,$connect);
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
	case 7:
		$courseID = secureData($_POST['courseID']);		
		$studentID = $_POST['studentID'];
		try{
			foreach($studentID as $data){
				addClass($courseID,$data,$connect);				
			}		
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
	case 8:
		$courseID = secureData($_POST['courseID']);		
		$studentID = $_POST['studentID'];
		try{
			foreach($studentID as $data){
				addAttendance($courseID,$data,$connect);				
			}		
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
	default:
		break;
}
switch($r){
	case 1:
		$departmentList = read("select * from department where bin=0 order by department_id desc",2,$connect);
		$i = 1;
		foreach($departmentList as $data){
			echo'
			<tr>
				<th scope="row">'.$i.'</th>
				<td>'.allTextDecrtptionDes($data['name'],$key).'</td>														
				<td><div class="pencil" style="cursor:pointer;" onclick="#"></div>  <div class="trash" style="cursor:pointer;" onclick="deleteDepartment('.$data['department_id'].')"></div></div></td>
			</tr>';
			$i += 1;
		}
		break;
	case 2:
		$departmentList = read("select * from department where bin=0",2,$connect);
		echo'
		<option></option>';															
		foreach($departmentList as $data){
			echo'<option value="'.$data['department_id'].'">'.allTextDecrtptionDes($data['name'],$key).'</option>';
		}
		break;
	case 3:
		$studentList = read("select s.student_id as studentID,s.student_number as studentNumber,s.name as studentName,d.name as departmentName,p.name as parentName from student as s inner join department as d on d.department_id=s.department_id inner join parent as p on p.parent_id=s.parent_id where s.bin=0",2,$connect);
		$i = 1;
		foreach($studentList as $data){
			echo'
			<tr>
				<th scope="row">'.allTextDecrtptionDes($data['studentNumber'],$key).'</th>
				<td>'.allTextDecrtptionDes($data['studentName'],$key).'</td>	
				<td>'.allTextDecrtptionDes($data['departmentName'],$key).'</td>				
				<td>'.allTextDecrtptionDes($data['parentName'],$key).'</td>
				<td><div class="pencil" style="cursor:pointer;" onclick="#"></div>  <div class="trash" style="cursor:pointer;" onclick="deleteStudent('.$data['studentID'].')"></div></div></td>
			</tr>';
			$i += 1;
		}
		break;
	case 4:
		$department = secureData($_POST['department']);
		$teacherList = read("select * from teacher where bin=0 and department_id=".$department,2,$connect);
		echo'
		<option></option>';															
		foreach($teacherList as $data){
			echo'<option value="'.$data['teacher_id'].'">'.allTextDecrtptionDes($data['name'],$key).'</option>';
		}
		break;
	case 5:
		$teacherList = read("select t.tid as teacherID,t.teacher_id as id, t.name as teacherName, d.name as departmentName from teacher as t inner join department as d on t.department_id=d.department_id where t.bin=0",2,$connect);
		$i = 1;
		foreach($teacherList as $data){
			echo'
			<tr>
				<td>'.allTextDecrtptionDes($data['teacherID'],$key).'</td>	
				<td>'.allTextDecrtptionDes($data['teacherName'],$key).'</td>				
				<td>'.allTextDecrtptionDes($data['departmentName'],$key).'</td>
				<td><div class="pencil" style="cursor:pointer;" onclick="#"></div>  <div class="trash" style="cursor:pointer;" onclick="deleteTeacher('.$data['id'].')"></div></div></td>
			</tr>';
			$i += 1;
		}
		break;
	case 6:
		$courseList = read("select c.course_id as courseID,c.course_name as courseName,c.short_name as shortName,d.name as departmentName,t.name as teacherName from course as c inner join teacher as t on c.teacher_id=t.teacher_id inner join department as d on d.department_id=c.department_id where c.bin=0",2,$connect);
		$i = 1;
		foreach($courseList as $data){
			echo'
			<tr>
				<th scope="row">'.$i.'</th>
				<td>'.allTextDecrtptionDes($data['courseName'],$key).'</td>	
				<td>'.allTextDecrtptionDes($data['shortName'],$key).'</td>				
				<td>'.allTextDecrtptionDes($data['departmentName'],$key).'</td>
				<td>'.allTextDecrtptionDes($data['teacherName'],$key).'</td>
				<td><div class="pencil" style="cursor:pointer;" onclick="#"></div>  <div class="trash" style="cursor:pointer;" onclick="deleteCourse('.$data['courseID'].')"></div></div></td>
			</tr>';
			$i += 1;
		}
		break;
	case 7:
		$chairList = read("select c.chair_id as chairID,t.name as teacherName, d.name as departmentName from chair as c inner join teacher as t on c.teacher_id=t.teacher_id inner join department as d on d.department_id=c.department_id where c.bin=0",2,$connect);
		$i = 1;
		foreach($chairList as $data){
			echo'
			<tr>
				<th scope="row">'.$i.'</th>		
				<td>'.allTextDecrtptionDes($data['teacherName'],$key).'</td>
				<td>'.allTextDecrtptionDes($data['departmentName'],$key).'</td>				
				<td><div class="pencil" style="cursor:pointer;" onclick="#"></div>  <div class="trash" style="cursor:pointer;" onclick="deleteChair('.$data['chairID'].')"></div></div></td>
			</tr>';
			$i += 1;
		}
		break;
	case 8:
		$administratorList = read("select * from administrator where bin=0",2,$connect);
		$i = 1;
		foreach($administratorList as $data){
			echo'
			<tr>
				<th scope="row">'.allTextDecrtptionDes($data['aid'],$key).'</th>		
				<td>'.allTextDecrtptionDes($data['name'],$key).'</td>			
				<td><div class="pencil" style="cursor:pointer;" onclick="#"></div>  <div class="trash" style="cursor:pointer;" onclick="deleteAdministrator('.$data['administrator_id'].')"></div></td>
			</tr>';
			$i += 1;
		}
		break;
	case 9:
		$id = secureData($_POST['id']);
		echo'
		<div class="modal-header">
			<h1 class="modal-title fs-5" id="exampleModalLabel">Student List</h1>        
		</div>
		<div class="modal-body">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">Student Number</th>
						<th scope="col">Student Name</th>
						<th scope="col">Student Department</th>
						<th scope="col">#</th>
					</tr>
				</thead>
				<tbody>';
					$studentList = read("select s.student_id as studentID,s.name as studentName,s.student_number as studentNumber,d.name as departmentName,p.name as parentName, (select count(c.student_id) from class as c where c.student_id=s.student_id and c.course_id=".$id." and c.bin=0) as total from student as s inner join department as d on d.department_id=s.department_id inner join parent as p on p.parent_id=s.parent_id where s.bin=0",2,$connect);
					$i = 1;
					foreach($studentList as $data){
						echo'
						<tr>
							<th scope="row">'.allTextDecrtptionDes($data['studentNumber'],$key).'</th>
							<td>'.allTextDecrtptionDes($data['studentName'],$key).'</td>	
							<td>'.allTextDecrtptionDes($data['departmentName'],$key).'</td>';
							if($data['total']>0){
								echo'
								<td><input class="form-check-input" type="checkbox" value="'.$data['studentID'].'" id="studentID" checked disabled></td>';
							}else{
								echo'
								<td><input class="form-check-input" type="checkbox" value="'.$data['studentID'].'" onclick="addStudentCheckBox('.$data['studentID'].')" id="studentID"></td>';
							}
							
						echo'
						</tr>';
						$i += 1;
					}
				echo'
				</tbody>
			</table>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-primary" onclick="addClass('.$id.')">Save changes</button>
		</div>';
		break;
	case 10:
		$id = secureData($_POST['id']);
		echo'
		<div class="modal-header">
			<h1 class="modal-title fs-5" id="exampleModalLabel">Student List</h1>        
		</div>
		<div class="modal-body">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">Student Number</th>
						<th scope="col">Student Name</th>
						<th scope="col">Student Department</th>
						<th scope="col">#</th>
					</tr>
				</thead>
				<tbody>';
					$studentList = read("select s.name as studentName,s.student_number as studentNumber,d.name as departmentName,c.id as id from class as c inner join student as s on s.student_id=c.student_id inner join department as d on d.department_id=s.department_id where c.bin=0 and c.course_id=".$id,2,$connect);
					$i = 1;
					foreach($studentList as $data){
						echo'
						<tr>
							<th scope="row">'.allTextDecrtptionDes($data['studentNumber'],$key).'</th>
							<td>'.allTextDecrtptionDes($data['studentName'],$key).'</td>	
							<td>'.allTextDecrtptionDes($data['departmentName'],$key).'</td>
							<td><a href="#" onclick="deleteStudentFromClass('.$data['id'].','.$id.')">Delete</a></td>
						</tr>';
						$i += 1;
					}
				echo'
				</tbody>
			</table>
		</div>';
		break;
	case 11:		
		$id = secureData($_POST['id']);
		switch(allTextDecrtptionDes($_userTYPE,$key)){
			case 1:				
				$classList = read("select s.student_number as studentNumber,s.student_id as studentID, s.name as studentName,d.name as departmentName,(select count(student_id) from attendance where student_id=s.student_id and DATE_FORMAT(yorn, '%Y-%d-%m')=DATE_FORMAT(NOW(), '%Y-%d-%m')) as total,(select count(student_id) from attendance where student_id=s.student_id and course_id=".$id.") as total1 from class as c inner join student as s on s.student_id=c.student_id inner join department as d on d.department_id=s.department_id inner join course as cr on cr.course_id=c.course_id where c.bin=0 and c.course_id=".$id." and  s.student_id=".$_userID,2,$connect);
				break;
			case 2:
				$classList = read("select s.student_number as studentNumber,s.student_id as studentID, s.name as studentName,d.name as departmentName,(select count(student_id) from attendance where student_id=s.student_id and DATE_FORMAT(yorn, '%Y-%d-%m')=DATE_FORMAT(NOW(), '%Y-%d-%m')) as total,(select count(student_id) from attendance where student_id=s.student_id and course_id=".$id.") as total1 from class as c inner join student as s on s.student_id=c.student_id inner join department as d on d.department_id=s.department_id inner join parent as p on p.parent_id=s.parent_id where c.bin=0 and c.course_id=".$id." and p.parent_id=".$_userID,2,$connect);
				break;
			case 3:
				$classList = read("select s.student_number as studentNumber,s.student_id as studentID, s.name as studentName,d.name as departmentName,(select count(student_id) from attendance where student_id=s.student_id and DATE_FORMAT(yorn, '%Y-%d-%m')=DATE_FORMAT(NOW(), '%Y-%d-%m')) as total,(select count(student_id) from attendance where student_id=s.student_id and course_id=".$id.") as total1 from class as c inner join student as s on s.student_id=c.student_id inner join department as d on d.department_id=s.department_id where c.bin=0 and c.course_id=".$id,2,$connect);
				break;
			case 4:
				$classList = read("select s.student_number as studentNumber,s.student_id as studentID, s.name as studentName,d.name as departmentName,(select count(student_id) from attendance where student_id=s.student_id and DATE_FORMAT(yorn, '%Y-%d-%m')=DATE_FORMAT(NOW(), '%Y-%d-%m')) as total,(select count(student_id) from attendance where student_id=s.student_id and course_id=".$id.") as total1 from class as c inner join student as s on s.student_id=c.student_id inner join department as d on d.department_id=s.department_id where c.bin=0 and c.course_id=".$id,2,$connect);
				break;
		}
		$i = 1;
		foreach($classList as $data){
			echo'
			<tr>
				<th scope="row">'.$i.'</th>		
				<td>'.allTextDecrtptionDes($data['studentNumber'],$key).'</td>
				<td>'.allTextDecrtptionDes($data['studentName'],$key).'</td>				
				<td>'.allTextDecrtptionDes($data['departmentName'],$key).'</td>							
				<td>'.$data['total'].'</td>';
				if($data['total1']>0){
					echo'
					<td align="center"><input class="form-check-input" type="checkBox" value="'.$data['studentID'].'" disabled checked></td>';
				}else if(allTextDecrtptionDes($_userTYPE,$key)==3){
					echo'
					<td align="center"><input class="form-check-input" type="checkBox" value="'.$data['studentID'].'" onclick="addStudentCheckBox1('.$data['studentID'].')"></td>';
				}else{
					echo'
					<td align="center"><input class="form-check-input" type="checkBox" value="'.$data['studentID'].'" disabled></td>';
				}					
			echo'
			</tr>';
			$i += 1;
		}
		break;
	case 12:
		$id = secureData($_POST['id']);
		echo'
		<div class="modal-header">
			<h1 class="modal-title fs-5" id="exampleModalLabel">Attendance History</h1>        
		</div>
		<div class="modal-body">
			<div class="form-group col-md-12">
				<label for="department">Date</label>
				<input type="date" class="form-control" id="date" onchange="readAttendenceHistory('.$id.')">
			</div>		
			<table class="table">
				<thead>
					<tr>
						<th scope="col">Student Number</th>
						<th scope="col">Student Name</th>
						<th scope="col">Student Department</th>
					</tr>
				</thead>
				<tbody id="attendanceHistory">
				</tbody>
			</table>
		</div>';
		break;
	case 13:
		$date = $_POST['date'];
		$id = secureData($_POST['id']);
		switch(allTextDecrtptionDes($_userTYPE,$key)){
			case 1:				
				$studentList = read("select s.student_number as studentNumber,s.name as studentName,d.name as departmentName from attendance as a inner join student as s on a.student_id=s.student_id inner join department as d on d.department_id=s.department_id where a.yorn>='".$date." 00:00:00' and a.yorn<='".$date." 23:59:59' and a.course_id=".$id." and s.student_id=".$_userID,2,$connect);
				break;
			case 2:
				$studentList = read("select s.student_number as studentNumber,s.name as studentName,d.name as departmentName from attendance as a inner join student as s on a.student_id=s.student_id inner join department as d on d.department_id=s.department_id inner join parent as p on p.parent_id=s.student_id where a.yorn>='".$date." 00:00:00' and a.yorn<='".$date." 23:59:59' and p.parent_id=".$_userID." and a.course_id=".$id,2,$connect);
				break;
			case 3:
				$studentList = read("select s.student_number as studentNumber,s.name as studentName,d.name as departmentName from attendance as a inner join student as s on a.student_id=s.student_id inner join department as d on d.department_id=s.department_id where a.yorn>='".$date." 00:00:00' and a.yorn<='".$date." 23:59:59' and a.course_id=".$id,2,$connect);
				break;
			case 4:
				$studentList = read("select s.student_number as studentNumber,s.name as studentName,d.name as departmentName from attendance as a inner join student as s on a.student_id=s.student_id inner join department as d on d.department_id=s.department_id where a.yorn>='".$date." 00:00:00' and a.yorn<='".$date." 23:59:59' and a.course_id=".$id,2,$connect);
				break;
		}		
		$i = 1;
		foreach($studentList as $data){
			echo'
			<tr>
				<th scope="row">'.allTextDecrtptionDes($data['studentNumber'],$key).'</th>
				<td>'.allTextDecrtptionDes($data['studentName'],$key).'</td>	
				<td>'.allTextDecrtptionDes($data['departmentName'],$key).'</td>							
			</tr>';
			$i += 1;
		}
		break;
	case 14:
		switch(allTextDecrtptionDes($_userTYPE,$key)){
			case 1:				
				$coursList = read("select c.short_name as courseName,c.course_id as courseID,d.name as departmentName from course as c inner join class as cls on cls.course_id=c.course_id inner join department as d on d.department_id=c.department_id where cls.bin = 0 and cls.student_id=".$_userID,2,$connect);
				break;
			case 2:
				$coursList = read("select c.short_name as courseName,c.course_id as courseID,d.name as departmentName from course as c inner join class as cls on c.course_id=cls.course_id inner join department as d on d.department_id=c.department_id inner join student as s on s.student_id=cls.student_id inner join parent as p on p.parent_id=s.parent_id where p.parent_id=".$_userID." group by c.course_id",2,$connect);
				break;
			case 3:
				if(userInformation()[4]){
					$coursList = read("select c.short_name as courseName,c.course_id as courseID,d.name as departmentName from course as c inner join department as d on d.department_id=c.department_id where c.department_id=".userInformation()[2],2,$connect);
				}else{
					$coursList = read("select c.short_name as courseName,c.course_id as courseID,d.name as departmentName from course as c inner join department as d on d.department_id=c.department_id where c.teacher_id=".$_userID,2,$connect);
				}
				break;
			case 4:
				$coursList = read("select c.short_name as courseName,c.course_id as courseID,d.name as departmentName from course as c inner join department as d on d.department_id=c.department_id",2,$connect);
				break;
		}					
		$i = 1;
		foreach($coursList as $data){
			echo'
			<div class="col-xl-3 col-md-6 mb-4" style="cursor:pointer;" onclick="window.location.href=\'index.php?p=6&id='.$data['courseID'].'\'">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">'.allTextDecrtptionDes($data['departmentName'],$key).'</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800">'.allTextDecrtptionDes($data['courseName'],$key).'</div>
							</div>                                       
						</div>
					</div>
				</div>
			</div>';
		}
		break;
	case 15:
			$id = secureData($_POST['id']);
			$courseList = read("select course_name from course where course_id=".$id,1,$connect);
			echo allTextDecrtptionDes($courseList['course_name'],$key);
		break;
	default:
		break;
}
/*Update */
switch($u){
	case 1:
		$classID = secureData($_POST['classID']);		
		try{
			deleteStudentFromClass($classID,$connect);		
			echo 1;
		}catch(Exception $e){
			echo 2;
		}		
		break;
	case 2:
		$administratorID = secureData($_POST['administratorID']);		
		try{
			deleteAdministrator($administratorID,$connect);		
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
	case 3:
		$departmentID = secureData($_POST['departmentID']);		
		try{
			deleteDepartment($departmentID,$connect);		
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
	case 4:
		$chairID = secureData($_POST['chairID']);		
		try{
			deleteChair($chairID,$connect);		
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
	case 5:
		$teacherID = secureData($_POST['teacherID']);		
		try{
			deleteTeacher($teacherID,$connect);		
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
	case 6:
		$courseID = secureData($_POST['courseID']);		
		try{
			deleteCourse($courseID,$connect);		
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
	case 7:
		$studentID = secureData($_POST['studentID']);		
		try{
			deleteStudent($studentID,$connect);		
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
	case 8:
		$passwordModal = secureData($_POST['passwordModal']);
		try{
			changePassword($passwordModal,$connect);		
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;		
	case 9:
		$newKey = secureData($_POST['newKey']);		
		try{
			changeKey($newKey);		
			echo 1;
		}catch(Exception $e){
			echo 2;
		}
		break;
	default:
		break;
}

?>