<!DOCTYPE html>
<head>
    <link href="./main.css" type="text/css" rel="stylesheet">

</head>

<body>

    <nav class="navbar">
          
            <div class = "nav nav-left">
                <h1 class="logo"><a href="./home.html"><img src = "./Logo.PNG" style = "display:inline-block; height:40px; width: auto"></a></h1>
                <div><svg style = "fill:#ffffff" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 18 18"><path d="M12.44 6.44L9 9.88 5.56 6.44 4.5 7.5 9 12l4.5-4.5z"/></svg></div>
            </div>
            <ul class="nav nav-right">
                <li>
                <a href="home.html">Home</a>
                </li>
                <li>
                    <a href="myprofile.html">My Profile</a>
                </li>
                <li>
                    <a href="assignment.html">&#43 New Assignment</a>
                </li>
                <li>
                    <a href="calculator.php">Calculator</a>
                </li>
            </ul>
    </nav>

    <div class = "main">
        <div class = "card">
            <h1>Simple Calculator</h1>

            <form action = "calculator.php" method = "post">
                    <tr>                
                        <td><input type="number" placeholder="First Number" name="c_firstnumber" style = "width:100%; margin: 5px">
                        <!-- <label for="teacher">Select a teacher</label> -->
                        <select id="operator" name="c_operator">
                            <option value="+"><label>+</label>
                            <option value="-"><label>-</label>
                            <option value="x"><label>x</label>
                            <option value="/"><label>/</label>
                        </select>
                        <input type="number" placeholder="Second Number" name="c_secondnumber" style = "width:100%; margin: 5px"></td>
                    </tr>
                    <tr>
                        <centre>
                            <td>
                            <button class="btn" type="submit">Calculate</button>
                            <!-- <button class="btn" type="submit">Submit</button></td> -->
                        </centre>
                    </tr>
                </table>
            </form>

            <strong>Result is: <?php 
            
            // echo $_POST["c_firstnumber"]; 
            $firstnumber = $_POST['c_firstnumber'] + 0;
            $secondnumber= $_POST['c_secondnumber'] + 0;
            $operator = $_POST["c_operator"];
            switch($operator)
            {
                case "+":
                    $answer = $firstnumber + $secondnumber;
                    echo $answer;
                    break; 
                case "-":
                    $answer = $firstnumber - $secondnumber;
                    echo $answer;
                    break;
                case "x":
                    $answer = $firstnumber * $secondnumber;
                    echo $answer;
                    break; 
                case "/":
                    $answer = $firstnumber / $secondnumber;
                    echo $answer;
                    break;
            }
            
            
            
            ?>


            </strong>
        </div>


    </div>
</body>