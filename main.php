<?php

/**
 * Main file of the "vector" template for DokuWiki
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
 * @link https://www.dokuwiki.org/devel:coding_style
 * @link https://www.dokuwiki.org/devel:environment
 * @link https://www.dokuwiki.org/devel:action_modes
 */


//check if we are running within the DokuWiki environment
if (!defined("DOKU_INC")) {
    die();
}

if (!function_exists("_vector_getLang")) {
    /**
     * Get a template language string using DokuWiki cascade-aware loading.
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

if (!function_exists("_vector_isSafeHref")) {
    /**
     * Check whether an href can be emitted by template-managed links.
     *
     * @param mixed $href
     * @return bool
     */
    function _vector_isSafeHref($href)
    {
        if (!is_scalar($href)) {
            return false;
        }
        $href = trim((string)$href);
        if ($href === "" || preg_match('/[\x00-\x20]/', $href) || strpos($href, "//") === 0) {
            return false;
        }
        $scheme = parse_url($href, PHP_URL_SCHEME);
        if ($scheme === null || $scheme === false || $scheme === "") {
            return true;
        }
        return in_array(strtolower($scheme), array("http", "https", "ftp", "mailto"), true);
    }
}

if (!function_exists("_vector_isSafeSrc")) {
    /**
     * Check whether a src URL can be emitted by template-managed images.
     *
     * @param mixed $src
     * @return bool
     */
    function _vector_isSafeSrc($src)
    {
        if (!is_scalar($src)) {
            return false;
        }
        $src = trim((string)$src);
        if ($src === "" || preg_match('/[\x00-\x20]/', $src) || strpos($src, "//") === 0) {
            return false;
        }
        $scheme = parse_url($src, PHP_URL_SCHEME);
        if ($scheme === null || $scheme === false || $scheme === "") {
            return true;
        }
        return in_array(strtolower($scheme), array("http", "https", "ftp"), true);
    }
}
if (!function_exists("_vector_isValidHtmlId")) {
    /**
     * Check whether a template-managed HTML id is valid and CSS-friendly.
     *
     * @param mixed $id
     * @return bool
     */
    function _vector_isValidHtmlId($id)
    {
        if (!is_scalar($id)) {
            return false;
        }
        return preg_match("/^[A-Za-z][A-Za-z0-9_-]*$/", (string)$id) === 1;
    }
}

if (!function_exists("_vector_normalizeClassList")) {
    /**
     * Normalize an optional class list for template-managed elements.
     *
     * @param mixed $class
     * @return false|string
     */
    function _vector_normalizeClassList($class)
    {
        if (!is_scalar($class)) {
            return false;
        }
        $class = trim((string)$class);
        if ($class === "" || preg_match("/^[A-Za-z0-9_-]+(?:[[:space:]]+[A-Za-z0-9_-]+)*$/", $class) !== 1) {
            return false;
        }
        return preg_replace("/[[:space:]]+/", " ", $class);
    }
}

if (!function_exists("_vector_normalizeAccessKey")) {
    /**
     * Normalize an optional accesskey for template-managed links.
     *
     * @param mixed $accesskey
     * @return false|string
     */
    function _vector_normalizeAccessKey($accesskey)
    {
        if (!is_scalar($accesskey)) {
            return false;
        }
        $accesskey = trim((string)$accesskey);
        if (preg_match("/^[A-Za-z0-9]$/", $accesskey) !== 1) {
            return false;
        }
        return $accesskey;
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

if (!function_exists("_vector_wl")) {
    /**
     * Build a DokuWiki URL with raw separators so attributes are escaped once.
     *
     * @param string $id
     * @param mixed $params
     * @param bool $absolute
     * @return string
     */
    function _vector_wl($id = "", $params = "", $absolute = false)
    {
        return wl($id, $params, $absolute, "&");
    }
}


if (!function_exists("_vector_cleanPageId")) {
    /**
     * Normalize an optional DokuWiki page id from template configuration.
     *
     * @param mixed $id
     * @return string
     */
    function _vector_cleanPageId($id)
    {
        if (!is_scalar($id)) {
            return "";
        }
        return cleanID((string)$id);
    }
}

if (!function_exists("_vector_cleanTranslatedPageId")) {
    /**
     * Normalize a translated page id built from a base page id and suffix.
     *
     * @param mixed $id
     * @param mixed $suffix
     * @return string
     */
    function _vector_cleanTranslatedPageId($id, $suffix)
    {
        $id = _vector_cleanPageId($id);
        if ($id === "" || !is_scalar($suffix)) {
            return $id;
        }
        $suffix = cleanID((string)$suffix);
        if ($suffix === "") {
            return $id;
        }
        return _vector_cleanPageId($id."_".$suffix);
    }
}

if (!function_exists("_vector_cleanNamespace")) {
    /**
     * Normalize an optional DokuWiki namespace from template configuration.
     *
     * @param mixed $namespace
     * @return string
     */
    function _vector_cleanNamespace($namespace)
    {
        if (!is_scalar($namespace)) {
            return "";
        }
        return cleanID(trim((string)$namespace, ":"));
    }
}

if (!function_exists("_vector_getTranslationPart")) {
    /**
     * Return the current translation language part when the plugin state is usable.
     *
     * @param mixed $transplugin
     * @return string
     */
    function _vector_getTranslationPart($transplugin)
    {
        if (!is_object($transplugin) ||
            !method_exists($transplugin, "getLangPart") ||
            !method_exists($transplugin, "getConf")) {
            return "";
        }

        $langcur = $transplugin->getLangPart(cleanID(getID()));
        $translations = $transplugin->getConf("translations");
        if (!is_scalar($langcur) || !is_scalar($translations)) {
            return "";
        }

        $langcur = strtolower(trim((string)$langcur));
        if ($langcur === "") {
            return "";
        }

        $langs = preg_split("/[\\s,]+/", strtolower(trim((string)$translations)), -1, PREG_SPLIT_NO_EMPTY);
        if (!is_array($langs) || !in_array($langcur, $langs, true)) {
            return "";
        }

        return $langcur;
    }
}
if (!function_exists("_vector_getTranslationPlugin")) {
    /**
     * Load the translation plugin helper when it is available.
     *
     * @return false|object
     */
    function _vector_getTranslationPlugin()
    {
        if (!function_exists("plugin_isdisabled") ||
            !function_exists("plugin_load") ||
            plugin_isdisabled("translation")) {
            return false;
        }

        $plugin = plugin_load("helper", "translation");
        return is_object($plugin) ? $plugin : false;
    }
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

if (!function_exists("_vector_getMenuItems")) {
    /**
     * Return DokuWiki menu items when the current core provides the menu API.
     *
     * @param string $menuClass Fully qualified DokuWiki menu class name
     * @return array
     */
    function _vector_getMenuItems($menuClass)
    {
        if (!is_string($menuClass) || !class_exists($menuClass)) {
            return array();
        }
        try {
            $menu = new $menuClass();
            if (!is_object($menu) || !method_exists($menu, "getItems")) {
                return array();
            }
            $items = $menu->getItems();
        } catch (\Throwable $ignored) {
            return array();
        }

        return is_array($items) ? $items : array();
    }
}

if (!function_exists("_vector_menuItemId")) {
    /**
     * Build a stable Vector-compatible HTML id from a DokuWiki menu item type.
     *
     * @param string $prefix
     * @param mixed $type
     * @return string
     */
    function _vector_menuItemId($prefix, $type)
    {
        if (!is_scalar($prefix) || !is_scalar($type)) {
            return "";
        }
        $id = strtolower(preg_replace("/[^A-Za-z0-9_-]+/", "-", trim((string)$type)));
        $id = trim($id, "-_");
        if ($id === "") {
            return "";
        }
        $id = (string)$prefix.$id;
        return _vector_isValidHtmlId($id) ? $id : "";
    }
}

if (!function_exists("_vector_menuItemData")) {
    /**
     * Convert a DokuWiki menu item into sanitized scalar data.
     *
     * @param mixed $item
     * @param string[] $excludeTypes
     * @return false|array
     */
    function _vector_menuItemData($item, $excludeTypes = array())
    {
        if (!is_object($item) ||
            !method_exists($item, "getType") ||
            !method_exists($item, "getLabel") ||
            !method_exists($item, "getLink")) {
            return false;
        }

        $type = $item->getType();
        $label = $item->getLabel();
        $href = $item->getLink();
        if (!is_scalar($type) ||
            !is_scalar($label) ||
            !is_scalar($href) ||
            trim((string)$label) === "" ||
            !_vector_isSafeHref($href)) {
            return false;
        }

        $type = strtolower(trim((string)$type));
        if (in_array($type, array_map("strtolower", $excludeTypes), true)) {
            return false;
        }

        $data = array(
            "type" => $type,
            "text" => trim((string)$label),
            "href" => trim((string)$href),
            "nofollow" => method_exists($item, "isNofollow") && $item->isNofollow()
        );
        if (method_exists($item, "getAccesskey")) {
            $accesskey = _vector_normalizeAccessKey($item->getAccesskey());
            if ($accesskey !== false) {
                $data["accesskey"] = $accesskey;
            }
        }
        if (method_exists($item, "getTitle")) {
            $title = $item->getTitle();
            if (is_scalar($title) && trim((string)$title) !== "") {
                $data["title"] = trim((string)$title);
            }
        }

        return $data;
    }
}

if (!function_exists("_vector_appendMenuItemsAsTabs")) {
    /**
     * Append DokuWiki menu items to a Vector tab collection.
     *
     * @param array $tabs
     * @param string $menuClass
     * @param string[] $excludeTypes
     * @param string $idPrefix
     * @return void
     */
    function _vector_appendMenuItemsAsTabs(&$tabs, $menuClass, $excludeTypes, $idPrefix)
    {
        if (!is_array($tabs)) {
            $tabs = array();
        }
        foreach (_vector_getMenuItems($menuClass) as $item) {
            $data = _vector_menuItemData($item, $excludeTypes);
            if ($data === false) {
                continue;
            }
            $id = _vector_menuItemId($idPrefix, $data["type"]);
            if ($id === "" || isset($tabs[$id])) {
                continue;
            }

            $tabs[$id] = array(
                "text" => $data["text"],
                "href" => $data["href"],
                "nofollow" => $data["nofollow"]
            );
            if (isset($data["accesskey"])) {
                $tabs[$id]["accesskey"] = $data["accesskey"];
            }
        }
    }
}

if (!function_exists("_vector_menuItemsToListItems")) {
    /**
     * Render DokuWiki menu items as Vector sidebar/personal tool list items.
     *
     * @param string $menuClass
     * @param string[] $excludeTypes
     * @param string $idPrefix
     * @return string
     */
    function _vector_menuItemsToListItems($menuClass, $excludeTypes, $idPrefix)
    {
        $html = "";
        foreach (_vector_getMenuItems($menuClass) as $item) {
            $data = _vector_menuItemData($item, $excludeTypes);
            if ($data === false) {
                continue;
            }
            $id = _vector_menuItemId($idPrefix, $data["type"]);
            if ($id === "") {
                continue;
            }

            $html .= "      <li id=\"".hsc($id)."\"><a href=\"".hsc($data["href"])."\"";
            if (!empty($data["nofollow"])) {
                $html .= " rel=\"nofollow\"";
            }
            if (isset($data["accesskey"])) {
                $html .= " accesskey=\"".hsc($data["accesskey"])."\" title=\"[ALT+".hsc(strtoupper($data["accesskey"]))."]\"";
            } elseif (isset($data["title"]) && $data["title"] !== $data["text"]) {
                $html .= " title=\"".hsc($data["title"])."\"";
            }
            $html .= ">".hsc($data["text"])."</a></li>\n";
        }

        return $html;
    }
}

if (!function_exists("_vector_appendMenuItemsToBox")) {
    /**
     * Append DokuWiki menu items to an existing Vector sidebar box.
     *
     * @param array $boxes
     * @param string $boxId
     * @param string $menuClass
     * @param string[] $excludeTypes
     * @param string $idPrefix
     * @return void
     */
    function _vector_appendMenuItemsToBox(&$boxes, $boxId, $menuClass, $excludeTypes, $idPrefix)
    {
        $items = _vector_menuItemsToListItems($menuClass, $excludeTypes, $idPrefix);
        if ($items === "") {
            return;
        }
        if (!isset($boxes[$boxId]) || !is_array($boxes[$boxId])) {
            $boxes[$boxId] = array("xhtml" => "      <ul>\n".$items."      </ul>");
            return;
        }
        if (!isset($boxes[$boxId]["xhtml"]) || !is_scalar($boxes[$boxId]["xhtml"])) {
            $boxes[$boxId]["xhtml"] = "      <ul>\n".$items."      </ul>";
            return;
        }

        $xhtml = (string)$boxes[$boxId]["xhtml"];
        $matches = array();
        if (preg_match("/\s*<\/ul>\s*$/i", $xhtml, $matches, PREG_OFFSET_CAPTURE)) {
            $boxes[$boxId]["xhtml"] = substr($xhtml, 0, $matches[0][1])."\n".$items."      </ul>";
        } else {
            $boxes[$boxId]["xhtml"] .= "\n      <ul>\n".$items."      </ul>";
        }
    }
}


/**
 * Stores the template wide action
 *
 * Different DokuWiki actions requiring some template logic. Therefore the
 * template has to know, what we are doing right now - and that is what this
 * var is for.
 *
 * Please have a look at the "detail.php" file in the same folder, it is also
 * influencing the var's value.
 *
 * @var string
 * @author ARSAVA <dokuwiki@dev.arsava.com>
 */
$vector_action = "article";
$vector_actions = array("article", "print", "detail", "cite");
if (isset($INPUT) &&
    is_object($INPUT) &&
    method_exists($INPUT, "valid")) {
    $vector_action = $INPUT->valid("vecdo", $vector_actions, "article");
}
if (!in_array($vector_action, $vector_actions, true)) {
    //ignore unknown values
    $vector_action = "article";
}
unset($vector_actions);
if ($vector_action === "detail" && (!isset($IMG) || !is_scalar($IMG) || (string)$IMG === "")) {
    $vector_action = "article";
}
if ($vector_action === "cite" && empty($INFO["exists"])) {
    $vector_action = "article";
}


/**
 * Stores the template wide context
 *
 * This template offers discussion pages via common articles, which should be
 * marked as "special". DokuWiki does not know any "special" articles, therefore
 * we have to take care about detecting if the current page is a discussion
 * page or not.
 *
 * @var string
 * @author ARSAVA <dokuwiki@dev.arsava.com>
 */
$vector_context = "article";
$vector_discuss_ns = _vector_cleanNamespace(tpl_getConf("vector_discuss_ns"));
$vector_userpage_ns = _vector_cleanNamespace(tpl_getConf("vector_userpage_ns"));
if (tpl_getConf("vector_discuss") && $vector_discuss_ns !== "" && preg_match("/^".preg_quote($vector_discuss_ns, "/")."(?::|$)/i", cleanID(getID()))) {
    $vector_context = "discuss";
}

/**
 * Stores the name the current client used to login
 *
 * @var string
 * @author ARSAVA <dokuwiki@dev.arsava.com>
 */
$loginname = "";
if (!empty($conf["useacl"])) {
    if (isset($INPUT) &&
        is_object($INPUT) &&
        isset($INPUT->server)) {
        $loginname = $INPUT->server->str("REMOTE_USER");
    }
}


//get current language and keep template strings available for legacy user config snippets
$vector_lang = preg_replace("/[^A-Za-z0-9_-]/", "", _vector_string($conf["lang"] ?? "en", "en"));
if ($vector_lang === "") {
    $vector_lang = "en";
}
include tpl_incdir()."lang/en/lang.php";
//mirror tpl_getLang() language cascade for direct $lang consumers
if (!empty($config_cascade["lang"]["template"]) &&
    is_array($config_cascade["lang"]["template"])) {
    foreach ($config_cascade["lang"]["template"] as $vector_lang_dir) {
        $vector_lang_file = $vector_lang_dir.$conf["template"]."/en/lang.php";
        if (file_exists($vector_lang_file)) {
            include $vector_lang_file;
        }
    }
}
//overwrite English language values with available translations for direct $lang access
if ($vector_lang !== "en" && file_exists(tpl_incdir()."lang/".$vector_lang."/lang.php")) {
    //get language file (partially translated language files are no problem
    //cause non translated stuff is still existing as English array value)
    include tpl_incdir()."lang/".$vector_lang."/lang.php";
}
if ($vector_lang !== "en" &&
    !empty($config_cascade["lang"]["template"]) &&
    is_array($config_cascade["lang"]["template"])) {
    foreach ($config_cascade["lang"]["template"] as $vector_lang_dir) {
        $vector_lang_file = $vector_lang_dir.$conf["template"]."/".$vector_lang."/lang.php";
        if (file_exists($vector_lang_file)) {
            include $vector_lang_file;
        }
    }
}
unset($vector_lang_dir, $vector_lang_file);
$vector_direction = (_vector_getLang("direction", "ltr") === "rtl") ? "rtl" : "ltr";
$vector_direction_class = ($vector_direction === "rtl") ? "rtl" : "ltr";
$vector_act = (isset($ACT) && is_scalar($ACT)) ? (string)$ACT : "show";
$vector_query = (isset($QUERY) && is_scalar($QUERY)) ? (string)$QUERY : "";
$vector_is_startpage = (cleanID(getID()) === cleanID(_vector_string($conf["start"] ?? "start", "start")));
$vector_skin_version = _vector_string(tpl_getConf("vector_skin_version"), "2011");
if (!in_array($vector_skin_version, array("2011", "2022"), true)) {
    $vector_skin_version = "2011";
}
$vector_toc_position = _vector_string(tpl_getConf("vector_toc_position"), "article");
if (!in_array($vector_toc_position, array("article", "sidebar"), true)) {
    $vector_toc_position = "article";
}
if ($vector_skin_version === "2022") {
    $vector_toc_position = "sidebar";
}


//detect revision
$rev = (int)($INFO["rev"] ?? 0); //$INFO comes from the DokuWiki core
if ($rev < 1) {
    $rev = (int)($INFO["lastmod"] ?? 0);
}


$_vector_tabs_left = array();
$_vector_tabs_right = array();
$_vector_boxes = array();
$_vector_btns = array();
$transplugin = _vector_getTranslationPlugin();

//get tab config
include tpl_incdir()."conf/tabs.php";  //default
if (empty($conf["useacl"]) ||
    $loginname !== "" ||
    !tpl_getConf("vector_closedwiki")) {
    if ($vector_action === "detail") {
        _vector_appendMenuItemsAsTabs(
            $_vector_tabs_right,
            "\\dokuwiki\\Menu\\DetailMenu",
            array("mediamanager", "img_backto", "top"),
            "ca-dw-detail-"
        );
    } else {
        _vector_appendMenuItemsAsTabs(
            $_vector_tabs_right,
            "\\dokuwiki\\Menu\\PageMenu",
            array("edit", "revisions", "backlink", "subscribe", "top"),
            "ca-dw-"
        );
    }
}
if (file_exists(tpl_incdir()."user/tabs.php")) {
    include tpl_incdir()."user/tabs.php"; //add user defined
}


//get boxes config
include tpl_incdir()."conf/boxes.php"; //default
if (tpl_getConf("vector_toolbox") &&
    tpl_getConf("vector_toolbox_default") &&
    isset($_vector_boxes["p-tb"])) {
    _vector_appendMenuItemsToBox(
        $_vector_boxes,
        "p-tb",
        "\\dokuwiki\\Menu\\SiteMenu",
        array("recent", "media", "index"),
        "t-dw-"
    );
}
if (file_exists(tpl_incdir()."user/boxes.php")) {
    include tpl_incdir()."user/boxes.php"; //add user defined
}


//get button config
include tpl_incdir()."conf/buttons.php"; //default
if (file_exists(tpl_incdir()."user/buttons.php")) {
    include tpl_incdir()."user/buttons.php"; //add user defined
}


/**
 * Helper to render the tabs (like a dynamic HTML snippet)
 *
 * @param array The tab data to render within the snippet. Each element is
 *        represented by a subarray:
 *        $array = array("tab1" => array("text"     => "hello world!",
 *                                       "href"     => "https://www.example.com",
 *                                       "nofollow" => true),
 *                       "tab2" => array("text"  => "I did it again",
 *                                       "href"  => wl("foobar", "", false, "&"),
 *                                       "class" => "foobar-css"),
 *                       "tab3" => array("text"  => "I did it again and again",
 *                                       "href"  => wl("start", "", false, "&"),
 *                                       "class" => "foobar-css"),
 *                       "tab4" => array("text"      => "Home",
 *                                       "wiki"      => ":start",
 *                                       "accesskey" => "H"));
 *        Available keys within the subarrays:
 *        - "text" (mandatory)
 *          The text/label of the element.
 *        - "href" (optional)
 *          URL the element should point to (as link). Provide a complete,
 *          valid href value; this function escapes it before output for
 *          security reasons. If the URL is absolute
 *          (= starts with http(s):// or ftp://), the URL will be treated as
 *          external (= a special style will be used if "class" is not set).
 *        - "wiki" (optional)
 *          ID of a WikiPage to link (like ":start" or ":wiki:foobar").
 *        - "class" (optional)
 *          Name of an additional CSS class to use for the list item.
 *          Works with either "href" or "wiki" links.
 *        - "nofollow" (optional)
 *          If set to TRUE, rel="nofollow" will be added to the link if "href"
 *          is set (otherwise this flag will do nothing).
 *        - "accesskey" (optional)
 *          accesskey="<value>" will be added to the link when a link is rendered
 *          (otherwise this option will do nothing).
 * @author ARSAVA <dokuwiki@dev.arsava.com>
 * @return bool
 * @see _vector_renderButtons()
 * @see _vector_renderBoxes()
 * @link https://en.wikipedia.org/wiki/Nofollow
 * @link https://wiki.selfhtml.org/wiki/HTML/Attribute/accesskey
 * @link https://www.dokuwiki.org/devel:environment
 * @link https://www.dokuwiki.org/devel:coding_style
 */
function _vector_renderTabs($arr)
{
    //is there something useful?
    if (empty($arr) ||
        !is_array($arr)) {
        return false; //nope, break operation
    }

    //array to store the created tabs into
    $elements = array();

    foreach ($arr as $li_id => $element) {
        //basic check
        if (empty($element) ||
            !is_array($element) ||
            !isset($element["text"]) ||
            !is_scalar($element["text"]) ||
            trim((string)$element["text"]) === "" ||
            (empty($element["href"]) &&
             empty($element["wiki"]))) {
            continue; //ignore invalid stuff and go on
        }
        if (!_vector_isValidHtmlId($li_id)) {
            continue;
        }
        $label = trim((string)$element["text"]);
        $li_class = "";
        $is_current = false;
        if (isset($element["class"])) {
            $li_class_value = _vector_normalizeClassList($element["class"]);
            if ($li_class_value !== false) {
                $li_class = " class=\"".hsc($li_class_value)."\"";
                $is_current = in_array("selected", explode(" ", $li_class_value), true);
            }
        }
        $accesskey = isset($element["accesskey"]) ? _vector_normalizeAccessKey($element["accesskey"]) : false;
        $interim = "";
        //do we have an external link?
        if (!empty($element["href"])) {
            if (!_vector_isSafeHref($element["href"])) {
                continue;
            }
            $href = trim((string)$element["href"]);
            //add URL
            $interim = "<a href=\"".hsc($href)."\"";
            if ($is_current) {
                $interim .= " aria-current=\"page\"";
            }
            //add rel="nofollow" attribute to the link?
            if (!empty($element["nofollow"])) {
                $interim .= " rel=\"nofollow\"";
            }
            //mark external link?
            if (preg_match("/^(?:https?|ftp):\/\//i", $href)) {
                $interim .= " class=\"urlextern\"";
            }
            //add access key?
            if ($accesskey !== false) {
                $interim .= " accesskey='".hsc($accesskey)."' title='[ALT+".hsc(strtoupper($accesskey))."]'";
            }
            $interim .= "><span>".hsc($label)."</span></a>";
            //internal wiki link
        } elseif (!empty($element["wiki"])) {
            if (!is_scalar($element["wiki"])) {
                continue;
            }
            $wiki = cleanID((string)$element["wiki"]);
            if ($wiki === "") {
                continue;
            }
            $interim = "<a href='".hsc(_vector_wl($wiki))."'";
            if ($is_current) {
                $interim .= " aria-current=\"page\"";
            }
            if ($accesskey !== false) {
                $interim .= " accesskey='".hsc($accesskey)."' title='[ALT+".hsc(strtoupper($accesskey))."]'";
            }
            $interim .= "><span>".hsc($label)."</span></a>";
        }
        //store it
        $elements[] = "\n        <li id=\"".hsc((string)$li_id)."\"".$li_class.">".$interim."</li>";
    }

    //show everything created
    if (!empty($elements)) {
        foreach ($elements as $element) {
            echo $element;
        }
    }
    return true;
}


/**
 * Helper to render the boxes (like a dynamic HTML snippet)
 *
 * @param array The box data to render within the snippet. Each box is
 *        represented by a subarray:
 *        $array = array("box-id1" => array("headline" => "hello world!",
 *                                          "xhtml"    => "I am <i>here</i>."));
 *        Available keys within the subarrays:
 *        - "xhtml" (mandatory)
 *          The content of the Box you want to show as HTML. Attention: YOU
 *          HAVE TO TAKE CARE ABOUT FILTER EVENTUALLY USED INPUT/SECURITY. Be
 *          aware of XSS and stuff.
 *        - "headline" (optional)
 *          Headline to show above the box. Leave empty/do not set for none.
 * @author ARSAVA <dokuwiki@dev.arsava.com>
 * @return bool
 * @see _vector_renderButtons()
 * @see _vector_renderTabs()
 * @link https://en.wikipedia.org/wiki/Nofollow
 * @link https://en.wikipedia.org/wiki/Cross-site_scripting
 * @link https://www.dokuwiki.org/devel:coding_style
 */
function _vector_renderBoxes($arr)
{
    //is there something useful?
    if (empty($arr) ||
        !is_array($arr)) {
        return false; //nope, break operation
    }

    //array to store the created boxes into
    $boxes = array();

    //handle the box data
    foreach ($arr as $div_id => $contents) {
        //basic check
        if (empty($contents) ||
            !is_array($contents) ||
            !isset($contents["xhtml"]) ||
            !is_scalar($contents["xhtml"])) {
            continue; //ignore invalid stuff and go on
        }
        if (!_vector_isValidHtmlId($div_id)) {
            continue;
        }
        $xhtml = trim((string)$contents["xhtml"]);
        if ($xhtml === "" || preg_match("/^<ul>\s*<\/ul>$/i", $xhtml)) {
            continue;
        }
        $box_id = hsc((string)$div_id);
        $headline_id = $box_id."-label";
        $has_headline = isset($contents["headline"])
            && $contents["headline"] !== ""
            && is_scalar($contents["headline"]);
        $interim  = "  <div id=\"".$box_id."\" class=\"portal\"".($has_headline ? " aria-labelledby=\"".$headline_id."\"" : "").">\n";
        if ($has_headline) {
            $interim .= "    <h5 id=\"".$headline_id."\">".hsc($contents["headline"])."</h5>\n";
        }
        $interim .= "    <div class=\"body\">\n"
                   ."      <div class=\"dokuwiki\">\n" //dokuwiki CSS class needed cause we might have to show rendered page content
                   .$xhtml."\n"
                   ."      </div>\n"
                   ."    </div>\n"
                   ."  </div>\n";
        //store it
        $boxes[] = $interim;
    }
    //show everything created
    if (!empty($boxes)) {
        echo  "\n";
        foreach ($boxes as $box) {
            echo $box;
        }
        echo  "\n";
    }

    return true;
}


/**
 * Helper to render the footer buttons (like a dynamic HTML snippet)
 *
 * @param array The button data to render within the snippet. Each element is
 *        represented by a subarray:
 *        $array = array("btn1" => array("img"      => tpl_basedir()."static/img/button-vector.png",
 *                                       "href"     => "https://github.com/viasnake/dokuwiki-template-vector",
 *                                       "width"    => 80,
 *                                       "height"   => 15,
 *                                       "title"    => "Vector template project",
 *                                       "nofollow" => true),
 *                       "btn2" => array("img"   => tpl_basedir()."user/mybutton1.png",
 *                                       "href"  => wl("start", "", false, "&")),
 *                       "btn3" => array("img"   => tpl_basedir()."user/mybutton2.png",
 *                                       "href"  => "https://www.example.com"));
 *        Available keys within the subarrays:
 *        - "img" (mandatory)
 *          The relative or full path of an image/button to show. Users may
 *          place own images within the /user/ dir of this template.
 *        - "href" (mandatory)
 *          URL the element should point to (as link). Provide a complete,
 *          valid href value; this function escapes it before output for
 *          security reasons.
 *        - "width" (optional)
 *          width="<value>" will be added to the image tag if both "width" and
 *          "height" are set (otherwise, this will be ignored).
 *        - "height" (optional)
 *          height="<value>" will be added to the image tag if both "height" and
 *          "width" are set (otherwise, this will be ignored).
 *        - "nofollow" (optional)
 *          Buttons open in a new tab and always get rel="noopener noreferrer";
 *          if set to TRUE, "nofollow" is added too.
 *        - "title" (optional)
 *          title="<value>"  will be added to the link and image if "title"
 *          is set + alt="<value>".
 * @author ARSAVA <dokuwiki@dev.arsava.com>
 * @return bool
 * @see _vector_renderButtons()
 * @see _vector_renderBoxes()
 * @link https://en.wikipedia.org/wiki/Nofollow
 * @link https://www.dokuwiki.org/devel:coding_style
 */
function _vector_renderButtons($arr)
{
    if (empty($arr) ||
        !is_array($arr)) {
        return false;
    }

    //array to store the created buttons into
    $elements = array();

    //handle the button data
    foreach ($arr as $li_id => $element) {
        //basic check
        if (empty($element) ||
            !is_array($element) ||
            !isset($element["img"]) ||
            !isset($element["href"])) {
            continue; //ignore invalid stuff and go on
        }
        if (!_vector_isSafeHref($element["href"])) {
            continue;
        }
        if (!_vector_isSafeSrc($element["img"])) {
            continue;
        }

        $href = trim((string)$element["href"]);
        $img = trim((string)$element["img"]);
        //add URL
        $interim = "<a href=\"".hsc($href)."\"";
        $rel = "noopener noreferrer";
        if (!empty($element["nofollow"])) {
            $rel .= " nofollow";
        }
        if (!empty($element["title"]) &&
            is_scalar($element["title"])) {
            $interim .= " title=\"".hsc($element["title"])."\"";
        }
        $interim .= " target=\"_blank\" rel=\"".hsc($rel)."\"><img src=\"".hsc($img)."\"";
        //add width and height attribute to the image?
        if (!empty($element["width"]) &&
            !empty($element["height"]) &&
            is_numeric($element["width"]) &&
            is_numeric($element["height"]) &&
            (int)$element["width"] > 0 &&
            (int)$element["height"] > 0) {
            $interim .= " width=\"".(int)$element["width"]."\" height=\"".(int)$element["height"]."\"";
        }
        //add title and alt attribute to the image?
        if (!empty($element["title"]) &&
            is_scalar($element["title"])) {
            $interim .= " title=\"".hsc($element["title"])."\" alt=\"".hsc($element["title"])."\"";
        } else {
            $interim .= " alt=\"\""; //alt is a mandatory attribute for images
        }
        $interim .= "></a>";

        //store it
        $elements[] = "      ".$interim."\n";
    }

    //show everything created
    if (!empty($elements)) {
        echo  "\n";
        foreach ($elements as $element) {
            echo $element;
        }
    }
    return true;
}

?><!DOCTYPE html>
<html lang="<?php echo hsc($vector_lang); ?>" dir="<?php echo hsc($vector_direction); ?>" class="no-js">
<head>
<meta charset="utf-8">
<title><?php tpl_pagetitle();
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

//show printable version?
if ($vector_action === "print") {
    //note: this is just a workaround for people searching for a print version.
    //      don't forget to update style.ini, this is the really important
    //      thing; the print stylesheet remains the canonical styling path.
    printf('<link rel="stylesheet" media="all" href="%s">%s', hsc(tpl_basedir()."static/3rd/dokuwiki/print.css"), "\n");
    printf('<link rel="stylesheet" media="all" href="%s">%s', hsc(tpl_basedir()."static/css/print.css"), "\n");
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
    printf('<link rel="stylesheet" media="%s" href="%s">%s', ($vector_action === "print") ? "all" : "print", hsc(tpl_basedir()."user/print.css"), "\n");
}
if ($vector_direction === "rtl" && file_exists(tpl_incdir()."user/rtl.css")) {
    printf('<link rel="stylesheet" media="all" href="%s">%s', hsc(tpl_basedir()."user/rtl.css"), "\n");
}
?>
</head>
<body class="<?php
             //different styles/backgrounds for different page types
             switch (true) {
                 //special: tech
                 case ($vector_action === "detail"):
                 case ($vector_action === "cite"):
                 case ($vector_act === "media"): //mirrors DokuWiki action
                 case ($vector_act === "search"): //mirrors DokuWiki action
                     echo "mediawiki ".$vector_direction_class." ns-1 ns-special ";
                     break;
                     //special: wiki
                 case (preg_match("/^wiki(?::|$)/i", cleanID(getID()))):
                     echo "mediawiki ".$vector_direction_class." capitalize-all-nouns ns-4 ns-subject ";
                     break;
                     //discussion
                 case ($vector_context === "discuss"):
                     echo "mediawiki ".$vector_direction_class." capitalize-all-nouns ns-1 ns-talk ";
                     break;
                     //"normal" content
                 case ($vector_act === "edit"): //mirrors DokuWiki action
                 case ($vector_act === "draft"): //mirrors DokuWiki action
                 case ($vector_act === "revisions"): //mirrors DokuWiki action
                 case ($vector_action === "print"):
                 default:
                     echo "mediawiki ".$vector_direction_class." capitalize-all-nouns ns-0 ns-subject ";
                     break;
             } ?>skin-vector skin-vector-<?php echo hsc($vector_skin_version); ?> <?php echo hsc(tpl_classes()); ?>" data-vector-menu-label="<?php echo hsc(_vector_getLang("vector_menu")); ?>" data-vector-skin-version="<?php echo hsc($vector_skin_version); ?>">
<a class="a11y skiplink" href="#dokuwiki__content"><?php echo hsc(_vector_getLang("vector_skip_to_content")); ?></a>
<?php _vector_includeFile("topheader.html"); ?>
<?php _vector_includeFile("header.html"); ?>
<div id="page-container">
<div id="page-base" class="noprint"></div>
<div id="head-base" class="noprint"></div>

<!-- start main id=content -->
<main id="content">
  <a id="top"></a>
  <a id="dokuwiki__top"></a>

  <!-- start main content area -->
  <?php
  //show messages (if there are any)
  html_msgarea();
_vector_includeFile("pageheader.html");
//show site notice
if (tpl_getConf("vector_sitenotice")) {
    //detect wiki page to load as content
    $transplugin_langcur = "";
    if (!empty($transplugin) &&
        tpl_getConf("vector_sitenotice_translate")) {
        $transplugin_langcur = _vector_getTranslationPart($transplugin);
    }
    if ($transplugin_langcur === "") {
        //current page is no translation or something is wrong, load default site notice
        $sitenotice_location = _vector_cleanPageId(tpl_getConf("vector_sitenotice_location"));
    } else {
        //load language specific site notice
        $sitenotice_location = _vector_cleanTranslatedPageId(tpl_getConf("vector_sitenotice_location"), $transplugin_langcur);
    }

    //we have to show a custom site notice
    if ($sitenotice_location !== "" && (empty($conf["useacl"]) ||
        auth_quickaclcheck($sitenotice_location) >= AUTH_READ)) { //current user got access?
        echo "\n  <div id=\"siteNotice\" class=\"noprint\">\n";
        //get the rendered content of the defined wiki article to use as
        //custom site notice.
        $interim = tpl_include_page($sitenotice_location, false);
        if ($interim === "" ||
            $interim === false) {
            //show creation/edit link if the defined page got no content
            echo "[&#160;";
            tpl_pagelink($sitenotice_location, _vector_getLang("vector_fillplaceholder")." (".$sitenotice_location.")");
            echo "&#160;]<br>";
        } else {
            //show the rendered page content
            echo  "    <div class=\"dokuwiki\">\n" //dokuwiki CSS class needed cause we are showing rendered page content
                 .$interim."\n    "
                 ."</div>";
        }
        echo "\n  </div>\n";
    }
}
//show breadcrumps if enabled and position = top
if (!empty($conf["breadcrumbs"]) &&
    $vector_act !== "media" && //mirrors DokuWiki action
    (empty($conf["useacl"]) || //are there any users?
     $loginname !== "" || //user is logged in?
     !tpl_getConf("vector_closedwiki")) &&
    tpl_getConf("vector_breadcrumbs_position") === "top") {
    echo "\n  <div class=\"catlinks noprint\"><p>\n    ";
    tpl_breadcrumbs();
    echo "\n  </p></div>\n";
}
//show hierarchical breadcrumps if enabled and position = top
if (!empty($conf["youarehere"]) &&
    $vector_act !== "media" && //mirrors DokuWiki action
    (empty($conf["useacl"]) || //are there any users?
     $loginname !== "" || //user is logged in?
     !tpl_getConf("vector_closedwiki")) &&
    tpl_getConf("vector_youarehere_position") === "top") {
    echo "\n  <div class=\"catlinks noprint\"><p>\n    ";
    tpl_youarehere();
    echo "\n  </p></div>\n";
}
?>

  <!-- start div id dokuwiki__content -->
  <div id="dokuwiki__content" tabindex="-1">
  <!-- start div id bodyContent -->
  <div id="bodyContent" class="dokuwiki">
    <!-- start rendered wiki content -->
    <?php
  //flush the buffer for faster page rendering, heaviest content follows
  tpl_flush();
//decide which type of pagecontent we have to show
switch ($vector_action) {
    //"image details"
    case "detail":
        include tpl_incdir()."inc_detail.php";
        break;
        //"cite this article"
    case "cite":
        if (!empty($INFO["exists"])) {
            include tpl_incdir()."inc_cite.php";
        } else {
            tpl_content($vector_toc_position === "article");
        }
        break;
        //show "normal" content
    default:
        tpl_content($vector_toc_position === "article");
        break;
}
?>
    <!-- end rendered wiki content -->
    <div class="clearer"></div>
  <?php _vector_includeFile("pagefooter.html"); ?>
  </div>
  <!-- end div id bodyContent -->
  </div>
  <!-- end div id dokuwiki__content -->

  <?php
  tpl_flush();

//show breadcrumps if enabled and position = bottom
if (!empty($conf["breadcrumbs"]) &&
    $vector_act !== "media" && //mirrors DokuWiki action
    (empty($conf["useacl"]) || //are there any users?
     $loginname !== "" || //user is logged in?
     !tpl_getConf("vector_closedwiki")) &&
    tpl_getConf("vector_breadcrumbs_position") === "bottom") {
    echo "\n  <div class=\"catlinks noprint\"><p>\n    ";
    tpl_breadcrumbs();
    echo "\n  </p></div>\n";
}
//show hierarchical breadcrumps if enabled and position = bottom
if (!empty($conf["youarehere"]) &&
    $vector_act !== "media" && //mirrors DokuWiki action
    (empty($conf["useacl"]) || //are there any users?
     $loginname !== "" || //user is logged in?
     !tpl_getConf("vector_closedwiki")) &&
    tpl_getConf("vector_youarehere_position") === "bottom") {
    echo "\n  <div class=\"catlinks noprint\"><p>\n    ";
    tpl_youarehere();
    echo "\n  </p></div>\n";
}
?>

</main>
<!-- end main id=content -->


<!-- start div id=head -->
<div id="head" class="noprint">
  <?php
//show personal tools
if (!empty($conf["useacl"])) { //...makes only sense if there are users
    echo  "\n"
         ."  <div id=\"p-personal\">\n"
         ."    <ul>\n";
    if ($loginname === "") {
        if (actionOK("register")) {
            echo  "      <li id='pt-register'><a href='".hsc(_vector_wl(cleanID(getID()), array("do" => "register")))."' rel='nofollow'>".hsc(_vector_getLang("btn_register", "Register"))."</a></li>"; //language comes from DokuWiki core
        }
        if (actionOK("login")) {
            echo  "      <li id='pt-login'><a href='".hsc(_vector_wl(cleanID(getID()), array("do" => "login", "sectok" => getSecurityToken())))."' rel='nofollow'>".hsc(_vector_getLang("btn_login", "Log In"))."</a></li>"; //language comes from DokuWiki core
        }
        if (actionOK("resendpwd")) {
            echo  "      <li id='pt-resendpwd'><a href='".hsc(_vector_wl(cleanID(getID()), array("do" => "resendpwd")))."' rel='nofollow'>".hsc(_vector_getLang("btn_resendpwd", "Set new password"))."</a></li>"; //language comes from DokuWiki core
        }
    } else {
        //username and userpage
        echo "      <li id='pt-userpage'>".(tpl_getConf("vector_userpage") && $vector_userpage_ns !== ""
                                              ? html_wikilink(cleanID($vector_userpage_ns.":".$loginname), $loginname)
                                              : hsc($loginname))."</li>";
        //personal discussion
        if (tpl_getConf("vector_discuss") &&
            tpl_getConf("vector_userpage") && $vector_userpage_ns !== "" && $vector_discuss_ns !== "") {
            echo "      <li id='pt-mytalk'>".html_wikilink(cleanID($vector_discuss_ns.":".$vector_userpage_ns.":".$loginname), _vector_getLang("vector_mytalk"))."</li>";
        }
        //admin
        if (actionOK("admin") &&
            (!empty($INFO["isadmin"]) ||
             !empty($INFO["ismanager"]))) {
            echo  "      <li id='pt-admin'><a href='".hsc(_vector_wl(cleanID(getID()), array("do" => "admin")))."' rel='nofollow'>".hsc(_vector_getLang("btn_admin", "Admin"))."</a></li>"; //language comes from DokuWiki core
        }
        if (actionOK("profile")) { //check if action is disabled
            echo  "      <li id=\"pt-preferences\"><a href=\"".hsc(_vector_wl(cleanID(getID()), array("do" => "profile")))."\" rel=\"nofollow\">".hsc(_vector_getLang("btn_profile", "Update Profile"))."</a></li>\n"; //language comes from DokuWiki core
        }
        //logout
        if (actionOK("logout")) {
            echo  "      <li id=\"pt-logout\"><a href=\"".hsc(_vector_wl(cleanID(getID()), array("do" => "logout", "sectok" => getSecurityToken())))."\" rel=\"nofollow\">".hsc(_vector_getLang("btn_logout", "Log Out"))."</a></li>\n"; //language comes from DokuWiki core
        }
    }
    if ($loginname !== "" || !tpl_getConf("vector_closedwiki")) {
        echo _vector_menuItemsToListItems(
            "\\dokuwiki\\Menu\\UserMenu",
            array("profile", "admin", "register", "login", "logout"),
            "pt-dw-"
        );
    }
    echo  "    </ul>\n"
         ."  </div>\n";
}
?>

  <!-- start div id=left-navigation -->
  <div id="left-navigation">
    <div id="p-namespaces" class="vectorTabs">
      <ul><?php
        //show tabs: left. see modernizedvector/user/tabs.php to configure them
        if (!empty($_vector_tabs_left) &&
            is_array($_vector_tabs_left)) {
            _vector_renderTabs($_vector_tabs_left);
        }
?>

      </ul>
    </div>
  </div>
  <!-- end div id=left-navigation -->

  <!-- start div id=right-navigation -->
  <div id="right-navigation">
    <div id="p-views" class="vectorTabs">
      <ul><?php
//show tabs: right. see modernizedvector/user/tabs.php to configure them
if (!empty($_vector_tabs_right) &&
    is_array($_vector_tabs_right)) {
    _vector_renderTabs($_vector_tabs_right);
}
?>

      </ul>
    </div>
<?php if (actionOK("search")) { ?>
    <div id="p-search">
      <h5>
        <label for="qsearch__in"><?php echo hsc(_vector_getLang("vector_search")); ?></label>
      </h5>
      <form action="<?php echo hsc(_vector_wl()); ?>" method="get" accept-charset="utf-8" id="dw__search" name="dw__search" class="search" role="search">
        <input type="hidden" name="do" value="search">
        <input type="hidden" name="id" value="<?php echo hsc(getID()); ?>">
        <div class="no">
          <div id="simpleSearch">
          <input id="qsearch__in" class="edit" name="q" type="text" accesskey="f" title="[F]" placeholder="<?php echo hsc(_vector_getLang("btn_search", "Search")); ?>" autocomplete="on" value="<?php echo hsc(($vector_act === "search") ? $vector_query : ""); ?>">
          <button id="searchButton" class="button" type="submit" name="button" title="<?php echo hsc(_vector_getLang("vector_btn_search_title")); ?>" aria-label="<?php echo hsc(_vector_getLang("vector_btn_search_title")); ?>">&#160;</button>
        </div>
        <div id="qsearch__out" class="ajax_qsearch JSpopup"></div>
        </div>
      </form>
    </div>
<?php } ?>
  </div>
  <!-- end div id=right-navigation -->

</div>
<!-- end div id=head -->

<!-- start panel/sidebar -->
<div id="panel" class="noprint" role="complementary" aria-label="<?php echo hsc(_vector_getLang("vector_sidebar")); ?>">
  <!-- start logo -->
  <div id="p-logo">
      <?php
      //include default, media, or user-defined logo
      $vector_logo = tpl_basedir()."static/3rd/dokuwiki/logo.png";
if (file_exists(tpl_incdir()."user/logo.svg")) {
    $vector_logo = tpl_basedir()."user/logo.svg";
} elseif (file_exists(tpl_incdir()."user/logo.png")) {
    $vector_logo = tpl_basedir()."user/logo.png";
} elseif (file_exists(tpl_incdir()."user/logo.gif")) {
    $vector_logo = tpl_basedir()."user/logo.gif";
} elseif (file_exists(tpl_incdir()."user/logo.jpg")) {
    $vector_logo = tpl_basedir()."user/logo.jpg";
}
if ($vector_logo === tpl_basedir()."static/3rd/dokuwiki/logo.png") {
    $vector_logo_info = null;
    $vector_logo_candidate = tpl_getMediaFile(array(":wiki:logo.svg", ":logo.svg", ":wiki:logo.png", ":logo.png", ":wiki:logo.gif", ":logo.gif", ":wiki:logo.jpg", ":logo.jpg"), false, $vector_logo_info, false);
    if ($vector_logo_candidate !== false) {
        $vector_logo = $vector_logo_candidate;
    }
}
$vector_home_label = strip_tags(_vector_string($conf["title"] ?? ""));
if ($vector_home_label === "") {
    $vector_home_label = "Home";
}
echo '<a href="'.hsc(_vector_wl()).'" style="background-image:url(&quot;'.hsc($vector_logo).'&quot;);" accesskey="h" title="[ALT+H]" aria-label="'.hsc($vector_home_label).'"></a>'."\n";
unset($vector_home_label, $vector_logo, $vector_logo_candidate, $vector_logo_info);
?>
  </div>
  <!-- end logo -->

  <?php _vector_includeFile("sidebarheader.html"); ?>
  <?php
  //show boxes, see modernizedvector/user/boxes.php to configure them
  if (!empty($_vector_boxes) &&
is_array($_vector_boxes)) {
      _vector_renderBoxes($_vector_boxes);
  }
?>
  <?php _vector_includeFile("sidebarfooter.html"); ?>

</div>
<!-- end panel/sidebar -->
</div>
<!-- end page-container -->

<!-- start footer -->
<div id="footer" class="noprint" role="contentinfo">
  <ul id="footer-info">
    <li id="footer-info-lastmod">
      <?php tpl_pageinfo()?><br>
    </li>
    <?php
  //copyright notice
  if (tpl_getConf("vector_copyright")) {
      //show dokuwiki's default notice?
      if (tpl_getConf("vector_copyright_default")) {
          echo "<li id=\"footer-info-copyright\">\n      <div class=\"dokuwiki\">";  //dokuwiki CSS class needed cause we have to show DokuWiki content
          tpl_license(false);
          echo "</div>\n    </li>\n";
          //show custom notice.
      } else {
          //detect wiki page to load as content
          $transplugin_langcur = "";
          if (!empty($transplugin) &&
              tpl_getConf("vector_copyright_translate")) {
              $transplugin_langcur = _vector_getTranslationPart($transplugin);
          }
          if ($transplugin_langcur === "") {
              //current page is no translation or something is wrong, load default copyright notice
              $copyright_location = _vector_cleanPageId(tpl_getConf("vector_copyright_location"));
          } else {
              //load language specific copyright notice
              $copyright_location = _vector_cleanTranslatedPageId(tpl_getConf("vector_copyright_location"), $transplugin_langcur);
          }

          if ($copyright_location !== "" && (empty($conf["useacl"]) ||
              auth_quickaclcheck($copyright_location) >= AUTH_READ)) { //current user got access?
              echo "<li id=\"footer-info-copyright\">\n        ";
              //get the rendered content of the defined wiki article to use as custom notice
              $interim = tpl_include_page($copyright_location, false);
              if ($interim === "" ||
                  $interim === false) {
                  //show creation/edit link if the defined page got no content
                  echo "[&#160;";
                  tpl_pagelink($copyright_location, _vector_getLang("vector_fillplaceholder")." (".$copyright_location.")");
                  echo "&#160;]<br>";
              } else {
                  //show the rendered page content
                  echo  "<div class=\"dokuwiki\">\n" //dokuwiki CSS class needed cause we are showing rendered page content
                       .$interim."\n        "
                       ."</div>";
              }
              echo "\n    </li>\n";
          }
      }
  }
?>
  </ul>
  <ul id="footer-places">
    <li><?php
    //show buttons, see modernizedvector/user/buttons.php to configure them
    if (!empty($_vector_btns) &&
        is_array($_vector_btns)) {
        _vector_renderButtons($_vector_btns);
    }
?>
    </li>
  </ul>
  <div class="clearer"></div>
</div>
<!-- end footer -->
<?php _vector_includeFile("footer.html"); ?>
<div class="no"><?php tpl_indexerWebBug(); ?></div>
<div id="screen__mode" class="no"></div>
<?php

//include web analytics software
if (file_exists(tpl_incdir()."user/tracker.php")) {
    include tpl_incdir()."user/tracker.php";
}
?>

</body>
</html>
