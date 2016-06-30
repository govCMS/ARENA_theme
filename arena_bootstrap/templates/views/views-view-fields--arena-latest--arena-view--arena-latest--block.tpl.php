<div class="category-wrapper">
  <?php
  switch (strip_tags($fields['type']->content)) {
    case "ARENA media":
      $link = '/news-media/media-releases';
      break;
    case "ARENA news":
      $link = '/news-media/news';
      break;
    default:
      $link = '/';
  }
  ?>
  <a href="<?php print $link; ?>"
     class="category"><?php print $fields['type']->content; ?>
  </a>
</div>

<div class="details">
  <time datetime><?php print $fields['field_arena_date_2']->content; ?><span class="arrow"></span></time>
  <div class="summary">
    <h2><?php print $fields['title']->content; ?></h2>
    <?php print $fields['body']->content; ?>
  </div>
</div>
