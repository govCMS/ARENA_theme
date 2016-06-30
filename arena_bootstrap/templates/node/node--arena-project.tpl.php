<?php
/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup templates
 */
?>
<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php if ((!$page && !empty($title)) || !empty($title_prefix) || !empty($title_suffix) || $display_submitted): ?>
  <header>
    <?php print render($title_prefix); ?>
    <?php if (!$page && !empty($title)): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php if ($display_submitted): ?>
    <span class="submitted">
      <?php print $user_picture; ?>
      <?php print $submitted; ?>
    </span>
    <?php endif; ?>
  </header>
  <?php endif; ?>
  <?php
    // Hide comments, tags, and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_tags']);
  if (!empty($content['field_image'])):
    print render($content['field_image']);
  endif;

?>
  <div id="overview" class="details">
    <aside>
      <div class="contents">
        <dl>
          <?php if (!empty($content['field_funding'])): ?>
            <dt><?php print t('ARENA funding provided / committed:'); ?></dt>
            <dd><?php print render($content['field_funding']); ?></dd>
          <?php endif; ?>
          <?php if (!empty($content['field_project_value'])): ?>
            <dt><?php print t('Total project value:'); ?></dt>
            <dd><?php print render($content['field_project_value']); ?></dd>
          <?php endif; ?>
        </dl>
      </div>
    </aside>
    <div class="summary">
      <?php print render ($content['body']['#items'][0]['safe_summary']); ?>
    </div>
  </div>
  <dl>
    <?php if (!empty($content['field_lead_organisation'])): ?>
      <dt><?php print render($content['field_lead_organisation']['#title']); ?></dt>
      <dd><?php print render($content['field_lead_organisation']); ?></dd>
    <?php endif; ?>

    <?php if (!empty($content['field_project_partners'])): ?>
      <dt><?php print render($content['field_project_partners']['#title']); ?></dt>
      <dd><?php print render($content['field_project_partners']); ?></dd>
    <?php endif; ?>

    <dt><?php print t('Location'); ?></dt>
    <dd><?php print render($content['field_suburb']['#items'][0]['safe_value']) . ', ' . render($content['field_state']['#items'][0]['safe_value']); ?></dd>

    <?php if (!empty($content['field_arena_programme'])): ?>
      <dt><?php print render($content['field_arena_programme']['#title']); ?></dt>
      <dd><?php print render($content['field_arena_programme']); ?></dd>
    <?php endif; ?>

    <?php if (!empty($content['field_technology'])): ?>
      <dt><?php print render($content['field_technology']['#title']); ?></dt>
      <dd><?php print render($content['field_technology']); ?></dd>
    <?php endif; ?>

    <?php if (!empty($content['field_sub_technology'])): ?>
      <dt><?php print render($content['field_sub_technology']['#title']); ?></dt>
      <dd><?php print render($content['field_sub_technology']); ?></dd>
    <?php endif; ?>

    <?php if (!empty($content['field_start_date'])): ?>
      <dt><?php print render($content['field_start_date']['#title']); ?></dt>
      <dd><?php print render($content['field_start_date']); ?></dd>
    <?php endif; ?>

    <?php if (!empty($content['field_finish_date'])): ?>
      <dt><?php print render($content['field_finish_date']['#title']); ?></dt>
      <dd><?php print render($content['field_finish_date']); ?></dd>
    <?php endif; ?>
  </dl>

  <?php print render($content['body']); ?>

  <h2><?php print t('Contact information'); ?></h2>
  <dl>
    <?php if (!empty($content['field_organiser'])): ?>
      <dd><?php print render($content['field_organiser']); ?></dd>
    <?php endif; ?>

    <?php if (!empty($content['field_organiser'])): ?>
      <dt><?php print render($content['field_organiser']['#title']); ?></dt>
      <dd><?php print render($content['field_organiser']); ?></dd>
    <?php endif; ?>

    <?php if (!empty($content['field_email'])): ?>
      <dt><?php print render($content['field_email']['#title']); ?></dt>
      <dd><?php print render($content['field_email']); ?></dd>
    <?php endif; ?>
  </dl>

  <?php if (!empty($content['field_tags']) || !empty($content['links'])): ?>
  <footer>
    <?php print render($content['field_tags']); ?>
    <?php print render($content['links']); ?>
  </footer>
  <?php endif; ?>
  <?php print render($content['comments']); ?>
</article>
