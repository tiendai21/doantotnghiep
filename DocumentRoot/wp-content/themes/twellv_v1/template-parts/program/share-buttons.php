<?php
$url = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$url = esc_url($url);
$isSimple = $args['isSimple'];
if (!$isSimple) :
    ?>
    <div class="social_banner">
        <h4>みんなに教える</h4>
        <ul>
            <li>
                <a href="https://twitter.com/share?url=<?php echo $url; ?>" target="_blank">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icon_text_x.png' ?>"
                         width="60"
                         height="60"
                         alt="social banner">
                </a>
            </li>
            <li>
                <a href="https://www.facebook.com/share.php?u=<?php echo $url; ?>" target="_blank">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icon_fb.png' ?>" width="60"
                         height="60" alt="social banner">
                </a>
            </li>
            <li>
                <a href="http://line.me/R/msg/text/?<?php echo $url; ?>" target="_blank">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icon_line.png' ?>" width="60"
                         height="60"
                         alt="social banner">
                </a>
            </li>
        </ul>
    </div>
<?php else: ?>
    <ul class="social_link">
        <li>
            <a href="https://twitter.com/share?url=<?php echo $url; ?>" target="_blank"></a>
        </li>
        <li>
            <a href="https://www.facebook.com/share.php?u=<?php echo $url; ?>" target="_blank"></a>
        </li>
        <li>
            <a href="http://line.me/R/msg/text/?<?php echo $url; ?>" target="_blank"></a>
        </li>
    </ul>
<?php endif; ?>