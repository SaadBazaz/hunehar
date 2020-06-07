



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
            <h1 class="logo"><a href="./home.html"><img src="./public/images/Logo.PNG"
                        style="display:inline-block; height:40px; width: auto"></a></h1>
            <div><svg style="fill:#ffffff" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                    viewBox="0 0 18 18">
                    <path d="M12.44 6.44L9 9.88 5.56 6.44 4.5 7.5 9 12l4.5-4.5z" /></svg></div>
        </div>
        <div class="nav nav-right">
            <div class="nav-links">
                <a href="home.html">Dashboard</a>
                <a href="classes.html">Classes</a>
                <a href="students.html">Students</a>
                <a href="parents.html">Parents</a>
            </div>
            <div onclick="openContextMenu(event, 'image-cropper', '#profile-picture-context-menu')"
                class="image-cropper profile-button">
                <img class="nav-img" src="./public/images/Fawad-Khan.jpg">
            </div>
        </div>
    </nav>

    <div class="main">

        <div class="main-header">
            <div class="main-row">
                <div class="main-header-title">
                    Classes
                </div>
                <div class="main-header-assistive">
                    <div class="input-container">
                        <i class="fa fa-search" style="margin-right: 10px;margin-top:5px"></i>
                        <form  name="searchFilterForm" action="./classes.php" method="POST">
                            <input type="text" placeholder="Search"  name="filter_search" />
                            <input type="submit" name="searchFilterForm_isSubmitted" style="height: 0px; width: 0px; border: none; padding: 0px;" hidefocus="true" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-body">
            <!-- Body content comes here  -->


            

            <div class="main-row">
                <table border="5" rules="none">
                    <!-- <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    </tr> -->



        <?php 

        $primary_key = 11223344;
        for ($x = 0; $x <= 10; $x++) {
        echo "
        <tr>
        <td>".
        $primary_key
        ."</td>
        <td>
            ".
            $filter_search_query
            ."
        </td>
        <td>
            5D
        </td>
        <td>".
        $filter_search
        ."</td>
        <td style=\"width:auto; padding:0\">
            <div class=\"status_buttons\" style=\"padding-bottom: 4px;\">
                <i class=\"fa fa-circle\" style=\"color:greenyellow\"></i>
                <div class=\"more_options\">
                    <button
                        onclick=\"openContextMenu(event, 'more_options', '#table-list-item-context-menu', ".$primary_key.")\"
                        class=\"mini-button\" style=\"background-color: transparent;\">
                        <i class=\"fa fa-angle-down\"></i>
                    </button>
                </div>
            </div>

        </td>
        </tr>";

        // increment primary key for testing
        $primary_key=$primary_key+1;


    }
        ?>

    <!-- / The Context Menu -->
    <nav id="profile-picture-context-menu" class="context-menu">
        <div class="context-menu-container-expander">

            <ul class="context-menu__items">
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
            <li class="context-menu__item">
                    <a onclick="openNewTabWithSelectedKey('./student_information.php')" class="context-menu__link" data-action="View Info">View Info</a>
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


</body>