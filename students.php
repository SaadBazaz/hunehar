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



<!-- /* All forms on this page are detected and handled here. Enter your queries! */ -->
<?php

if(isset($_POST["deleteItemForm_isSubmitted"])){
    echo "deleteItemForm has been submitted. ";
    echo "Please delete ".$_POST['context_menu_delete'];
}
else if(isset($_POST["searchFilterForm_isSubmitted"])){
    echo "Search Filter has been submitted. ";
    echo "Please search ".$_POST['filter_search'];
    $filter_search = $_POST['filter_search'];
    if ($filter_search == ""){
        $sql_select = "SELECT * 
        FROM student";
    }
	// else if (is_numeric( $filter_search))
	// {
    //     $sql_select = "SELECT F_ID, F_NAME, F_CNIC, F_NUM, F_ADDRESS, F_ISALIVE, F_EMP_ID 
    //     FROM father 
    //     WHERE F_CNIC like '".$filter_search."'";
    //     $sql_select2 = "SELECT M_ID, M_NAME, M_CNIC, M_NUM, M_ADDRESS, M_ISALIVE, M_EMP_ID 
    //     FROM mother
    //     WHERE M_CNIC like '".$filter_search."'";
	// }
    else{
        $sql_select = "SELECT * 
        FROM student
        WHERE S_ROLLNUMBER like '".$filter_search."' or S_NAME like '".$filter_search."'";
    }
}
else if(isset($_POST["advancedFilterSearchForm_isSubmitted"])){
    echo "Advanced Search Filter has been submitted. ";
    $Student_ID=$_POST['Student_ID'];
    $Student_Name=$_POST['Student_Name'];
    $Exact_Match=$_POST['Exact_Match'];
    $Group_By=$_POST['GroupLabels'];
    $Student_Status=$_POST['ActiveStatus'];
    $From_Date=$_POST['From'];
    $To_Date=$_POST['To'];

    echo "Please advanced search: ".$Student_ID.", ".
    $Student_Name.", ".
    $Exact_Match.", ".
    $Group_By.", ".
    $Student_Status.", ".
    $From_Date.", ".
    $To_Date;


    // $sql_select = "SELECT * 
    // FROM student
    // WHERE S_ROLLNUMBER like '".$filter_search."' or S_NAME like '".$filter_search."'";

}
else if(isset($_POST["classChangeForm_isSubmitted"])){
    echo "Change Class form has been submitted. ";
    $Student_ID=$_POST['StudentID'];
    $Current_Class=$_POST['CurrentClass'];
    $New_Class=$_POST['NewClass'];
    $Class_Change_Reason=$_POST['ClassChangeReason'];
    $Approved_By=$_POST['ApprovedBy'];


    echo "Please change class: ".$Student_ID.", ".
    $Current_Class.", ".
    $New_Class.", ".
    $Class_Change_Reason.", ".
    $Approved_By;
}
else if(isset($_POST["accompanyStudentForm_isSubmitted"])){
    echo "Accompany Student form has been submitted. ";
    $Student_ID=$_POST['StudentID'];
    $Student_Name=$_POST['StudentName'];
    $Class=$_POST['Class'];
    $Guardian_ID=$_POST['GuardianID'];
    $Guardian_Name=$_POST['GuardianName'];
    $Pregnant=$_POST['Pregnant'];
    $Reason_For_Parent_Absence=$_POST['ReasonForParentAbsence'];

    echo "Please accompany student: ".$Student_ID.", ".
    $Student_Name.", ".
    $Class.", ".
    $Guardian_ID.", ".
    $Guardian_Name.", ".
    $Pregnant.", ".
    $Reason_For_Parent_Absence;
}
else {
    $sql_select = "SELECT * 
    FROM student";
}

?>

<!DOCTYPE html>

<head>

    <link href="./public/html/main.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="./public/html/home.js"></script>
    <!-- FONTAWESOME -->
    <!-- jQuery library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />


</head>

<body>


    <nav class="navbar">

        <div class="nav nav-left">
            <h1 class="logo"><a href="./home.html"><img src="../images/Logo.PNG"
                        style="display:inline-block; height:40px; width: auto"></a></h1>
            <div><svg style="fill:#ffffff" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                    viewBox="0 0 18 18">
                    <path d="M12.44 6.44L9 9.88 5.56 6.44 4.5 7.5 9 12l4.5-4.5z" /></svg></div>
        </div>
        <div class="nav nav-right">
            <div class="nav-links">
                <a href="home.php">Dashboard</a>
                <a href="classes.php">Classes</a>
                <a href="students.php">Students</a>
                <a href="parents.php">Parents</a>
            </div>
            <div onclick="openContextMenu(event, 'image-cropper', '#profile-picture-context-menu')"
                class="image-cropper profile-button">
                <img class="nav-img" src="../images/Fawad-Khan.jpg">
            </div>
        </div>
    </nav>

    <div class="main">

        <div class="main-header">
            <div class="main-row">
                <div class="main-header-title">
                    Students
                </div>
                <div class="main-header-assistive">
                    <div class="input-container">
                        <i class="fa fa-search" style="margin-right: 10px;margin-top:5px"></i>
                        <form  name="searchFilterForm" action="./students.php" method="POST">
                            <input type="text" placeholder="Search"  name="filter_search" />
                            <input type="submit" name="searchFilterForm_isSubmitted" style="height: 0px; width: 0px; border: none; padding: 0px;" hidefocus="true" />
                        </form>
                        <button onclick="openContextMenu(event, 'input-container', '#search-bar-context-menu')"
                            class="mini-button" style="background-color: transparent;">
                            <i class="fa fa-filter"></i>
                        </button>
                    </div>
                    <button onclick=" window.open('./register_student.html','_blank')" class="btn"
                        style="background-color: #45E900;">
                        &#xf234; Register Student
                    </button>
                </div>

                <!-- <div class = "card">
                    <h1>خوش آمدید</h1>
                </div> -->
            </div>
        </div>


        <div class="main-body">
            <!-- Body content comes here  -->
            <div class="main-row">
                <table border="5" rules="none">
                    <tr>
                    <th>Picture</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Gender</th>
                    <th>Year Enrolled</th>

                    </tr>
					
<?php 
						$query_id = oci_parse($con, $sql_select);
						$result = oci_execute($query_id);
						while($row = oci_fetch_array($query_id, OCI_BOTH+OCI_RETURN_NULLS)) 
						{
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

        echo "
        <tr>
        <td style=\"width:80px\">
            <div class=\"image-cropper profile-button\">
                <img class=\"nav-img\" src=\"./public/images/Saad-Bazaz.jpg\">
            </div>
        </td>
        <td>".
        $ID
        ."</td>
        <td>
            ".
            $Name
            ."
        </td>
        <td>
            5D
        </td>
        <td>".
        $Gender
        ."</td>
        <td>".
        $YearEnrolled."
        </td>
        <td style=\"width:auto; padding:0\">
            <div class=\"status_buttons\" style=\"padding-bottom: 4px;\">
                <i class=\"fa fa-circle\" style=\"color:greenyellow\"></i>
                <div class=\"more_options\">
                    <button
                        onclick=\"openContextMenu(event, 'more_options', '#table-list-item-context-menu', '".$ID."')\"
                        class=\"mini-button\" style=\"background-color: transparent;\">
                        <i class=\"fa fa-angle-down\"></i>
                    </button>
                </div>
            </div>

        </td>
        </tr>";

    }
    ?>
                </table>
            </div>
        </div>
        <!-- <div class = "card">
            <h1>Welcome to Slate.</h1>
        </div> -->
    </div>

    <!-- / The Context Menu -->
    <nav id="profile-picture-context-menu" class="context-menu">
        <div class="context-menu-container-expander">

            <ul class="context-menu__items">
                <!-- <li class="context-menu__item">
                <a href="#" class="context-menu__link" data-action="Pin">Pin</a>
              </li> -->
                <li class="context-menu__item">
                    <a href="#" class="context-menu__link" data-action="My Account">My Account</a>
                </li>
                <li class="context-menu__item">
                    <a href="./login.html" class="context-menu__link_delete" data-action="Sign Out">Sign Out</a>
                </li>
            </ul>
        </div>
    </nav>


    <!-- / The Context Menu for Table Lists-->
    <nav id="table-list-item-context-menu" class="context-menu">
        <!-- <div class="over"></div> -->
        <div class="context-menu-container-expander">

            <ul class="context-menu__items">
                <!-- <li class="context-menu__item">
                            <a href="#" class="context-menu__link" data-action="Pin">Pin</a>
                          </li> -->
                <li class="context-menu__item">
                   <a onclick="openNewTabWithSelectedKey('./student_information.php')" class="context-menu__link" data-action="View Info">View Info</a>

                </li>
                <li class="context-menu__item">
                    <a onclick="openModal('#student-accompanying-modal')" class="context-menu__link"
                        data-action="Accompany" style="pointer-events: auto; cursor: pointer;">Accompany</a>
                </li>
                <li class="context-menu__item">
                    <a onclick="openModal('#class-change-modal')" class="context-menu__link" 
                         data-action="Change Class" style="pointer-events: auto; cursor: pointer;">Change Class...</a>
                </li>
                <li class="context-menu__item">
                    <a onclick="submitFormWithSelectedKey('#context_menu_delete', 'deleteItemForm')" class="context-menu__link_delete" data-action="Delete">Delete</a>
                </li>
            </ul>
            <form name="deleteItemForm" action="./classes.php" method="POST">
                <input type="hidden" name="context_menu_delete" id="#context_menu_delete"/>
                <input type="hidden" name="deleteItemForm_isSubmitted" value="1">
            </form>
        </div>
    </nav>


    <!-- / The Context Menu for Search Filter Button-->
    <nav id="search-bar-context-menu" class="context-menu" style="width: fit-content;">
        <div class="over" id="search-bar-context-menu-over">Over</div>

        <div class="context-menu-container-expander">

            <form name="advancedFilterSearchForm" action="./students.php" method="POST">
                <ul class="context-menu__items">
                    <!-- <li class="context-menu__item">
                                <a href="#" class="context-menu__link" data-action="Pin">Pin</a>
                            </li> -->
                    <li class="context-menu__item">
                        <div class="context-menu__link_generic">
                            <div class="input-container"
                                style="width: 100%; height:100%; padding:0;margin:0; background-color: #EEEEEE; border:none; outline:none; ">
                                <input name="Student_ID" type="text" placeholder="Student ID"
                                    style="margin:0; padding:0 4px 0 4px;  color: #A7A7A7;" />
                            </div>
                        </div>
                    </li>
                    <li class="context-menu__item">
                        <div class="context-menu__link_generic">
                            <div class="input-container"
                                style="width: 100%; height:100%; padding:0;margin:0; background-color: #EEEEEE; border:none; outline:none; ">
                                <input name="Student_Name" type="text" placeholder="Student Name"
                                    style="margin:0; padding:0 4px 0 4px;  color: #A7A7A7;" />
                            </div>
                        </div>
                    </li>
                    <li class="context-menu__item">
                        <div class="context-menu__link_generic">
                            <input type="checkbox" id="exactmatch" name="Exact_Match">
                            <label for="Exact_Match"> Exact Match</label>
                        </div>
                    </li>
                    <li class="context-menu__item">
                        <div class="context-menu__link_generic">
                            <label for="GroupLabels">Group by </label>
                            <select name="GroupLabels" id="GroupLabels" style="margin-left: 5px;">
                                <option value="None">Select...</option>
                                <option value="Class">Class</option>
                            </select>
                        </div>
                    </li>
                    <li class="context-menu__item">
                        <div class="context-menu__link_generic" style="max-width: 140px; flex-wrap: wrap;">

                            <select name="ActiveStatus" id="ActiveStatus">
                                <option value="All">Select...</option>
                                <option value="Active">Active</option>
                                <option value="Dormant">Dormant</option>
                            </select>
                            <label for="ActiveStatus" style="margin-left: 5px;margin-right: 5px;"> from </label>
                            <input type="date" id="From" name="From" style="width:140px"><br>
                            <label for="From" style="margin-left: 5px;margin-right: 5px;">to</label>
                            <input type="date" id="To" name="To" style="width:140px">

                        </div>
                    </li>
                    <li class="context-menu__item">
                        <div class="context-menu__link_button">
                            <input type="submit" style="outline: none; border: none; background-color: transparent; color: white; width: 100%; height: 100%; pointer-events: auto;
                                        cursor: pointer;" value="Filter" />
                        </div>
                    </li>
                </ul>
                <input type="hidden" name="advancedFilterSearchForm_isSubmitted" value="1">
            </form>
        </div>
    </nav>


    <!-- ========================= MODAL TYPES =========================  -->
    <!-- <div class="wrapper">
        <h1>Simple Modal</h1>
        <p>Hey, click on that button to open the modal </p>
        <button id="modBtn" onclick="openModal('#class-change-modal')" class="modal-btn">Open Modal</button>
    </div>
 -->





    <!-- Class Change Modal -->
    <div id="class-change-modal" class="modal">
        <!-- Modal Content -->
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 style="color:black">Change Class</h3>
                <div class="close fa fa-close" onclick="closeModal('#class-change-modal')"></div>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- <h3>Hello</h3> -->
                <form action="./students.php" method="POST">
                    <div class="main-row" style="padding-top: 20px;">
                        <label for="StudentID" style="font-style: italic;">Student ID </label>
                        <input type="text" name="StudentID" placeholder="Student ID" value="i180621"
                            style="margin-left: 5px" ; />
                    </div>
                    <div class="main-row">
                        <label for="CurrentClass" style="font-style: italic;">Current Class </label>
                        <input type="text" name="CurrentClass" placeholder="Current Class" value="5D" disabled
                            style="margin-left: 5px" />
                    </div>
                    <div class="main-row">
                        <label for="NewClass" style="font-style: italic;">New Class </label>
                        <input type="text" name="NewClass" placeholder="Enter a new Class..."
                            style="margin-left: 5px" />
                    </div>
                    <textarea id="ClassChangeReason" name="ClassChangeReason" placeholder="Reason" name="s_content"
                        style="width: 100%;"></textarea>
                    <div class="main-row">
                        <label for="ApprovedBy" style="font-style: italic;">Approved by </label>
                        <input type="text" name="ApprovedBy" placeholder="Enter Employee ID..."
                            style="margin-left: 5px" />
                    </div>
                    <div class="modal-footer" style="padding:0">
                        <li class="context-menu__item">
                            <div class="context-menu__link_button" style="background-color: orange;">
                                <input type="submit" style="outline: none; border: none; background-color: transparent; color: white; pointer-events: auto; width: 100%; height: 100%;     pointer-events: auto;
                    cursor: pointer;" value="Submit" />
                            </div>
                        </li>
                    </div>
                    <input type="hidden" name="classChangeForm_isSubmitted" value="1">
                </form>
            </div>
        </div>
    </div>




    <!-- Student Accompanying Modal -->
    <div id="student-accompanying-modal" class="modal">
        <!-- Modal Content -->
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 style="color:black">Assign Accompanier</h3>
                <div class="close fa fa-close" onclick="closeModal('#student-accompanying-modal')"></div>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form action="./students.php" method="POST">


                    <h3 style="color:black">Student Information</h3>
                    <div class="main-row" style="height: auto;">
                        <label for="StudentID" style="font-weight: bolder;">Student ID </label>
                        <input type="text" name="StudentID" placeholder="Student ID" value="i180621" disabled
                            style="margin-left: 5px" />
                    </div>
                    <div class="main-row" style="height: auto;">
                        <label for="StudentName" style="font-weight: bolder;">Student Name </label>
                        <input type="text" name="StudentName" placeholder="Student Name" value="Saad Bazaz" disabled
                            style="margin-left: 5px" />
                    </div>
                    <div class="main-row" style="height: auto;">
                        <label for="Class" style="font-weight: bolder;">Class </label>
                        <input type="text" name="Class" placeholder="Class" value="5D" disabled
                            style="margin-left: 5px" />
                    </div>

                    <div class="main-row" style="padding-top: 20px;">
                        <h3 style="color:black">Accompanying Guardian Information</h3>
                    </div>
                    <div class="main-row">
                        <label for="GuardianID" style="font-style: italic;">Guardian ID </label>
                        <input type="text" name="GuardianID" placeholder="Enter Guardian ID..."
                            style="margin-left: 5px" ; />
                    </div>
                    <div class="main-row">
                        <label for="GuardianName" style="font-style: italic;">Guardian Name </label>
                        <input type="text" name="GuardianName" placeholder="Enter Guardian Name..." value="Shabaana Bibi" disabled
                            style="margin-left: 5px" />
                    </div>
                    <div class="main-row" style="justify-content: flex-start;">
                        <label for="Pregnant" style="font-style: italic;">Pregnant?</label>
                        <input type="radio" name="Pregnant" value="Yes"><label>Yes</label>
                        <input type="radio" name="Pregnant" value="No"><label>No</label>
                    </div>
                    <textarea id="ReasonForParentAbsence" name="ReasonForParentAbsence" placeholder="Reason for Parents' Absence" name="s_content"
                        style="width: 100%;"></textarea>
                    <div class="modal-footer" style="padding:0">
                        <li class="context-menu__item">
                            <div class="context-menu__link_button" style="background-color: orange;">
                                <input type="submit" style="outline: none; border: none; background-color: transparent; color: white; pointer-events: auto; width: 100%; height: 100%;     pointer-events: auto;
                                cursor: pointer;" value="Submit" />
                            </div>
                        </li>
                    </div>
                    <input type="hidden" name="accompanyStudentForm_isSubmitted" value="1">
                </form>
            </div>
        </div>
    </div>



</body>