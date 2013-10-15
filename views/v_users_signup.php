
<form id="myForm" method='POST' action='/users/p_signup'>

<?php	// define variables and initialize with empty values
$nameErr = $lastErr = $emailErr = $passwordErr =  "";
$name = $last = $email = $password = "";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["first_name"])) {
        $nameErr = "Missing";
    }
    else {
        $name = $_POST["first_name"];
    }
 
    if (empty($_POST["last_name"])) {
        $lasrErr = "Missing";
    }
    else {
        $last = $_POST["last_name"];
    }
 
    if (empty($_POST["email"]))  {
        $emailErr = "Missing";
    }
    else {
        $email = $_POST["email"];
    }
 
    if (!isset($_POST["password"])) {
        $passwordErr = "You must enter a password";
    }
    else {
        $password = $_POST["password"];
    }
}

?>

    First Name<br>
    <input type='text' name='first_name'>
    <br><br>

    Last Name<br>
    <input type='text' name='last_name'>
    <br><br>

    Email<br>
    <input type='text' name='email'>
    <br><br>

    Password<br>
    <input type='password' name='password'>
    <br><br>

    <input type='submit'>

</form>