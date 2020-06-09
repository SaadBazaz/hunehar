<?php
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
?>



<?php
  if(isset($_POST['modalClassName']))
    $modalClassName = $_POST["modalClassName"];
  if(isset($_POST['Parent_ID'])) {
    if ($_POST['Parent_ID']){
      $Parent_ID = trim($_POST['Parent_ID']);

      $sql_select = "select * 
      from Father F
      where F.Parent_ID = '".$Parent_ID."'";

      $query_id = oci_parse($con, $sql_select);
      $result = oci_execute($query_id);
      if (result){
        $row = oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS); 

        $ID = $row['M_ID'];
        $Name = $row['M_NAME'];
        $CNIC = $row['M_CNIC'];
        $Number = $row['M_NUM'];
        $Address = $row['M_ADDRESS'];
        $IsAlive = $row['M_ISALIVE'];
        $EmpID = $row['M_EMP_ID'];

        $response = array(
            'Parent_ID'  => $ID,
            'Parent_Name' => $Name,
            'Parent_CNIC' => $CNIC,
            'Parent_Number' => $Number,
            'Parent_Address' => $Address,
            'Parent_IsAlive' => $IsAlive,
            'Parent_Employee_ID' => $EmpID,
            'Parent_Relation' => "FATHER",
            "modalClassName" => $modalClassName
        );
        }
        else {
            $sql_select2 = "select * 
            from Mother M
            where M.Parent_ID = '".$Parent_ID."'";

            $query_id2 = oci_parse($con, $sql_select2);
            $result2 = oci_execute($query_id2);
            if (result2){
            $row = oci_fetch_array($query_id2, OCI_BOTH+OCI_RETURN_NULLS); 

            $ID = $row['M_ID'];
            $Name = $row['M_NAME'];
            $CNIC = $row['M_CNIC'];
            $Number = $row['M_NUM'];
            $Address = $row['M_ADDRESS'];
            $IsAlive = $row['M_ISALIVE'];
            $EmpID = $row['M_EMP_ID'];

            $response = array(
                'Parent_ID'  => $ID,
                'Parent_Name' => $Name,
                'Parent_CNIC' => $CNIC,
                'Parent_Number' => $Number,
                'Parent_Address' => $Address,
                'Parent_IsAlive' => $IsAlive,
                'Parent_Employee_ID' => $EmpID,
                'Parent_Relation' => "MOTHER",
                "modalClassName" => $modalClassName
            );
        }
        else {
            $response = "Couldn't find parent.";
        }
    }
      echo json_encode($response);
    }
}

    else if(isset($_POST['Student_ID'])) {
        if ($_POST['Student_ID']){
          $Student_ID = trim($_POST['Student_ID']);

          $sql_select = "SELECT * 
          FROM student
          WHERE s_rollnumber = '".$Student_ID."' ";

          $query_id = oci_parse($con, $sql_select);
          $result = oci_execute($query_id);
          if ($result){
              $row = oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS);
              $ID = $row['S_ROLLNUMBER'];
              $Name = $row['S_NAME'];
              $BayForm = $row['S_BAYFORMNO'];
              $Gender  = $row['S_GENDER'];
              $DOB = $row['DOB'];
              $YearEnrolled = $row['S_YEARENROLLED'];
              $FatherID = $row['F_ID'];
              $MotherID = $row['M_ID']; 
              $GuardianID = $row['G_ID'];   
              $GuardianRelation  = $row['G_RELATION'];


              $response = array(
                'Student_ID'  => $ID,
                'Student_Name' => $Name,
                'Student_BayForm' => $BayForm,
                'Student_Gender' => $Gender,
                'Student_DOB' => $DOB,
                'Student_Year_Enrolled' => $YearEnrolled,
                'Student_Father_ID' => $FatherID,
                'Student_Mother_ID' => $MotherID,
                'Student_Guardian_ID' => $GuardianID,
                'Student_Guardian_Relation' => $GuardianRelation, 
                "modalClassName" => $modalClassName
              );



          }else{
              $response = "Couldn't retreive any student against this ID.";
          }
          echo json_encode($response);
        }
    }

    else if(isset($_POST['Guardian_ID'])) {
      if ($_POST['Guardian_ID']){
        $Guardian_ID = trim($_POST['Guardian_ID']);
        $query_id = oci_parse($con, $sql_select);
        $result = oci_execute($query_id);
        if ($result){
            $row = oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS);
            $ID = $row['G_ID'];
            $Name = $row['G_NAME'];
            $CNIC = $row['G_CNIC'];
            $Number = $row['G_NUM'];
            $Address = $row['G_ADDRESS'];
            $Gender = $row['G_GENDER'];
            $EmpID = $row['G_EMP_ID'];

            $response = array(
              'Guardian_ID'  => $ID,
              'Guardian_Name' => $Name,
              'Guardian_CNIC' => $CNIC,
              'Guardian_Number' => $Number,
              'Guardian_Address' => $Address,
              'Guardian_Gender' => $Gender,
              'Guardian_Employee_ID' => $EmpID,
              "modalClassName" => $modalClassName
          );


        }else{
            $response = "Couldn't retreive any guardian against this ID.";
        }
        echo json_encode($response);
      }
  }
?>