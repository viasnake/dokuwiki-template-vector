<?php

/**
 * Chinese (simplified) language for the Config Manager
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
 * @author LAINME <lainme993 [ät] gmail.com>
 * @author viasnake <https://github.com/viasnake/>
 * @link https://github.com/viasnake/dokuwiki-template-vector
 * @link https://www.dokuwiki.org/config:lang
 * @link https://www.dokuwiki.org/devel:configuration
 */


//check if we are running within the DokuWiki environment
if (!defined("DOKU_INC")){
    die();
}

//user pages
$lang["vector_userpage"]    = "使用用户页？";
$lang["vector_userpage_ns"] = "如果是，使用下列“:namespace:“作为用户页的根：";

//discussion pages
$lang["vector_discuss"]    = "使用讨论标签页/站点？";
$lang["vector_discuss_ns"] = "如果是，使用下列“:namespace:“作为讨论页的根：";

//site notice
$lang["vector_sitenotice"]          = "显示站点公告？";
$lang["vector_sitenotice_location"] = "如果是，使用下列wiki页面作为站点公告：";

//navigation
$lang["vector_navigation"]          = "显示导航？";
$lang["vector_navigation_location"] = "如果是，使用下列wiki页面作为导航：";

//exportbox ("print/export")
$lang["vector_exportbox"]          = "显示“打印/导出”栏？";
$lang["vector_exportbox_default"]  = "如果是，使用默认的“打印/导出”栏？";
$lang["vector_exportbox_location"] = "如果不是默认，使用下列wiki页面作为“打印/导出“栏位置：";

//toolbox
$lang["vector_toolbox"]          = "显示工具？";
$lang["vector_toolbox_default"]  = "如果是，使用默认工具？";
$lang["vector_toolbox_location"] = "如果不是默认，使用下列wiki页面作为工具位置：";

//qr code box
$lang["vector_qrcodebox"] = "Show a box with a QR code for the current wiki page URL? This uses an external QR code service.";
//custom copyright notice
$lang["vector_copyright"]          = "显示版权信息？";
$lang["vector_copyright_default"]  = "如果是，使用默认的版权信息？";
$lang["vector_copyright_location"] = "如果不是默认，使用下列wiki页面作为版权信息：";

//donation link/button
$lang["vector_donate"]          = "显示捐赠链接/按钮？";
$lang["vector_donate_url"]      = "HTTPS donation URL:";

//TOC
$lang["vector_toc_position"] = "目录位置";

//other stuff
$lang["vector_breadcrumbs_position"]  = "足迹导航的位置（如果激活的话）：";
$lang["vector_youarehere_position"]   = "“您在这里“导航的位置（如果激活的话）：";
$lang["vector_cite_author"]           = "“引用此文“中的作者姓名：";
$lang["vector_loaduserjs"]            = "载入“modernizedvector/user/user.js“？";
$lang["vector_closedwiki"]            = "封闭wiki(许多链接/标签/栏是隐藏的，直到用户登录)？";

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
