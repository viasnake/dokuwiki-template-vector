<?php

/**
 * Image detail page
 *
 * See "detail.php" if you don't know how this is getting included within the
 * "main.php".
 *
 * NOTE: Based on the detail.php out of the "starter" template by Anika Henke.
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
$ERROR = (isset($ERROR) && is_scalar($ERROR)) ? (string)$ERROR : "";
$IMG = (isset($IMG) && is_scalar($IMG)) ? (string)$IMG : "";
$ID = (isset($ID) && is_scalar($ID)) ? cleanID((string)$ID) : cleanID(getID());
$imageHeadline = tpl_img_getTag("IPTC.Headline", noNS($IMG));
$imageTitle = tpl_img_getTag("Simple.Title");
$imageHeadline = is_scalar($imageHeadline) ? (string)$imageHeadline : "";
$imageTitle = is_scalar($imageTitle) ? (string)$imageTitle : "";
$mediaUsage = array();
if ($IMG !== "") {
    $mediaUsageLoaded = false;
    if (class_exists("\\dokuwiki\\Search\\MetadataSearch")) {
        try {
            $metadataSearch = new \dokuwiki\Search\MetadataSearch();
            if (method_exists($metadataSearch, "mediause")) {
                $mediaUsage = $metadataSearch->mediause($IMG, true);
                $mediaUsageLoaded = true;
            }
        } catch (\Throwable $ignored) {
            $mediaUsageLoaded = false;
        }
    }
    if (!$mediaUsageLoaded && function_exists("ft_mediause")) {
        $mediaUsage = ft_mediause($IMG, true);
    }
}
if (!is_array($mediaUsage)) {
    $mediaUsage = array();
}

?>

    <div id="dokuwiki__detail" class="dokuwiki">

        <?php if ($ERROR !== "") {
            echo hsc($ERROR);
        } else { ?>

            <h1><?php echo hsc($imageHeadline)?></h1>

            <div class="content">
                <?php tpl_img(900, 700); /* parameters: maximum width, maximum height (and more) */ ?>

                <div class="img_detail">
                    <h2><?php echo nl2br(hsc($imageTitle), false); ?></h2>

                    <?php tpl_img_meta(); ?>

                    <dl>
                        <?php
                            echo '<dt>'.hsc(_vector_getLang("reference", "Reference")).':</dt>';
            if ($mediaUsage !== array()) {
                foreach ($mediaUsage as $t) {
                    if (!is_scalar($t)) {
                        continue;
                    }
                    $target = cleanID((string)$t);
                    if ($target === "") {
                        continue;
                    }
                    echo '<dd>'.html_wikilink($target, $target).'</dd>';
                }
            } else {
                echo '<dd>'.hsc(_vector_getLang("nothingfound", "Nothing found")).'</dd>';
            }
            ?>
                    </dl>
                    <?php
            if (function_exists("media_acl_warning")) {
                media_acl_warning($IMG);
            } else {
                echo '<p>'.hsc(_vector_getLang("media_acl_warning", "This list might not be complete due to ACL restrictions and hidden pages.")).'</p>';
            }
            ?>
                </div>
                <div class="clearer"></div>
            </div><!-- /.content -->

            <p class="back">
                <?php
            $imgNS = ($IMG !== "") ? getNS($IMG) : "";
            $authNS = ($IMG !== "") ? auth_quickaclcheck("$imgNS:*") : 0;
            if ($IMG !== "" && ($authNS >= AUTH_UPLOAD) && actionOK("media")) {
                $mmURL = _vector_wl($ID, array("do" => "media", "ns" => $imgNS, "image" => $IMG));
                echo '<a href="'.hsc($mmURL).'">'.hsc(_vector_getLang("img_manager", "Media Manager")).'</a><br>';
            }
            ?>
                &larr; <?php echo hsc(_vector_getLang("img_backto", "Back to"))?> <?php tpl_pagelink($ID)?>
            </p>

        <?php } ?>
    </div>
