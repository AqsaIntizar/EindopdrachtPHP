<?php

class Location{

public function getcity(){
    $curl = curl_init("https://eu1.locationiq.com/v1/reverse.php?key=1b3949e3d91235&lat=" . $_SESSION['lat'] . "&lon=" .$_SESSION['long'] . "&format=json");
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER    =>  true,
        CURLOPT_FOLLOWLOCATION    =>  true,
        CURLOPT_MAXREDIRS         =>  10,
        CURLOPT_TIMEOUT           =>  30,
        CURLOPT_CUSTOMREQUEST     =>  'GET',
        
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        $json = json_decode($response);
        return $json->address->town;

        }
    }

}