<?php

/**
 * English language for the Config Manager
 *
 * If your language is not/only partially translated or you found an error/typo,
 * have a look at the following files:
 * - /lib/tpl/modernizedvector/lang/<your lang>/lang.php
 * - /lib/tpl/modernizedvector/lang/<your lang>/settings.php
 * If they do not exist, copy and translate the English ones (hint: looking
 * at the Wikipedia for your language might be helpful).
 *
 * Please submit translation updates through GitHub issues or pull requests.
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
 * @link https://www.dokuwiki.org/config:lang
 * @link https://www.dokuwiki.org/devel:configuration
 */


//check if we are running within the DokuWiki environment
if (!defined("DOKU_INC")) {
    die();
}

//user pages
$lang["vector_userpage"]    = "Use user pages?";
$lang["vector_userpage_ns"] = "If enabled, use this absolute ':namespace:' as root for user pages:";

//discussion pages
$lang["vector_discuss"]    = "Use discussion tabs/pages?";
$lang["vector_discuss_ns"] = "If enabled, use this absolute ':namespace:' as root for discussion pages:";

//site notice
$lang["vector_sitenotice"]           = "Show site-wide notice?";
$lang["vector_sitenotice_location"]  = "If enabled, use this absolute wiki page id for the site-wide notice:";
$lang["vector_sitenotice_translate"] = "If yes and <a href=\"https://www.dokuwiki.org/plugin:translation\">Translation plugin</a> available: load a language-specific site-wide notice?<br>The wiki page of the translated site notice(s) is [value of 'vector_sitenotice_location']_[iso lang code] (e.g. ':wiki:site_notice_de').";

//navigation
$lang["vector_navigation"]           = "Show navigation?";
$lang["vector_navigation_location"]  = "If enabled, use this absolute wiki page id as navigation:";
$lang["vector_navigation_translate"] = "If yes and <a href=\"https://www.dokuwiki.org/plugin:translation\">Translation plugin</a> available: load language-specific navigation?<br>The wiki page of the translated navigation(s) is [value of 'vector_navigation_location']_[iso lang code] (e.g. ':wiki:navigation_de').";

//exportbox ("print/export")
$lang["vector_exportbox"]          = "Show 'print/export' box?";
$lang["vector_exportbox_default"]  = "If yes, use default 'print/export' box?";
$lang["vector_exportbox_location"] = "If not using the default, use this absolute wiki page id as 'print/export' box location:";

//toolbox
$lang["vector_toolbox"]          = "Show tools?";
$lang["vector_toolbox_default"]  = "If yes, use default tools?";
$lang["vector_toolbox_location"] = "If not using the default, use this absolute wiki page id as tools location:";

//qr code box
$lang["vector_qrcodebox"] = "Show a box with a QR code for the current wiki page URL? This uses an external QR code service.";

//custom copyright notice
$lang["vector_copyright"]           = "Show copyright notice?";
$lang["vector_copyright_default"]   = "If yes, use default copyright notice?";
$lang["vector_copyright_location"]  = "If not using the default, use this absolute wiki page id as copyright notice:";
$lang["vector_copyright_translate"] = "If not default and <a href=\"https://www.dokuwiki.org/plugin:translation\">Translation plugin</a> available: load a language-specific copyright notice?<br>The wiki page of the translated copyright notice(s) is [value of 'vector_copyright_location']_[iso lang code] (e.g. ':wiki:copyright_de').";

//donation link/button
$lang["vector_donate"]          = "Show donation link/button?";
$lang["vector_donate_url"]      = "HTTPS donation URL:";

//TOC
$lang["vector_toc_position"] = "Table of contents (TOC) position";
$lang["vector_toc_position_o_article"] = "Article";
$lang["vector_toc_position_o_sidebar"] = "Sidebar";

//other stuff
$lang["vector_breadcrumbs_position"]  = "Position of breadcrumb navigation (if enabled):";
$lang["vector_breadcrumbs_position_o_top"] = "Top";
$lang["vector_breadcrumbs_position_o_bottom"] = "Bottom";
$lang["vector_youarehere_position"]   = "Position of 'You are here' navigation (if enabled):";
$lang["vector_youarehere_position_o_top"] = "Top";
$lang["vector_youarehere_position_o_bottom"] = "Bottom";
$lang["vector_cite_author"]           = "Author name in 'Cite this Article':";
$lang["vector_loaduserjs"]            = "Load 'modernizedvector/user/user.js'?";
$lang["vector_closedwiki"]            = "Closed wiki (most links/tabs/boxes are hidden until user is logged in)?";
