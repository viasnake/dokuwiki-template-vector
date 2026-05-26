<?php

/**
 * Czech language for the Config Manager
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
 * @author David Roesel <http://david.roesel.cz/>
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
$lang["vector_userpage"]    = "Používat uživatelské stránky?";
$lang["vector_userpage_ns"] = "Pokud ano, používat tento ':jmenný prostor:' jako kořenový adresář:";

//discussion pages
$lang["vector_discuss"]    = "Používat diskusní taby/stránky?";
$lang["vector_discuss_ns"] = "Pokud ano, používat tento ':jmenný prostor:' jako kořenový adresář pro diskuse:";

//site notice
$lang["vector_sitenotice"]          = "Zobrazovat globální upozornění?";
$lang["vector_sitenotice_location"] = "Pokud ano, použít jako globální upozornění tuto stránku:";

//navigation
$lang["vector_navigation"]          = "Zobrazovat navigaci?";
$lang["vector_navigation_location"] = "Pokud ano, použít jako navigaci následující stránku:";

//exportbox ("print/export")
$lang["vector_exportbox"]          = "Zobrazovat 'tisk/export' sekci?";
$lang["vector_exportbox_default"]  = "Pokud ano, používat původní 'tisk/export' sekci?";
$lang["vector_exportbox_location"] = "Pokud ne tu původní, potom používat následující stránku jako 'tisk/export' sekci:";

//toolbox
$lang["vector_toolbox"]          = "Zobrazovat nástroje?";
$lang["vector_toolbox_default"]  = "Pokud ano, používat původní nástroje?";
$lang["vector_toolbox_location"] = "Pokud ne ty původní, potom používat následující stránku jako nástroje:";

//qr code box
$lang["vector_qrcodebox"] = "Show a box with a QR code for the current wiki page URL? This uses an external QR code service.";
//custom copyright notice
$lang["vector_copyright"]          = "Zobrazovat informace o autorských právech?";
$lang["vector_copyright_default"]  = "Pokud ano, používat původní informace o autorských právech?";
$lang["vector_copyright_location"] = "Pokud ne ty původní, potom používat následující stránku jako informace o autorských právech:";

//donation link/button
$lang["vector_donate"]          = "Zobrazovat možnost \"Přispět\"?";
$lang["vector_donate_url"]      = "HTTPS donation URL:";

//TOC
$lang["vector_toc_position"] = "Pozice obsahu:";

//other stuff
$lang["vector_breadcrumbs_position"]  = "Pozice aktuální cesty (breadcrumbs) (je-li tato funkce povolena):";
$lang["vector_youarehere_position"]   = "Pozice navigace 'Jste tady' (je-li tato funkce povolena):";
$lang["vector_cite_author"]           = "Jméno autora při použití 'Citovat tento článek':";
$lang["vector_loaduserjs"]            = "Nahrávat 'modernizedvector/user/user.js'?";
$lang["vector_closedwiki"]            = "Je wiki zavřená (většina odkazů/tabů/boxů nebude vidět do přihlášení)?";

$lang["vector_sitenotice_translate"] = "If yes and the Translation plugin is available, load a language-specific site-wide notice. The translated page id is the configured site notice page id followed by an underscore and ISO language code.";
$lang["vector_navigation_translate"] = "If yes and the Translation plugin is available, load language-specific navigation. The translated page id is the configured navigation page id followed by an underscore and ISO language code.";
$lang["vector_copyright_translate"] = "If not using the default and the Translation plugin is available, load a language-specific copyright notice. The translated page id is the configured copyright page id followed by an underscore and ISO language code.";

// English fallback labels for multichoice settings added after the original translation
$lang["vector_toc_position_o_article"] = "Article";
$lang["vector_toc_position_o_sidebar"] = "Sidebar";

//skin variant
$lang["vector_skin_version"] = "Vector design version";
$lang["vector_skin_version_o_2011"] = "Vector 2011";
$lang["vector_skin_version_o_2022"] = "Vector 2022";
$lang["vector_breadcrumbs_position_o_top"] = "Top";
$lang["vector_breadcrumbs_position_o_bottom"] = "Bottom";
$lang["vector_youarehere_position_o_top"] = "Top";
$lang["vector_youarehere_position_o_bottom"] = "Bottom";
