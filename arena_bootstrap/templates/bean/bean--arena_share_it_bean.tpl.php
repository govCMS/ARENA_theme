<?php
/**
 * @file
 * Default theme implementation for beans.
 *
 * Available variables:
 * - $content: An array of comment items. Use render($content) to print them all
 *   , or print a subset such as render($content['field_example']). Use
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
    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
      <a class="a2a_button_email">Email</a>
      <a class="a2a_button_print">Print</a>
      <a class="a2a_button_twitter">Twitter</a>
      <a class="a2a_button_linkedin">Linkedin</a>
      <a class="a2a_button_facebook">Facebook</a>
      <a class="a2a_dd" href="https://www.addtoany.com/share">More</a>
    </div>
    <script>
      var a2a_config = a2a_config || {};
      a2a_config.num_services = 4;
      a2a_config.prioritize = ["google_plus", "pinterest", "tumblr", "reddit"];
    </script>
    <script async src="https://static.addtoany.com/menu/page.js"></script>
  </div>
</div>
