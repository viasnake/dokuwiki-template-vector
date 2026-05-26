<?php

/**
 * Basque language for the Config Manager
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
 * @author ander
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
$lang["vector_userpage"]    = "Erabili erabiltzaile orrialdeak?";
$lang["vector_userpage_ns"] = "Bai bada, erabili hurrengo ':izenespazioa:' erabiltzaile orrialdeen erro bezala:";

//discussion pages
$lang["vector_discuss"]    = "Erabili eztabaida fitxak/lekuak?";
$lang["vector_discuss_ns"] = "Bai bada, erabili hurrengo ':izenespazioa:' eztabaiden orrialdeen erro bezala:";

//site notice
$lang["vector_sitenotice"]          = "Erakutsi lekuaren oharrak?";
$lang["vector_sitenotice_location"] = "Bai bada, erabili hurrengo wiki orrialdea lekuaren oharrenfako:";

//navigation
$lang["vector_navigation"]          = "Erakutsi Nabigazioa?";
$lang["vector_navigation_location"] = "Bai bada, erabili hurrengo wiki orria nabigaziorako:";

//exportbox ("print/export")
$lang["vector_exportbox"]          = "Erakutsi 'imprimatu/esportatu' koadroa?";
$lang["vector_exportbox_default"]  = "Bai bada, erabili lehenetsitako  'imprimatu/esportatu' koadroa?";
$lang["vector_exportbox_location"] = "Ez bada lehenetsia, erabili hurrengo orrialdea 'inprimatu/esportatu' koadroaren kokapen bezala:";

//toolbox
$lang["vector_toolbox"]          = "Erakutsi tresna koadroa?";
$lang["vector_toolbox_default"]  = "Bai bada, lehenetsitako tresna koadroa erabili?";
$lang["vector_toolbox_location"] = "Ez bada lehenetsia, erabili hurrengo wiki orrialdea tresna koadroaren kokapen bezala:";

//qr code box
$lang["vector_qrcodebox"] = "Show a box with a QR code for the current wiki page URL? This uses an external QR code service.";
//custom copyright notice
$lang["vector_copyright"]          = "Erakutsi copyright oharra?";
$lang["vector_copyright_default"]  = "Bai bada, erabili lehenetsitako copyright oharra?";
$lang["vector_copyright_location"] = "Ez bada lehenetsia, erabili hurrengo wiki orrialdea copyright oharrarendako:";

//donation link/button
$lang["vector_donate"]          = "Erakutsi dohaintza lotura/botoia?";
$lang["vector_donate_url"]      = "HTTPS donation URL:";

//TOC
$lang["vector_toc_position"] = "Edukien taularen (TOC) posizioa";

//other stuff
$lang["vector_breadcrumbs_position"]  = "Breadcrumb-aren posizioa nabigazioan (gaituta badago):";
$lang["vector_youarehere_position"]   = "'Hemen zaude'-ren posizioa nabigazioan (gaituta badago):";
$lang["vector_cite_author"]           = "Jarri autorearen izena 'Artikuluaren aipamenean':";
$lang["vector_loaduserjs"]            = "Kargatu 'modernizedvector/user/user.js'?";
$lang["vector_closedwiki"]            = "Wiki itxia (lotura/fitxa/koadro gehienak ezkutatuta daude erabiltzailea sartu arte)?";

$lang["vector_sitenotice_translate"] = "If yes and the Translation plugin is available, load a language-specific site-wide notice. The translated page id is the configured site notice page id followed by an underscore and ISO language code.";
$lang["vector_navigation_translate"] = "If yes and the Translation plugin is available, load language-specific navigation. The translated page id is the configured navigation page id followed by an underscore and ISO language code.";
$lang["vector_copyright_translate"] = "If not using the default and the Translation plugin is available, load a language-specific copyright notice. The translated page id is the configured copyright page id followed by an underscore and ISO language code.";

// English fallback labels for multichoice settings added after the original translation
$lang["vector_toc_position_o_article"] = "Article";
$lang["vector_toc_position_o_sidebar"] = "Sidebar";
$lang["vector_breadcrumbs_position_o_top"] = "Top";
$lang["vector_breadcrumbs_position_o_bottom"] = "Bottom";
$lang["vector_youarehere_position_o_top"] = "Top";
$lang["vector_youarehere_position_o_bottom"] = "Bottom";
