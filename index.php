<!DOCTYPE html>
<html lang="ru-RU" class="mdl-js">
<head>
        <meta charset="UTF-8">

</head>
<body>
<!--
 <script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
<script src="/buildShowcases.js"></script>
<script>$(function() {getShowcases(6925,2600,$('#vc_showcases_content'),0,0,0,0);});</script>
<div id="vc_showcases_content"></div>


<div class="theme_main col_670">
        <h3>Стихи для главного бухгалтера</h3>

    <div style="width:240px; height:400px; position:relative; overflow:hidden;">
        <iframe frameborder='0' marginheight='0' marginwidth='0' scrolling='No' allowTransparency='true'
                width='240' height='400' src=https://monetti.ru/view/34128?= style=
                'position:relative; z-index:10;'></iframe>
    </div> 
</body> -->

<script src="https://www.gstatic.com/firebasejs/4.8.0/firebase.js"></script>
<script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
<script src="/app.js"></script>

<script>
    // Initialize Firebase
    var apiKey = "AIzaSyBrDMKfCzofzhXLlwGiwe9OtQ2_5PsWPJc";
    var domain = "test-push-voicecards";
    var senderId = "970814197197";

    var config = {
        apiKey: apiKey,
        authDomain: domain+".firebaseapp.com",
        databaseURL: "https://"+domain+".firebaseio.com",
        projectId: domain,
        storageBucket: domain+".appspot.com",
        messagingSenderId: senderId
    };
    firebase.initializeApp(config);


</script>

<button type="button" id="subscribe">Следить за изменениями</button>

</body>