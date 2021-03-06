<?php
require_once('theme-functions.inc.php');

ob_start();

if (!empty($theme_options['theme_header_logo']['url'])) {
	echo $theme_options['main_header_title'] . "\n";
	if (!empty($theme_options['main_header_sub'])) {
		echo $theme_options['main_header_sub'] . "\n";
	}
} else {
	echo get_option('blogname') . "\n";
	if (!empty($theme_options['main_header_sub'])) {
		echo $theme_options['main_header_sub'] . "\n";
	}
}

echo "\n" . $theme_options['theme_title'] . "\n\n";

echo convert_html_text($theme_options['theme_introduction_text']);

echo "\n\n" . '*In deze nieuwsbrief:*' . "\n\n";
if (!empty($posts)) {
	foreach ($posts as $post) {
		echo ' * ' . trim($post->post_title) . "\n";
	}
}

if (count($theme_options['theme_blog_items']) > 0) echo " * Recente blogposts\n";
if (count($theme_options['theme_agenda_items']) > 0) echo " * Kalender\n";
echo " * Nieuwsbrief info\n";

if (!empty($posts)) {
	foreach ($posts as $post) {
		echo "\n*" . trim($post->post_title) . "*\n";
		echo convert_html_text($post->post_content) . "\n";
	}
}

$nieuwsbrief_text = ob_get_contents();
ob_end_clean();

$nieuwsbrief_text = str_replace('&nbsp;',' ',$nieuwsbrief_text);
$nieuwsbrief_text = preg_replace('/[[:blank:]]+/', ' ', $nieuwsbrief_text);
$nieuwsbrief_text = preg_replace("/^ ([^*])/m","$1", $nieuwsbrief_text);

echo $nieuwsbrief_text;

if (count($theme_options['theme_blog_items']) > 0) {
  echo "\n*Recente blogposts*\n";
  foreach (get_blog_items() as $blog_item) {
    if (!in_array($blog_item['id'],$theme_options['theme_blog_items'])) continue;
    echo $blog_item['title'] . "\n" . 'Geschreven door: ' . $blog_item['author'] . ' op ' . strtolower(date('j F Y',$blog_item['timestamp'])) . "\n" . $blog_item['link'] . "\n\n";
  }
}

if (count($theme_options['theme_agenda_items']) > 0) {
  echo "\n*Kalender*\n";
  foreach (get_agenda_items() as $agenda_item) {
    if (!in_array($agenda_item['id'],$theme_options['theme_agenda_items'])) continue;
    echo strtolower(date('j F Y, H:i',$agenda_item['timestamp'])) . " - " . $agenda_item['title'] . "\n" . $agenda_item['link'] . "\n\n";
  }
}
?>
*Nieuwsbrief info*
Heb je zaken voor in de nieuwsbrief, agenda-items, heb je vragen, wil je helpen of een oproep doen? Mail naar nieuwsbrief@piratenpartij.nl
Deze nieuwsbrief wordt opgemaakt in html ({email_url}). Voor een archief met verzonden nieuwsbrieven of als deze nieuwsbrief niet correct wordt weergegeven per e-mail kun je terecht op de website: https://piratenpartij.nl/nieuwsbrief

Deze e-mail is verstuurd naar {email} omdat je lid bent van de Piratenpartij en/of aangemeld bent om de nieuwsbrief van de Piratenpartij te ontvangen. Klik hier ({profile_url}) om je aanmelding te wijzigen of om je af te melden.
