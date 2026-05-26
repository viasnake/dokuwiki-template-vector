<?php

/**
 * Dutch language for the Config Manager
 * by Theo Klein (14/06/2010)
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
 * @author Theo Klein
 * @author viasnake <https://github.com/viasnake/>
 * @link https://github.com/viasnake/dokuwiki-template-vector
 * @link https://www.dokuwiki.org/config:lang
 * @link https://www.dokuwiki.org/devel:configuration
 */


//check if we are running within the DokuWiki environment
if (!defined("DOKU_INC")) {
    die();
}

//discussion pages
$lang["vector_discuss"]    = "Gebruik discussie pagina's en tabs?";
$lang["vector_discuss_ns"] = "Indien ja, gebruik de volgende ':namespace:' als root voor discussies:";

//site notice
$lang["vector_sitenotice"]          = "Toon notificatie door de gehele site?";
$lang["vector_sitenotice_location"] = "Indien ja, gebruik de volgende wiki pagina als notificatie:";

//navigation
$lang["vector_navigation"]          = "Toon navigatie?";
$lang["vector_navigation_location"] = "Indien ja, gebruik de volgende wiki pagina als navigatie:";

//exportbox ("print/export")
$lang["vector_exportbox"]          = "Toon 'Afdrukken/exporteren' box?";
$lang["vector_exportbox_default"]  = "Indien ja, gebruik de standaard 'Afdrukken/exporteren' box?";
$lang["vector_exportbox_location"] = "Indien niet standaard, gebruik de volgende wikipagina als 'Afdrukken/exporteren' box locatie:";

//toolbox
$lang["vector_toolbox"]          = "Toon hulpmiddelen?";
$lang["vector_toolbox_default"]  = "Indien ja, gebruik de standaard hulpmiddelen?";
$lang["vector_toolbox_location"] = "Indien niet standaard, gebruik de volgende wikipagina als 'hulpmiddelen' locatie:";

//qr code box
$lang["vector_qrcodebox"] = "Show a box with a QR code for the current wiki page URL? This uses an external QR code service.";
//custom copyright notice
$lang["vector_copyright"]          = "Toon copyright notificatie?";
$lang["vector_copyright_default"]  = "Indien ja, gebruik de standaard copyright notificatie?";
$lang["vector_copyright_location"] = "Wanneer de standaard niet gebruikt wordt, gebruik de volgende wiki pagina als copyright notificatie:";

//donation link/button
$lang["vector_donate"]          = "Toon donatie button?";
$lang["vector_donate_url"]      = "HTTPS donation URL:";

//TOC
$lang["vector_toc_position"] = "Positionering van de inhoudopgave";

//other stuff
$lang["vector_breadcrumbs_position"]  = "Positie van broodkruimel navigatie (indien ingeschakeld):";
$lang["vector_youarehere_position"]   = "Positie van 'U bent hier' navigatie (indien ingeschakeld):";
$lang["vector_cite_author"]           = "Naam van de auteur in 'Citeer dit artikel':";
$lang["vector_loaduserjs"]            = "Laad 'modernizedvector/user/user.js'?";
// English fallback labels for settings added after the original translation
$lang["vector_userpage"] = "Use user pages?";
$lang["vector_userpage_ns"] = "If enabled, use this absolute ':namespace:' as root for user pages:";
$lang["vector_closedwiki"] = "Closed wiki (most links/tabs/boxes are hidden until user is logged in)?";
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
