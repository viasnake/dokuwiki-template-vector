<?php

/**
 * Default tab configuration of the "vector" DokuWiki template
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
  If you want to add some own tabs, have a look at the README.md file for this template
  and "/user/tabs.php". You have been warned!
 *****************************************************************************/


//check if we are running within the DokuWiki environment
if (!defined("DOKU_INC")){
    die();
}



/****************************** LEFT NAVIGATION ******************************/

//note: The tabs will be rendered in the order they were defined. Means: first
//      tab will be rendered first, last tab will be rendered at last.



//article tab
//ATTENTION: "ca-nstab-main" is used as css id selector!
if (!tpl_getConf("vector_userpage") || $vector_userpage_ns === "" || !preg_match("/^".preg_quote($vector_userpage_ns, "/")."(?::|$)/i", cleanID(getID()))){
    $_vector_tabs_left["ca-nstab-main"]["text"] = _vector_getLang("vector_article");
}else{
    $_vector_tabs_left["ca-nstab-main"]["text"] = _vector_getLang("vector_userpage");
}
$_vector_tabs_left["ca-nstab-main"]["accesskey"] = "V";
if ($vector_context !== "discuss"){ //$vector_context was defined within main.php
    $_vector_tabs_left["ca-nstab-main"]["wiki"]  = ":".getID();
    $_vector_tabs_left["ca-nstab-main"]["class"] = "selected";
}else{
    $_vector_tabs_left["ca-nstab-main"]["wiki"]  = ":".preg_replace("/^".preg_quote($vector_discuss_ns, "/").":?/i", "", cleanID(getID()));
}


//hide some tabs for anonymous clients (closed wiki)?
if (empty($conf["useacl"]) || //are there any users?
    $loginname !== "" || //user is logged in?
    !tpl_getConf("vector_closedwiki")){

    //discussion tab
    //ATTENTION: "ca-talk" is used as css id selector!
    if (tpl_getConf("vector_discuss") && $vector_discuss_ns !== ""){
        $_vector_tabs_left["ca-talk"]["text"] = _vector_getLang("vector_discussion");
        if ($vector_context === "discuss"){ //$vector_context was defined within main.php
            $_vector_tabs_left["ca-talk"]["wiki"]  = ":".getID();
            $_vector_tabs_left["ca-talk"]["class"] = "selected";
        }else{
            $_vector_tabs_left["ca-talk"]["wiki"] = ":".$vector_discuss_ns.":".getID();
        }
    }

}



/****************************** RIGHT NAVIGATION ******************************/

//note: The tabs will be rendered in the order they were defined. Means: first
//      tab will be rendered first, last tab will be rendered at last.


//read tab
if(!empty($INFO["exists"])){
    //ATTENTION: "ca-view" is used as css id selector!
    $_vector_tabs_right["ca-view"]["text"] = _vector_getLang("vector_read");
    if ($vector_context !== "discuss"){ //$vector_context was defined within main.php
        $_vector_tabs_right["ca-view"]["wiki"]  = ":".getID();
        if ($vector_act === "show") { //$vector_act mirrors DokuWiki action
            $_vector_tabs_right["ca-view"]["class"] = "selected";
        }
    }else{
        $_vector_tabs_right["ca-view"]["wiki"]  = ":".preg_replace("/^".preg_quote($vector_discuss_ns, "/").":?/i", "", cleanID(getID()));
    }
}


//hide some tabs for anonymous clients (closed wiki)?
if (empty($conf["useacl"]) || //are there any users?
    $loginname !== "" || //user is logged in?
    !tpl_getConf("vector_closedwiki")){

    //edit/create/show source tab
    //ATTENTION: "ca-edit" is used as css id selector!
    if ((!empty($INFO["writable"]) && actionOK("edit")) ||
        (!empty($INFO["exists"]) && actionOK("source"))){
        $_vector_tabs_right["ca-edit"]["accesskey"] = "E";
        if (!empty($INFO["writable"]) && actionOK("edit")){ //$INFO comes from DokuWiki core
            $_vector_tabs_right["ca-edit"]["href"] = wl(cleanID(getID()), array("do" => "edit", "rev" => (int)$rev), false, "&");
            if (!empty($INFO["draft"])){
                $_vector_tabs_right["ca-edit"]["href"] = wl(cleanID(getID()), array("do" => "draft", "rev" => (int)$rev), false, "&");
                $_vector_tabs_right["ca-edit"]["text"] = _vector_getLang("btn_draft", "Recover Draft"); //language comes from DokuWiki core
            }elseif (!empty($INFO["exists"])){
                $_vector_tabs_right["ca-edit"]["text"] = _vector_getLang("vector_edit");
            }else{
                $_vector_tabs_right["ca-edit"]["text"] = _vector_getLang("vector_create");
            }
        }else{
            $_vector_tabs_right["ca-edit"]["href"] = wl(cleanID(getID()), array("do" => "source", "rev" => (int)$rev), false, "&");
            $_vector_tabs_right["ca-edit"]["text"] = _vector_getLang("btn_source", "Show pagesource"); //language comes from DokuWiki core
        }
        if (in_array($vector_act, array("edit", "draft", "source"), true)){ //$vector_act mirrors DokuWiki action
            $_vector_tabs_right["ca-edit"]["class"] = "selected";
        }
    }


    //old versions/revisions tab
    if (!empty($INFO["exists"]) &&
        actionOK("revisions")){ //check if action is disabled
        //ATTENTION: "ca-history" is used as css id selector!
        $_vector_tabs_right["ca-history"]["text"]      = _vector_getLang("btn_revs", "Old revisions"); //language comes from DokuWiki core
        $_vector_tabs_right["ca-history"]["href"]      = wl(cleanID(getID()), array("do" => "revisions"), false, "&");
        $_vector_tabs_right["ca-history"]["accesskey"] = "O";
        if ($vector_act === "revisions"){ //$vector_act mirrors DokuWiki action
            $_vector_tabs_right["ca-history"]["class"] = "selected";
        }
    }


    //subscribe tab
    //ATTENTION: "ca-watch" is used as css id selector!
    if (!empty($conf["useacl"]) &&
        $loginname !== "" &&
        actionOK("subscribe")){ //$loginname was defined within main.php
        $_vector_tabs_right["ca-watch"]["href"] = wl(cleanID(getID()), array("do" => "subscribe"), false, "&");
        $_vector_tabs_right["ca-watch"]["text"] = !empty($INFO["subscribed"]) ? _vector_getLang("btn_unsubscribe", "Unsubscribe") : _vector_getLang("btn_subscribe", "Subscribe"); //language comes from DokuWiki core
        if ($vector_act === "subscribe"){ //$vector_act mirrors DokuWiki action
            $_vector_tabs_right["ca-watch"]["class"] = "selected";
        }
    }
}

/******************************************************************************
 ********************************  ATTENTION  *********************************
         DO NOT MODIFY THIS FILE, IT WILL NOT BE PRESERVED ON UPDATES!
 ******************************************************************************
  If you want to add some own tabs, have a look at the README.md file for this template
  and "/user/tabs.php". You have been warned!
 *****************************************************************************/
