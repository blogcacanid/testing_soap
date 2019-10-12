<?php
    // Pull in the NuSOAP code
    require_once('lib/nusoap.php');
    // Create the client instance
    $wsdl="http://localhost/ci3-soap-server/index.php/Soap_WS/wsdl";
    $client =new nusoap_client($wsdl,true);
    // Check for an error
    $err = $client->getError();
    if ($err) {
        echo '<h2>Constructor error</h2><pre>' . $err . '</pre>'; // Display the error
    }
    // Call the SOAP method
    $result = $client->call('hello', array('name' => 'Rony'));
    if ($client->fault) { // Check for a fault
        echo '<h2>Fault</h2><pre>';
        print_r($result);
        echo '</pre>';
    }else{
        $err = $client->getError(); // Check for errors
        if ($err) {
            echo '<h2>Error</h2><pre>' . $err . '</pre>'; // Display the error
        } else {
            echo '<h2>Result</h2><pre>'; // Display the result
            print_r($result);
            echo '</pre>';
        }
    }
    echo '<h2>Request</h2>'; // Display the request and response
    echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
    echo '<h2>Response</h2>';
    echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
    echo '<h2>Debug</h2>'; // Display the debug messages
    echo '<pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
?>