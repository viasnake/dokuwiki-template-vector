<?php

/**
 * Default button configuration of the "vector" DokuWiki template
 *
 *
 * LICENSE: This file is open source software (OSS) and may be copied under
 *          certain conditions. See COPYING file for details or try to contact
 *          the author(s) of this file in doubt.
 *
 * @license GPLv2 (https://www.gnu.org/licenses/gpl-2.0.html)
 * @author ARSAVA <dokuwiki@dev.arsava.com>
 * @author viasnake <https://github.com/viasnake/>
 * @link https://github.com/viasnake/dokuwiki-template-vector
 * @link https://www.dokuwiki.org/devel:configuration
 */



/******************************************************************************
 ********************************  ATTENTION  *********************************
         DO NOT MODIFY THIS FILE, IT WILL NOT BE PRESERVED ON UPDATES!
 ******************************************************************************
  If you want to add some own buttons, have a look at the README of this
  template and "/user/buttons.php". You have been warned!
 *****************************************************************************/


//check if we are running within the DokuWiki environment
if (!defined("DOKU_INC")){
    die();
}


//note: The buttons will be rendered in the order they were defined. Means:
//      first button will be rendered first, last button will be rendered at
//      last.


//RSS recent changes button
if (actionOK("rss")){
    $_vector_btns["rss"]["img"]      = tpl_basedir()."static/img/button-rss.png";
    $_vector_btns["rss"]["href"]     = DOKU_BASE."feed.php";
    $_vector_btns["rss"]["width"]    = 80;
    $_vector_btns["rss"]["height"]   = 15;
    $_vector_btns["rss"]["title"]    = _vector_getLang("vector_recentchanges");
    $_vector_btns["rss"]["nofollow"] = true;
}


//"vector for DokuWiki" button
$_vector_btns["vecfdw"]["img"]      = tpl_basedir()."static/img/button-vector.png";
$_vector_btns["vecfdw"]["href"]     = "https://github.com/viasnake/dokuwiki-template-vector";
$_vector_btns["vecfdw"]["width"]    = 80;
$_vector_btns["vecfdw"]["height"]   = 15;
$_vector_btns["vecfdw"]["title"]    = _vector_getLang("vector_mdtemplatefordw");
$_vector_btns["vecfdw"]["nofollow"] = !$vector_is_startpage;


//donation button
$vector_donate_url = trim(_vector_string(tpl_getConf("vector_donate_url")));
if (tpl_getConf("vector_donate") &&
    filter_var($vector_donate_url, FILTER_VALIDATE_URL) !== false &&
    parse_url($vector_donate_url, PHP_URL_SCHEME) === "https"){
    $_vector_btns["donate"]["img"]      = tpl_basedir()."static/img/button-donate.gif";
    $_vector_btns["donate"]["href"]     = $vector_donate_url;
    $_vector_btns["donate"]["width"]    = 80;
    $_vector_btns["donate"]["height"]   = 15;
    $_vector_btns["donate"]["title"]    = _vector_getLang("vector_donate");
    $_vector_btns["donate"]["nofollow"] = true;
}


unset($vector_donate_url);

//DokuWiki button
$_vector_btns["dw"]["img"]      = tpl_basedir()."static/img/button-dw.png";
$_vector_btns["dw"]["href"]     = "https://www.dokuwiki.org/";
$_vector_btns["dw"]["width"]    = 80;
$_vector_btns["dw"]["height"]   = 15;
$_vector_btns["dw"]["title"]    = "DokuWiki";
$_vector_btns["dw"]["nofollow"] = !$vector_is_startpage;





/******************************************************************************
 ********************************  ATTENTION  *********************************
         DO NOT MODIFY THIS FILE, IT WILL NOT BE PRESERVED ON UPDATES!
 ******************************************************************************
  If you want to add some own buttons, have a look at the README of this
  template and "/user/buttons.php". You have been warned!
 *****************************************************************************/

