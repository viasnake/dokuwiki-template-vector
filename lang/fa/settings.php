<?php

/**
 * Persian language for the Config Manager
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
 * LICENSE: This file is free software and may be copied under
 *          certain conditions. See COPYING file for details or try to contact
 *          the author(s) of this file in doubt.
 *
 * @license GPLv2 (https://www.gnu.org/licenses/gpl-2.0.html)
 * @author Salman Mohammadi <salman@shimool.org>
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
$lang["vector_userpage"]    = "از صفحه‌ی کاربر استفاده شود؟";
$lang["vector_userpage_ns"] = "اگر بله، از :namespace: زیر به عنوان ریشه برای صفحه‌های کاربرها استفاده کن:";

//discussion pages
$lang["vector_discuss"]    = "از وب‌گاه‌های/برگه‌های بحث استفاده شود؟";
$lang["vector_discuss_ns"] = "اگر بله، از :namespace: زیر به عنوان ریشه یرای صفحه‌های بحث استفاده کن:";

//site notice
$lang["vector_sitenotice"]          = "آیا از اعلامیه‌ی سراسری در وب‌گاه استفاده شود؟";
$lang["vector_sitenotice_location"] = ":اگر بله، از صفحه‌ی ویکی زیر برای اعلامیه‌ی سراسری در وب‌گاه استفاده کن";

//navigation
$lang["vector_navigation"]           = "ناوبری نشان داده شود؟";
$lang["vector_navigation_location"]  = ":اگر بله، از صفحه‌ی ویکی زیر برای ناوبری استفاده کن";
$lang["vector_navigation_translate"] = "اگر بله و <a href=\"https://www.dokuwiki.org/plugin:translation\">Translation plugin</a> در دسترس بود: آیا آیا از ناوبری مخصوص هر زبان استفاده شود؟<br>صفحه‌ی ویرایش برای ناوبری(های) ترجمه شده به مانند روبرو است [مقدار 'vector_navigation_location']_[iso lang code] (مثلا ':wiki:navigation_fa').";

//exportbox ("print/export")
$lang["vector_exportbox"]          = "جعبه‌ی «چاپ/برون‌ریزی را نشان دهد؟?";
$lang["vector_exportbox_default"]  = "اگر بله، از جعبه‌ی «چاپ/برون‌ریزی» پیش‌فرض استفاده کند؟";
$lang["vector_exportbox_location"] = "اگر نمی‌خواهید از پیش‌فرض استفاده کند، از صفحه‌ی ویکی زیر به عنوان مکان «چاپ/برون‌ریزی» استفاده کند.";

//toolbox
$lang["vector_toolbox"]          = "جعبه‌ابزار را نشان دهد؟";
$lang["vector_toolbox_default"]  = "اگر بله، از جعبه‌‌ابزار  پیش‌فرض استفاده کند؟";
$lang["vector_toolbox_location"] = "اگر نمی‌خواهید از پیش‌فرض استفاده کند، از صفحه‌ی ویکی زیر به عنوان مکان جعبه‌ابزار استفاده کند.";

//qr code box
$lang["vector_qrcodebox"] = "Show a box with a QR code for the current wiki page URL? This uses an external QR code service.";
//custom copyright notice
$lang["vector_copyright"]          = "آیا اعلامیه‌ی حق‌کپی را نشان دهد؟";
$lang["vector_copyright_default"]  = "اگر بله، از اعلامیه‌ی حق کپی پیش‌فرض استفاده کند؟";
$lang["vector_copyright_location"] = "اگر نمی‌خواهید از پیش‌فرض استفاده کند، از صفحه‌ی ویکی زیر به عنوان اعلامیه‌ی حق‌کپی استفاده کند.";

//donation link/button
$lang["vector_donate"]          = "پیوند/دکمه‌ی اهدا را نشان دهد؟";
$lang["vector_donate_url"]      = "HTTPS donation URL:";

//TOC
$lang["vector_toc_position"] = "موقعیت فهرست مطالب";

//other stuff
$lang["vector_breadcrumbs_position"]  = "موقعیت ناوبری بردکرامب (اگر فعال شده باشد):";
$lang["vector_youarehere_position"]   = "موقعیت «شما اینجا هستید» (اگر فعال شده باشد):";
$lang["vector_cite_author"]           = "نام نویسنده در «یادکرد این مقاله«";
$lang["vector_loaduserjs"]            = "آیا 'modernizedvector/user/user.js' را بارگذاری کند؟";
$lang["vector_closedwiki"]            = " ویکی بسته‌شده (بیشتر پیوندها/برگه‌ها/جعبه‌ها تا زمانی که کاربر وارد حساب کاربری خود شود، به صورت مخفی است)";
$lang["vector_sitenotice_translate"] = "If yes and the Translation plugin is available, load a language-specific site-wide notice. The translated page id is the configured site notice page id followed by an underscore and ISO language code.";
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
