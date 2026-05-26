<?php

/**
 * DokuWiki Media Manager Popup
 *
 * NOTE: Based on the mediamanager.php out of the "starter" template by
 *       Anika Henke.
 *
 *
 * LICENSE: This file is open source software (OSS) and may be copied under
 *          certain conditions. See COPYING file for details or try to contact
 *          the author(s) of this file in doubt.
 *
 * @license GPLv2 (https://www.gnu.org/licenses/gpl-2.0.html)
 * @author ARSAVA <dokuwiki@dev.arsava.com>
 * @author viasnake <https://github.com/viasnake/>
 * @link https://github.com/viasnake/dokuwiki-template-vector
 * @link https://www.dokuwiki.org/devel:templates
 */

//check if we are running within the DokuWiki environment
if (!defined("DOKU_INC")) {
    die();
}
if (!function_exists("_vector_includeFile")) {
    /**
     * Include an optional template hook file through DokuWiki.
     *
     * @param string $file
     * @return void
     */
    function _vector_includeFile($file)
    {
        tpl_includeFile($file);
    }
}

if (!function_exists("_vector_string")) {
    /**
     * Return a scalar value as string, otherwise a default.
     *
     * @param mixed $value
     * @param string $default
     * @return string
     */
    function _vector_string($value, $default = "")
    {
        if (!is_scalar($value)) {
            return $default;
        }
        return (string)$value;
    }
}

if (!function_exists("_vector_getLang")) {
    /**
     * Get a language string with scalar fallback.
     *
     * @param mixed $id
     * @param mixed $default
     * @return string
     */
    function _vector_getLang($id, $default = null)
    {
        global $lang;
        if (!is_scalar($id)) {
            return is_scalar($default) ? (string)$default : "";
        }
        $id = (string)$id;
        if (function_exists("tpl_getLang")) {
            $value = tpl_getLang($id);
            if (is_scalar($value) && (string)$value !== "") {
                return (string)$value;
            }
        }
        return (isset($lang[$id]) && is_scalar($lang[$id])) ? (string)$lang[$id] : (is_scalar($default) ? (string)$default : $id);
    }
}

$vector_lang = preg_replace("/[^A-Za-z0-9_-]/", "", _vector_string($conf["lang"] ?? "en", "en"));
if ($vector_lang === "") {
    $vector_lang = "en";
}
$vector_direction = (_vector_getLang("direction", "ltr") === "rtl") ? "rtl" : "ltr";
?><!DOCTYPE html>
<html lang="<?php echo hsc($vector_lang); ?>" dir="<?php echo hsc($vector_direction); ?>" class="no-js popup">
<head>
<meta charset="utf-8">
<title><?php echo hsc(_vector_getLang("mediaselect", "Media Manager"));
echo " - ".hsc(strip_tags(_vector_string($conf["title"] ?? ""))); ?></title>
<?php
//show meta-tags
tpl_metaheaders();
echo "<meta name=\"viewport\" content=\"width=device-width,initial-scale=1\">\n";
_vector_includeFile("meta.html");

//include default or user-defined icons
$vector_favicon = "";
$vector_favicon_type = "";
foreach (array("user/favicon.svg" => "image/svg+xml", "user/favicon.png" => "image/png", "user/favicon.ico" => "image/x-icon") as $vector_favicon_file => $vector_icon_type) {
    if (file_exists(tpl_incdir().$vector_favicon_file)) {
        $vector_favicon = tpl_basedir().$vector_favicon_file;
        $vector_favicon_type = $vector_icon_type;
        break;
    }
}
if ($vector_favicon === "") {
    foreach (array(":wiki:favicon.svg" => "image/svg+xml", ":favicon.svg" => "image/svg+xml", ":wiki:favicon.png" => "image/png", ":favicon.png" => "image/png", ":wiki:favicon.ico" => "image/x-icon", ":favicon.ico" => "image/x-icon") as $vector_favicon_file => $vector_icon_type) {
        $vector_icon_info = null;
        $vector_favicon_candidate = tpl_getMediaFile(array($vector_favicon_file), false, $vector_icon_info, false);
        if ($vector_favicon_candidate !== false) {
            $vector_favicon = $vector_favicon_candidate;
            $vector_favicon_type = $vector_icon_type;
            break;
        }
    }
}
if ($vector_favicon === "") {
    $vector_favicon = tpl_basedir()."static/3rd/dokuwiki/favicon.ico";
    $vector_favicon_type = "image/x-icon";
}
echo "\n<link rel=\"icon\" href=\"".hsc($vector_favicon)."\" type=\"".hsc($vector_favicon_type)."\">\n";

$vector_apple_touch_icon = "";
if (file_exists(tpl_incdir()."user/apple-touch-icon.png")) {
    $vector_apple_touch_icon = tpl_basedir()."user/apple-touch-icon.png";
} else {
    $vector_icon_info = null;
    $vector_apple_touch_icon = tpl_getMediaFile(array(":wiki:apple-touch-icon.png", ":apple-touch-icon.png"), false, $vector_icon_info, false);
}
if ($vector_apple_touch_icon === "" || $vector_apple_touch_icon === false) {
    $vector_apple_touch_icon = tpl_basedir()."static/3rd/dokuwiki/apple-touch-icon.png";
}
echo "<link rel=\"apple-touch-icon\" href=\"".hsc($vector_apple_touch_icon)."\">\n";
unset($vector_apple_touch_icon, $vector_favicon, $vector_favicon_candidate, $vector_favicon_file, $vector_favicon_type, $vector_icon_info, $vector_icon_type);

//load user-defined js?
if (tpl_getConf("vector_loaduserjs") && file_exists(tpl_incdir()."user/user.js")) {
    echo "<script src=\"".hsc(tpl_basedir()."user/user.js")."\"".(!empty($conf["defer_js"]) ? " defer" : "")."></script>\n";
}

//load right-to-left overrides when needed
if ($vector_direction === "rtl") {
    printf('<link rel="stylesheet" media="all" href="%s">%s', hsc(tpl_basedir()."static/3rd/vector/main-rtl.css"), "\n");
    printf('<link rel="stylesheet" media="all" href="%s">%s', hsc(tpl_basedir()."static/css/rtl.css"), "\n");
}

//load language-specific custom CSS?
$vector_lang_style = tpl_incdir()."lang/".$vector_lang."/style.css";
if (is_readable($vector_lang_style) && filesize($vector_lang_style) > 0) {
    printf('<link rel="stylesheet" media="all" href="%s">%s', hsc(tpl_basedir()."lang/".$vector_lang."/style.css"), "\n");
}
unset($vector_lang_style);

//load user-defined CSS only when it exists
if (file_exists(tpl_incdir()."user/screen.css")) {
    printf('<link rel="stylesheet" media="screen" href="%s">%s', hsc(tpl_basedir()."user/screen.css"), "\n");
}
if (file_exists(tpl_incdir()."user/print.css")) {
    printf('<link rel="stylesheet" media="print" href="%s">%s', hsc(tpl_basedir()."user/print.css"), "\n");
}
if ($vector_direction === "rtl" && file_exists(tpl_incdir()."user/rtl.css")) {
    printf('<link rel="stylesheet" media="all" href="%s">%s', hsc(tpl_basedir()."user/rtl.css"), "\n");
}
?>
</head>
<body>
    <div id="media__manager" class="dokuwiki">
        <?php html_msgarea() ?>
        <nav id="mediamgr__aside"><div class="pad">
            <h1><?php echo hsc(_vector_getLang("mediaselect", "Media Manager"))?></h1>

            <?php /* keep the id! additional elements are inserted via JS here */?>
            <div id="media__opts"></div>

            <?php tpl_mediaTree() ?>
        </div></nav>

        <main id="mediamgr__content"><div class="pad">
            <?php tpl_mediaContent() ?>
        </div></main>
    </div>
</body>
</html>
