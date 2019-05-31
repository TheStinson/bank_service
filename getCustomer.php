<?php

require_once("./include/membersite_config.php");

if(isset($_GET['asid']))
{       
        $asid = $_GET['asid'];
    
        //API Url
        $url = 'https://barclaysbotnode-thestinson.c9users.io/checkasid/';
         
        $postData = array(
                'asid' => $asid
            );

         
        //Initiate cURL.
        $ch = curl_init($url);
         
        //Encode the array into JSON.
        $jsonDataEncoded = json_encode($postData);
         
        //Tell cURL that we want to send a POST request.
        curl_setopt($ch, CURLOPT_POST, 1);
        
        //Tell Curl to not post anything on screen 
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
         
        //Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
         
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        //Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
         
        //Execute the request
        $result = curl_exec($ch);
        
        //Encode the array into JSON.
        $jsonResponse = json_decode($result, true);
        
        if($jsonResponse["status"] == "success")
        {
            $response=array(
                "error" => "false",
                "id_user" => $row['id_user'],
                "name" => $row['name'],
                "email" => $row['email'],
                "customer_id" => $row['customer_id'],
                "secure_pin" => $row['secure_pin'],
                "fb_id" => $row['fb_id']
                );
            echo json_encode($response);
        }
        else
        { 
            $response=array(
                "error" => "true",
                "id_user" => "",
                "name" => "$asid not found",
                "email" => "",
                "customer_id" =>"",
                "secure_pin" => "",
                "fb_id" => ""
                );
            echo json_encode($response);
        }
}
else
{
            $response=array(
                "error" => "true",
                "id_user" => "",
                "name" => "bad request",
                "email" => "",
                "customer_id" =>"",
                "secure_pin" => "",
                "fb_id" => ""
                );
            echo json_encode($response);
}

?>