<?php
    //checks if the 'url' parameter is set in the GET request 
    if(isset($_GET['url'])) {
        $request = curl_init();// initializes a CURL (Client URL Library) session used for making HTTP requests
        curl_setopt($request, CURLOPT_URL, $_GET['url']);//Set the URL for the CURL session This means that the code will make an HTTP request to the URL provided in the 'url' parameter.
        curl_setopt($request, CURLOPT_HEADER, 0);//Prevent CURL from including response headers in the output
        curl_exec($request);// executes the CURL session, making the HTTP request to the URL specified in the 'url' parameter.
        curl_close($request);// close the CURL session
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



