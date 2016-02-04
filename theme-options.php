<?php
require_once('theme-functions.inc.php');
?>
<style>
.iframe {
  width: 100%;
  max-height: 250px;
  overflow: scroll;
  background-color: white;
}
</style>
<p>General options for header, social links and footer sections could also be set in <a href="?page=newsletter_main_main">Blog Info panel</a>.</p>
<p><a href="#" id="open_preview" target="_blank" style="display:none;">Open the preview in a new window (fullscreen)</a></p>
<script type="text/javascript">
jQuery( document ).ready(function() {
  jQuery('#open_preview').attr({'href':jQuery('iframe').attr('src')}).css('display','block');
});
</script>
<p><strong>Title</strong><br />
   <?php $controls->text('theme_title',60); ?></p>
<p><strong>Introduction text</strong><br />
   <?php $controls->wp_editor('theme_introduction_text'); ?></p>
<p><strong>Newsletter tag</strong><br />
   <?php $controls->text('theme_tags', 50); ?></p>
<p><strong>Location thumbnails</strong><br />
   <?php $controls->select('theme_thumbnails_location', array('n' => 'None','l' => 'Left' , 'r' => 'Right')); ?></p>
<p><strong>Blog items</strong><br />
<div class="iframe">
<?php
foreach (get_blog_items() as $blog_item) {
  $controls->checkbox_group('theme_blog_items',$blog_item['id'],strftime('%e %B %Y',$blog_item['timestamp']) . ' - ' . $blog_item['title'] . ' (<em>' . $blog_item['author'] . '</em>)');
  echo '<br />';
}
?>
</div>
</p>
<p><strong>Agenda items</strong><br />
<div class="iframe">
<?php
foreach (get_agenda_items() as $agenda_item) {
  $controls->checkbox_group('theme_agenda_items',$agenda_item['id'],strftime('%e %B %Y, %H:%M',$agenda_item['timestamp']) . ' - ' . $agenda_item['title']);
  echo '<br />';
}
?>
</div>
</p>
