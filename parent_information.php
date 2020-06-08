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
if (isset($_GET['id'])) {
    $ID = $_GET['id'];
    $sql_select = "SELECT * 
    FROM father
    WHERE F_ID = '".$ID."' ";

    $sql_select2 = "SELECT * 
    FROM mother
    WHERE M_ID = '".$ID."' ";

} else {
    $error = "No ID has been specified.";
    //redirecting back to Parents page
    header("Location: ./parents.php");
    die();
}

?>





<?php
                    $query_id = oci_parse($con, $sql_select);
                    $result = oci_execute($query_id);
                    if ($result){
                        $row = oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS);
                        $ID = $row['F_ID'];
                        $Name = $row['F_NAME'];
                        $CNIC = $row['F_CNIC'];
                        $Number = $row['F_NUM'];
                        $Address = $row['F_ADDRESS'];
                        $IsAlive = $row['F_ISALIVE'];
                        $EmpID = $row['F_EMP_ID'];
                        $ParentType = "Father";   
                        $Alive_Status = ($IsAlive == "1"  ? 1 : 0);
 
                    }else{
                        $query_id2 = oci_parse($con, $sql_select2);
                        $result2 = oci_execute($query_id2);
                        if ($result2){
                            $row = oci_fetch_array($query_id2, OCI_BOTH+OCI_RETURN_NULLS);
                            $ID = $row['M_ID'];
                            $Name = $row['M_NAME'];
                            $CNIC = $row['M_CNIC'];
                            $Number = $row['M_NUM'];
                            $Address = $row['M_ADDRESS'];
                            $IsAlive = $row['M_ISALIVE'];
                            $EmpID = $row['M_EMP_ID'];
                            $ParentType = "Mother";   
                            $Alive_Status = ($IsAlive == "1"  ? 1 : 0);
                        }
                        else{
                            $error = "Couldn't retreive any parent against this ID.";
                        }
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
                Parent Information
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
                    <!-- <div class="person-picture">
                        <div class="image-cropper" style = "height:80px; width:80px; ">
                            <img class = "nav-img" src = "../images/Saad-Bazaz.jpg">
                        </div>
                    </div> -->
                    <div class="person-details">
                        <div class="person-details title"><?php echo $Name ?></div>
                        <div class="person-details subtitle"><?php echo $ParentType ?></div>
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