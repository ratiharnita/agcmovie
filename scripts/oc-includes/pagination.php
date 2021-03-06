<?php
require_once( BASEPATH . '/oc-config.php' );

define("QS_VAR", "page"); // the variable name inside the query string (don't use this name inside other links)
define("NUM_ROWS", get_bloginfo('posts_per_page')); // the number of records on each page

define("STR_FWD", "Next"); // the string is used for a link (step forward)
define("STR_BWD", "Back"); // the string is used for a link (step backward)

define("STR_START", "First"); // the string is used for a link (first step)
define("STR_END", "Last"); // the string is used for a link (last step)

// use the right pathes to get it working with the php function getimagesize
define("IMG_FWD", "forward.gif"); // the image for forward link 
define("IMG_BWD", "backward.gif"); // the image for backward link 
define("IMG_START", "start.gif"); // the image for the first link 
define("IMG_END", "end.gif"); // the image for the last link 

define("NUM_LINKS", 1); // the number of links inside the navigation (the default value)

class MyPagina {
	
	var $sql;
	var $result;
	var $outstanding_rows = false;
	var $hashtag = '';
	
	var $get_var = QS_VAR;
	
	var $forw = STR_FWD;
	var $forw_img = IMG_FWD;
	var $back = STR_BWD;
	var $back_img = IMG_BWD;
	
	// new in ver. 1.04
	var $start = STR_START;
	var $start_img = IMG_START;
	var $end = STR_END;
	var $end_img = IMG_END;

	var $max_rows;
	var $number_links = NUM_LINKS;
	var $rows_on_page = NUM_ROWS;	
	
	
	// constructor
	function MyPagina($rows = 0, $connect = true) {
		if ($connect) $this->connect_db();
		$this->max_rows = $rows;

	}
	// sets the current page number
	function set_page() {
		$page = (!empty($_REQUEST[$this->get_var])) ? (int)$_REQUEST[$this->get_var] : 0;
		return $page;
	}
	// gets the total number of records 
	function get_total_rows() {
                $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$tmp_result = mysqli_query($db, $this->sql) or die (mysqli_error($db));
		$all_rows = mysqli_num_rows($tmp_result);
		if (!empty($this->max_rows) && $all_rows > $this->max_rows) {
			$all_rows = $this->max_rows;
			$this->outstanding_rows = true;
		}
		mysqli_free_result($tmp_result);
		return $all_rows;
	}
	// database connection
	function connect_db() {
		$connId = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die ('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error()); 
	}
	// get the totale number of result pages
	function get_num_pages() {
		$number_pages = ceil($this->get_total_rows() / $this->rows_on_page);
		return $number_pages;
	}
	// returns the records for the current page
	function get_page_result() {
                $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$start = $this->set_page() * $this->rows_on_page;
		$diff = $this->get_total_rows() - $start;
		$end = ($diff < $this->rows_on_page) ? $diff : $this->rows_on_page;
		$page_sql = sprintf("%s LIMIT %s, %s", $this->sql, $start, $end);
		$this->result = mysqli_query($db,$page_sql);
		return $this->result;
	}
	// get the number of rows on the current page
	function get_page_num_rows() {
                if($this->result === FALSE) {
                     die(mysqli_error());
                }
		$num_rows = mysqli_num_rows($this->result);
		return $num_rows;
	}
	// free the database result
	function free_page_result() {
		mysqli_free_result($this->result);
	}
	// function to handle other querystring than the page variable
	function rebuild_qs($curr_var) {
		$qs = '';
		if (!empty($_SERVER['QUERY_STRING'])) {
			$parts = explode("&", $_SERVER['QUERY_STRING']);
			$newParts = array();
			foreach ($parts as $val) {
				if (stristr($val, $curr_var) == false)  {
					array_push($newParts, $val);
				}
			}
			if (count($newParts) != 0) {
				$qs = "&".implode("&", $newParts); // this is your new created query string
			}  
		}
		if ($this->hashtag != '') $qs .= $this->hashtag;
		return $qs; 
	} 
	// this method will return the navigation links for the conplete recordset
	function navigation($separator = " | ", $css_current = "", $numbers_only = false, $only_back_forward = false, $use_images = false, $use_start_end = false, $css_before = "",$css_after = "") {
		$max_links = $this->number_links;
		$curr_pages = $this->set_page();
		$all_pages = $this->get_num_pages() - 1;
		if (!$only_back_forward) {
			$max_links = ($max_links < 2) ? 2 : $max_links;
		}
		if ($curr_pages <= $all_pages && $curr_pages >= 0) {
			if ($curr_pages > ceil($max_links/2)) {
				$start = ($curr_pages - ceil($max_links/2) > 0) ? $curr_pages - ceil($max_links/2) : 1;
				$end = $curr_pages + ceil($max_links/2);
				if ($end >= $all_pages) {
					$end = $all_pages + 1;
					$start = ($all_pages - ($max_links - 1) > 0) ? $all_pages  - ($max_links - 1) : 0;
				}
			} else {
				$start = 0;
				$end = ($all_pages >= $max_links) ? $max_links : $all_pages + 1;
			}
			if ($all_pages >= 1) {
				$forward = $curr_pages + 1;
				$backward = $curr_pages - 1;
				// the text two labels are new sinds ver 1.02
				$lbl_forward = $this->build_back_or_forward("forward", $use_images);
				$lbl_backward = $this->build_back_or_forward("backward", $use_images);
				$navi_string = "";
				$middle_part = "";
					
				if (!$only_back_forward) {
					for($a = $start + 1; $a <= $end; $a++){
						$theNext = $a - 1; // because a array start with 0
						if ($theNext != $curr_pages) {
							$middle_part .= $css_before."<a rel=\"nofollow\" href=\"".$_SERVER['PHP_SELF']."?".$this->get_var."=".$theNext.$this->rebuild_qs($this->get_var)."\">";
							$middle_part .= $a."</a>".$css_after;
							$middle_part .= ($theNext < ($end - 1)) ? $separator : "";
						} else {
							$middle_part .= ($css_current != "") ? "<li class=\"".$css_current."\"><a rel=\"nofollow\">".$a."</a></li>" : $a;
							$middle_part .= ($theNext < ($end - 1)) ? $separator : "";
						}
					}
				}
				if (!$numbers_only) {
					// ver. 1.04 add extra links (start/end)
					$lbl_start = $this->build_back_or_forward("start", $use_images);
					$lbl_end = $this->build_back_or_forward("end", $use_images);
					if ($curr_pages > 0) {
						if ($use_start_end && ($curr_pages > ($max_links-2))) {
							// add here the start link
							$navi_string .=  $css_before."<a rel=\"nofollow\" href=\"".$_SERVER['PHP_SELF']."?".$this->get_var."=0".$this->rebuild_qs($this->get_var)."\">".$lbl_start."</a>&nbsp;".$css_after;
						}
						$navi_string .=  $css_before."<a rel=\"nofollow\" href=\"".$_SERVER['PHP_SELF']."?".$this->get_var."=".$backward.$this->rebuild_qs($this->get_var)."\">".$lbl_backward."</a>&nbsp;".$css_after;
					} else {

					}
					$navi_string .= $middle_part; // the number links
					if ($curr_pages < $all_pages) {
						$navi_string .=  $css_before."&nbsp;<a rel=\"nofollow\" href=\"".$_SERVER['PHP_SELF']."?".$this->get_var."=".$forward.$this->rebuild_qs($this->get_var)."\">".$lbl_forward."</a>".$css_after;
						if ($use_start_end && ($curr_pages < ($all_pages-$max_links+2))) {
							// add here the end links
							$navi_string .=  $css_before."&nbsp;<a rel=\"nofollow\" href=\"".$_SERVER['PHP_SELF']."?".$this->get_var."=".$all_pages.$this->rebuild_qs($this->get_var)."\">".$lbl_end."</a>".$css_after;
						}
					} else {

					}
				} else {
					$navi_string .= $middle_part; // the number links
				}
				return $navi_string;
			}
		}
	}
	// function to create the back/forward elements; $what = forward or backward
	// type = text or img
	// ver. 1.04, added extra labels for the start and end links
	function build_back_or_forward($what, $img = false) {
		$label['text']['forward'] = $this->forw;
		$label['text']['backward'] = $this->back;
		$label['img']['forward'] = $this->forw_img;
		$label['img']['backward'] = $this->back_img;
		$label['text']['start'] = $this->start;
		$label['text']['end'] = $this->end;
		$label['img']['start'] = $this->start_img;
		$label['img']['end'] = $this->end_img;
		if ($img) {
			$img_info = getimagesize($label['img'][$what]);
			$label = "<img src=\"".$label['img'][$what]."\" ".$img_info[3]." border=\"0\">";
		} else {
			$label = $label['text'][$what];
		}
		return $label;
	}
	// this info will tell the visitor which number of records are shown on the current page
	function page_info($str = "Result: %d - %d of %d") {
		$first_rec_no = ($this->set_page() * $this->rows_on_page) + 1;
		$last_rec_no = $first_rec_no + $this->rows_on_page - 1;
		$last_rec_no = ($last_rec_no > $this->get_total_rows()) ? $this->get_total_rows() : $last_rec_no;
		$info = sprintf($str, $first_rec_no, $last_rec_no, $this->get_total_rows());
		return $info;
	}
	// simple method to show only the page back and forward link.
	function back_forward_link($images = false) {

		$simple_links = $this->navigation(" ", "", false, true, $images);
		return $simple_links;
	}
}
?>