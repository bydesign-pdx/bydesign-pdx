<?php
global $post;

$property = new IBR_Property();
$rating_controller = new IBR_Rating();
?>

<div class="overview">

  <h2 class="title"><?php _e('Overview', 'flatroom'); ?></h2>

  <div class="options row">

    <div class="span3">

      <div>
        <strong><?php _e('ID:', 'flatroom'); ?></strong>
        #<?php echo get_the_ID(); ?>
      </div>

      <div>
        <strong><?php _e('Price:', 'flatroom'); ?></strong>
        <?php echo $property->get_price(); ?>
      </div>

      <div>
        <?php $rating_controller->renderSummary('property'); ?>
      </div>

    </div>

    <div class="span3">

      <div>
        <strong><?php _e('Contract type:', 'flatroom'); ?></strong>
        <?php echo IBR_Property::get_labels($property->get_value('label')); ?>
      </div>

      <div>
        <strong><?php _e('Type:', 'flatroom'); ?></strong>
        <?php echo IBR_Property::get_types($property->get_value('type')); ?>
      </div>

      <div>
        <strong><?php _e('Location:', 'flatroom'); ?></strong>

        <?php
        $location = new IBR_Location($property->get_value('location_text'));
        echo $location->get('text');
        ?>
      </div>

    </div>

    <div class="span3">

      <div>
        <strong><?php _e('Bathrooms:', 'flatroom'); ?></strong>
        <?php echo $property->get_value('baths'); ?>
      </div>

      <div>
        <strong><?php _e('Bedrooms:', 'flatroom'); ?></strong>
        <?php echo $property->get_value('beds'); ?>
      </div>

      <div>
        <strong><?php _e('Area:', 'flatroom'); ?></strong>
        <?php echo $property->get_area(); ?>
      </div>

    </div>

  </div><!-- .options -->

  <?php
    if ($thumbnail = get_post_thumbnail_id($post_id)) {
      $image = wp_get_attachment_image_src($thumbnail, 'property_image');
      $image = $image[0];
    }
  ?>

  <?php if (!empty($image)): ?>
    <div class="galery">

      <div class="images-box">
        <div class="images">
          <img src="<?php echo $image; ?>" alt="" />
        </div>
      </div><!-- .images-box -->

    </div><!-- .galery -->
  <?php endif; ?>

  <?php echo $post->post_content; ?>
  <div class="clearfix"></div>

</div><!-- .overview -->

<?php if ($attributes = $property->get_value('attributes')) : ?>
  <div class="amenities">

    <h2 class="title"><?php _e('General Amenities', 'flatroom'); ?></h2>

    <?php $array = json_decode($attributes); ?>

    <?php if (!empty($array)) : ?>

      <?php
      $array = array_filter($array, function ($element) {
        return isset($element->name);
      });
      ?>

      <?php foreach (array_chunk($array, 4) as $_array) : ?>

        <div class="row-fluid">

          <?php foreach ($_array as $v) : ?>

            <div class="span3">
              <div class="attribute <?php echo $v->type; ?>"><?php echo $v->name; ?></div>
            </div>

          <?php endforeach; ?>

        </div>

      <?php endforeach; ?>

    <?php endif; ?>

  </div><!-- .amenities -->
<?php endif; ?>

<?php if ($agent_id = $property->get_value('agent')) : ?>
  <?php $agent = new IBR_Agent($agent_id); ?>
  <?php if (user_has_cap(IBR_AGENT, $agent->user, false)) : ?>

    <div class="agent-info">
      <h2 class="title"><?php _e('Agent info', 'flatroom'); ?></h2>
      <?php $agent->view('list-item', array('width' => 'sidebar')); ?>
    </div>

  <?php endif; ?>
<?php endif; ?>

<img class="star-active" src="<?php echo get_template_directory_uri(); ?>/images/star.png">

