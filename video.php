<?php

    if(isset($_GET['id'])) {
        $videoId = $_GET['id'];
        
        $apikey = 'AIzaSyC_14WkUJnv_w1jrZtLV2o-xq0U4J8a6yA';
        $googleApiUrl = 'https://www.googleapis.com/youtube/v3/videos?id=' . $videoId . '&key=' . $apikey . '&part=snippet';
        
    	$ch = curl_init();
        
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
            
        curl_close($ch);
            
        $data = json_decode($response);
            
        $value = json_decode(json_encode($data), true);
            
        $title = $value['items'][0]['snippet']['title'];
        $description = $value['items'][0]['snippet']['description'];
    }
    


?>

<!DOCTYPE html>
<html >
    <head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <title><?php echo $title;?></title>
        <meta property="fb:app_id" content="MY_APP_ID" />
        
        <meta property="og:site_name" content="YouTube">
        <meta property="og:url" content="https://www.youtube.com/watch?v=<?php echo $videoId;?>">
        <meta property="og:title" content="<?php echo $title;?>"">
        <meta property="og:image" content="https://i.ytimg.com/vi/<?php echo $videoId;?>/hqdefault.jpg">
        <meta property="og:description" content="<?php echo $description;?>">

        <meta property="al:ios:app_store_id" content="544007664">
        <meta property="al:ios:app_name" content="YouTube">
        <meta property="al:ios:url" content="vnd.youtube://www.youtube.com/watch?v=<?php echo $videoId;?>&amp;feature=applinks">

        <meta property="al:android:url" content="vnd.youtube://www.youtube.com/watch?v=<?php echo $videoId;?>&amp;feature=applinks">
        <meta property="al:android:app_name" content="YouTube">
        <meta property="al:android:package" content="com.google.android.youtube">
        <meta property="al:web:url" content="https://www.youtube.com/watch?v=<?php echo $videoId;?>&amp;feature=applinks">

        <meta property="og:type" content="video">
        <meta property="og:video:url" content="https://www.youtube.com/embed/<?php echo $videoId;?>">
        <meta property="og:video:secure_url" content="https://www.youtube.com/embed/<?php echo $videoId;?>">
        <meta property="og:video:type" content="text/html">
        <meta property="og:video:width" content="1280">
        <meta property="og:video:height" content="720">
        <meta property="og:video:url" content="http://www.youtube.com/v/<?php echo $videoId;?>?version=3&amp;autohide=1">
        <meta property="og:video:secure_url" content="https://www.youtube.com/v/<?php echo $videoId;?>?version=3&amp;autohide=1">
        <meta property="og:video:type" content="application/x-shockwave-flash">
        <meta property="og:video:width" content="1280">
        <meta property="og:video:height" content="720">

    </head>
    <body>
        <div class="video-container">
            <p><iframe width="auto" height="auto" src="https://www.youtube.com/embed/<?php echo $videoId;?>?feature=oembed" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></p>
            </div>
        <script type="text/javascript">
            window.onload = function() {

                var desktopFallback = "https://youtube.com/watch?v=<?php echo $videoId;?>",
                mobileFallback = "https://youtube.com/watch?v=<?php echo $videoId;?>",
                app = "vnd.youtube://<?php echo $videoId;?>";

                if( /Android|iPhone|iPad|iPod/i.test(navigator.userAgent) ) {
                    window.location = app;
                    window.setTimeout(function() {
                        window.location = mobileFallback;
                    }, 25);
                } else {
                    window.location = desktopFallback;
                }

                function killPopup() {
                    window.removeEventListener('pagehide', killPopup);
                }

                window.addEventListener('pagehide', killPopup);

            };
        </script>
    </body>
</html>
