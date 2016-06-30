<?php
/**
 * @file
 * The primary PHP file for this theme.
 */

// Add scripts.min.js at end of body tag.
$theme_path = drupal_get_path('theme', 'arena_bootstrap');
drupal_add_js(
  $theme_path . '/build/js-contrib/bootstrap.min.js',
  [
    'type' => 'file',
    'scope' => 'footer',
  ]
);
drupal_add_js(
  $theme_path . '/build/js-custom/arena-scripts.min.js',
  [
    'type' => 'file',
    'scope' => 'footer',
  ]
);
drupal_add_js(
  $theme_path . '/build/js-contrib/jquery.equalheights.js',
  [
    'type' => 'file',
    'scope' => 'footer',
  ]
);

/**
 * Implements hook_js_alter().
 */
function arena_bootstrap_js_alter(&$javascript) {
  // Use updated jQuery library on all but some paths.
  $node_admin_paths = [
    'node/*/edit',
    'node/add',
    'node/add/*',
  ];
  $replace_jquery = TRUE;
  if (path_is_admin(current_path())) {
    $replace_jquery = FALSE;
  }
  else {
    foreach ($node_admin_paths as $node_admin_path) {
      if (drupal_match_path(current_path(), $node_admin_path)) {
        $replace_jquery = FALSE;
      }
    }
  }
  // Swap out jQuery to use an updated version of the library.
  if ($replace_jquery) {
    $javascript['misc/jquery.js']['data'] = drupal_get_path('theme', 'arena_bootstrap') . '/js/jquery.min.js';
  }
}

/**
 * Implements theme_preprocess_html().
 */
function arena_bootstrap_preprocess_html(&$variables) {
  // Add legacy HTML class attribute.
  $variables['html_attributes_array']['class'][] = drupal_html_class('mediaqueries');

  // Add custom html class based on path alias.
  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $item = drupal_get_path_alias();
    switch ($item) {
      case 'resources':
        $variables['classes_array'][] = drupal_html_class('bg3');
        break;

      case 'about-arena':
      case 'how-to-apply-for-funding':
        $variables['classes_array'][] = drupal_html_class('bg1');
        break;
    }
  }
}

/**
 * Implements theme_preprocess_page().
 */
function arena_bootstrap_preprocess_page(&$variables) {
  $search_form = drupal_get_form('search_block_form');
  $search_form_box = drupal_render($search_form);
  $variables['search_box'] = $search_form_box;

  // Unset page header for some view pages.
  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $item = drupal_get_path_alias();
    switch ($item) {
      case 'news-media':
        $variables['title_prefix'] = ['#markup' => '<div class="element-invisible">'];
        $variables['title_suffix'] = ['#markup' => '</div>'];
        break;
    }
  }
}

/**
 * Implements theme_menu_tree__menu_block().
 *
 * Overrides bootstrap_bootstrap_search_form_wrapper()
 */
function arena_bootstrap_menu_tree__menu_block(&$variables) {
  // Add level 2 menu ID.
  if (stripos($variables['tree'], 'home')) {
    return '<ul id="primary-nav">' . $variables['tree'] . '</ul>';
  }
  else {
    return '<ul id="secondary-nav">' . $variables['tree'] . '</ul>';
  }
}

/**
 * Overrides bootstrap_bootstrap_search_form_wrapper()
 *
 * Returns HTML for the Bootstrap search form wrapper.
 */
function arena_bootstrap_bootstrap_search_form_wrapper($variables) {
  $output  = '<label for="' . $variables['element']['#id'] . '" class="visuallyhidden">' . t('Search') . '</label>';
  $output .= $variables['element']['#children'];
  $output .= '<input type="submit" value="Search" id="searchsubmit">';
  return $output;
}

/**
 * Overrides hook_preprocess_field().
 */
function arena_bootstrap_preprocess_field(&$variables) {
  // Alter taxonomy term link to use the term's entity reference link.
  $fields = [
    'field_technology',
    'field_arena_programme',
  ];
  if (in_array($variables['element']['#field_name'], $fields)) {
    $term = $variables['element']['#items'][0]['entity'];
    $target_page_nid = $term->field_page[LANGUAGE_NONE][0]['target_id'];
    $url = drupal_get_path_alias('node/' . $target_page_nid);
    $variables['items'][0]['#markup'] = '<a href="/' . $url . '">' . $term->name . '</a>';
  }
}

/**
 * Overrides theme_menu_link().
 *
 * Bootstrap hard coded the depth of the menu levels, this is to override that.
 */
function arena_bootstrap_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    // Prevent dropdown functions from being added to management menu so it
    // does not affect the navbar module.
    if (($element['#original_link']['menu_name'] == 'management') && (module_exists('navbar'))) {
      $sub_menu = drupal_render($element['#below']);
    }
    elseif ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] == 2)) {
      // Add our own wrapper.
      unset($element['#below']['#theme_wrappers']);
      $sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
      // Generate as standard dropdown.
      $element['#title'] .= ' <span class="caret"></span>';
      $element['#attributes']['class'][] = 'dropdown';
      $element['#localized_options']['html'] = TRUE;

      // Set dropdown trigger element to # to prevent inadvertant page loading
      // when a submenu link is clicked.
      $element['#localized_options']['attributes']['data-target'] = '#';
      $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
      $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
    }
  }
  // On primary navigation menu, class 'active' is not set on active menu item.
  // @see https://drupal.org/node/1896674
  if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
    $element['#attributes']['class'][] = 'active';
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Overrides theme_preprocess_node().
 *
 * Add project term reference as a html class to the project node.
 */
function arena_bootstrap_preprocess_node(&$vars) {
  if ($vars['type'] == 'arena_project') {
    $field = field_get_items('node', $vars['node'], 'field_technology');
    $term = taxonomy_term_load($field[0]['target_id']);
    $name = $term->name;
    if ($field) {
      $vars['classes_array'][] = drupal_html_class($name);
    }
  }
}

/**
 * Implements theme_preprocess_views_view().
 */
function arena_bootstrap_preprocess_views_view(&$vars) {
  $view = $vars['view'];

  if ($view->name === 'arena_projects') {
//    dpm($vars);
    $api_key = variable_get('arena_google_api_key');
    $theme_path = drupal_get_path('theme', 'arena_bootstrap');
    drupal_add_js('https://maps.googleapis.com/maps/api/js?key=' . $api_key, ['type' => 'file', 'scope' => 'footer']);
    drupal_add_js($theme_path . '/build/js-contrib/arena-projects.js', ['type' => 'file', 'scope' => 'footer']);
  }
}

