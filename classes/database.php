<?php

class database{

    function opencon(){
        return new PDO('mysql:host=localhost; dbname=loginmethod', 'root', '');
    }


    function check($username, $password){
        $con = $this->opencon();
        $query = "SELECT * from users WHERE username='".$username."'&&password='".$password."'                ";
        return $con->query($query)->fetch();
    }

function signup($username, $password, $firstname, $lastname, $birthday, $sex){
        $con = $this->opencon();

// Check if the username is already exists

    $query=$con->prepare("SELECT username FROM users WHERE username =?");
    $query->execute([$username]);
    $existingUser= $query->fetch();
    

// If the username already exists, return false
    if($existingUser){
    return false;
}
// Insert the new username and password into the database
    return $con->prepare("INSERT INTO users(username, password ,user_firstname,user_lastname,user_birthday,user_sex)
VALUES (?, ?, ?, ?, ?, ?)")
           ->execute([$username,$password, $firstname, $lastname, $birthday, $sex]);
           
}

function signupUser($username, $password, $firstname, $lastname, $birthday, $sex){
    $con = $this->opencon();
    // Check if the username is already exists
    $query=$con->prepare("SELECT username FROM users WHERE username =?");
    $query->execute([$username]);
    $existingUser= $query->fetch();

// If the username already exists, return false
    if($existingUser){
    return false;
}
// Insert the new username and password into the database
 $con->prepare("INSERT INTO users(username,password,user_firstname,user_lastname,user_birthday,user_sex) VALUES (?, ?, ?, ?, ?, ?)")
           ->execute([$username,$password, $firstname, $lastname, $birthday, $sex]);
           return $con->lastInsertId();
}


function insertAddress($user_id, $city, $province, $street, $barangay){
    $con = $this->opencon();
    return $con->prepare("INSERT INTO
    user_address (user_id, user_add_street, user_add_barangay, user_add_city, user_add_province)
    VALUES (?, ?, ?, ?, ?)")->execute([$user_id, $city, $province, $street, $barangay]);
}
function view()
{
    $con = $this->opencon();
    return $con->query("")->fetchAll();

}


function view(){
    $con = $this ->opencon();
    return $con->query("SELECT users.user_id,users.user_firstname, users.user_lastname, users.user_birthday, users.user_sex, users.username, users.password,
    concat (user_address.user_add_street,' ',user_address.user_add_barangay,' ',user_address.user_add_city,' ',user_address.user_add_province) AS address
    FROM users
    JOIN user_address ON users.User_id = user_address.User_id")->fetchAll();
}
function delete($id)
{
    try{
    $con = $this->opencon();
    $con->beginTransaction();
    //Delete user address
    $query= $con->prepare("DELETE FROM users WHERE user_id= ?");

    $con->commit();
    return true; // Deletion succesful
    } catch (PDOExeption $e){
        $con->rollBack();
        return false;
    }
}

}