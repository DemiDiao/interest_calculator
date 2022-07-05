<?php
//This API accept three parameters from the user and cfalculate the compound interest.
//localhost:8080/webservices/assignment1/api.php?principal?principal_amount=1000&rate_of_interest=5&time=5
//reference: https://www.bankbazaar.com/fixed-deposit/compound-interest-formula.html

if(isset($_GET['principal_amount']) && isset($_GET['rate_of_interest']) && isset($_GET['time']))
{
    $principal_amount = $_GET['principal_amount'];
    $rate_of_interest = $_GET['rate_of_interest'];
    $time = $_GET['time'];
    $n = 2;

    
    if(!empty($principal_amount) && !empty($rate_of_interest) && !empty($time))
    {
        if($principal_amount < 0 )
        {
            $output = array(
                "status" => "error",
                "error_code" => "2",
                "error_description" => "the principal amount parameter is negative",
                "error-solution" => "Please check the value of the principal amount parameter"
            );
            echo json_encode($output); 
        }
        else if( $rate_of_interest < 0)
        {
            $output = array(
                "status" => "error",
                "error_code" => "3",
                "error_description" => "the rate of interest parameter is negative",
                "error-solution" => "Please check the value of the rate of interest parameter"
            );
            echo json_encode($output); 
        }
        else if($time < 0)
        {
            $output = array(
                "status" => "error",
                "error_code" => "4",
                "error_description" => "the time parameter is negative",
                "error-solution" => "Please check the value of the time parameter"
            );
            echo json_encode($output); 
        }
        
        else{
            $output = array(
                "principal_amount" => $principal_amount,
                "rate_of_interest" => $rate_of_interest,
                "time_of_investment" => $time,
                "interest_amount" =>  number_format($principal_amount * (pow((1 + $rate_of_interest / ($n * 100)),$n * $time) - 1),1,'.',''),
                "total_return" => number_format($principal_amount * pow((1 + $rate_of_interest / ($n * 100)),$n * $time),1,'.','')
                );
            echo json_encode($output);
        }
    }
    else if(($principal_amount == 0 && $rate_of_interest > 0 && $time > 0) 
            || ($principal_amount > 0 && $rate_of_interest == 0 && $time > 0)
            || ($principal_amount > 0 && $rate_of_interest > 0 && $time == 0)
            || ($principal_amount == 0 && $rate_of_interest == 0 && $time > 0)
            || ($principal_amount > 0 && $rate_of_interest == 0 && $time == 0) 
            || ($principal_amount == 0 && $rate_of_interest > 0 && $time == 0)
            || ($principal_amount == 0 && $rate_of_interest == 0 && $time == 0))
        {
            $output = array(
                "principal_amount" => $principal_amount,
                "rate_of_interest" => $rate_of_interest,
                "time_of_investment" => $time,
                "interest_amount" => 0,
                "total_return" => $principal_amount
                );
            echo json_encode($output);
        }
    else
    {
        $output = array(
            "status" => "error",
            "error_code" => "5",
            "error_description" => "Pareters are empty",
            "error-solution" => "Please provide the required get parameters for this API"
        );
        echo json_encode($output);
    }
}
else
{
     $output = array(
        "status" => "error",
        "error_code" => "1",
        "error_description" => "Pareter missing",
        "error-solution" => "Please provide the required get parameters for this API"
    );
    echo json_encode($output);
}
