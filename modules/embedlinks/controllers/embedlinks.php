<?php defined("SYSPATH") or die("No direct script access.");
/**
 * Gallery - a web based photo album viewer and editor
 * Copyright (C) 2000-2009 Bharat Mediratta
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or (at
 * your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street - Fifth Floor, Boston, MA  02110-1301, USA.
 */
class EmbedLinks_Controller extends Controller {
  /**
   * Display the EXIF data for an item.
   */
  public function showhtml($item_id) {
    $item = ORM::factory("item", $item_id);
    access::required("view", $item);

    if ($item->is_album()) {
      $linkArray[0] = array("Text:", "<a href=&quot;" . url::abs_site("{$item->type}s/{$item->id}") . "&quot;>Click Here</a>");
      $linkArray[1] = array("Thumbnail:", "<a href=&quot;" . url::abs_site("{$item->type}s/{$item->id}") . "&quot;><img src=&quot;" . $item->thumb_url(true) . "&quot;></a>");
      $linkTitles[0] = array("Link To This Album:", 2);  
    } else {
      $linkArray[0] = array("Text:", "<a href=&quot;" . url::abs_site("{$item->type}s/{$item->id}") . "&quot;>Click Here</a>");
      $linkArray[1] = array("Thumbnail:", "<a href=&quot;" . url::abs_site("{$item->type}s/{$item->id}") . "&quot;><img src=&quot;" . $item->thumb_url(true) . "&quot;></a>");
      $linkArray[2] = array("Resized:", "<a href=&quot;" . url::abs_site("{$item->type}s/{$item->id}") . "&quot;><img src=&quot;" . $item->resize_url(true) . "&quot;></a>");
      $linkTitles[0] = array("Link To This Page:", 3);  

      $linkArray[3] = array("Text:", "<a href=&quot;" . $item->resize_url(true) . "&quot;>Click Here</a>");
      $linkArray[4] = array("Thumbnail:", "<a href=&quot;" . $item->resize_url(true) . "&quot;><img src=&quot;" . $item->thumb_url(true) . "&quot;></a>");
      $linkArray[5] = array("Image:", "<img src=&quot;" . $item->resize_url(true) . "&quot;>");
      $linkTitles[1] = array("Link To The Resized Image:", 3);  
      
      if (access::can("view_full", $item)) {
        $linkArray[6] = array("Text:", "<a href=&quot;" . $item->file_url(true) . "&quot;>Click Here</a>");
        $linkArray[7] = array("Thumbnail:", "<a href=&quot;" . $item->file_url(true) . "&quot;><img src=&quot;" . $item->thumb_url(true) . "&quot;></a>");
        $linkArray[8] = array("Resized:", "<a href=&quot;" . $item->file_url(true) . "&quot;><img src=&quot;" . $item->resize_url(true) . "&quot;></a>");
        $linkTitles[2] = array("Link To The Fullsize Image:", 3);        
      }
    }
    
    $view = new View("embedlinks_htmldialog.html");
    $view->titles = $linkTitles;
    $view->details = $linkArray;
    print $view;
  }

  public function showbbcode($item_id) {
    $item = ORM::factory("item", $item_id);
    access::required("view", $item);
  
    if ($item->is_album()) {
      $linkArray[0] = array("Text:", "[url=" . url::abs_site("{$item->type}s/{$item->id}") . "]Click Here[/url]");
      $linkArray[1] = array("Thumbnail:", "[url=" . url::abs_site("{$item->type}s/{$item->id}") . "][img]" . $item->thumb_url(true) . "[/img][/url]");
      $linkTitles[0] = array("Link To This Album:", 2);  
    } else {
      $linkArray[0] = array("Text:", "[url=" . url::abs_site("{$item->type}s/{$item->id}") . "]Click Here[/url]");
      $linkArray[1] = array("Thumbnail:", "[url=" . url::abs_site("{$item->type}s/{$item->id}") . "][img]" . $item->thumb_url(true) . "[/img][/url]");
      $linkArray[2] = array("Resized:", "[url=" . url::abs_site("{$item->type}s/{$item->id}") . "][img]" . $item->resize_url(true) . "[/img][/url]");
      $linkTitles[0] = array("Link To This Page:", 3);  

      $linkArray[3] = array("Text:", "[url=" . $item->resize_url(true) . "]Click Here[/url]");
      $linkArray[4] = array("Thumbnail:", "[url=" . $item->resize_url(true) . "][img]" . $item->thumb_url(true) . "[/img][/url]");
      $linkArray[5] = array("Image:", "[img]" . $item->resize_url(true) . "[/img]");
      $linkTitles[1] = array("Link To The Resized Image:", 3);  
      
      if (access::can("view_full", $item)) {
        $linkArray[6] = array("Text:", "[url=" . $item->file_url(true) . "]Click Here[/url]");
        $linkArray[7] = array("Thumbnail:", "[url=" . $item->file_url(true) . "][img]" . $item->thumb_url(true) . "[/img][/url]");
        $linkArray[8] = array("Resized:", "[url=" . $item->file_url(true) . "][img]" . $item->resize_url(true) . "[/img][/url]");
        $linkTitles[2] = array("Link To The Fullsize Image:", 3);        
      }
    }
    
    $view = new View("embedlinks_bbcodedialog.html");
    $view->titles = $linkTitles;
    $view->details = $linkArray;
    print $view;
  }
}