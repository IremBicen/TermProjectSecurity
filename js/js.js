function loginUser(){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?l=1",
        data:{"studentNumber":document.getElementById("studentNumber").value,"password":document.getElementById("password").value},
        success:function(result){
            console.log(result);
            if(result == "Number and password are correct. You will be directed shortly..."){
                document.getElementById("alert").classList.remove("alertMessageError");	
				document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = result;				
                document.getElementById("alert").classList.add("alertMessageSuccess");
                window.location = "index.php";
            }else{
				document.getElementById("alert").classList.remove("alertMessageSuccess");
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = result;
                document.getElementById("alert").classList.add("alertMessageError");
            }
        }
    });
}
/*AddFunction*/
function addStudent(){
	$.ajax({
        type:"POST",
        url:"func/ajaxControl.php?i=2",
        data:{"name":document.getElementById("name").value,"departments":document.getElementById("departments").value,"fatherName":document.getElementById("fatherName").value,"fatherPhone":document.getElementById("fatherPhone").value,"address":document.getElementById("address").value,"password":document.getElementById("password").value},
        success:function(result){
			//console.log(result);
            if(result == "1"){
				readStudents();
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "Student Added";
				document.getElementById("alert").classList.remove("alertMessageError");		
                document.getElementById("alert").classList.add("alertMessageSuccess");				
            }else{
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem. Please try again later.";
				document.getElementById("alert").classList.remove("alertMessageSuccess");
                document.getElementById("alert").classList.add("alertMessageError");				
            }
        }
    });	
}
function addDepartmant(){
	$.ajax({
        type:"POST",
        url:"func/ajaxControl.php?i=1",
        data:{"department":document.getElementById("department").value},
        success:function(result){
			//console.log(result);
            if(result == "1"){
				readDepartment();
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "Department Added";
				document.getElementById("alert").classList.remove("alertMessageError");		
                document.getElementById("alert").classList.add("alertMessageSuccess");				
            }else{
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem. Please try again later.";
				document.getElementById("alert").classList.remove("alertMessageSuccess");
                document.getElementById("alert").classList.add("alertMessageError");				
            }
        }
    });	
}
function addCourse(){
	$.ajax({
        type:"POST",
        url:"func/ajaxControl.php?i=3",
        data:{"courseName":document.getElementById("courseName").value,"courseShortName":document.getElementById("courseShortName").value,"departments":document.getElementById("departments").value,"courseInst":document.getElementById("courseInst").value},
        success:function(result){
			//console.log(result);
            if(result == "1"){
				readCourses();
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "Course Added";
				document.getElementById("alert").classList.remove("alertMessageError");		
                document.getElementById("alert").classList.add("alertMessageSuccess");				
            }else{
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem. Please try again later.";
				document.getElementById("alert").classList.remove("alertMessageSuccess");
                document.getElementById("alert").classList.add("alertMessageError");				
            }
        }
    });	
}
function addTeacher(){
	$.ajax({
        type:"POST",
        url:"func/ajaxControl.php?i=4",
        data:{"teacherName":document.getElementById("teacherName").value,"password":document.getElementById("password").value,"department":document.getElementById("departments").value},
        success:function(result){
			//console.log(result);
			readTeacher();
            if(result == "1"){				
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "Teacher Added";
				document.getElementById("alert").classList.remove("alertMessageError");		
                document.getElementById("alert").classList.add("alertMessageSuccess");				
            }else{
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem. Please try again later.";
				document.getElementById("alert").classList.remove("alertMessageSuccess");
                document.getElementById("alert").classList.add("alertMessageError");				
            }
        }
    });
}

function addChair(){
	$.ajax({
        type:"POST",
        url:"func/ajaxControl.php?i=5",
        data:{"department":document.getElementById("departments").value,"teacher_id":document.getElementById("courseInst").value},
        success:function(result){
			//console.log(result);
            if(result == "1"){
				readChair();
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "Chair Added";
				document.getElementById("alert").classList.remove("alertMessageError");		
                document.getElementById("alert").classList.add("alertMessageSuccess");				
            }else{
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem. Please try again later.";
				document.getElementById("alert").classList.remove("alertMessageSuccess");
                document.getElementById("alert").classList.add("alertMessageError");				
            }
        }
    });
}

function addAdministrator(){
	$.ajax({
        type:"POST",
        url:"func/ajaxControl.php?i=6",
        data:{"name":document.getElementById("name").value,"password":document.getElementById("password").value},
        success:function(result){
			readAdministrator();
			//console.log(result);
            if(result == "1"){
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "Administrator Added";
				document.getElementById("alert").classList.remove("alertMessageError");		
                document.getElementById("alert").classList.add("alertMessageSuccess");				
            }else{
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem. Please try again later.";
				document.getElementById("alert").classList.remove("alertMessageSuccess");
                document.getElementById("alert").classList.add("alertMessageError");				
            }
        }
    });
}
var checkBoxCounter = 0;
const studentCheckbox = [];
function addStudentCheckBox(_studentID){	
	var _delete = false;
	for(var i=0;i<=checkBoxCounter;i++){
		if(studentCheckbox[i] == _studentID){			
			_delete = true;
            studentCheckbox.splice(i, 1);         
		}
	}
	if(_delete){
		checkBoxCounter--;
	}else{
		studentCheckbox[checkBoxCounter]= _studentID;
		checkBoxCounter++;
	}
	_delete = false;
}
function addClass(_id){
	$.ajax({
        type:"POST",
        url:"func/ajaxControl.php?i=7",
        data:{"studentID":studentCheckbox,"courseID":_id},
        success:function(result){
			//console.log(result);
			checkBoxCounter = 0;
			studentCheckbox.splice(0,studentCheckbox.length);
			readClassList(_id);
			
            /*if(result == "1"){
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "Department Added";
				document.getElementById("alert").classList.remove("alertMessageError");		
                document.getElementById("alert").classList.add("alertMessageSuccess");				
            }else{
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem. Please try again later.";
				document.getElementById("alert").classList.remove("alertMessageSuccess");
                document.getElementById("alert").classList.add("alertMessageError");				
            }*/
        }
    });	
}
var checkBoxCounter1 = 0;
const studentCheckbox1 = [];
function addStudentCheckBox1(_studentID){	
	var _delete = false;
	for(var i=0;i<=checkBoxCounter1;i++){
		if(studentCheckbox1[i] == _studentID){			
			_delete = true;
            studentCheckbox1.splice(i, 1);         
		}
	}
	if(_delete){
		checkBoxCounter1--;
	}else{
		studentCheckbox1[checkBoxCounter1]= _studentID;
		checkBoxCounter1++;
	}
	_delete = false;
}
function addAttendance(_id){
	$.ajax({
        type:"POST",
        url:"func/ajaxControl.php?i=8",
        data:{"studentID":studentCheckbox1,"courseID":_id},
        success:function(result){
            console.log(result);	
			checkBoxCounter1 = 0;
			studentCheckbox1.splice(0,studentCheckbox1.length);
			readClassList(_id);
           // document.getElementById("departmentsL").innerHTML = result;            
        }
    });
}
function readDepartment(){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=1",
        data:{},
        success:function(result){
            //console.log(result);
            document.getElementById("departmentsL").innerHTML = result;            
        }
    });
}

function readDepartmentSelect(){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=2",
        data:{},
        success:function(result){
            //console.log(result);			
            document.getElementById("departments").innerHTML = result; 
        }
    });
}

function readStudents(){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=3",
        data:{},
        success:function(result){
            //console.log(result);			
            document.getElementById("students").innerHTML = result;            
        }
    });
}
function readCourseInst(){
	$.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=4",
        data:{"department":document.getElementById("departments").value},
        success:function(result){
            //console.log(result);			
            document.getElementById("courseInst").innerHTML = result;            
        }
    });
}

function readTeacher(){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=5",
        data:{},
        success:function(result){
            //console.log(result);			
            document.getElementById("teachers").innerHTML = result;            
        }
    });
}
function readCourses(){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=6",
        data:{},
        success:function(result){
            //console.log(result);			
            document.getElementById("courses").innerHTML = result;            
        }
    });
}
function readChair(){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=7",
        data:{},
        success:function(result){
            //console.log(result);			
            document.getElementById("chairs").innerHTML = result;            
        }
    });
}
function readAdministrator(){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=8",
        data:{},
        success:function(result){
            //console.log(result);			
            document.getElementById("administrators").innerHTML = result;            
        }
    });
}
function readStudentList(_id){
	$.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=9",
        data:{"id":_id},
        success:function(result){
            //console.log(result);			
            document.getElementById("modalC").innerHTML = result;            
        }
    });
}
function readDeleteStudentClassList(_id){
	$.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=10",
        data:{"id":_id},
        success:function(result){	
			readClassList(_id);			
            document.getElementById("modalC").innerHTML = result;            
        }
    });
}
function readAttendanceHistoryModel(_id){
	$.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=12",
        data:{"id":_id},
        success:function(result){				
            document.getElementById("modalC").innerHTML = result;            
        }
    });
}
function readAttendenceHistory(_id){
	$.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=13",
        data:{"id":_id,"date":document.getElementById("date").value},
        success:function(result){	
			//console.log(result);
            document.getElementById("attendanceHistory").innerHTML = result;            
        }
    });
}
function readClassList(_id){
	$.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=11",
        data:{"id":_id},
        success:function(result){
            //console.log(result);			
            document.getElementById("classList").innerHTML = result;            
        }
    });
}
function readCourseHeader(_id){
	$.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=15",
        data:{"id":_id},
        success:function(result){
            //console.log(result);			
            document.getElementById("courseNameHeader").innerHTML = result;            
        }
    });
}
function readMainCoursList(){
	$.ajax({
        type:"POST",
        url:"func/ajaxControl.php?r=14",
        data:{},
        success:function(result){
            //console.log(result);			
            document.getElementById("readMainCoursList").innerHTML = result;            
        }
    });
}
/*read*/

/* */
function alertShow(){
    $("alert").fadeIn(400).delay(3000);
	$("alert").slideUp(300);
}

/*Update */
function deleteStudentFromClass(_id,_courseID){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?u=1",
        data:{"classID":_id},
        success:function(result){
            //console.log(result);
            if(result == "1"){
                /*document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "Your Personal Inforamtion Saved";
                document.getElementById("alert").classList.add("alertMessageSuccess");*/
				readDeleteStudentClassList(_courseID);
            }else{
				document.getElementById("alert").classList.remove("alertMessageSuccess");
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem. Please try again later.";
                document.getElementById("alert").classList.add("alertMessageError");
            }
        }
    });
}
function deleteAdministrator(_id){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?u=2",
        data:{"administratorID":_id},
        success:function(result){
            //console.log(result);
            if(result == "1"){
				readAdministrator();
				document.getElementById("alert").classList.remove("alertMessageError");	
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "Administrator Deleted";
                document.getElementById("alert").classList.add("alertMessageSuccess");
            }else{
				document.getElementById("alert").classList.remove("alertMessageSuccess");
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem. Please try again later.";
                document.getElementById("alert").classList.add("alertMessageError");
            }
        }
    });
}
function deleteDepartment(_id){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?u=3",
        data:{"departmentID":_id},
        success:function(result){
            //console.log(result);
            if(result == "1"){
				readDepartment();
				document.getElementById("alert").classList.remove("alertMessageError");	
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "Department Deleted";
                document.getElementById("alert").classList.add("alertMessageSuccess");
            }else{
				document.getElementById("alert").classList.remove("alertMessageSuccess");
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem. Please try again later.";
                document.getElementById("alert").classList.add("alertMessageError");
            }
        }
    });
}
function deleteChair(_id){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?u=4",
        data:{"chairID":_id},
        success:function(result){
            //console.log(result);
            if(result == "1"){
				readChair();
				document.getElementById("alert").classList.remove("alertMessageError");	
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "Chair Deleted";
                document.getElementById("alert").classList.add("alertMessageSuccess");
            }else{
				document.getElementById("alert").classList.remove("alertMessageSuccess");
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem. Please try again later.";
                document.getElementById("alert").classList.add("alertMessageError");
            }
        }
    });
}

function deleteTeacher(_id){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?u=5",
        data:{"teacherID":_id},
        success:function(result){
            //console.log(result);
            if(result == "1"){
				readTeacher();
				document.getElementById("alert").classList.remove("alertMessageError");	
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "Teacher Deleted";
                document.getElementById("alert").classList.add("alertMessageSuccess");
            }else{
				document.getElementById("alert").classList.remove("alertMessageSuccess");
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem. Please try again later.";
                document.getElementById("alert").classList.add("alertMessageError");
            }
        }
    });
}

function deleteCourse(_id){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?u=6",
        data:{"courseID":_id},
        success:function(result){
            //console.log(result);
            if(result == "1"){
				readCourses();
				document.getElementById("alert").classList.remove("alertMessageError");	
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "Course Deleted";
                document.getElementById("alert").classList.add("alertMessageSuccess");
            }else{
				document.getElementById("alert").classList.remove("alertMessageSuccess");
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem. Please try again later.";
                document.getElementById("alert").classList.add("alertMessageError");
            }
        }
    });
}

function deleteStudent(_id){
    $.ajax({
        type:"POST",
        url:"func/ajaxControl.php?u=7",
        data:{"studentID":_id},
        success:function(result){
            //console.log(result);
            if(result == "1"){
				readStudents();
				document.getElementById("alert").classList.remove("alertMessageError");	
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "Student Deleted";
                document.getElementById("alert").classList.add("alertMessageSuccess");
            }else{
				document.getElementById("alert").classList.remove("alertMessageSuccess");
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem. Please try again later.";
                document.getElementById("alert").classList.add("alertMessageError");
            }
        }
    });
}

function changePassword(){
	$.ajax({
        type:"POST",
        url:"func/ajaxControl.php?u=8",
        data:{"passwordModal":document.getElementById("passwordModal").value},
        success:function(result){
            //console.log(result);
            if(result == "1"){
				document.getElementById("alert").classList.remove("alertMessageError");	
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "Password Changed";
                document.getElementById("alert").classList.add("alertMessageSuccess");
            }else{
				document.getElementById("alert").classList.remove("alertMessageSuccess");
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem. Please try again later.";
                document.getElementById("alert").classList.add("alertMessageError");
            }
        }
    });
}

function changeKey(){
	$.ajax({
        type:"POST",
        url:"func/ajaxControl.php?u=9",
        data:{"newKey":document.getElementById("newKey").value},
        success:function(result){
            //console.log(result);
            if(result == "1"){
				document.getElementById("alert").classList.remove("alertMessageError");	
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "Key Changed";
                document.getElementById("alert").classList.add("alertMessageSuccess");
            }else{
				document.getElementById("alert").classList.remove("alertMessageSuccess");
                document.getElementById("alert").style.display = "block";
                document.getElementById("alert").innerHTML = "There is a problem. Please try again later.";
                document.getElementById("alert").classList.add("alertMessageError");
            }
        }
    });
}