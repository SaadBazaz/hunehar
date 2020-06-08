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

} else {
    $error = "No ID has been specified.";
    //redirecting back to Parents page
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
						
						$sql_select1 = "select * from student where M_ID = '".$Mother_ID."' and F_ID = '".$Father_ID."'";
						$sql_select2 = "select * from Mother where M_ID = '".$Mother_ID."'";
						$sql_select3 = "select * from Father where F_ID = '".$Father_ID."'";
						$sql_select4 = "select * from Registration where s_rollnumber = '".$ID."'";
						
						$query_id1 = oci_parse($con, $sql_select1);
						$result1 = oci_execute($query_id1);
						if ($result1)
						{
							$siblings = array();
							
							while($row1 = oci_fetch_array($query_id1, OCI_BOTH+OCI_RETURN_NULLS)) 	// for siblings)
							{
								$tempsib = array
												('Sibling_ID' => $row1['S_ROLLNUMBER'],
												'Sibling_Name' => $row1['S_NAME']);
								array_push($siblings, $tempsib);
							}
							
							foreach($siblings as &$value)
							{
								echo "Sibling_ID = ". $value['Sibling_ID'] . " " . $value['Sibling_Name']."<br>" ;
						
							}
							//echo $siblings;
						}	
						
						$query_id2 = oci_parse($con, $sql_select2);
						$result2 = oci_execute($query_id2);
						if ($result2)
						{
							$row2 = oci_fetch_array($query_id2, OCI_BOTH+OCI_RETURN_NULLS);	// for mother info
							if ($row2)
							{
								$mother_name = $row2['M_NAME'];
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
								$Father_name = $row3['F_NAME'];
							}
							else
							{
								
							}
						}	
						
						$query_id4 = oci_parse($con, $sql_select4);
						$result4 = oci_execute($query_id4);
						if ($result4)
						{
							$siblings = array();
							
							while($row4 = oci_fetch_array($query_id4, OCI_BOTH+OCI_RETURN_NULLS)) 	// for siblings)
							{
								$tempsib = array
												('Sibling_ID' => $row4['CLASS_ID'],
												'Sibling_Name' => $row4['CO_ID'],
												'R_date' => $row4['R_DATE']);
								array_push($siblings, $tempsib);
							}
							
							foreach($siblings as &$value)
							{
								echo "Sibling_ID = ". $value['Sibling_ID'] . " " . $value['Sibling_Name']. " " . $value['R_date']."<br>";
						
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
                onclick="hello()"
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
                <div class = "card" id="card1">
                    <button class = "mini-button card-close-button" style="font-size: smaller; background-color: transparent;" onclick="destroyCard('#card1')"><i class="fa fa-close"></i></button>
                    <h1>خوش آمدید</h1>
                </div>
            </div>
        </div>
    </div>

    
</body>