<?php

require "RedisClass.php";
require "UserEnhancement.php";

// Check if the GET parameters 'param1' and 'param2' are set
if (isset($_GET['user']) && isset($_GET['password'])) {
    // Retrieve the GET parameters
    $user = $_GET['user'];
    $user_password = $_GET['password'];
    $user_type = $_GET['type'];

    // echo $user_type;

    $dsn = "mysql:host=127.0.0.1:3306;dbname=nuvemshop";
    $username = "nuvem";
    $password = "nuvem123!@";

    try {
        
        // Create a PDO instance
        // $pdo = new PDO($dsn, $username, $password);
        // //Set the PDO error mode to exception
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // // echo "Connected successfully\n";
        // $query = "SELECT * FROM users where username='".$user."' and password='".$user_password."'";
        // // echo $query."\n";
        // $stmt = $pdo->query($query);

        $cluster_address = array("some.nuvemshop.redis.cluster.com");
        $redis_cluster = new RedisClass($cluster_address);
        $redis_cluster->Get();
        $redis_cluster->HGet();

        $cluster_address2 = array("another.nuvemshop.redis.cluster.com");
        $redis_cluster2 = new RedisClass($cluster_address2);
        $redis_cluster2->Get();
        $redis_cluster2->HGet();

        $enhancement = new UserEnhancement();
        // echo "Calling validation for ".$user_type;
        // echo $user_type;
        $enhancement->ValidateUserType($user_type);
        
        // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //     echo "id: " . $row["user_id"]. " - Name: " . $row["username"]. " - Email: " . $row["email"]. "<br>";
        // }
    } //catch (PDOException $e) {
    //     echo "Connection failed: " . $e->getMessage();
    // } 
    catch(Exception $e){
        echo "Something happened ".$e->getMessage();
    }


    // Echo the parameters
    //echo "Parameter 1: " . htmlspecialchars($param1) . "<br>";
    // echo "Parameter 2: " . htmlspecialchars($param2) . "<br>";
} else {
    echo "Please provide both 'param1' and 'param2' parameters.";
}
?>