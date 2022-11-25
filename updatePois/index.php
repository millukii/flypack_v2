<?php
$data = [];
$dataString = '';
$sep = '';
$offset = 0;
$cantidad = 1000;
$flag = true;
while($flag){
    // agregar get a points de quadmins
    $curl = curl_init('https://flash-api.quadminds.com/api/v2/pois/search?limit=1000&offset='.($offset * $cantidad));

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'x-saas-apikey:  SzaORv8XtExcO1zVX3jcWGsOvyGwsl3y46sOLnmn')
    );

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Make it so the data coming back is put into a string

    // Send the request
    $result = curl_exec($curl);

    // Free up the resources $curl is using
    curl_close($curl);

    $points = json_decode($result, true);
    if(!empty($points['data'])){
        $temp = json_encode($points['data']);
        $dataString .= $temp;
        $offset++;
        if($offset == 5)
            $flag = false;
    }
    else
        $flag = false;
}
$handle = fopen ("pois.json", "w+");
$dataString = str_replace('][',',',$dataString);
fwrite($handle, $dataString);
fclose($handle);
?>