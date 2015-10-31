<table class="form-table">
    <tr><td colspan="2">General options for header, social links and footer sections could also be set in <a href="?page=newsletter_main_main">Blog Info panel</a>.</td></tr>
   <tr>
        <th>Title</th>
        <td>
            <?php $controls->text('theme_title'); ?>
        </td>
    </tr>
   <tr>
        <th>Introduction text</th>
        <td>
            <?php $controls->wp_editor('theme_introduction_text'); ?>
        </td>
    </tr>
<!--
    <tr>
        <th>Thumbnails</th>
        <td>
            <?php $controls->checkbox('theme_thumbnails', 'Add post thumbnails'); ?>
        </td>
    </tr>
-->
  <tr>
        <th>Lokatie Thumbnails</th>
        <td>
            <?php $controls->select('theme_thumbnails_location', array('n' => 'Geen','l' => 'Links' , 'r' => 'Rechts')); ?>
        </td>
    </tr>
    <tr>
        <th>Aantal agenda items</th>
        <td>
            <?php $controls->text('theme_agenda_items'); ?>
        </td>
    </tr>
    <tr>
        <th>Tags</th>
        <td>
            <?php $controls->text('theme_tags', 30); ?>
            <p class="description" style="display: inline"> comma separated</p>
        </td>
    </tr>
</table>
