<?php
/**
 * @file
 * Default theme implementation for beans.
 *
 * Available variables:
 * - $content: An array of comment items. Use render($content) to print them all
 * , or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $title: The (sanitized) entity label.
 * - $url: Direct url of the current entity if specified.
 * - $page: Flag for the full page state.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity-{ENTITY_TYPE}
 *   - {ENTITY_TYPE}-{BUNDLE}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_entity()
 * @see template_process()
 */
?>
<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <div class="content"<?php print $content_attributes; ?>>
    <div id="homeLeft">
      <h1>Australian Renewable Energy Agency</h1>
      <h2>ARENA</h2>
      <p class="featureText">ARENA was established to make renewable energy solutions more affordable and increase the supply of renewable energy in Australia. </p>

      <div id="actionBtns">
        <a href="/how-to-apply-for-funding/" title="" class="one" onclick="ga('arenaTracker.send', 'event', 'button', 'Click', 'How to apply for funding' );"><span class="table"><span>How to apply for funding</span></span></a>
        <a href="http://www.arena.gov.au/projects/" title="" class="two" onclick="ga('arenaTracker.send', 'event', 'button', 'Click', 'Our projects' );"><span class="table"><span>Our projects</span></span></a>
        <a href="/resources/" title="" class="three" onclick="ga('arenaTracker.send', 'event', 'button', 'Click', 'Knowledge bank' );"><span class="table"><span>Knowledge bank</span></span></a>
      </div>

      <?php if (!empty($page['highlighted'])): ?>
        <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
      <?php endif; ?>
    </div>
  </div>
</div>
