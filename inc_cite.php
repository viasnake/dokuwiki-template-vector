<?php

/**
 * Content for the citation page
 *
 * This file will be imported by the "main.php".
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
if (!function_exists("_vector_citeBibtexValue")) {
    function _vector_citeBibtexValue($value)
    {
        $value = _vector_string($value);
        $value = str_replace(array("\\", "{", "}", "\"", "\r", "\n", ","), array("\\\\", "\\{", "\\}", "\\\"", " ", " ", "{,}"), $value);
        return hsc($value);
    }
}


//detect rev
$rev = (int)($INFO["rev"] ?? 0);
if ($rev < 1) {
    $rev = (int)($INFO["lastmod"] ?? 0);
}

//set permanent URL
$permurl = wl(cleanID(getID()), array("rev" => $rev), true, "&");
$pageTitle = html_entity_decode(_vector_string(tpl_pagetitle(null, true)), ENT_QUOTES, "UTF-8");
$siteTitle = strip_tags(_vector_string($conf["title"] ?? ""));
$citeAuthor = _vector_string(tpl_getConf("vector_cite_author"));
$bibtexAuthor = _vector_citeBibtexValue($citeAuthor);
$bibtexTitle = _vector_citeBibtexValue($pageTitle);
$bibtexSiteTitle = _vector_citeBibtexValue($siteTitle);
$bibtexPermurl = _vector_citeBibtexValue($permurl);

?>
<h1 id="bibliographic_details"><?php echo hsc(_vector_getLang("vector_cite_bibdetailsfor")); ?> &quot;<?php echo hsc($pageTitle); ?>&quot;</h1>
<div class="level2">
  <ul>
    <li class="level1">
      <div class="li"><?php echo hsc(_vector_getLang("vector_cite_pagename")); ?>: <?php echo hsc($pageTitle); ?></div>
    </li>
    <li class="level1">
      <div class="li"><?php echo hsc(_vector_getLang("vector_cite_author")); ?>: <?php echo hsc($citeAuthor); ?></div>
    </li>
    <li class="level1">
      <div class="li"><?php echo hsc(_vector_getLang("vector_cite_publisher")); ?>: <?php echo hsc($siteTitle); ?>.</div>
    </li>
    <li class="level1">
      <div class="li"><?php echo hsc(_vector_getLang("vector_cite_dateofrev")); ?>: <?php echo gmdate("j F Y H:i T", $rev); ?></div>
    </li>
    <li class="level1">
      <div class="li"><?php echo hsc(_vector_getLang("vector_cite_dateretrieved")); ?>: <?php echo gmdate("j F Y H:i T"); ?></div>
    </li>
    <li class="level1">
      <div class="li"><?php echo hsc(_vector_getLang("vector_cite_permurl")); ?>: <a rel="nofollow" href="<?php echo hsc($permurl); ?>"><?php echo hsc($permurl); ?></a></div>
    </li>
    <li class="level1">
      <div class="li"><?php echo hsc(_vector_getLang("vector_cite_pageversionid")); ?>: <?php echo hsc($rev); ?></div>
    </li>
  </ul>
  <p>
    <?php echo hsc(_vector_getLang("vector_cite_checkstandards")); ?>
  </p>
</div>


<h2 id="citation_styles_for"><?php echo hsc(_vector_getLang("vector_cite_citationstyles")); ?> &quot;<?php echo hsc($pageTitle); ?>&quot;</h2>

<h3 id="apa_style">APA</h3>
<div class="level3">
  <p>
     <?php echo hsc($pageTitle); ?>. (<?php echo gmdate("Y, M j", $rev); ?>).
     <?php echo hsc(_vector_getLang("vector_cite_in")); ?> <em><?php echo hsc($siteTitle); ?></em>.
     <?php echo hsc(_vector_getLang("vector_cite_retrieved"))." ".gmdate("H:i, F j, Y,")." ".hsc(_vector_getLang("vector_cite_from")); ?>
     <a rel="nofollow" href="<?php echo hsc($permurl); ?>"><?php echo hsc($permurl); ?></a>.
  </p>
</div>

<h3 id="mla_style">MLA</h3>
<div class="level3">
  <p>
     <?php echo hsc($citeAuthor); ?>.
    "<?php echo hsc($pageTitle); ?>".
     <em><?php echo hsc($siteTitle); ?></em>.
     <?php echo gmdate("j M. Y", $rev); ?>. Web. <?php echo gmdate("j M. Y, H:i"); ?>
  </p>
</div>

<h3 id="mhra_style">MHRA</h3>
<div class="level3">
  <p>
     <?php echo hsc($citeAuthor); ?>,
     '<?php echo hsc($pageTitle); ?>',
     <em><?php echo hsc($siteTitle); ?></em>,
     <?php echo gmdate("j F Y, H:i T", $rev); ?>,
     &lt;<a rel="nofollow" href="<?php echo hsc($permurl); ?>"><?php echo hsc($permurl); ?></a>&gt; [<?php echo hsc(_vector_getLang("vector_cite_accessed"))." ".gmdate("j F Y"); ?>]
  </p>
</div>

<h3 id="chicago_style">Chicago</h3>
<div class="level3">
  <p>
    <?php echo hsc($citeAuthor); ?>,
    "<?php echo hsc($pageTitle); ?>",
    <em><?php echo hsc($siteTitle); ?></em>,
    <a rel="nofollow" href="<?php echo hsc($permurl); ?>"><?php echo hsc($permurl); ?></a> (<?php echo hsc(_vector_getLang("vector_cite_accessed"))." ".gmdate("F j, Y"); ?>).
  </p>
</div>

<h3 id="cbe_cse_style">CBE/CSE</h3>
<div class="level3">
  <p>
    <?php echo hsc($citeAuthor); ?>.
    <?php echo hsc($pageTitle); ?> [Internet].
    <?php echo hsc($siteTitle)?>; <?php echo gmdate("Y M j, H:i T", $rev); ?> [<?php echo hsc(_vector_getLang("vector_cite_cited"))." ".gmdate("Y M j"); ?>].
    <?php echo hsc(_vector_getLang("vector_cite_availableat")); ?>: <a rel="nofollow" href="<?php echo hsc($permurl); ?>"><?php echo hsc($permurl); ?></a>.
  </p>
</div>

<h3 id="bluebook_style">Bluebook</h3>
<div class="level3">
  <p>
    <?php echo hsc($pageTitle); ?>,
    <a rel="nofollow" href="<?php echo hsc($permurl); ?>"><?php echo hsc($permurl); ?></a> (<?php echo hsc(_vector_getLang("vector_cite_lastvisited"))." ".gmdate("F j, Y"); ?>).
  </p>
</div>

<h3 id="ama_style">AMA</h3>
<div class="level3">
  <p>
    <?php echo hsc($citeAuthor); ?>.
    <?php echo hsc($pageTitle); ?>.
    <?php echo hsc($siteTitle)?>.
    <?php echo gmdate("F j, Y, H:i T", $rev); ?>.
    <?php echo hsc(_vector_getLang("vector_cite_availableat")); ?>: <a rel="nofollow" href="<?php echo hsc($permurl); ?>"><?php echo hsc($permurl); ?></a>.
    <?php echo hsc(_vector_getLang("vector_cite_accessed"))." ".gmdate("F j, Y"); ?>.
  </p>
</div>

<h3 id="bibtex_entry">BibTeX</h3>
<div class="level3">
  <pre>
 @misc{ wiki:xxx,
   author = &quot;<?php echo $bibtexAuthor; ?>&quot;,
   title = &quot;<?php echo $bibtexTitle; ?> --- <?php echo $bibtexSiteTitle; ?>&quot;,
   year = &quot;<?php echo gmdate("Y", $rev); ?>&quot;,
   url = &quot;<?php echo $bibtexPermurl; ?>&quot;,
   note = &quot;[Online; accessed <?php echo gmdate("j-F-Y"); ?>]&quot;
 }
  </pre>
  <p>
    <?php echo hsc(_vector_getLang("vector_cite_latexusepackagehint")); ?>:
  </p>
  <pre>
 @misc{ wiki:xxx,
   author = &quot;<?php echo $bibtexAuthor; ?>&quot;,
   title = &quot;<?php echo $bibtexTitle; ?> --- <?php echo $bibtexSiteTitle; ?>&quot;,
   year = &quot;<?php echo gmdate("Y", $rev); ?>&quot;,
   url = &quot;\url{<?php echo $bibtexPermurl; ?>}&quot;,
   note = &quot;[Online; accessed <?php echo gmdate("j-F-Y"); ?>]&quot;
 }
  </pre>
</div>

<h3 id="talk_pages"><?php echo hsc(_vector_getLang("vector_cite_discussionpages")); ?></h3>
<div class="level3">
  <dl>
    <dt><?php echo hsc(_vector_getLang("vector_cite_markup")); ?></dt>
    <dd>[[<?php echo hsc(getID()); ?>|<?php echo hsc($pageTitle); ?>]] ([[<?php echo hsc(getID()."?rev=".$rev); ?>|<?php echo hsc(_vector_getLang("vector_cite_thisversion")); ?>]])</dd>
  </dl>
  <dl>
    <dt><?php echo hsc(_vector_getLang("vector_cite_result")); ?></dt>
    <dd><a rel="nofollow" class="wikilink1" href="<?php echo hsc(_vector_wl(cleanID(getID()))); ?>"><?php echo hsc($pageTitle); ?></a> (<a rel="nofollow" class="wikilink1" href="<?php echo hsc($permurl); ?>"><?php echo hsc(_vector_getLang("vector_cite_thisversion")); ?></a>)</dd>
  </dl>
</div>
