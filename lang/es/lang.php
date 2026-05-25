<?php

/**
 * Spanish language for the "vector" DokuWiki template
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
 * @author Jesús Muñoz Martínez <kisumum@gmail.com>
 * @author viasnake <https://github.com/viasnake/>
 * @link https://github.com/viasnake/dokuwiki-template-vector
 * @link https://www.dokuwiki.org/config:lang
 * @link https://www.dokuwiki.org/devel:configuration
 */


//check if we are running within the DokuWiki environment
if (!defined("DOKU_INC")){
    die();
}

//tabs, personal tools and special links
$lang["vector_article"] = "Artículo";
$lang["vector_discussion"] = "Discusión";
$lang["vector_read"] = "Leer";
$lang["vector_edit"] = "Editar";
$lang["vector_create"] = "Crear";
$lang["vector_userpage"] = "Página de Usuario";
$lang["vector_mytalk"] = "Mi Discurso";
$lang["vector_exportodt"] = "Exportar: ODT";
$lang["vector_exportpdf"] = "Exportar: PDF";
$lang["vector_translations"] = "Idiomas";

//headlines for the different bars and boxes
$lang["vector_navigation"] = "Navegación";
$lang["vector_toolbox"] = "Herramientas";
$lang["vector_exportbox"] = "Imprimir/exportar";

//buttons
$lang["vector_btn_search_title"] = "Buscar este texto";

//exportbox ("print/export")
$lang["vector_exportbxdef_print"] = "Versión imprimible";
$lang["vector_exportbxdef_downloadodt"] = "Descargar como ODT";
$lang["vector_exportbxdef_downloadpdf"] = "Descargar como PDF";

//default toolbox
$lang["vector_toolbxdef_whatlinkshere"] = "Qué enlaza aquí";
$lang["vector_toolbxdef_siteindex"] = "Índice";
$lang["vector_toolboxdef_permanent"] = "Inicio";
$lang["vector_toolboxdef_cite"] = "Citar esta página";

//cite this article
$lang["vector_cite_bibdetailsfor"] = "Detalles bibliográficos de";
$lang["vector_cite_pagename"] = "Nombre de la página";
$lang["vector_cite_author"] = "Autor";
$lang["vector_cite_publisher"] = "Editor";
$lang["vector_cite_dateofrev"] = "Día de esta revisión";
$lang["vector_cite_dateretrieved"] = "Día recuperado";
$lang["vector_cite_permurl"] = "URL Permanente";
$lang["vector_cite_pageversionid"] = "ID de la Versión de la Página";
$lang["vector_cite_citationstyles"] = "Estilos de cita para";
$lang["vector_cite_checkstandards"] = "Por favor recuerda consultar el manual de estilo, guías de estándares o las directrices del instructor para una sintáxis exacta para satisfacer sus necesidades.";
$lang["vector_cite_latexusepackagehint"] = "Cuando uses el paquete LaTeX url (\usepackage{url} en algún sitio en el preámbulo),tiende a dar el formato para las direcciones web, lo siguiente pueden ser preferido";
$lang["vector_cite_retrieved"] = "Recuperado";
$lang["vector_cite_from"] = "de";
$lang["vector_cite_in"] = "En";
$lang["vector_cite_accessed"] = "Accedido";
$lang["vector_cite_cited"] = "Citado";
$lang["vector_cite_lastvisited"] = "Último visitado";
$lang["vector_cite_availableat"] = "Disponible en";
$lang["vector_cite_discussionpages"] = "DokuWiki páginas de charla";
$lang["vector_cite_markup"] = "Margen";
$lang["vector_cite_result"] = "Resultado";
$lang["vector_cite_thisversion"] = "esta versión";

//other
$lang["vector_search"] = "Buscar";
$lang["vector_fillplaceholder"] = "Por favor rellena este marcador";
$lang["vector_donate"] = "Donaciones";
$lang["vector_mdtemplatefordw"] = "Plantilla vector para DokuWiki";
$lang["vector_recentchanges"] = "Cambios recientes";


// English fallback labels for strings added after the original translation
$lang["vector_qrcodebox"] = "QR Code";
$lang["vector_sidebar"] = "Sidebar";
$lang["vector_qrcodebox_qrcode"] = "QR Code";
$lang["vector_qrcodebox_genforcurrentpage"] = "generated for current page";
$lang["vector_qrcodebox_urlofcurrentpage"] = "Current page as QR Code (scan for easy mobile access)";
$lang["vector_skip_to_content"] = "Skip to content";
$lang["vector_menu"] = "Menu";
