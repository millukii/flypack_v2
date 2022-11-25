<?php
include_once 'conexion.php';
ini_set('date.timezone', 'America/Santiago');

function replaceAllTildes($value){
    $value = str_replace('Á','A', $value);
    $value = str_replace('É','E', $value);
    $value = str_replace('Í','I', $value);
    $value = str_replace('Ó','O', $value);
    $value = str_replace('Ú','U', $value);

    $value = str_replace('á','a', $value);
    $value = str_replace('é','e', $value);
    $value = str_replace('í','i', $value);
    $value = str_replace('ó','o', $value);
    $value = str_replace('ú','u', $value);

    $value = str_replace('Ñ','N', $value);
    $value = str_replace('ñ','n', $value);

    return $value;
}

function getRandomCode(){
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($permitted_chars), 0, 16);
}

function getMerchantId($order_nro){
    global $conexion;
    $prefix = explode("-", $order_nro);
    $prefix = $prefix[0];
    $SQL = "SELECT merchant_id FROM companies WHERE prefix = '".$prefix."' LIMIT 1";
    $result = $conexion->query($SQL);
    $merchant_id = 0;
    while($rs=$result->fetch()){
        $merchant_id = $rs['merchant_id'];
    }

    return $merchant_id;
}

function createPoiQuadmin($data, $order_nro){
    global $conexion;
    $dataPoi = [];
    array_push($dataPoi, $data);

    $data_string = json_encode($dataPoi);
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://flash-api.quadminds.com/api/v2/pois',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => 'UTF-8',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data_string,
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Content-Type: application/json',
            'x-saas-apikey: SzaORv8XtExcO1zVX3jcWGsOvyGwsl3y46sOLnmn',
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    if ($err) {
        $SQL = "update shipping_request set status = 3, quadmin_response = '".$err."', quadmin_response_code = 500 where order_nro = '".$order_nro."'";
        $result = $conexion->query($SQL);
        return 0;
    }

    curl_close($curl);
    $points = json_decode($response, true);
    //print_r($points);
    $data = $points['data'][0];
    return $data['_id'];
}

function createOrderQuadmin($data, $order_nro){
    global $conexion;
    $measures = array();
    $volume = new stdClass;
    $volume->constraintId = 7;
    $volume->value = (int) $data['total_amount'];

    array_push($measures, $volume);

    $merchants = array();
    $merchant = new stdClass;
    $merchant->_id = (int) getMerchantId($order_nro);
    array_push($merchants, $merchant);

    $quadminOrder = array(
        'code' => $order_nro,
        'poiId' => (int) $data['poiId'],
        'quadmins_code' => $data['quadmins_code'],
        'date' => $data['shipping_date'],
        'operation' => $data['operation'],
        'priority' => 0,
        'totalAmount' => (int) $data['total_amount'],
        'totalAmountWithoutTaxes' => (int) $data['total_amount'],
        'orderMeasures' => $measures,
        'merchants' => $merchants,
    );
    $orders = [];

    array_push($orders, $quadminOrder);
    try {
        $data_string = json_encode($orders);
        $curl = curl_init('https://flash-api.quadminds.com/api/v2/orders');

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
            'x-saas-apikey: ' . 'SzaORv8XtExcO1zVX3jcWGsOvyGwsl3y46sOLnmn'));

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Make it so the data coming back is put into a string
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string); // Insert the data

        // Send the request
        $result = curl_exec($curl);
        $err = curl_error($curl);
        if ($err) {
            $SQL = "update shipping_request set status = 3, quadmin_response = '".$err."', quadmin_response_code = 500 where order_nro = '".$order_nro."'";
            $result = $conexion->query($SQL);
            return 0;
        }
        $array = json_decode($result, true);
        // Free up the resources $curl is using
        curl_close($curl);
        //update table shipping_request
        $SQL = "update shipping_request set quadmins_code = '".$array['data'][0]['_id']."', poiId = '".$data['poiId']."', status = 1, quadmin_response = 'success', quadmin_response_code = 200, modified = now() where order_nro = '".$order_nro."'";
        $result = $conexion->query($SQL);
        //update table shipping
        $SQL = "update shipping set quadmins_code = '".$array['data'][0]['_id']."', poiId = '".$data['poiId']."', modified = now() WHERE order_nro = '".$order_nro."'";
        $result = $conexion->query($SQL);
        return $array['data'][0]['_id'];
    }
    catch(Exception $e){
        $SQL = "update shipping_request set status = 3, quadmin_response = '".$e."', quadmin_response_code = 500 where order_nro = '".$order_nro."'";
        $result = $conexion->query($SQL);
        return 0;
    }
    
}

function updateDataFlypack(){
    global $conexion;
}
//--------- FLUJO PRINCIPAL ---------------------------
$SQL = "select * from shipping_request where status <> 1";
$result = $conexion->query($SQL);
while($rs=$result->fetch()){
    //recorro ordenes que no estan con su status = 1.
    //es decir ordenes que tuvieron problemas o no han sido procesadas por quadmins
    $order_nro                                  = $rs['order_nro'];
    $quadmins_code                              = $rs['quadmins_code'];
    $shipping_type                              = $rs['shipping_type'];
    $total_amount                               = $rs['total_amount'];
    $delivery_name                              = $rs['delivery_name'];
    $shipping_date                              = $rs['shipping_date'];
    $shipping_states_id                         = $rs['shipping_states_id'];
    $companies_id                               = $rs['companies_id'];
    $address                                    = $rs['address'];
    $receiver_name                              = $rs['receiver_name'];
    $receiver_phone                             = $rs['receiver_phone'];
    $receiver_mail                              = $rs['receiver_mail'];
    $observation                                = $rs['observation'];
    $users_id                                   = $rs['users_id'];
    $created                                    = $rs['created'];
    $modified                                   = $rs['modified'];
    $origin                                     = $rs['origin'];
    $destination                                = $rs['destination'];
    $packages                                   = $rs['packages'];
    $operation                                  = $rs['operation'];
    $shipping_delivery_date                     = $rs['shipping_delivery_date'];
    $nuevo_poi                                  = $rs['nuevo_poi'];
    $poiId                                      = $rs['poiId'];
    $status                                     = $rs['status'];
    $quadmin_response                           = $rs['quadmin_response'];
    $quadmin_response_code                      = $rs['quadmin_response_code'];

    $dataOrder =    [
                        'order_nro' => $order_nro,
                        'quadmins_code' => $quadmins_code,
                        'shipping_type' => $shipping_type,
                        'total_amount' => $total_amount,
                        'delivery_name' => $delivery_name,
                        'shipping_date' => $shipping_date,
                        'shipping_states_id' => $shipping_states_id,
                        'companies_id' => $companies_id,
                        'address' => $address,
                        'receiver_name' => $receiver_name,
                        'receiver_phone' => $receiver_phone,
                        'receiver_mail' => $receiver_mail,
                        'observation' => $observation,
                        'users_id' => $users_id,
                        'created' => $created,
                        'modified' => $modified,
                        'origin' => $origin,
                        'destination' => $destination,
                        'packages' => $packages,
                        'operation' => $operation,
                        'shipping_delivery_date' => $shipping_delivery_date,
                        'nuevo_poi' => $nuevo_poi,
                        'poiId' => $poiId,
                        'status' => $status,
                        'quadmin_response' => $quadmin_response,
                        'quadmin_response_code' => $quadmin_response_code
                    ];

    //valido si hay que crear el poi o no
    if(empty($poiId) && !empty($nuevo_poi)){
        //crear nuevo
        $quadminPoi = array(
            'code' => getRandomCode(),
            'poiType' => 'SIN_TIPO',
            'name' => replaceAllTildes($receiver_name),
            'email' => replaceAllTildes($receiver_mail),
            'enabled' => true,
            'phoneNumber' => $receiver_phone,
            'poiDeliveryComments' => replaceAllTildes($observation),
            'originalAddress' => replaceAllTildes($address),
            'longAddress' => replaceAllTildes($address),
            'visitingFrequency' => "weekly",
        );
        $poiId = createPoiQuadmin($quadminPoi, $order_nro);
        $dataOrder['poiId'] = $poiId;
        //crear order en quadmin
        $quadminResponseCode = createOrderQuadmin($dataOrder, $order_nro);
    }
    else{
        if(!empty($poiId)){
            //reutilizar poiId
            //crear order en quadmin
            $quadminResponseCode = createOrderQuadmin($dataOrder, $order_nro);
        }
        else{
            //crear nuevo
            $quadminPoi = array(
                'code' => getRandomCode(),
                'poiType' => 'SIN_TIPO',
                'name' => replaceAllTildes($receiver_name),
                'email' => replaceAllTildes($receiver_mail),
                'enabled' => true,
                'phoneNumber' => $receiver_phone,
                'poiDeliveryComments' => replaceAllTildes($observation),
                'originalAddress' => replaceAllTildes($address),
                'longAddress' => replaceAllTildes($address),
                'visitingFrequency' => "weekly",
            );

            $poiId = createPoiQuadmin($quadminPoi, $order_nro);
            $dataOrder['poiId'] = $poiId;
            //crear order en quadmin
            $quadminResponseCode = createOrderQuadmin($dataOrder, $order_nro);
        }
    }
}

?>