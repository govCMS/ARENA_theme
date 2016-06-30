<?php $nid = strip_tags($fields['nid']->content); ?>
<div class="arena-project-marker" arena-project-nid="<?php print $fields['nid']->content; ?>" arena-project-title="<?php print $fields['title']->content; ?>" arena-project-summary="<?php print $fields['body']->content; ?>" arena-project-location-lat="<?php print $fields['field_latitude']->content; ?>" arena-project-location-lng="<?php print $fields['field_longitude']->content; ?>" arena-project-location-suburb="<?php print $fields['field_suburb']->content; ?>" arena-project-location-state="<?php print $fields['field_state']->content; ?>" arena-project-funding="<?php print $fields['field_funding']->content; ?>" arena-project-lead-organisation="<?php print strip_tags($fields['field_lead_organisation']->content); ?>">
</div>
<div class="panel-heading" role="tab" id="heading<?php print $nid; ?>">
  <h4 class="panel-title">
    <a class="collapsed clearfix" role="button" data-toggle="collapse"
       data-parent="#accordion" href="#collapse<?php print $nid; ?>"
       aria-expanded="false" aria-controls="collapse<?php print $nid; ?>">
      <span class="arena-project"><?php print $fields['title']->content; ?></span>
      <span class="arena-funding"><?php print $fields['field_funding']->content; ?></span>
    </a>
  </h4>
</div>
<div id="collapse<?php print $nid; ?>" class="panel-collapse collapse"
     role="tabpanel" aria-labelledby="heading<?php print $nid; ?>">
  <div class="panel-body">
    <?php print $fields['view_node']->content; ?>
    <?php print $fields['body']->content; ?>
    <dl>
      <?php if (!empty($fields['field_lead_organisation']->content)) : ?>
        <dt><?php print $fields['field_lead_organisation']->label_html; ?></dt>
        <dd><?php print $fields['field_lead_organisation']->content; ?></dd>
      <?php endif; ?>

      <?php if (!empty($fields['field_project_partners']->content)) : ?>
        <dt><?php print $fields['field_project_partners']->label_html; ?></dt>
        <dd><?php print $fields['field_project_partners']->content; ?></dd>
      <?php endif; ?>

      <dt><?php print t('ARENA funding'); ?></dt>
      <dd><?php print $fields['field_funding']->content; ?></dd>

      <dt><?php print $fields['field_state']->label_html; ?></dt>
      <dd><?php print $fields['field_state']->content; ?>
        , <?php print $fields['field_suburb']->content; ?></dd>

      <?php if (!empty($fields['field_technology']->content)) : ?>
        <dt><?php print $fields['field_technology']->label_html; ?></dt>
        <dd><?php print $fields['field_technology']->content; ?></dd>
      <?php endif; ?>

      <?php if (!empty($fields['field_arena_programme']->content)) : ?>
        <dt><?php print $fields['field_arena_programme']->label_html; ?></dt>
        <dd><?php print $fields['field_arena_programme']->content; ?></dd>
      <?php endif; ?>

      <?php if (!empty($fields['field_start_date']->content)) : ?>
        <dt><?php print $fields['field_start_date']->label_html; ?></dt>
        <dd><?php print $fields['field_start_date']->content; ?></dd>
      <?php endif; ?>

      <?php if (!empty($fields['field_finish_date']->content)) : ?>
        <dt><?php print $fields['field_finish_date']->label_html; ?></dt>
        <dd><?php print $fields['field_finish_date']->content; ?></dd>
      <?php endif; ?>
    </dl>
  </div>
</div>
