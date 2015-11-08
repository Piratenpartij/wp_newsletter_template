<?php
require_once('theme-functions.inc.php');
?>
<p>General options for header, social links and footer sections could also be set in <a href="?page=newsletter_main_main">Blog Info panel</a>.</p>
<p><strong>Title</strong><br />
   <?php $controls->text('theme_title',60); ?></p>
<p><strong>Introduction text</strong><br />
   <?php $controls->wp_editor('theme_introduction_text'); ?></p>
<p><strong>Newsletter tag</strong><br />
   <?php $controls->text('theme_tags', 50); ?></p>
<p><strong>Location thumbnails</strong><br />
   <?php $controls->select('theme_thumbnails_location', array('n' => 'None','l' => 'Left' , 'r' => 'Right')); ?></p>
<p><strong>Agenda items</strong><br />
<?php
foreach (get_agenda_items() as $agenda_item) {
  $controls->checkbox_group('theme_agenda_items',$agenda_item['id'],$agenda_item['date'] . ' - ' . $agenda_item['title']);
  echo '<br />';
}
?></p>
