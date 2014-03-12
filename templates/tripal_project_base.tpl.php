<?php
$project = $variables['node']->project;

// Drupal Date Field
// We want to remove it from the toc and into the base/overview
$date = $node->content['field_date_month_year'];
unset($node->content['field_date_month_year']);

// get the project description.  The first iteration of the project
// module incorrectly stored the project description in the Drupal
// node->body field.  Also, the project.descriptin field is only 255
// characters which is not large neough. Therefore, we store the description
// in the  chado.projectprop table.  For backwards compatibility, we
// will check if the node->body is empty and if not we'll use that instead.
// If there is data in the project.description field then we will use that, but
// if there is data in the projectprop table for a descrtion then that takes
// precedence
$description = '';
if (property_exists($node, 'body')) {
  $description = $node->body;
}
if ($project->description) {
  $description = $project->description;
}
else {
  $projectprop = tripal_project_get_property($project->project_id, 'Project Description');
  $description = $projectprop->value;
} ?>

<div class="tripal_project-data-block-desc tripal-data-block-desc"></div>

<span class="project-date"><?php print render($date); ?></span>
<h3><?php print $project->name ?></h3>
<?php if ($description) { ?>
  <div style="text-align: justify"><?php print $description; ?></div>
<?php } ?>
