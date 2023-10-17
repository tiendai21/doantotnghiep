<?php
$twitter_url = get_sub_field( 'twitter_url' );
$facebook_url = get_sub_field( 'facebook_url' );
?>
<div class="sns-timeline">
    <?php if($twitter_url): ?>
    <div class="tl twitter">
        <a class="twitter-timeline"
           data-lang="ja"
           data-width="100%"
           data-height="520"
           href="<?php echo $twitter_url; ?>"><?php the_title(); ?></a>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div>
    <?php endif; ?>
    <?php if($facebook_url): ?>
    <div class="tl facebook">
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5&appId=1104166902948138";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

        <div class="fb-page"
             data-href="<?php echo $facebook_url; ?>"
             data-tabs="timeline" data-width="480" data-height="520"
             data-small-header="false" data-adapt-container-width="true"
             data-hide-cover="false" data-show-facepile="true">
            <blockquote cite="<?php echo $facebook_url; ?>" class="fb-xfbml-parse-ignore">
                <a href="<?php echo $facebook_url; ?>"><?php the_title(); ?></a>
            </blockquote>
        </div>
    </div>
    <?php endif; ?>
</div>
