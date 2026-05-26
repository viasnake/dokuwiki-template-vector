<?php

/**
 * Italian language for the Config Manager
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
 * @author Luigi Micco <l.micco@tiscali.it>
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
$lang["vector_discuss"]    = "Usare linguetta discussioni?";
$lang["vector_discuss_ns"] = "Se si, usa questo ':namespace:' come radice per le discussioni:";

//site notice
$lang["vector_sitenotice"]          = "Mostra annunci generali?";
$lang["vector_sitenotice_location"] = "Se si, usa la seguente pagina wiki come annuncio:";

//navigation
$lang["vector_navigation"]          = "Mostra pannello di navigazione?";
$lang["vector_navigation_location"] = "Se si, usa la seguente pagina wiki come pannello di navigazione:";

//exportbox ("print/export")
$lang["vector_exportbox"]          = "Mostrat pannello 'stampa/esporta'";
$lang["vector_exportbox_default"]  = "Se si, usa il pannello predefinito 'stampa/esporta'?";
$lang["vector_exportbox_location"] = "Se non usi il predefinito, usa la seguente pagina wiki come pannello 'stampa/esporta':";

//toolbox
$lang["vector_toolbox"]               = "Mostra pannello strumenti?";
$lang["vector_toolbox_default"]       = "Se si, usa il pannello predefinito?";
$lang["vector_toolbox_location"]      = "Se non usi il predefinito, usa la seguente pagina wiki come pannello degli strumenti:";

//qr code box
$lang["vector_qrcodebox"] = "Show a box with a QR code for the current wiki page URL? This uses an external QR code service.";
//custom copyright notice
$lang["vector_copyright"]          = "Mostra avviso di copyright?";
$lang["vector_copyright_default"]  = "Se si, usa l'avviso di copyright predefinito?";
$lang["vector_copyright_location"] = "Se non usi il predefinito, usa la seguente pagina wiki come avviso di copyright:";


//donation link/button
$lang["vector_donate"]          = "Mostra link/pulsante per le donazioni?";
$lang["vector_donate_url"]      = "HTTPS donation URL:";

//TOC
$lang["vector_toc_position"] = "Posizione indice dei contenuti";

//other stuff
$lang["vector_breadcrumbs_position"]  = "Posizione del pannello breadcrumb (se abilitato):";
$lang["vector_youarehere_position"]   = "Posizione del pannello 'Tu sei qui' (se abilitato):";
$lang["vector_cite_author"]           = "Nome autore in 'Cita questo articolo':";
$lang["vector_loaduserjs"]            = "Carica 'modernizedvector/user/user.js'?";
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

//skin variant
$lang["vector_skin_version"] = "Vector design version";
$lang["vector_skin_version_o_2011"] = "Vector 2011";
$lang["vector_skin_version_o_2022"] = "Vector 2022";
$lang["vector_breadcrumbs_position_o_top"] = "Top";
$lang["vector_breadcrumbs_position_o_bottom"] = "Bottom";
$lang["vector_youarehere_position_o_top"] = "Top";
$lang["vector_youarehere_position_o_bottom"] = "Bottom";
