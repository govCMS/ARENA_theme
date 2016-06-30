<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup templates
 */
?>
<div id="bgContinuator"></div>
<div id="sitecontainer">
  <div id="innerContainer">
    <a href="#content" class="visuallyhidden focusable" title="" id="skipToContent">Skip to content</a>

    <div id="sideWrapper">
      <div id="sidebar">
        <div class="inner">
          <div class="firstLevel">
            <!-- Place search form here -->
            <?php if ($search_box): ?>
              <?php print $search_box; ?>
            <?php endif; ?>
            <!-- Place main nav here -->
            <?php if (!empty($page['sidebar_second'])): ?>
              <aside id="primary-nav" role="complementary">
                <?php print render($page['sidebar_second']); ?>
              </aside>  <!-- /#sidebar-second -->
            <?php endif; ?>
            <!-- Place other sub navigations here -->
            <?php if (!empty($page['footer'])): ?>
              <footer id="extraNav" class="footer">
                <?php print render($page['footer']); ?>
              </footer>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <div id="main" role="main">
      <header>
        <div id="header">
          <div class="wrapper">
            <div id="govlogo">
              <?php if ($logo): ?>
                <a class="logo navbar-btn pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
                  <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
                </a>
              <?php endif; ?>
            </div>
          </div>
          <!-- @.wrapper-->
        </div>
      </header>
      <!-- #header-->
      <div id="innerMain">
        <div id="ARENAlogo">
          <h2><?php print t('ARENA'); ?></h2>
        </div>
        <div id="contentArea">
          <div id="content">
            <?php if (!empty($page['content'])):
              unset($page['content']['system_main']['default_message']);
              print render($page['content']); ?>
            <?php endif; ?>
          </div>
          <!--#content-->
        </div>
        <!--#contentArea-->
      </div>
      <!--#innerMain-->
    </div>
    <!-- #main-->
    <!--#sideWrapper-->
  </div>
  <!-- .innerContainer -->
  <div class="clearfix"></div>
  <!--important to have the nav display properly-->
</div><!-- @#sitecontainer-->
