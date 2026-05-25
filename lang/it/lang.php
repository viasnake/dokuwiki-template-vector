<?php

/**
 * Italian language for the "vector" DokuWiki template
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
if (!defined("DOKU_INC")){
    die();
}

//tabs
$lang["vector_article"] = "Articolo";
$lang["vector_discussion"] = "Discussione";
$lang["vector_read"] = "Leggi";
$lang["vector_edit"] = "Modifica";
$lang["vector_create"] = "Crea";
$lang["vector_userpage"] = "Pagina utente";
$lang["vector_mytalk"] = "Le mie discussioni";
$lang["vector_exportodt"] = "Esporta: ODT";
$lang["vector_exportpdf"] = "Esporta: PDF";
$lang["vector_translations"] = "Altre lingue";

//headlines for the different bars
$lang["vector_navigation"] = "Navigazione";
$lang["vector_toolbox"] = "Strumenti";
$lang["vector_exportbox"] = "Stampa/Esporta";
$lang["vector_search"] = "Cerca";

//buttons
$lang["vector_btn_search_title"] = "Ricerca questo testo";

//exportbox ("print/export")
$lang["vector_exportbxdef_print"] = "Versione stampabile";
$lang["vector_exportbxdef_downloadodt"] = "Esporta come ODT";
$lang["vector_exportbxdef_downloadpdf"] = "Esporta come PDF";

//default toolbox
$lang["vector_toolbxdef_whatlinkshere"] = "Pagine che puntano qui";
$lang["vector_toolbxdef_siteindex"] = "Indice del sito";
$lang["vector_toolboxdef_permanent"] = "Link permanente";
$lang["vector_toolboxdef_cite"] = "Cita questo articolo";

//cite this article
$lang["vector_cite_bibdetailsfor"] = "Dettagli bibliografici per";
$lang["vector_cite_pagename"] = "Nome pagina";
$lang["vector_cite_author"] = "Autore";
$lang["vector_cite_publisher"] = "Editore";
$lang["vector_cite_dateofrev"] = "Data dell'ultima revisione";
$lang["vector_cite_dateretrieved"] = "Data della citazione";
$lang["vector_cite_permurl"] = "Link permanente";
$lang["vector_cite_pageversionid"] = "ID della revisione";
$lang["vector_cite_citationstyles"] = "Stili di citazione per";
$lang["vector_cite_checkstandards"] = "Usate la versione che risponde meglio ai vostri bisogni.";
$lang["vector_cite_latexusepackagehint"] = "Quando viene usato il package url di LaTeX ('\usepackage{url}' all'inizio del documento), che in genere da' indirizzi web formattati in modo migliore, e' preferibile usare il seguente codice:";
$lang["vector_cite_retrieved"] = "Retrieved";
$lang["vector_cite_in"] = "In";
$lang["vector_cite_from"] = "da";
$lang["vector_cite_accessed"] = "Accessed";
$lang["vector_cite_cited"] = "Cited";
$lang["vector_cite_lastvisited"] = "Ultima visita";
$lang["vector_cite_availableat"] = "Disponibile su";
$lang["vector_cite_discussionpages"] = "Pagina delle discussioni";
$lang["vector_cite_markup"] = "Markup";
$lang["vector_cite_result"] = "Risultato";
$lang["vector_cite_thisversion"] = "questa versione";

//other
$lang["vector_fillplaceholder"] = "Sostituisci questo segnaposto";
$lang["vector_donate"] = "Dona";
$lang["vector_mdtemplatefordw"] = "stile vector per DokuWiki";
$lang["vector_recentchanges"] = "Modifiche recenti";

// English fallback labels for strings added after the original translation
$lang["vector_qrcodebox"] = "QR Code";
$lang["vector_sidebar"] = "Sidebar";
$lang["vector_qrcodebox_qrcode"] = "QR Code";
$lang["vector_qrcodebox_genforcurrentpage"] = "generated for current page";
$lang["vector_qrcodebox_urlofcurrentpage"] = "Current page as QR Code (scan for easy mobile access)";
$lang["vector_skip_to_content"] = "Skip to content";
$lang["vector_menu"] = "Menu";
