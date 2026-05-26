<?php

/**
 * Russian language for the "Vector" DokuWiki template
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
 * @author anarchist IVANOV <ivanov@anarhist.org>
 * @author Aleksandr Selivanov <alexgearbox@gmail.com>
 * @author viasnake <https://github.com/viasnake/>
 * @link https://github.com/viasnake/dokuwiki-template-vector
 * @link https://www.dokuwiki.org/config:lang
 * @link https://www.dokuwiki.org/devel:configuration
 */


//check if we are running within the DokuWiki environment
if (!defined("DOKU_INC")) {
    die();
}

//пользовательские страницы
$lang['vector_userpage']                  = 'Добавить пользовательские страницы?';
$lang['vector_userpage_ns']               = 'Если &laquo;Да&raquo;, использовать следующее &laquo;:пространство_имён:&raquo; как корневое для пользовательских страниц:';

//страницы обсуждений
$lang['vector_discuss']                   = 'Использовать вкладки/страницы обсуждений?';
$lang['vector_discuss_ns']                = 'Если &laquo;Да&raquo;, использовать следующее &laquo;:пространство_имён:&raquo; как корневое для страниц обсуждений:';

//уведомления сайта
$lang['vector_sitenotice']                = 'Показывать уведомления сайта?';
$lang['vector_sitenotice_location']       = 'Если &laquo;Да&raquo;, использовать следующую страницу вики для уведомлений сайта:';

//навигация
$lang['vector_navigation']                = 'Показывать навигацию?';
$lang['vector_navigation_location']       = 'Если &laquo;Да&raquo;, использовать следующую страницу вики для создания навигации:';

//блок экспорта (печать/экспорт)
$lang['vector_exportbox']                 = 'Показывать блок &laquo;печать/экспорт&raquo;?';
$lang['vector_exportbox_default']         = 'Если &laquo;Да&raquo;, использовать блок &laquo;печать/экспорт&raquo; по&nbsp;умолчанию?';
$lang['vector_exportbox_location']        = 'Если не&nbsp;задействован блок по&nbsp;умолчанию, используйте следующую страницу вики как блок &laquo;печать/экспорт&raquo;:';

//инструменты
$lang['vector_toolbox']                   = 'Показывать инструменты?';
$lang['vector_toolbox_default']           = 'Если &laquo;Да&raquo;, использовать панель инструментов по&nbsp;умолчанию?';
$lang['vector_toolbox_location']          = 'Если не&nbsp;задействована панель по&nbsp;умолчанию, используйте следующую страницу вики как панель инструментов:';

//QR code box
$lang['vector_qrcodebox']              = 'Show a box with a QR code for the current wiki page URL? This uses an external QR code service.';
//уведомления об авторских правах
$lang['vector_copyright']                 = 'Показывать уведомления об&nbsp;авторских правах?';
$lang['vector_copyright_default']         = 'Если &laquo;Да&raquo;, использовать уведомления по умолчанию?';
$lang['vector_copyright_location']        = 'Если &laquo;Нет&raquo;, использовать следующую страницу вики для уведомления об&nbsp;авторских правах:';

//ссылка/кнопка пожертвований
$lang['vector_donate']                    = 'Показывать ссылку/кнопку пожертвований?';
$lang['vector_donate_url']                = 'HTTPS donation URL:';

//TOC (список содержания страницы)
$lang['vector_toc_position']              = 'Расположение списка содержания страниц (TOC)';

//прочее
$lang['vector_breadcrumbs_position']      = 'Позиция навигационной цепочки (если включено):';
$lang['vector_youarehere_position']       = 'Расположение панели &laquo;Вы&nbsp;находитесь здесь&raquo; (если включено):';
$lang['vector_cite_author']               = 'Имя автора в&nbsp;&laquo;Цитировать страницу&raquo;:';
$lang['vector_loaduserjs']                = 'Подгружать &laquo;modernizedvector/user/user.js&raquo;?';
$lang['vector_closedwiki']                = 'Закрыть вики (большинство ссылок/вкладок/блоков будут скрыты от&nbsp;пользователя до&nbsp;входа)?';

$lang["vector_sitenotice_translate"] = "If yes and the Translation plugin is available, load a language-specific site-wide notice. The translated page id is the configured site notice page id followed by an underscore and ISO language code.";
$lang["vector_navigation_translate"] = "If yes and the Translation plugin is available, load language-specific navigation. The translated page id is the configured navigation page id followed by an underscore and ISO language code.";
$lang["vector_copyright_translate"] = "If not using the default and the Translation plugin is available, load a language-specific copyright notice. The translated page id is the configured copyright page id followed by an underscore and ISO language code.";

// English fallback labels for multichoice settings added after the original translation
$lang["vector_toc_position_o_article"] = "Article";
$lang["vector_toc_position_o_sidebar"] = "Sidebar";
$lang["vector_skin_version"] = "Vector design version";
$lang["vector_skin_version_o_2011"] = "Vector 2011";
$lang["vector_skin_version_o_2022"] = "Vector 2022";
$lang["vector_breadcrumbs_position_o_top"] = "Top";
$lang["vector_breadcrumbs_position_o_bottom"] = "Bottom";
$lang["vector_youarehere_position_o_top"] = "Top";
$lang["vector_youarehere_position_o_bottom"] = "Bottom";
