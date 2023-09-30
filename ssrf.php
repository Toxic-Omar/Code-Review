<?php
    if(isset($_GET['url'])) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $_GET['url']);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
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



