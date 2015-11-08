<?php
setlocale(LC_ALL, 'nl_NL');

function clear_agenda_text($string) {
  $string = trim($string);
  $string = str_replace(array('â'),'-',$string);

  return $string;
}

function make_agenda_timestamp($string) {
  $months = array('dummy','jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec');
  $date = explode('@',$string);
  $day = explode(' ',trim($date[0]));
  $time = explode(' ',trim($date[1]));
  $time = explode(':',trim($time[0]));

  if (count($time) != 2) {
    $time  = array(0,0);
  }

  $date = mktime($time[0],$time[1],0,array_search($day[0],$months),$day[1]);

  if ($date < time()) {
    $date = mktime($time[0],$time[1],0,array_search($day[0],$months),$day[1],date('Y')+1);
  }
  return $date;
}

function get_agenda_items($amount = 50) {
    $doc = new DOMDocument();
	$doc->loadHTML(do_shortcode('[ai1ec view="agenda" events_limit="' . $amount . '"]'));
	$xpath = new DOMXpath($doc);
	$agenda_items = $xpath->query("//div[@data-end]");

	$agenda_list = array();
	foreach ($agenda_items as $agenda_item) {
		$agenda_list_item = array('title' => '', 'description' =>'', 'date' => '', 'link' => '' , 'id' => -1, 'timestamp' => 0);

		$agenda_parts = $xpath->query(".//span[@class='ai1ec-event-title']",$agenda_item);
		foreach ($agenda_parts as $agenda_part) {
			$agenda_list_item['title'] = clear_agenda_text($agenda_part->nodeValue);
		}

		$agenda_parts = $xpath->query(".//div[@class='ai1ec-event-description']",$agenda_item);
		foreach ($agenda_parts as $agenda_part) {
			$agenda_list_item['description'] = clear_agenda_text($agenda_part->nodeValue);
		}

		$agenda_parts = $xpath->query(".//div[@class='ai1ec-event-time']",$agenda_item);
		foreach ($agenda_parts as $agenda_part) {
			$agenda_list_item['date'] = clear_agenda_text($agenda_part->nodeValue);
			$agenda_list_item['timestamp'] = make_agenda_timestamp($agenda_list_item['date']);
		}

		$agenda_parts = $xpath->query(".//div[@class='ai1ec-btn-group ai1ec-actions']/a",$agenda_item);
		foreach ($agenda_parts as $agenda_part) {
			$agenda_list_item['link'] = clear_agenda_text($agenda_part->attributes->getNamedItem('href')->nodeValue);
			preg_match("/instance_id=(\\d+)/", $agenda_list_item['link'], $matches);
	                $agenda_list_item['id'] = $matches[1];
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
}
