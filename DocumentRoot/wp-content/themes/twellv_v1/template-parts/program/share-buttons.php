<?php
$url = ( empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$url = esc_url( $url );
?>
<div class="share-list">
    <ul>
        <li class="twitter"><a href="https://twitter.com/share?url=<?php echo $url; ?>" target="_blank"><span>Twitterでシェア</span></a></li>
        <li class="facebook"><a href="https://www.facebook.com/share.php?u=<?php echo $url; ?>" target="_blank"><span>Facebookでシェア</span></a></li>
        <li class="line"><a href="http://line.me/R/msg/text/?<?php echo $url; ?>" target="_blank"><span>LINEで送る</span></a></li>
    </ul>
</div>
