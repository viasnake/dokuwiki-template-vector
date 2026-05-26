<?php

/**
 * Default box configuration of the "vector" DokuWiki template
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
 * @link https://www.dokuwiki.org/devel:configuration
 */

/******************************************************************************
 ********************************  ATTENTION  *********************************
         DO NOT MODIFY THIS FILE, IT WILL NOT BE PRESERVED ON UPDATES!
 ******************************************************************************
  If you want to add some own boxes, have a look at the README.md file for this
  template and "/user/boxes.php". You have been warned!
 *****************************************************************************/

//check if we are running within the DokuWiki environment
if (!defined("DOKU_INC")) {
    die();
}

//note: The boxes will be rendered in the order they were defined. Means:
//      first box will be rendered first, last box will be rendered at last.

//hide boxes for anonymous clients (closed wiki)?
if (empty($conf["useacl"]) || //are there any users?
    $loginname !== "" || //user is logged in?
    !tpl_getConf("vector_closedwiki")) {


    //navigation
    if (tpl_getConf("vector_navigation")) {
        //headline
        $_vector_boxes["p-navigation"]["headline"] = _vector_getLang("vector_navigation");

        //detect wiki page to load as content
        $transplugin_langcur = "";
        if (!empty($transplugin) &&
            tpl_getConf("vector_navigation_translate")) {
            $transplugin_langcur = _vector_getTranslationPart($transplugin);
        }
        if ($transplugin_langcur === "") {
            //current page is no translation or something is wrong, load default navigation
            $nav_location = _vector_cleanPageId(tpl_getConf("vector_navigation_location"));
        } else {
            //load language specific navigation
            $nav_location = _vector_cleanTranslatedPageId(tpl_getConf("vector_navigation_location"), $transplugin_langcur);
        }

        $nav_location = _vector_cleanPageId($nav_location);

        //content
        if ($nav_location !== "" && (empty($conf["useacl"]) ||
            auth_quickaclcheck($nav_location) >= AUTH_READ)) { //current user got access?
            //get the rendered content of the defined wiki article to use as custom navigation
            $interim = tpl_include_page($nav_location, false);
            if ($interim === "" ||
                $interim === false) {
                //creation/edit link if the defined page got no content
                $_vector_boxes["p-navigation"]["xhtml"] = "[&#160;".html_wikilink($nav_location, _vector_getLang("vector_fillplaceholder")." (".$nav_location.")")."&#160;]<br>";
            } else {
                //the rendered page content
                $_vector_boxes["p-navigation"]["xhtml"] = $interim;
            }
        }
        unset($nav_location);
    }

    //table of contents (TOC) - show outside the article? (this is a dirty hack but often requested)
    if (tpl_getConf("vector_toc_position") === "sidebar") {
        //check if the current page got a TOC
        $toc = tpl_toc(true);
        if (!empty($toc)) {
            //headline
            $_vector_boxes["p-toc"]["headline"] = _vector_getLang("toc", "Table of Contents"); //language comes from DokuWiki core

            //content
            $_vector_boxes["p-toc"]["xhtml"] = str_replace(
                array(" id=\"dw__toc\"", "<h3 class=\"toggle\">"._vector_getLang("toc", "Table of Contents")."</h3>"),
                "",
                $toc
            );
        }
        unset($toc);
    }

    //exportbox ("print/export")
    if (tpl_getConf("vector_exportbox")) {
        //headline
        $_vector_boxes["p-coll-print_export"]["headline"] = _vector_getLang("vector_exportbox");

        //content
        if (tpl_getConf("vector_exportbox_default")) {
            //define default, predefined exportbox
            $_vector_boxes["p-coll-print_export"]["xhtml"] =  "      <ul>\n";
            if (!empty($INFO["exists"])) {
                //ODT plugin
                //see <https://www.dokuwiki.org/plugin:odt> for info
                if (actionOK("export_odt") &&
                    file_exists(DOKU_PLUGIN."odt/syntax.php") &&
                    !plugin_isdisabled("odt")) {
                    $_vector_boxes["p-coll-print_export"]["xhtml"] .= sprintf("        <li id=\"coll-download-as-odt\"><a href=\"%s\" rel=\"nofollow\">%s</a></li>\n", hsc(_vector_wl(cleanID(getID()), array("do" => "export_odt"))), hsc(_vector_getLang("vector_exportbxdef_downloadodt")));
                }
                //dw2pdf plugin
                //see <https://www.dokuwiki.org/plugin:dw2pdf> for info
                if (actionOK("export_pdf") &&
                    file_exists(DOKU_PLUGIN."dw2pdf/action.php") &&
                    !plugin_isdisabled("dw2pdf")) {
                    $_vector_boxes["p-coll-print_export"]["xhtml"] .= sprintf("        <li id=\"coll-download-as-pdf\"><a href=\"%s\" rel=\"nofollow\">%s</a></li>\n", hsc(_vector_wl(cleanID(getID()), array("do" => "export_pdf"))), hsc(_vector_getLang("vector_exportbxdef_downloadpdf")));
                    //html2pdf plugin
                    //see <https://www.dokuwiki.org/plugin:html2pdf> for info
                } elseif (actionOK("export_pdf") &&
                          file_exists(DOKU_PLUGIN."html2pdf/action.php") &&
                          !plugin_isdisabled("html2pdf")) {
                    $_vector_boxes["p-coll-print_export"]["xhtml"] .= sprintf("        <li id=\"coll-download-as-pdf\"><a href=\"%s\" rel=\"nofollow\">%s</a></li>\n", hsc(_vector_wl(cleanID(getID()), array("do" => "export_pdf"))), hsc(_vector_getLang("vector_exportbxdef_downloadpdf")));
                }
                $_vector_boxes["p-coll-print_export"]["xhtml"] .= sprintf("        <li id=\"t-print\"><a href=\"%s\" rel=\"nofollow\">%s</a></li>\n", hsc(_vector_wl(cleanID(getID()), array("rev" => (int)$rev, "vecdo" => "print"))), hsc(_vector_getLang("vector_exportbxdef_print")));
            }
            $_vector_boxes["p-coll-print_export"]["xhtml"] .= "      </ul>";
        } else {
            //we have to use a custom exportbox
            $exportbox_location = _vector_cleanPageId(tpl_getConf("vector_exportbox_location"));
            if ($exportbox_location !== "" && (empty($conf["useacl"]) ||
                auth_quickaclcheck($exportbox_location) >= AUTH_READ)) { //current user got access?
                //get the rendered content of the defined wiki article to use as
                //custom exportbox
                $interim = tpl_include_page($exportbox_location, false);
                if ($interim === "" ||
                    $interim === false) {
                    //add creation/edit link if the defined page got no content
                    $_vector_boxes["p-coll-print_export"]["xhtml"] = "      <ul><li>[&#160;".html_wikilink($exportbox_location, _vector_getLang("vector_fillplaceholder")." (".$exportbox_location.")", "")."&#160;]<br></li></ul>";
                } else {
                    //add the rendered page content
                    $_vector_boxes["p-coll-print_export"]["xhtml"] =  $interim;
                }
            } else {
                //we are not allowed to show the content of the defined wiki
                //article to use as custom exportbox.
            }
        }
    }

    //toolbox
    if (tpl_getConf("vector_toolbox")) {
        //headline
        $_vector_boxes["p-tb"]["headline"] = _vector_getLang("vector_toolbox");

        //content
        if (tpl_getConf("vector_toolbox_default")) {
            //define default, predefined toolbox
            $_vector_boxes["p-tb"]["xhtml"] = "      <ul>\n";
            if (actionOK("backlink")) { //check if action is disabled
                $_vector_boxes["p-tb"]["xhtml"] .= sprintf("        <li id='t-whatlinkshere'><a href='%s'>%s</a></li>\n", hsc(_vector_wl(cleanID(getID()), array("do" => "backlink"))), hsc(_vector_getLang("vector_toolbxdef_whatlinkshere")));
            }
            if (actionOK("recent")) { //check if action is disabled
                $_vector_boxes["p-tb"]["xhtml"] .= sprintf("        <li id='t-recentchanges'><a href='%s' rel='nofollow'>%s</a></li>\n", hsc(_vector_wl("", array("do" => "recent"))), hsc(_vector_getLang("btn_recent", "Recent Changes"))); //language comes from DokuWiki core
            }
            if (actionOK("media")) { //check if action is disabled
                $_vector_boxes["p-tb"]["xhtml"] .= sprintf("        <li id='t-upload'><a href='%s' rel='nofollow'>%s</a></li>\n", hsc(_vector_wl(cleanID(getID()), array("do" => "media", "ns" => getNS(cleanID(getID()))))), hsc(_vector_getLang("btn_media", "Media Manager"))); //language comes from DokuWiki core
            }
            if (actionOK("index")) { //check if action is disabled
                $_vector_boxes["p-tb"]["xhtml"] .= sprintf("        <li id='t-special'><a href='%s' rel='nofollow'>%s</a></li>\n", hsc(_vector_wl("", array("do" => "index"))), hsc(_vector_getLang("vector_toolbxdef_siteindex")));
            }
            if (!empty($INFO["exists"])) {
                $_vector_boxes["p-tb"]["xhtml"] .= sprintf("        <li id='t-permanent'><a href='%s' rel='nofollow'>%s</a></li>\n", hsc(_vector_wl(cleanID(getID()), array("rev" => (int)$rev))), hsc(_vector_getLang("vector_toolboxdef_permanent")))
                                                   .sprintf("        <li id='t-cite'><a href='%s' rel='nofollow'>%s</a></li>\n", hsc(_vector_wl(cleanID(getID()), array("rev" => (int)$rev, "vecdo" => "cite"))), hsc(_vector_getLang("vector_toolboxdef_cite")));
            }
            $_vector_boxes["p-tb"]["xhtml"] .= "      </ul>";
        } else {
            //we have to use a custom toolbox
            $toolbox_location = _vector_cleanPageId(tpl_getConf("vector_toolbox_location"));
            if ($toolbox_location !== "" && (empty($conf["useacl"]) ||
                auth_quickaclcheck($toolbox_location) >= AUTH_READ)) { //current user got access?
                //get the rendered content of the defined wiki article to use as custom toolbox
                $interim = tpl_include_page($toolbox_location, false);
                if ($interim === "" ||
                    $interim === false) {
                    //add creation/edit link if the defined page got no content
                    $_vector_boxes["p-tb"]["xhtml"] = "      <ul><li>[&#160;".html_wikilink($toolbox_location, _vector_getLang("vector_fillplaceholder")." (".$toolbox_location.")", "")."&#160;]<br></li></ul>";
                } else {
                    //add the rendered page content
                    $_vector_boxes["p-tb"]["xhtml"] = $interim;
                }
            } else {
                //we are not allowed to show the content of the defined wiki article to use as custom toolbox.
            }
        }
    }

    //QR Code of current page URL
    if (tpl_getConf("vector_qrcodebox")) {
        //headline
        $_vector_boxes["p-qrcode"]["headline"] = _vector_getLang("vector_qrcodebox");

        //content
        $qrcode_page_url = wl(cleanID(getID()), "", true, "&");
        $qrcode_page_title = html_entity_decode(_vector_string(tpl_pagetitle(null, true)), ENT_QUOTES, "UTF-8");
        $qrcode_alt = _vector_getLang("vector_qrcodebox_qrcode")." ".$qrcode_page_title." ("._vector_getLang("vector_qrcodebox_genforcurrentpage").")";
        $qrcode_img = "<img src='https://api.qrserver.com/v1/create-qr-code/?data=".urlencode($qrcode_page_url)."&#38;size=130x130&#38;margin=0&#38;bgcolor=f3f3f3' alt='".hsc($qrcode_alt)."' title='".hsc(_vector_getLang("vector_qrcodebox_urlofcurrentpage"))."'>";
        $_vector_boxes["p-qrcode"]["xhtml"] = "        <span id='t-qrcode'>".$qrcode_img."</span>";
        unset($qrcode_alt, $qrcode_img, $qrcode_page_title, $qrcode_page_url);
    }
} else {

    //headline
    $_vector_boxes["p-login"]["headline"] = _vector_getLang("btn_login", "Log In");
    $_vector_boxes["p-login"]["xhtml"] =  "      <ul>\n";
    if (actionOK("register")) {
        $_vector_boxes["p-login"]["xhtml"] .= "        <li id='t-register'><a href='".hsc(_vector_wl(cleanID(getID()), array("do" => "register")))."' rel='nofollow'>".hsc(_vector_getLang("btn_register", "Register"))."</a></li>"; //language comes from DokuWiki core
    }
    if (actionOK("login")) {
        $_vector_boxes["p-login"]["xhtml"] .= "        <li id='t-login'><a href='".hsc(_vector_wl(cleanID(getID()), array("do" => "login", "sectok" => getSecurityToken())))."' rel='nofollow'>".hsc(_vector_getLang("btn_login", "Log In"))."</a></li>"; //language comes from DokuWiki core
    }
    if (actionOK("resendpwd")) {
        $_vector_boxes["p-login"]["xhtml"] .= "        <li id='t-resendpwd'><a href='".hsc(_vector_wl(cleanID(getID()), array("do" => "resendpwd")))."' rel='nofollow'>".hsc(_vector_getLang("btn_resendpwd", "Set new password"))."</a></li>"; //language comes from DokuWiki core
    }
    $_vector_boxes["p-login"]["xhtml"] .= "      </ul>";
}

//Languages/translations provided by Andreas Gohr's translation plugin,
//see <https://www.dokuwiki.org/plugin:translation>
if ((empty($conf["useacl"]) ||
    $loginname !== "" ||
    !tpl_getConf("vector_closedwiki")) &&
    !empty($transplugin) &&
    is_object($transplugin) &&
    method_exists($transplugin, "showTranslations")) {
    $_vector_boxes["p-lang"]["headline"] = _vector_getLang("vector_translations");
    $_vector_boxes["p-lang"]["xhtml"]    = $transplugin->showTranslations();
}

/******************************************************************************
 ********************************  ATTENTION  *********************************
         DO NOT MODIFY THIS FILE, IT WILL NOT BE PRESERVED ON UPDATES!
 ******************************************************************************
  If you want to add some own boxes, have a look at the README.md file for this
  template and "/user/boxes.php". You have been warned!
 *****************************************************************************/
