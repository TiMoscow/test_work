<?php
session_start();
// строка, которую будем записывать
//$file_name = "api/1.php";
$file_name = "api/".$_POST['file_name'].".php";
$text = <<< HTML
<!DOCTYPE html>
<html>
  <body>
    <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
    <div id="player"></div>

    <script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '360',
          width: '640',
          videoId: 'M7lc1UVf-VE',
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.playVideo();
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
          setTimeout(stopVideo, 6000);
          done = true;
        }
      }
      function stopVideo() {
        player.stopVideo();
      }
    </script>
  </body>
</html>
HTML;


// проверка на существование файла
if (file_exists($file_name)) {

    // показываем имя файла
    $path_parts = pathinfo($file_name);



    $_SESSION['message_no_good'] .= 'Файл '. $path_parts['basename'] .' существует. - Создать \"Файл '.$file_name.'\" с API \n не удалось';
    header("Location: ".$_SERVER["HTTP_REFERER"]);
    exit;
} else {
    // показываем имя файла
    $path_parts = pathinfo($file_name);


    //делается попытка создать его
    $fp = fopen($file_name, "w");

    // записываем в файл текст
    fwrite($fp, $text);
// закрываем
    fclose($fp);

    $_SESSION['message_good'] .= 'Файл'. $path_parts['basename'] .'НЕ существует. - Создан \"Файл '.$file_name.'\" с API \n';
    header("Location: ".$_SERVER["HTTP_REFERER"]);
    exit;
}








