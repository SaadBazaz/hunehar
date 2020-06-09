<?php

/*
------ MEGA INDEX OF ALL FIELDS:
Student_Photo_URI
Student_Name
Student_Bayform
Student_Date_of_Birth
Student_Gender

Father_ID
Father_Name
Father_Date_of_Birth
Father_Phone_Number
Father_Income
Father_CNIC
Father_Email
Father_Address

Mother_ID
Mother_Name
Mother_Date_of_Birth
Mother_Phone_Number
Mother_Income
Mother_CNIC
Mother_Email
Mother_Address

Guardian_ID
Guardian_Name
Guardian_Relation
Guardian_Date_of_Birth
Guardian_Phone_Number
Guardian_Income
Guardian_CNIC
Guardian_Email
Guardian_Address
Guardian_Gender

Staff_Fee_Amount
Staff_Discount
Staff_Final_Amount
Staff_Fully_Paid
Staff_Challan_Number
*/

$db_sid = 
	"(DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = Turab-PC)(PORT = 1521))
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = orcl)
    )
	)";            // Your oracle SID, can be found in tnsnames.ora  ((oraclebase)\app\Your_username\product\11.2.0\dbhome_1\NETWORK\ADMIN) 
  
	$db_user = "scott";   // Oracle username e.g "scott"
	$db_pass = "1234";    // Password for user e.g "1234"
	$con = oci_connect($db_user,$db_pass,$db_sid); 
	if($con) 
	{
		//echo "Oracle Connection Successful."; 
	} 
	else 
    { 
		die('Could not connect to Oracle: '); 
	} 


if(isset($_POST["registerStudentForm_isSubmitted"])){


  $Student_Photo_URI  =  $_POST['Student_Photo_URI'];
  $Student_Name   =   $_POST['Student_Name'];
  $Student_Bayform   =   $_POST['Student_Bayform'];
  $Student_Date_of_Birth  =  $_POST['Student_Date_of_Birth'];
  $Student_Gender   =   $_POST['Student_Gender'];

  if(isset($_POST['Father_ID']) && $_POST['Father_ID'] != ""){
    $Father_ID  =  $_POST['Father_ID'];
  }
  else {
    $Father_Name  =  $_POST['Father_Name'];
    $Father_Date_of_Birth   =   $_POST['Father_Date_of_Birth'];
    $Father_Phone_Number  =  $_POST['Father_Phone_Number'];
	$Father_Income = $_POST['Father_Income'];
    $Father_CNIC  =  $_POST['Father_CNIC'];
    $Father_Email   =   $_POST['Father_Email'];
    $Father_Address   =   $_POST['Father_Address'];  
	$Father_Is_Alive = $_POST['Father_Is_Alive'];
	$Father_Is_Employee = $_POST['Father_Is_Employee'];
	$sql_father = "INSERT into father
(f_name,f_cnic,f_num ,f_address ,f_mail ,f_income ,f_isalive ,f_emp_ID)
VALUES('".$Father_Name."','".$Father_CNIC."',".$Father_Phone_Number.",'".$Father_Address."','".$Father_Email."',".$Father_Income.",".$Father_Is_Alive.",'".$Father_Is_Employee."')";

	$query_id0 = oci_parse($con, $sql_father);
    $result0 = oci_execute($query_id0);
	
	if ($result0)
	{
		echo "success father";
		$sql_return_father = "select F_ID from father where F_NAME = '".$Father_Name."' and F_NUM = ".$Father_Phone_Number." and F_CNIC = '".$Father_CNIC."'";
		$query_id00 = oci_parse($con, $sql_return_father);
		$result00 = oci_execute($query_id00);
		
		$row0 = oci_fetch_array($query_id00, OCI_BOTH+OCI_RETURN_NULLS);
		$Father_ID = $row0['F_ID'];
	}
	else
	{
		echo "error father";
		die();
	}
  }

  if(isset($_POST['Mother_ID']) && $_POST['Mother_ID'] != "")
  {
    $Mother_ID  =  $_POST['Mother_ID'];
  }
  else{
    $Mother_Name  =  $_POST['Mother_Name'];
    $Mother_Date_of_Birth   =   $_POST['Mother_Date_of_Birth'];
    $Mother_Phone_Number  =  $_POST['Mother_Phone_Number'];
	$Mother_Income = $_POST['Mother_Income'];
    $Mother_CNIC  =  $_POST['Mother_CNIC'];
    $Mother_Email   =   $_POST['Mother_Email'];
    $Mother_Address   =   $_POST['Mother_Address'];
	$Mother_Is_Alive = $_POST['Mother_Is_Alive'];
	$Mother_Is_Employee = $_POST['Mother_Is_Employee'];
	$sql_mother = "insert into mother(m_name,m_cnic,m_num ,m_address ,m_mail ,m_income ,m_isalive ,m_emp_ID )
				VALUES('".$Mother_Name."','".$Mother_CNIC."',".$Mother_Phone_Number.",'".$Mother_Address."','".$Mother_Email."',".$Mother_Income.",".$Mother_Is_Alive.",'".$Mother_Is_Employee."')";
  
	$query_id1 = oci_parse($con, $sql_mother);
    $result1 = oci_execute($query_id1);
	
	if ($result1)
	{
		echo "success mother";
		$sql_return_mother = "select M_ID from mother where M_NAME = '".$Mother_Name."' and M_NUM = ".$Mother_Phone_Number." and M_CNIC = '".$Mother_CNIC."'";
		$query_id10 = oci_parse($con, $sql_return_mother);
		$result10 = oci_execute($query_id10);
		
		$row1 = oci_fetch_array($query_id10, OCI_BOTH+OCI_RETURN_NULLS);
		$Mother_ID = $row1['M_ID'];
	}
	else
	{
		echo "error mother";
		die();
	}
  }

  if(isset($_POST['Guardian_ID']) && $_POST['Guardian_ID'] != ""){
    $Guardian_ID  =  $_POST['Guardian_ID'];
	$Guardian_Relation  =  $_POST['Guardian_Relation'];
  }
  else{
    $Guardian_Name  =  $_POST['Guardian_Name'];
    $Guardian_Date_of_Birth   =   $_POST['Guardian_Date_of_Birth'];
    $Guardian_Phone_Number  =  $_POST['Guardian_Phone_Number'];
	$Guardian_Income = $_POST['Guardian_Income'];
    $Guardian_CNIC  =  $_POST['Guardian_CNIC'];
    $Guardian_Email   =   $_POST['Guardian_Email'];
    $Guardian_Address   =   $_POST['Guardian_Address'];  
	$Guardian_Is_Employee = $_POST['Guardian_Is_Employee']; 
	$Guardian_Gender = $_POST['Guardian_Gender'];
	
	$sql_guardian = "INSERT into guardian
(g_name,g_cnic,g_gender,g_num ,g_address ,g_mail ,g_income ,g_emp_ID)
VALUES('".$Guardian_Name."','".$Guardian_CNIC."','".$Guardian_Gender."',".$Guardian_Phone_Number.",'".$Guardian_Address."','".$Guardian_Email."',".$Guardian_Income.",'".$Guardian_Is_Employee."')";

	$query_id2 = oci_parse($con, $sql_guardian);
    $result2 = oci_execute($query_id2);
	
	if ($result2)
	{
		echo "success guardian";
		$sql_return_guardian = "select G_ID from guardian where G_NAME = '".$Guardian_Name."' and G_NUM = ".$Guardian_Phone_Number." and G_CNIC = '".$Guardian_CNIC."'";
		$query_id20 = oci_parse($con, $sql_return_guardian);
		$result20 = oci_execute($query_id20);
		
		$row2 = oci_fetch_array($query_id20, OCI_BOTH+OCI_RETURN_NULLS);
		$Guardian_ID = $row2['G_ID'];
	}
	else
	{
		echo "error guardian";
		die();
	}
		
  }

  $Staff_Fee_Amount   =   $_POST['Staff_Fee_Amount'];
  $Staff_Discount   =   $_POST['Staff_Discount'];
  $Staff_Final_Amount   =   $_POST['Staff_Final_Amount'];
  $Staff_Fully_Paid   =   $_POST['Staff_Fully_Paid'];
  $Staff_Challan_Number   =   $_POST['Staff_Challan_Number'];

  $sql_insert = " INSERT INTO student(s_name,s_bayformno,s_gender,DOB,f_ID,g_relation,m_ID,g_ID)
					values('".$Student_Name."',".$Student_Bayform.",'".$Student_Gender."',to_char(to_date('".$Student_Date_of_Birth."','YYYY-MM-DD'), 'DD-MON-YY'),'".$Father_ID."','".$Guardian_Relation."','".$Mother_ID."','".$Guardian_ID."')";

		$query_id30 = oci_parse($con, $sql_insert);
		$result30 = oci_execute($query_id30);
		
		if ($result30)
		{
			echo "success student";
			header("Location: ./students.php");
		}
		else
		{
			echo "error student";
			die();
		}
}

?>



<!DOCTYPE html>

<head>

  <link href="./public/html/main.css" type="text/css" rel="stylesheet">
  <link href="./public/html/register_student.css" type="text/css" rel="stylesheet">

  <!-- FONTAWESOME -->
  <!-- jQuery library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

  <!-- jQuery (for Ajax) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>

  <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>

  
  <div class="stepper-horizontal orange">
    <div class="step active"  id="#Step_1">
      <div class="step-circle"><span>1</span></div>
      <div class="step-title">Student</div>
      <div class="step-bar-left"></div>
      <div class="step-bar-right"></div>
    </div>
    <div class="step"  id="#Step_2">
      <div class="step-circle"><span>2</span></div>
      <div class="step-title">Parents</div>
      <div class="step-bar-left"></div>
      <div class="step-bar-right"></div>
    </div>
    <div class="step"  id="#Step_3">
      <div class="step-circle"><span>3</span></div>
      <div class="step-title">Guardian</div>
      <div class="step-bar-left"></div>
      <div class="step-bar-right"></div>
    </div>
    <div class="step" id="#Step_4">
      <div class="step-circle"><span>4</span></div>
      <div class="step-title">Employee Discount</div>
      <div class="step-optional">Optional</div>
      <div class="step-bar-left"></div>
      <div class="step-bar-right"></div>
    </div>
  </div>
  <div class="main-content-body" style="padding-top: 25px;">


    <form action="./register_student.php" method="POST">


    <div id="#Step_1_body">

      <div class="main-row" style="width:100%; justify-content: center;">
        <div class="main-header" style="width:100%; justify-content: center;">
          <div class="main-header-title" style="padding:0; text-align: center;">
            Student Information
          </div>
        </div>
      </div>

      <!-- Inputs come here -->
      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Student_Photo_URI">Student Photo URI</label>
          <div class="input-container" style=" flex:0; width:200px;">
            <input type="text" name="Student_Photo_URI" placeholder="Enter Student Picture Link"/>
          </div>  
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Student_Name">Student Name</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="text" name="Student_Name" placeholder="Enter Student Name"/>
          </div>
        </div>
      </div>
	  
	  <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Student_Bayform">Student BayformNo</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="number" name="Student_Bayform" placeholder="Enter Student Bayform"/>
          </div>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Student_Date_of_Birth">Date of Birth</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="date" name="Student_Date_of_Birth"/>
          </div>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Student_Gender">Gender</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <select name="Student_Gender" id="Student_Gender">
              <option value="M">Male</option>
              <option value="F">Female</option>
            </select>
          </div>
        </div>
      </div>

      <div class="main-row" style="width:100%; justify-content: center;">
        <button class="stepper-button" type="button" onclick="LoadStep(event, '#Step_2', '#Step_1')"> Next </button>
      </div>

    </div>



    <div id="#Step_2_body"  style="display:none">
      
      <div class="main-row">
        <div class="main-header" style="width:100%; justify-content: center;">
          <div class="main-header-title" style="padding:0; text-align: center;">
            Parents Information
          </div>
        </div>
      </div>

      <!-- Inputs come here -->

      <div class="main-row" style="flex:1; justify-content: center; margin-bottom: 0;">
        <h3>FATHER</h3>
      </div>
      
      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Father_ID">Father ID (if already registered, skip the rest of the information)</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="text" name="Father_ID" id="Father_ID" placeholder="Father ID"/>
          </div>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Father_Name">Father Name</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="text" name="Father_Name" id="Father_Name" placeholder="Enter Father Name"/>
          </div>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Father_Date_of_Birth">Date of Birth</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="date" name="Father_Date_of_Birth" id="Father_Date_of_Birth"/>
          </div>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Father_Phone_Number">Phone Number</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="number" name="Father_Phone_Number" id="Father_Phone_Number"  placeholder="Phone Number"/>
          </div>
        </div>
      </div>
	  
	  <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Father_Income">Income</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="number" name="Father_Income" id="Father_Income"  placeholder="Income"/>
          </div>
        </div>
      </div>
	  
	  <div class="main-row" style="flex:1; justify-content: center">
        <div class="input-container" style=" flex:0; width:100px; border:none">
          <label for="Father_Is_Alive" style="font-style: italic;">Is Alive?</label>
          <input type="radio" name="Father_Is_Alive" value="1"><label>Yes</label>
          <input type="radio" name="Father_Is_Alive" value="0"><label>No</label>
        </div>
      </div>
	  
	  <div class="main-row" style="flex:1; justify-content: center">
        <div class="input-container" style=" flex:0; width:100px; border:none">
          <label for="Father_Is_Employee" style="font-style: italic;">Is Employee?</label>
          <input type="radio" name="Father_Is_Employee" value="1"><label>Yes</label>
          <input type="radio" name="Father_Is_Employee" value="0"><label>No</label>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Father_CNIC">CNIC</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="number" name="Father_CNIC" id="Father_CNIC" placeholder="CNIC (14 digits)"/>
          </div>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Father_Email">Email</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="email" name="Father_Email" id="Father_Email" placeholder="Email Address"/>
          </div>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Father_Address">Address</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="text" name="Father_Address" id="Father_Address" placeholder="Address"/>
          </div>
        </div>
      </div>









      <div class="main-row" style="flex:1; justify-content: center; margin-bottom: 0;">
        <h3>MOTHER</h3>
      </div>
      
      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Mother_ID">Mother ID (if already registered, skip the rest of the information)</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="text" name="Mother_ID" id="Mother_ID" placeholder="Mother ID"/>
          </div>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Mother_Name">Mother Name</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="text" name="Mother_Name" id="Mother_Name" placeholder="Enter Mother Name"/>
          </div>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Mother_Date_of_Birth">Date of Birth</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="date" name="Mother_Date_of_Birth" id="Mother_Date_of_Birth"/>
          </div>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Mother_Phone_Number">Phone Number</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="number" name="Mother_Phone_Number" id="Mother_Phone_Number"  placeholder="Phone Number"/>
          </div>
        </div>
      </div>

		<div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Mother_Income">Income</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="number" name="Mother_Income" id="Mother_Income"  placeholder="Income"/>
          </div>
        </div>
      </div>
	  
	  <div class="main-row" style="flex:1; justify-content: center">
        <div class="input-container" style=" flex:0; width:100px; border:none">
          <label for="Mother_Is_Alive" style="font-style: italic;">Is Alive?</label>
          <input type="radio" name="Mother_Is_Alive" value="1"><label>Yes</label>
          <input type="radio" name="Mother_Is_Alive" value="0"><label>No</label>
        </div>
      </div>
	  
	  <div class="main-row" style="flex:1; justify-content: center">
        <div class="input-container" style=" flex:0; width:100px; border:none">
          <label for="Mother_Is_Employee" style="font-style: italic;">Is Employee?</label>
          <input type="radio" name="Mother_Is_Employee" value="1"><label>Yes</label>
          <input type="radio" name="Mother_Is_Employee" value="0"><label>No</label>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Mother_CNIC">CNIC</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="number" name="Mother_CNIC" id="Mother_CNIC" placeholder="CNIC (14 digits)"/>
          </div>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Mother_Email">Email</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="email" name="Mother_Email" id="Mother_Email" placeholder="Email Address"/>
          </div>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Mother_Address">Address</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="text" name="Mother_Address" id="Mother_Address" placeholder="Address"/>
          </div>
        </div>
      </div>




      <div class="main-row" style="width:100%; justify-content: center;">
        <button class="stepper-button"  type="button" onclick="LoadStep(event, '#Step_3', '#Step_2')"> Next </button>
      </div>

    </div>



    <div id="#Step_3_body"  style="display:none">
      
      <div class="main-row">
        <div class="main-header" style="width:100%; justify-content: center;">
          <div class="main-header-title" style="padding:0; text-align: center;">
            Guardian Information
          </div>
        </div>
      </div>


      <!-- Inputs come here -->

      <div class="main-row" style="flex:1; justify-content: center; margin-bottom: 0;">
        <h3>GUARDIAN</h3>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Guardian_ID">Guardian ID (if already registered, skip the rest of the information)</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="text" name="Guardian_ID" id="Guardian_ID" placeholder="Guardian ID"/>
          </div>
        </div>
      </div>
      
      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Guardian_Name">Guardian Name</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="text" name="Guardian_Name" id="Guardian_Name" placeholder="Enter Guardian Name"/>
          </div>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Guardian_Relation">Relation to Child</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="text" name="Guardian_Relation" id="Guardian_Relation" placeholder="Enter Relation"/>
          </div>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Guardian_Date_of_Birth">Date of Birth</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="date" name="Guardian_Date_of_Birth" id="Guardian_Date_of_Birth"/>
          </div>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Guardian_Phone_Number">Phone Number</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="number" name="Guardian_Phone_Number" id="Guardian_Phone_Number"  placeholder="Phone Number"/>
          </div>
        </div>
      </div>

		<div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Guardian_Income">Income</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="number" name="Guardian_Income" id="Guardian_Income"  placeholder="Income"/>
          </div>
        </div>
      </div>
	  
	  <div class="main-row" style="flex:1; justify-content: center">
        <div class="input-container" style=" flex:0; width:100px; border:none">
          <label for="Guardian_Is_Employee" style="font-style: italic;">Is Employee?</label>
          <input type="radio" name="Guardian_Is_Employee" value="1"><label>Yes</label>
          <input type="radio" name="Guardian_Is_Employee" value="0"><label>No</label>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Guardian_CNIC">CNIC</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="number" name="Guardian_CNIC" id="Guardian_CNIC" placeholder="CNIC (14 digits)"/>
          </div>
        </div>
      </div>
	  
	  <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Guardian_Gender">Gender</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <select name="Guardian_Gender" id="Guardian_Gender">
              <option value="M">Male</option>
              <option value="F">Female</option>
            </select>
          </div>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Guardian_Email">Email</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="email" name="Guardian_Email" id="Guardian_Email" placeholder="Email Address"/>
          </div>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Guardian_Address">Address</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="text" name="Guardian_Address" id="Guardian_Address" placeholder="Address"/>
          </div>
        </div>
      </div>



      <div class="main-row" style="width:100%; justify-content: center;">
        <button class="stepper-button"  type="button" onclick="LoadStep(event, '#Step_4', '#Step_3')"> Next </button>
      </div>

    </div>


    <div id="#Step_4_body"  style="display:none">
      
      <div class="main-row">
        <div class="main-header" style="width:100%; justify-content: center;">
          <div class="main-header-title" style="padding:0; text-align: center;">
            For Staff Only
          </div>
        </div>
      </div>

      <!-- Inputs come here -->
      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Staff_Fee_Amount">Staff Fee Amount</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="number" name="Staff_Fee_Amount" id="Staff_Fee_Amount"  placeholder="Staff Fee Amount"/>
          </div>
        </div>
      </div>


      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Staff_Discount">Staff Discount</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="number" name="Staff_Discount" id="Staff_Discount"  placeholder="Staff Discount"/>
          </div>
        </div>
      </div>


      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Staff_Final_Amount">Staff Final Amount</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="number" name="Staff_Final_Amount" id="Staff_Final_Amount"  placeholder="Final Amount"/>
          </div>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="input-container" style=" flex:0; width:100px; border:none">
          <label for="Staff_Fully_Paid" style="font-style: italic;">Fully Paid?</label>
          <input type="radio" name="Staff_Fully_Paid" value="Yes"><label>Yes</label>
          <input type="radio" name="Staff_Fully_Paid" value="No"><label>No</label>
        </div>
      </div>

      <div class="main-row" style="flex:1; justify-content: center">
        <div class="whole-input-container">
          <label for="Staff_Challan_Number">Challan Number</label>
          <div class="input-container" style=" flex:0; width:auto;">
            <input type="number" name="Staff_Challan_Number" id="Staff_Challan_Number"  placeholder="Challan Number"/>
          </div>
        </div>
      </div>


      <div class="main-row" style="width:100%; justify-content: center;">
        <button class="stepper-button" name="registerStudentForm_isSubmitted"> Finish </button>
      </div>

    </div>


  </form>


  </div>

  <script type="text/javascript" src="./public/html/home.js"></script>
  <script type="text/javascript" src="./public/html/register_student.js"></script>



</body>