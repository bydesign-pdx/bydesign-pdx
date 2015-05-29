<?php
function flatroom_pager($args = array()) {
  extract($args);

  foreach (array('found_posts', 'max_num_pages') as $field) {
    if (!isset(${$field})) {
      ${$field} = $query->{$field};
    }
  }

  if (empty($href)) {
    $href = is_category()
      ? get_category_link(get_category_by_slug(get_query_var('category_name'))->term_id)
      : get_permalink();
  }

  // @TODO Remove workaround.
  if (is_search()) {
    $href = (!empty($_SERVER['REQUEST_URI']))
      ? $_SERVER['REQUEST_URI']
      : add_query_arg($wp->query_string, '', home_url($wp->request));
  }

  $link = remove_query_arg('paged', $href);

  $get = $_GET;
  if (isset($get['paged'])) {
    unset($get['paged']);
  }

  // Pagination links.
  $params = array(
    'base'         => $link . '%_%',
    'format'       => (strpos($link, '?')) ? '&paged=%#%' : '?paged=%#%',
    'total'        => $max_num_pages,
    'current'      => max( 1, get_query_var('paged') ),
    'show_all'     => False,
    'end_size'     => 1,
    'mid_size'     => 2,
    'prev_next'    => True,
    'prev_text'    => '〈',
    'next_text'    => '〉',
    'type'         => 'array',
    'add_args'     => ($href) ? $get : false,
    'add_fragment' => '',
  );

  $links = paginate_links($params);

?>

<?php if (!empty($links) && is_array($links)) : ?>

  <div class="pagination">
    <ul>
  
  
      <?php if (strpos(reset($links), 'prev') === false) : ?>
	<li class="disabled">
	  <span><?php echo $params['prev_text'] ?></span>
	</li>
      <?php endif; ?>
  
      <?php foreach ($links as $link) : ?>
  
	<?php if (strpos($link, 'current') == true) : ?>
	  <li class="active">
	    <?php echo $link; ?>
	  </li>
  
	<?php else : ?>
	  <li>
	    <?php echo $link; ?>
	  </li>
	<?php endif; ?>
  
      <?php endforeach; ?>
  
      <?php if (strpos(end($links), 'next') === false) : ?>
	<li class="disabled">
	  <span><?php echo $params['next_text']; ?></span>
	</li>
      <?php endif; ?>
  
    </ul>
  </div>

<?php endif; ?>
<?php } ?>