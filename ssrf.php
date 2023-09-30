<?php
    //Vulnerable Version
    //checks if the 'url' parameter is set in the GET request 
    if(isset($_GET['url'])) {
        $request = curl_init();// initializes a CURL (Client URL Library) session used for making HTTP requests
        curl_setopt($request, CURLOPT_URL, $_GET['url']);//Set the URL for the CURL session This means that the code will make an HTTP request to the URL provided in the 'url' parameter.
        curl_setopt($request, CURLOPT_HEADER, 0);//Prevent CURL from including response headers in the output
        curl_exec($request);// executes the CURL session, making the HTTP request to the URL specified in the 'url' parameter.
        curl_close($request);// close the CURL session
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    

        //Remediated Version
        // Check if the 'url' parameter is set and not empty
if(isset($_GET['url']) && !empty($_GET['url'])) {
    // Get the URL from the 'url' parameter and sanitize it
    $url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
    
    // Define an array of allowed domains or IP addresses
    $allowed_domains = array("example.com", "trusted-domain.com");

    // Parse the URL to extract the hostname
    //$url = "http://example.com/path/to/resource?param1=value1&param2=value2#section";
    /*Array (
    [scheme] => http
    [host] => example.com
    [path] => /path/to/resource
    [query] => param1=value1&param2=value2
    [fragment] => section
)*/
    $parsed_url = parse_url($url);

    // Check if the hostname is in the list of allowed domains
    if (isset($parsed_url['host']) && in_array($parsed_url['host'], $allowed_domains)) {
        // Check if the scheme is one of the allowed schemes (http, https)
        $allowed_schemes = array("http", "https");
        $scheme = isset($parsed_url['scheme']) ? $parsed_url['scheme'] : '';
        
        if (in_array($scheme, $allowed_schemes)) {
            // Initialize a CURL session
            $ch = curl_init();
            
            // Set the URL for the CURL session
            curl_setopt($ch, CURLOPT_URL, $url);
            
            // Prevent CURL from including response headers in the output
            curl_setopt($ch, CURLOPT_HEADER, 0);
            
            // Execute the CURL session
            curl_exec($ch);
            
            // Close the CURL session
            curl_close($ch);
        } /*else {
            echo "Access to the specified scheme is not allowed.";
        }
    } else {
        echo "Access to the specified domain is not allowed.";
    }*/
}
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title> SSRF</title>
    </head>

    <body>
        <div>
            <p>Enter The URL to fetch</p>

            <form method="GET" action="#">
            <span>IP: 
                <input name="url" type="text" placeholder="uri://example.com" />
                <input type="submit" />
            </span>            
            </form>
        </div>  
    </body>

</html>



