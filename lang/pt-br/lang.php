<?php

/**
 * Brazilian Portuguese language for the "vector" DokuWiki template
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
 * @author Fabio Reis <fabio.netsys@gmail.com>
 * @author viasnake <https://github.com/viasnake/>
 * @reviewer Daniel "Nerun" Rodrigues <danieldiasr@gmail.com>
 * @link https://github.com/viasnake/dokuwiki-template-vector
 * @link https://www.dokuwiki.org/config:lang
 * @link https://www.dokuwiki.org/devel:configuration
 */


//check if we are running within the DokuWiki environment
if (!defined("DOKU_INC")){
    die();
}

//tabs, personal tools and special links
$lang["vector_article"] = "Página";
$lang["vector_discussion"] = "Discussão";
$lang["vector_read"] = "Ler";
$lang["vector_edit"] = "Editar";
$lang["vector_create"] = "Criar";
$lang["vector_userpage"] = "Página do Usuário";
$lang["vector_mytalk"] = "Minha discussão";
$lang["vector_exportodt"] = "Exportar: ODT";
$lang["vector_exportpdf"] = "Exportar: PDF";
$lang["vector_translations"] = "Idiomas";

//headlines for the different bars and boxes
$lang["vector_navigation"] = "Navegação";
$lang["vector_toolbox"] = "Ferramentas";
$lang["vector_exportbox"] = "Imprimir/Exportar";
$lang["vector_qrcodebox"] = "Código QR";

//buttons
$lang["vector_btn_search_title"] = "Pesquisar nesta wiki";

//exportbox ("print/export")
$lang["vector_exportbxdef_print"] = "Versão para impressão";
$lang["vector_exportbxdef_downloadodt"] = "Download como ODT";
$lang["vector_exportbxdef_downloadpdf"] = "Download como PDF";

//default toolbox
$lang["vector_toolbxdef_whatlinkshere"] = "Páginas afluentes";
$lang["vector_toolbxdef_siteindex"] = "Índice";
$lang["vector_toolboxdef_permanent"] = "Link permanente";
$lang["vector_toolboxdef_cite"] = "Citar esta página";

//qr code box
$lang["vector_qrcodebox_qrcode"] = "Código QR";
$lang["vector_qrcodebox_genforcurrentpage"] = "gerado para a página atual";
$lang["vector_qrcodebox_urlofcurrentpage"] = "Página atual em Código QR (escaneie para facilitar acesso de aparelho móvel)";

//cite this article
$lang["vector_cite_bibdetailsfor"] = "Detalhes bibliográficos para";
$lang["vector_cite_pagename"] = "Nome da página";
$lang["vector_cite_author"] = "Autor";
$lang["vector_cite_publisher"] = "Editor";
$lang["vector_cite_dateofrev"] = "Data desta revisão";
$lang["vector_cite_dateretrieved"] = "Data encontrada";
$lang["vector_cite_permurl"] = "URL permanente";
$lang["vector_cite_pageversionid"] = "ID da versão da página";
$lang["vector_cite_citationstyles"] = "Estilos de citação para";
$lang["vector_cite_checkstandards"] = "Por favor, lembre-se de verificar no seu guia de padrões ou diretivas do seu professor pela sintaxe exata para as suas necessidades.";
$lang["vector_cite_latexusepackagehint"] = "Quando usar o pacote url LaTeX (\usepackage{url} em algum lugar no prefácio), que tende a dar muito mais bem formatada endereços da web, o seguinte pode ser preferido";
$lang["vector_cite_retrieved"] = "Encontrado";
$lang["vector_cite_from"] = "De";
$lang["vector_cite_in"] = "Em";
$lang["vector_cite_accessed"] = "Accessado";
$lang["vector_cite_cited"] = "Citado";
$lang["vector_cite_lastvisited"] = "Visitado por último";
$lang["vector_cite_availableat"] = "Disponível em";
$lang["vector_cite_discussionpages"] = "DokuWiki páginas de discussão";
$lang["vector_cite_markup"] = "Remarcação";
$lang["vector_cite_result"] = "Resultado";
$lang["vector_cite_thisversion"] = "esta versão";

//other
$lang["vector_search"] = "Procurar";
$lang["vector_fillplaceholder"] = "Preencha o espaço reservado";
$lang["vector_donate"] = "Doações";
$lang["vector_mdtemplatefordw"] = "template vector para DokuWiki";
$lang["vector_recentchanges"] = "Alterações Recentes";


// English fallback labels for strings added after the original translation
$lang["vector_sidebar"] = "Sidebar";
$lang["vector_skip_to_content"] = "Skip to content";
$lang["vector_menu"] = "Menu";
