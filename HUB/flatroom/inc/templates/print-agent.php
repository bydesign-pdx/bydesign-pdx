<?php $agent = new IBR_Agent($_GET['user']); ?>

<article class="agent">

  <div class="row">

    <div class="span2">
      <div class="image">
        <?php echo get_avatar($agent->user->ID, 206); ?>
      </div>
    </div>

    <div class="span7 autor-content">

      <div class="autor-meta">

        <?php if ($phones = $agent->get_phones()) : ?>

          <div class="phone">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve">
            <path fill="#41A3E1" d="M13.498,11.499c-1,1-1,2-2,2c-1,0-2-1-3-2c-0.999-0.998-1.999-2-1.999-3C6.5,7.5,7.5,7.5,8.499,6.5	c1-1-1.999-4-2.999-4s-3,3-3,3c0,2,2.055,6.055,4,7.999c1.945,1.945,5.998,4.001,7.998,4.001c0,0,3.002-2.001,3.002-3.001 S14.498,10.501,13.498,11.499z"/>
          </svg>
            <?php echo $phones; ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($agent->user->data->user_email)) : ?>

          <?php
          $mail = (strlen($agent->user->data->user_email) <= 25)
            ? $agent->user->data->user_email
            : substr($agent->user->data->user_email, 0, 25) . '...';
          ?>

          <div class="email no-border">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve">
            <path fill="#41A3E1" d="M16,4.001H4.002c-1.104,0-2,0.896-2,2.001V14c0,1.105,0.896,1.998,2,1.998H16 c1.104,0,1.999-0.893,1.999-1.998V6.003C17.999,4.897,17.104,4.001,16,4.001z M16,13.002C16,13.553,15.552,14,15.001,14H5.002 c-0.553,0-1.001-0.447-1-1V7c0-0.553,0.447-0.998,1-0.998h9.999C15.552,6.003,16,6.448,16,7V13.002z"/>
              <polygon fill="#41A3E1" points="13.501,7.502 10.001,11 6.501,7.502 5.501,8.502 7.001,10.002 5.501,11.502 6.501,12.5 8.001,11 10.001,12.5 12.001,11 13.501,12.5 14.5,11.5 13,10 14.5,8.5 "/>
          </svg>
            <a href="mailto:<?php echo $agent->user->data->user_email; ?>"><?php echo $mail; ?></a>
          </div>
        <?php endif; ?>

        <?php if (!empty($agent->user->data->user_url)) : ?>

          <?php
          $web_site = (strlen($agent->user->data->user_url) <= 25)
            ? $agent->user->data->user_url
            : substr($agent->user->data->user_url, 0, 25) . '...';
          ?>

          <div class="web-site no-border">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve">
            <g>
              <g>
                <path fill="#41A3E1" d="M7.038,5.964L7.06,5.636L7.483,5.47h0.91l0.275-0.248L8.837,4.75l0.467-0.248L9.917,4.07l0.016-0.108
                  C9.31,3.671,8.62,3.494,7.886,3.494c-1.306,0-2.487,0.513-3.345,1.343L4.498,4.997L4.52,5.286l0.358,0.267L5.005,5.82l0.021,0.372
                  L5.005,6.623l0.318,0.021l0.34,0.124c0,0,0.275,0.083,0.359,0.164c0.084,0.083,0.55,0.372,0.614,0.474
                  C6.699,7.51,7.017,7.51,7.017,7.51c0.254-0.207,0-0.496,0-0.496L6.911,6.768L6.826,6.521l0.042-0.289L7.038,5.964z"/>
                <path fill="#41A3E1" d="M8,0.001C3.583,0.001,0.001,3.583,0.001,8c0,4.418,3.582,8,7.999,8s7.999-3.582,7.999-8
                  C15.999,3.583,12.417,0.001,8,0.001z M8,14c-3.313,0-5.999-2.686-5.999-6c0-3.314,2.686-6,5.999-6s5.999,2.686,5.999,6
                  C13.999,11.314,11.313,14,8,14z"/>
                <path fill="#41A3E1" d="M11.759,9.197l-0.275-0.329h-0.402l-0.359-0.123l-0.273-0.434l-0.445-0.35L9.812,7.571H9.347L8.69,7.447
                  L8.499,7.51L8.224,7.818L7.991,7.982L7.886,8.765c0,0,0,0.844,0,0.926c0,0.083,0.127,0.248,0.232,0.413
                  c0.105,0.164,0.17,0.351,0.254,0.452c0.086,0.103,0.191,0.103,0.338,0.165c0.148,0.062,0.297,0.205,0.359,0.31
                  c0.064,0.103,0.107,0.493,0.107,0.493l0.084,0.681v0.293c0.24-0.071,0.475-0.154,0.695-0.261l0.301-0.219l0.508-0.309l0.176-0.103
                  c0.4-0.33,0.738-0.717,1.008-1.157l0.045-0.243V9.795l-0.064-0.248L11.759,9.197z"/>
              </g>
            </g>
          </svg>
            <a href="<?php echo $agent->user->data->user_url; ?>"><?php echo $web_site; ?></a>
          </div>
        <?php endif; ?>

      </div>

      <div class="description"><?php echo $agent->get_description($_GET['user']); ?></div>

    </div>

  </div>

</article><!-- .agent -->

<?php
  $properties = new IBR_Properties(array(
    'posts_per_page' => -1,
    'meta_query'     => array(
      array(
        'key' => IBR_PROPERTY . '_agent',
        'value' => array($agent->user->ID),
        'compare' => 'IN',
      )
    )
  ));
?>

<?php if ($properties->found()) : ?>
  <?php if ($properties->get_query()->have_posts()): ?>
    <table>
      <thead>
        <tr>
          <th><?php _e('Type', 'flatroom'); ?></th>
          <th><?php _e('Name', 'flatroom'); ?></th>
          <th><?php _e('Location', 'flatroom'); ?></th>
          <th><?php _e('Price', 'flatroom'); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php while ($properties->get_query()->have_posts()) : ?>
          <tr>
            <?php $properties->get_query()->the_post(); ?>
            <?php $property = new IBR_Property($properties->get_query()->post); ?>

            <td>
              <?php echo IBR_Property::get_types($property->get_value('type')); ?>
            </td>

            <td>
              <?php echo $property->post->post_title; ?>
            </td>

            <td>
              <?php
                $location = new IBR_Location($property->get_value('location_text'));
                echo $location->get('text');
              ?>
            </td>

            <td>
              <?php echo $property->get_price(); ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php endif; ?>
<?php endif; ?>
