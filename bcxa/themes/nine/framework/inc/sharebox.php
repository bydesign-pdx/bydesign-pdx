<?php global $data; ?>
<nav class="i-large">
<ul><?php
if($data['check_sharingboxfacebook'] == true) { ?>
<li class="s-facebook">
<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" title="<?php _e( 'Facebook', 'moutheme' ) ?>" target="_blank"><?php _e( 'Facebook', 'moutheme' ) ?></a>
</li><?php
}
if($data['check_sharingboxtwitter'] == true) { ?>	
<li class="s-twitter">
<a href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>" title="<?php _e( 'Twitter', 'moutheme' ) ?>" target="_blank"><?php _e( 'Twitter', 'moutheme' ) ?></a>
</li><?php
}
if($data['check_sharingboxlinkedin'] == true) { ?>	
<li class="s-linkedin">
<a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink();?>&amp;title=<?php the_title();?>" title="<?php _e( 'LinkedIn', 'moutheme' ) ?>" target="_blank"><?php _e( 'LinkedIn', 'moutheme' ) ?></a>
</li><?php
}
if($data['check_sharingboxreddit'] == true) { ?>	
<li class="s-reddit">
<a href="http://www.reddit.com/submit?url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(the_title('', '', false)) ?>" title="<?php _e( 'Reddit', 'moutheme' ) ?>" target="_blank"><?php _e( 'Reddit', 'moutheme' ) ?></a>
</li><?php
}
if($data['check_sharingboxdigg'] == true) { ?>	
<li class="s-digg">
<a href="http://digg.com/submit?phase=2&amp;url=<?php the_permalink() ?>&amp;bodytext=&amp;tags=&amp;title=<?php echo urlencode(the_title('', '', false)) ?>" target="_blank" title="<?php _e( 'Digg', 'moutheme' ) ?>"><?php _e( 'Digg', 'moutheme' ) ?></a>
</li><?php
}
if($data['check_sharingboxdelicious'] == true) { ?>	
<li class="s-delicious">
<a href="http://www.delicious.com/post?v=2&amp;url=<?php the_permalink() ?>&amp;notes=&amp;tags=&amp;title=<?php echo urlencode(the_title('', '', false)) ?>" title="<?php _e( 'Delicious', 'moutheme' ) ?>" target="_blank"><?php _e( 'Delicious', 'moutheme' ) ?></a>
</li><?php
}
if($data['check_sharingboxgoogle'] == true) { ?>	
<li class="s-google">
<a href="http://google.com/bookmarks/mark?op=edit&amp;bkmk=<?php the_permalink() ?>&amp;title=<?php echo urlencode(the_title('', '', false)) ?>" title="<?php _e( 'Google+', 'moutheme' ) ?>" target="_blank"><?php _e( 'Google+', 'moutheme' ) ?>+</a>
</li><?php
}
if($data['check_sharingboxemail'] == true) { ?>	
<li class="s-email">
<a href="mailto:?subject=<?php the_title();?>&amp;body=<?php the_permalink() ?>" title="<?php _e( 'E-Mail', 'moutheme' ) ?>" target="_blank"><?php _e( 'E-Mail', 'moutheme' ) ?>+</a>
</li><?php
} ?>
</ul>
<h5><?php _e('Share', 'moutheme'); ?></h5>
</nav>