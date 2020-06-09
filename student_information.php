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
if (isset($_GET['id'])) 
{
    $ID = $_GET['id'];
    $sql_select = "SELECT * 
    FROM student
    WHERE s_rollnumber = '".$ID."' ";

} 
else if (isset($_POST['editStudentForm_isSubmitted']))
{
	
	$Date_Format = "YYYY-MM-DD";
	$ID = $_POST['id'];
	$Name	=	$_POST['Name'];
	$BayForm	=	$_POST['BayForm'];
	$Gender	=	$_POST['Gender'];
	$DOB	=	$_POST['DOB'];
	$Year_Enrolled	=	$_POST['Year_Enrolled'];
	$Father_ID	=	$_POST['Father_ID'];
	$Mother_ID	=	$_POST['Mother_ID'];
	$Guardian_ID	=	$_POST['Guardian_ID'];
	$Guardian_Relation	=	$_POST['Guardian_Relation'];
	
	if ($DOB == "")
	{
		$DOB = $_POST['oldDOB'];
		$Date_Format = "DD-MON-YY";
	}
	
	$sql_select = "SELECT * 
    FROM student
    WHERE s_rollnumber = '".$ID."' ";
	
	$sql_update = "UPDATE student
	SET 
		s_name = '".$Name."',
		s_Bayformno = '".$BayForm."',
		s_gender = '".$Gender."',
		DOB = to_char(to_date('".$DOB."','".$Date_Format."'), 'DD-MON-YY'),
		S_YEARENROLLED = '".$Year_Enrolled."',
		F_ID = '".$Father_ID."',
		M_ID = '".$Mother_ID."',
		G_ID = '".$Guardian_ID."',
		G_RELATION = '".$Guardian_Relation."' 

	WHERE s_rollnumber = '".$ID."'";
	echo $sql_update;
					$query_id0 = oci_parse($con, $sql_update);
                    $result0 = oci_execute($query_id0);
                    if ($result0)
					{
                       echo "Update Successful";
					} 
}
else
{
    $error = "No ID has been specified.";
    //redirecting back to Students page
    header("Location: ./students.php");
    die();
}


?>



<?php
                    $query_id = oci_parse($con, $sql_select);
                    $result = oci_execute($query_id);
                    if ($result)
					{
                        $row = oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS);
                        $ID = $row['S_ROLLNUMBER'];
                        $Name = $row['S_NAME'];
                        $BayForm = $row['S_BAYFORMNO'];
                        $Gender  = $row['S_GENDER'];
                        $DOB = $row['DOB'];
                        $YearEnrolled = $row['S_YEARENROLLED'];
                        $Father_ID = $row['F_ID'];
                        $Mother_ID = $row['M_ID']; 
                        $GuardianID = $row['G_ID'];   
                        $GuardianRelation  = $row['G_RELATION'];
						
						$sql_select1 = "select * from student where M_ID = '".$Mother_ID."' or F_ID = '".$Father_ID."'";
						$sql_select2 = "select * from Mother where M_ID = '".$Mother_ID."'";
						$sql_select3 = "select * from Father where F_ID = '".$Father_ID."'";
						$sql_select4 = "select * from Registration where s_rollnumber = '".$ID."'";
						
						$query_id1 = oci_parse($con, $sql_select1);
						$result1 = oci_execute($query_id1);
						if ($result1)
						{
							$Siblings = array();
							
							while($row1 = oci_fetch_array($query_id1, OCI_BOTH+OCI_RETURN_NULLS)) 	// for siblings)
							{
								$tempsib = array
												('Sibling_ID' => $row1['S_ROLLNUMBER'],
												'Sibling_Name' => $row1['S_NAME'],
												'Sibling_G_ID' => $row1['G_ID']);
								array_push($Siblings, $tempsib);
							}
							
							//echo $Siblings;
						}	
						
						$query_id2 = oci_parse($con, $sql_select2);
						$result2 = oci_execute($query_id2);
						if ($result2)
						{
							$row2 = oci_fetch_array($query_id2, OCI_BOTH+OCI_RETURN_NULLS);	// for mother info
							if ($row2)
							{
								$Mother_Name = $row2['M_NAME'];
							}
							else
							{
								
							}
						}	
						
						$query_id3 = oci_parse($con, $sql_select3);
						$result3 = oci_execute($query_id3);
						if ($result3)
						{
							$row3 = oci_fetch_array($query_id3, OCI_BOTH+OCI_RETURN_NULLS);	// for father info
							if ($row3)
							{
								$Father_Name = $row3['F_NAME'];
							}
							else
							{
								
							}
						}	
						
						$query_id4 = oci_parse($con, $sql_select4);
						$result4 = oci_execute($query_id4);
						if ($result4)
						{
							$Class_History = array();
							
							while($row4 = oci_fetch_array($query_id4, OCI_BOTH+OCI_RETURN_NULLS)) 	// for Class History
							{
								$tempch = array
												('Class_ID' => $row4['CLASS_ID'],
												'Course_ID' => $row4['CO_ID'],
												'R_Date' => $row4['R_DATE']);
								array_push($Class_History, $tempch);
							}
							
							
						}	
						
						
                    }else{
                        $error = "Couldn't retreive any parent against this ID.";
                    }

?>




<!DOCTYPE html>
<head>

    <link href="./public/html/main.css" type="text/css" rel="stylesheet">
    <link href="./public/html/register_student.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="./public/html/home.js"></script>
    <script type="text/javascript" src="./public/html/register_student.js"></script>

    <!-- FONTAWESOME -->
    <!-- jQuery library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />


</head>

<body>

    <div class="main-row">
        <div class="main-header"  style = "width:100%; justify-content: center;">
            <div class="main-header-title" style="padding:0; text-align: center;" >
                Student Information
            </div>
            <button
                onclick="displayCard('#card0')"
                class="mini-button" style="background-color: transparent;font-size: 25px; padding: 5px 0px 0px 8px">
                <i class="fa fa-edit"></i>
            </button>
        </div>
    </div>

    <div class="main-content-body" style="padding-top: 25px;">
        <div class = "main-header">
            <div class = "main-row">
                <div class = "person">
                    <div class="person-picture">
                        <div class="image-cropper" style = "height:80px; width:80px; ">
                            <img class = "nav-img" src = "./public/images/Saad-Bazaz.jpg">
                        </div>
                    </div>
                    <div class="person-details">
                        <div class="person-details title"><?php echo $Name ?></div>
                        <div class="person-details subtitle"><?php echo $ID ?></div>
                    </div>
				</div>
				<div class = "card" id="card0" style="display:none">
                    <button class = "mini-button card-close-button" style="font-size: smaller; background-color: transparent;" onclick="destroyCard('#card1')"><i class="fa fa-close"></i></button>
					<h2>Edit Student</h2>
					<form action="./student_information.php" method="POST">
					<?php 
						echo "
						<input type=\"hidden\" name=\"id\" placeholder=\"Name\" value=\"".$ID."\"/><br/>
						<input type=\"text\" name=\"Name\" placeholder=\"Name\" value=\"".$Name."\"/><br/>
						<input type=\"text\" name=\"BayForm\" placeholder=\"BayForm\" value=\"".$BayForm."\"/><br/>
						<select name=\"Gender\" id=\"Gender\" value=\"".$Gender."\">
							<option value=\"M\">Male</option>
							<option value=\"F\">Female</option>
						</select><br/>					
						<input type=\"hidden\" name=\"oldDOB\" placeholder=\"DOB\" value=\"".$DOB."\"/><br/>
						<input type=\"date\" name=\"DOB\" placeholder=\"DOB\" value=\"".$DOB."\"/><br/>
						<input type=\"text\" name=\"Year_Enrolled\" placeholder=\"Year Enrolled\" value=\"".$YearEnrolled."\"/><br/>
						<input type=\"text\" name=\"Father_ID\" placeholder=\"Father ID\" value=\"".$Father_ID."\"/><br/>
						<input type=\"text\" name=\"Mother_ID\" placeholder=\"Mother ID\" value=\"".$Mother_ID."\"/><br/>
						<input type=\"text\" name=\"Guardian_ID\" placeholder=\"Guardian ID\" value=\"".$GuardianID."\"/><br/>
						<input type=\"text\" name=\"Guardian_Relation\" placeholder=\"Guardian Relation\" value=\"".$GuardianRelation."\"/><br/>
						<input type=\"submit\" name=\"editStudentForm_isSubmitted\"/><br/>";
					?>
					</form>
				</div>

				<div class = "card" id="card4">
                    <button class = "mini-button card-close-button" style="font-size: smaller; background-color: transparent;" onclick="destroyCard('#card4')"><i class="fa fa-close"></i></button>
					<h2>Details</h2>
					<?php
						echo "
						Roll Number: ".$ID." <br/>
						Name: ".$Name." <br/>
						BayForm: ".$BayForm." <br/>
						Gender: ".$Gender." <br/>
						DOB: ".$DOB." <br/>
						Year Enrolled: ".$YearEnrolled." <br/>
						Father ID: ".$Father_ID." <br/>
						Mother ID: ".$Mother_ID." <br/>
						Guardian ID: ".$GuardianID." <br/>
						Guardian Relation: ".$GuardianRelation." <br/>
						";
					?>
				</div>

                <div class = "card" id="card1">
                    <button class = "mini-button card-close-button" style="font-size: smaller; background-color: transparent;" onclick="destroyCard('#card1')"><i class="fa fa-close"></i></button>
                    <h1>Hello world!</h1>
                </div>
            </div>
		</div>
		
		<div class = "main-row">
			<div class = "card" id="card2" style="width:300px">
				<button class = "mini-button card-close-button" style="font-size: smaller; background-color: transparent;" onclick="destroyCard('#card2')"><i class="fa fa-close"></i></button>
				<h1>Siblings of <?php echo $Name?></h1>
				<table border="5" rules="none">
					<tr>
						<th>Name</th>
						<th>Roll Number</th>
					</tr>
				<?php

					foreach($Siblings as &$value)
					{
						
						echo "
						<tr onclick=\"openNewTabWithSelectedKey('./student_information.php', '".$value['Sibling_ID']."')\">
							<td>
							".
							$value['Sibling_Name']
							."
							</td>
							<td>
							".
							$value['Sibling_ID']
							."
							</td>
							<td>
							".
							$value['Sibling_G_ID']
							."
							</td>
						</tr>";			
					}
				?>
				</table>
			</div>


			<div class = "card" id="card3" style="width:300px">
				<button class = "mini-button card-close-button" style="font-size: smaller; background-color: transparent;" onclick="destroyCard('#card3')"><i class="fa fa-close"></i></button>
				<h1><?php echo $Name?>'s Class History</h1>
				<table border="5" rules="none">
					<tr>
						<th>Class ID</th>
						<th>Course ID</th>
						<th>Date Taken</th>
					</tr>
				<?php

					foreach($Class_History as &$value)
					{
						
						echo "
						<tr>
							<td>
							".
							$value['Class_ID']
							."
							</td>
							<td>
							".
							$value['Course_ID']
							."
							</td>
							<td>
							".
							$value['R_Date']
							."
							</td>
						</tr>";			
					}
				?>
				</table>
			</div>



		</div>

    
</body>