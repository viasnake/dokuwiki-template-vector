<?php

/**
 * Hungarian language (informal) for the Config Manager
 *
 * If your language is not/only partially translated or you found an error/typo,
 * have a look at the following files:
 * - /lib/tpl/vector/lang/<your lang>/lang.php
 * - /lib/tpl/vector/lang/<your lang>/settings.php
 * If they are not existing, copy and translate the English ones (hint: looking
 * at <http://[your lang].wikipedia.org> might be helpful).
 *
 * Don't forget to mail your translation to ARSAVA <dokuwiki@dev.arsava.com>.
 * Thanks! :-D
 *
 *
 * LICENSE: This file is open source software (OSS) and may be copied under
 *          certain conditions. See COPYING file for details or try to contact
 *          the author(s) of this file in doubt.
 *
 * @license GPLv2 (http://www.gnu.org/licenses/gpl2.html)
 * @author ARSAVA <dokuwiki@dev.arsava.com>
 * @link https://www.dokuwiki.org/template:vector
 * @link https://www.dokuwiki.org/config:lang
 * @link https://www.dokuwiki.org/devel:configuration
 * 
 * Translation credits:
 * @author Szíjártó Levente Pál <szijartoleventepal@gmail.com>
 */


//check if we are running within the DokuWiki environment
if (!defined("DOKU_INC")){
    die();
}

//user pages
$lang["vector_userpage"]    = "Szerkesztői lapok használata";
$lang["vector_userpage_ns"] = "A fenti esetén a szerkesztői lapok gyökérnévtere:";

//discussion pages
$lang["vector_discuss"]    = "Vitalapok használata";
$lang["vector_discuss_ns"] = "A fenti esetén a vitalapok gyökérnévtere:";

//site notice
$lang["vector_sitenotice"]           = "Közlemény megjelenítése a teljes wikin";
$lang["vector_sitenotice_location"]  = "A fenti esetén a következő lap használata közleményként:";
$lang["vector_sitenotice_translate"] = "A fenti és a <a href=\"https://www.dokuwiki.org/plugin:translation\">fordítási bővítmény</a> jelenléte esetén honosított oldalak használata közleménylént<br />A honosított oldalak hivatkozása a következő formátum: „[vector_közleményoldal]_[ISO-nyelvkód]” (pl.: „:wiki:site_notice_de”)";

//navigation
$lang["vector_navigation"]           = "Navigáció megjelenítése";
$lang["vector_navigation_location"]  = "A fenti esetén a következő lap használata navigációként:";
$lang["vector_navigation_translate"] = "A fenti és a <a href=\"https://www.dokuwiki.org/plugin:translation\">fordítási bővítmény</a> jelenléte esetén honosított oldalak használata navigációként<br />A honosított oldalak hivatkozása a következő formátum: „[vector_navigációs_oldal]_[ISO-nyelvkód]” (pl.: „:wiki:navigation_de”)";

//exportbox ("print/export")
$lang["vector_exportbox"]          = "Nyomtatási/exportálási lehetőségek megjelenítése";
$lang["vector_exportbox_default"]  = "A fenti esetén az alapértelmezett megjelenés használata";
$lang["vector_exportbox_location"] = "Nem alapértelmezett megjelenés esetén a következő lap használata:";

//toolbox
$lang["vector_toolbox"]          = "Eszközök megjelenítése";
$lang["vector_toolbox_default"]  = "A fenti esetén az alapértelmezett megjelenés használata";
$lang["vector_toolbox_location"] = "Nem alapértelmezett megjelenés esetén a következő lap használata:";

//qr code box
$lang["vector_qrcodebox"] = "Megnyitott lap QR-kódjának megjelenítése (könnyű mobilos hozzáféréshez)";

//custom copyright notice
$lang["vector_copyright"]           = "Szerzői jogi közlemény megjelenítése";
$lang["vector_copyright_default"]   = "A fenti esetén az alapértelmezett közlemény használata";
$lang["vector_copyright_location"]  = "Nem alapértelmezett közlemény esetén a következő lap használata:";
$lang["vector_copyright_translate"] = "A fenti és a <a href=\"https://www.dokuwiki.org/plugin:translation\">fordítási bővítmény</a> jelenléte esetén honosított oldalak használata jogi közleménylént<br />A honosított oldalak hivatkozása a következő formátum: „[vector_jogi_közleményoldal]_[ISO-nyelvkód]” (pl.: „:wiki:copyright_de”).";

//donation link/button
$lang["vector_donate"]          = "Adományozási hivatkozás megjelenítése";
$lang["vector_donate_url"]      = "Adományozási hivatkozás webcíme:";

//TOC
$lang["vector_toc_position"] = "Tartalomjegyzék elhelyezkedése";

//other stuff
$lang["vector_breadcrumbs_position"]  = "Nyomvonal elhelyzkedése (ha engedélyezve van):";
$lang["vector_youarehere_position"]   = "Az „Itt vagy” navigáció elhelyezkedése (ha engedélyezve van):";
$lang["vector_cite_author"]           = "Szerző megjelenített neve hivatkozásnál:";
$lang["vector_loaduserjs"]            = "„vector/user/user.js” használata";
$lang["vector_closedwiki"]            = "Zárt wiki (legtöbb hivatkozás, fül és doboz elrejtése, amíg a felhasználó be nem jelentkezik)";

