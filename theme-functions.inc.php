<?php

function get_agenda_items($amount) {
    $doc = new DOMDocument();
	$doc->loadHTML(do_shortcode('[ai1ec view="agenda" events_limit="' . $amount . '"]'));
	$xpath = new DOMXpath($doc);
	$agenda_items = $xpath->query("//div[@data-end]");

	$agenda_list = array();
	foreach ($agenda_items as $agenda_item) {
		$agenda_list_item = array('title' => '', 'description' =>'', 'date' => '', 'link' => '');

		$agenda_parts = $xpath->query(".//span[@class='ai1ec-event-title']",$agenda_item);
		foreach ($agenda_parts as $agenda_part) {
			$agenda_list_item['title'] = trim($agenda_part->nodeValue);
		}

		$agenda_parts = $xpath->query(".//div[@class='ai1ec-event-description']",$agenda_item);
		foreach ($agenda_parts as $agenda_part) {
			$agenda_list_item['description'] = trim($agenda_part->nodeValue);
		}

		$agenda_parts = $xpath->query(".//div[@class='ai1ec-event-time']",$agenda_item);
		foreach ($agenda_parts as $agenda_part) {
			$agenda_list_item['date'] = trim($agenda_part->nodeValue);
		}

		$agenda_parts = $xpath->query(".//div[@class='ai1ec-btn-group ai1ec-actions']/a",$agenda_item);
		foreach ($agenda_parts as $agenda_part) {
			$agenda_list_item['link'] = trim($agenda_part->attributes->getNamedItem('href')->nodeValue);
		}
		$agenda_list[] = $agenda_list_item;
	}
	return $agenda_list;
}

function convert_html_text($text) {
    $doc = new DOMDocument();
    $doc->loadHTML($text);
    $xpath = new DOMXpath($doc);
    $links = $xpath->query("//a");

    $link_list = array();
    foreach ($links as $link) {
	$link_list_item['link'] = str_replace('mailto:','',trim($link->attributes->getNamedItem('href')->nodeValue));
	$link_list_item['text'] = trim($link->nodeValue);
	if ($link_list_item['link'] != $link_list_item['text']) {
		$link_list[] = $link_list_item;
	}
    }

    $text = trim(strip_tags($text));

    foreach($link_list as $link) {
	$text = str_replace($link['text'],$link['text'] . ' ( ' . $link['link'] . ' )',$text);
    }

    return $text;
}

function get_newsletter_item_icon($postid) {
  ob_start();
  newsletter_get_post_image($postid);
  $thumbnail = trim(ob_get_contents());
  ob_end_clean();
  return $thumbnail;
/*
                              if ($thumbnail != '') { ?>
                                        <img width="125" src="<?php echo $thumbnail; ?>" class="icon" alt="icon">
                                 <?php }
                                } ?>
*/
}
