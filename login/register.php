<?php 
include 'connect.php';

if(isset($_POST['signUp'])){
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);
    $bio = $_POST['bio'];
    $age = $_POST['age'];

    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);
    if($result->num_rows > 0){
        echo "Email Address Already Exists!";
    }
    else{
        // Insert user data into the users table
        $insertQuery = "INSERT INTO users(firstName, lastName, email, password)
                        VALUES ('$firstName', '$lastName', '$email', '$password')";
        if($conn->query($insertQuery) == TRUE){
            // Insert profile data into the profiles table
            $user_id = $conn->insert_id; // Get the inserted user ID
            $insertProfileQuery = "INSERT INTO profiles(user_id, bio, age) 
                                   VALUES ('$user_id', '$bio', '$age')";
            if($conn->query($insertProfileQuery) == TRUE){
                header("Location: index.php");
            } else {
                echo "Error: " . $conn->error;
            }
        }
        else{
            echo "Error: " . $conn->error;
        }
    }
}


if(isset($_POST['signIn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

    // Update the SQL to fetch bio and age from the Profiles table as well
    $sql = "SELECT Users.firstName, Users.lastName, Users.email, Profiles.bio, Profiles.age
    FROM Users
    LEFT JOIN Profiles ON Users.id = Profiles.user_id";
$result = $conn->query($sql);

    if($result->num_rows > 0){
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        $_SESSION['bio'] = $row['bio']; // Store bio in session
        $_SESSION['age'] = $row['age']; // Store age in session
        header("Location: homepage.php");
        exit();
    }
    else{
        echo "Not Found, Incorrect Email or Password";
    }
}
?>
