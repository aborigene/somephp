<?php
class UserEnhancement {

    // Property
    private $enhancement_status = "Validation ok.";

    // Method to get the color of the car
    public function ValidateUserType($user_type)
     {
        $user_enhancement = getenv('USER_ENHANCEMENT');
        echo "User enhancement var: ".$user_enhancement;
        echo "User type: ".$user_type;

        if ( $user_enhancement == "true" ){
            if ($user_type == "platinum"){
                $error = "'platinum' is not a valid user type...";
                $this->setValidationStatus($error);
                header('HTTP/1.1 401 Unauthorized');
                throw new Exception($error);
            }
        }
        return "user is valid";
    }

    public function setValidationStatus($value){
        // echo "Cluster Array Mod: ".$this->cluster_array[0]."\n";
        $this->enhancment_status = $value;
    }
}

?>
