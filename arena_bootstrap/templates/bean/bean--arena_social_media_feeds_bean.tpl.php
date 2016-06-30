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
    <script src="//assets.juicer.io/embed.js" type="text/javascript"></script>
    <link href="//assets.juicer.io/embed.css" media="all" rel="stylesheet" type="text/css" />
    <ul class="juicer-feed" data-feed-id="arena" data-per="7" data-columns="1"></ul>
    <p class="more">
        <a href="https://twitter.com/search?f=tweets&amp;vertical=default&amp;q=%40arena_aus&amp;src=typd" title="Twitter">Join the conversation &gt;&gt;</a>
    </p>
  </div>
</div>
