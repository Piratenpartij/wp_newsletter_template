<?php
/*
* Name: Piratenpartij.nl
* Type: standard
* Some variables are already defined:
*
* - $theme_options An array with all theme options
* - $theme_url Is the absolute URL to the theme folder used to reference images
* - $theme_subject Will be the email subject if set by this theme
*
*/

global $newsletter, $post;

$filters = array();
$filters['showposts'] = 99;
if (!empty($theme_options['theme_tags'])) {
    $filters['tag'] = $theme_options['theme_tags'];
}
$filters['post_type'] = 'newsletter_item';
$filters['order'] = 'ASC';
$posts = get_posts($filters);

require_once('theme-functions.inc.php');

?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $theme_options['theme_title']; ?></title>
        <!-- Not all email client take care of styles inserted here -->
        <style type="text/css" media="all">
            body {
                background-color: #ddd;
                font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
                font-size: 14px;
                color: #000;
                margin: 0 auto;
                padding: 0;
            }

            table.nieuwsbrief {
                width: 700px;
		background-color: #fff;
            }

            table.nieuwsbrief td {
                padding: 0px 10px;
                color: #000;
            }

            table.nieuwsbrief a, a {
                color: #572b85;
                text-decoration: none;
            }

            table.nieuwsbrief a:hover, a:hover {
                text-decoration: underline;
            }

            table.nieuwsbrief h1, h1 {
                color: #572b85;
            }
            table.nieuwsbrief h2, h2 {
                color: #7c5ba8;
            }

            table.nieuwsbrief img.icon, img.icon {
              padding-top: 20px;
            }
        </style>
    </head>
    <body>
        <table align="center" width="700px" border="0" class="nieuwsbrief">
            <tr>
                <td align="center" style="padding-top: 20px;">
                <?php if (!empty($theme_options['theme_header_logo']['url'])) { ?>
                    <img title="<?php echo $theme_options['main_header_title'] ?>" alt="<?php echo $theme_options['main_header_title'] ?>" src="<?php echo $theme_options['theme_header_logo']['url'] ?>" />
                <?php } elseif (!empty($theme_options['main_header_logo']['url'])) { ?>
                    <img title="<?php echo $theme_options['main_header_title'] ?>" alt="<?php echo $theme_options['main_header_title'] ?>" src="<?php echo $theme_options['main_header_logo']['url'] ?>" />
                <?php } elseif (!empty($theme_options['main_header_title'])) { ?>
                    <?php echo $theme_options['main_header_title'] ?>
                    <?php if (!empty($theme_options['main_header_sub'])) { ?>
                        <?php echo $theme_options['main_header_sub'] ?>
                    <?php } ?>
                <?php } else { ?>
                    <?php echo get_option('blogname'); ?>
                    <?php if (!empty($theme_options['main_header_sub'])) { ?>
                        <?php echo $theme_options['main_header_sub'] ?>
                    <?php } ?>
                <?php } ?>
                </td>
            </tr>

            <tr>
                <td>
                    <h1><?php echo $theme_options['theme_title']; ?></h1>
                    <p><?php echo $theme_options['theme_introduction_text']; ?></p>
                    <strong>In deze nieuwsbrief:</strong><br />
                    <ul>
                        <?php if (!empty($posts)) {
                            foreach ($posts as $post) {
                                echo '<li><a href="#' . $post->post_name . '" title="' . $post->post_title . '">' . $post->post_title . '</a></li>';
                            }
                        }?>
                        <li><a href="#kalender" title="Kalender">Kalender</a></li>
                        <li><a href="#nbinfo" title="Nieuwsbrief info">Nieuwsbrief info</a></li>
                    </ul>
                </td>
            </tr>
	   <tr>
             <td style="padding: 0px">
               <table>
            <?php if (!empty($posts)) {
                foreach ($posts as $post) { ?>
                    <tr>
			<?php if ($theme_options['theme_thumbnails_location'] == 'l') { ?>
                          <td valign="top">
                            <?php if ( ($thumbnail = get_newsletter_item_icon($post->ID)) != '') { ?>
				<img width="125" src="<?php echo $thumbnail; ?>" class="icon" alt="icon">
                            <?php } ?>
                          </td>
                        <?php } ?>
                        <td valign="top">
				<a name="<?php echo $post->post_name ?>"></a><h1><?php echo $post->post_title; ?></h1>
                                <p><?php echo $post->post_content; ?></p>
                        </td>
                        <?php if ($theme_options['theme_thumbnails_location'] == 'r') { ?>
                          <td valign="top">
                            <?php if ( ($thumbnail = get_newsletter_item_icon($post->ID)) != '') { ?>
                                <img width="125" src="<?php echo $thumbnail; ?>" class="icon" alt="icon">
                            <?php } ?>
                          </td>
                        <?php } ?>
                    </tr>

                <?php } ?>
            <?php } ?>
            <tr>
		<?php if ($theme_options['theme_thumbnails_location'] == 'l') { ?>
                <td valign="top"><img src="https://piratenpartij.nl/wp-content/uploads/2014/04/Google_Calendar23.png" class="icon" width="125"></td>
		<?php } ?>
                <td valign="top"><a name="kalender"></a>
                    <h1>Kalender</h1>
                    <?php
			foreach (get_agenda_items($theme_options['theme_agenda_items']) as $agenda_item) {
			    echo '<a href="' . $agenda_item['link'] . '" target="_blank" title="' . str_replace('â','-',$agenda_item['title']) . '">' . str_replace('â','-',$agenda_item['date']) . '<br />' . str_replace('â','-',$agenda_item['title']) . '</a><br /><br />';
			}?>
                </td>
                <?php if ($theme_options['theme_thumbnails_location'] == 'r') { ?>
                <td valign="top"><img src="https://piratenpartij.nl/wp-content/uploads/2014/04/Google_Calendar23.png" class="icon" width="125"></td>
                <?php } ?>
            </tr>
           </table>
         </td>
         </tr>
            <tr>
                <td valign="top">
                    <a name="nbinfo"></a><h1>Nieuwsbrief info</h1>
                    <p>Heb je zaken voor in de nieuwsbrief, agenda-items, heb je vragen, wil je helpen of een oproep doen? Mail naar <a href="mailto:nieuwsbrief@piratenpartij.nl">nieuwsbrief@piratenpartij.nl</a></p>
                    <p>Deze nieuwsbrief wordt opgemaakt in html. Voor een archief met verzonden nieuwsbrieven of als deze nieuwsbrief niet correct wordt weergegeven per e-mail kun je terecht op de website: <a href="https://piratenpartij.nl/nieuwsbrief" title="Piratenpartij Nederland nieuwsbrief archief">Piratenpartij Nieuwsbrief</a></p>
                </td>
            </tr>
        </table>
        <?php include 'footer.php'; ?>
    </body>
</html>
