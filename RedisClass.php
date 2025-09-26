<?php
class RedisClass {
    // Property
    private $cluster_array;

    // Constructor
    public function __construct($value) {
        $this->cluster_array = $value;
    }

    // Method to get the color of the car
    public function Get() {
        $this->returnClusterAddress();
        // echo "Making a get call to redis\n";
        return "Some Redis Value";
    }

    // Method to set a new color for the car
    public function HGet() {
        // echo "HGET".$this->returnClusterAddress();
        // echo "Making a HGet call to redis\n";
        return "Some other redis value";
    }

    public function returnClusterAddress(){
        // echo "Cluster Array Mod: ".$this->cluster_array[0]."\n";
        return $this->cluster_array[0];
    }
}

// // Creating an instance of the Car class
// $myCar = new Car("red");

// // Getting the color of the car
// echo $myCar->getColor(); // Output: red

// // Setting a new color for the car
// $myCar->setColor("blue");

// // Getting the new color of the car
// echo $myCar->getColor(); // Output: blue
?>
