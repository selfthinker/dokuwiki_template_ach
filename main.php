<?php
/**
 * DokuWiki 'ACH' Template
 *
 * This is the template you need to change for the overall look
 * of DokuWiki.
 *
 * You should leave the doctype at the very top - It should
 * always be the very first line of a document.
 *
 * @link   http://wiki.splitbrain.org/wiki:tpl:templates
 * @author Andreas Gohr <andi@splitbrain.org>
 * @author Anika Henke <a.c.henke@arcor.de>
 */

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

/* include template translations */
include_once(dirname(__FILE__).'/lang/en/lang.php');
@include_once(dirname(__FILE__).'/lang/'.$conf['lang'].'/lang.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang']?>"
 lang="<?php echo $conf['lang']?>" dir="<?php echo $lang['direction']?>">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php tpl_pagetitle()?> [<?php echo strip_tags($conf['title'])?>]</title>
  <?php tpl_metaheaders()?>
  <link rel="shortcut icon" href="<?php echo DOKU_TPL?>images/favicon.ico" />
</head>

<body>
<div id="ach__template" class="dokuwiki">
  <?php html_msgarea()?><!-- error messages, etc. -->
  <div id="ach__header">
 
    <h1><?php tpl_link(wl(),$conf['title'],'name="dokuwiki__top" id="dokuwiki__top" accesskey="h" title="[ALT+H]"')?></h1>
    <h2>[[<?php echo $ID?>]]</h2>

    <?php if($conf['breadcrumbs']){?>
      <p class="trace"><?php tpl_breadcrumbs()?></p>
    <?php }?>
    <?php if($conf['youarehere']){?>
      <p class="trace"><?php tpl_youarehere()?></p>
    <?php }?>
  </div><!-- /ach__header -->
  <hr class="invisible" />

  <div id="ach__mainbox">

    <div id="ach__pageactions">
      <?php tpl_button('edit')?>
      <?php
        $discussNS='discussion:';
        if(substr($ID,0,strlen($discussNS))==$discussNS) {
          $backID=substr(strstr($ID,':'),1);
          print html_btn('back',$backID,'',array());
          /*link instead of button: tpl_pagelink(':'.$backID,$lang['btn_back']);*/
        } else {
          print html_btn('discussion',$discussNS.$ID,'',array());
          /*link instead of button: tpl_pagelink($discussNS.$ID,$lang['btn_discussion']);*/
        }
      ?>
      <?php tpl_button('history')?>
      <?php tpl_button('backlink')?>
    </div><!-- /ach__pageactions -->
    

    <div id="ach__siteactions">
      <div class="box">
        <ul>
          <li><?php tpl_link(wl('wiki:syntax'),'Wiki Syntax')?></li>
          <li><?php tpl_actionlink('recent')?></li>
          <li><?php tpl_actionlink('index')?></li>
        </ul>
        <?php tpl_searchform()?>
      </div>
       
<!-- todo: navigation bar
      <div class="box">
        <?/*php html_index($IDX);*/?>
      </div>
-->
      <?php if($conf['useacl']){?>
      <div class="box">
      <?php if($_SERVER['REMOTE_USER']){
         ob_start();
         tpl_actionlink('profile');
         $_profile = ob_get_contents();
         ob_end_clean();

         ob_start();
         tpl_actionlink('subscription');
         $_subscription = ob_get_contents();
         ob_end_clean();

         ob_start();
         tpl_actionlink('admin');
         $_admin = ob_get_contents();
         ob_end_clean();
      ?>
          <ul>
            <li><?php tpl_actionlink('login')?></li>
            <?php if($_profile){?>
               <li><?php print $_profile;?></li>
            <?php }?>
            <?php if($_subscription){?>
               <li><?php print $_subscription;?></li>
            <?php }?>
            <?php if($_admin){?>
               <li><?php print $_admin;?></li>
            <?php }?>
          </ul>
          <p><em><?php tpl_userinfo()?></em></p>
        <?php }else{
          html_login();
        }?>
      </div>
      <?php }?>
    </div><!-- /ach__siteactions -->
    <hr class="invisible" />

    <?php flush()?>

    <div id="ach__content">
      <!-- wikipage start -->
      <?php tpl_content()?>
      <!-- wikipage stop -->
      <div class="clearer">&nbsp;</div>
    </div><!-- /ach__content -->

    <?php flush()?>

  </div><!-- /ach__mainbox -->
  <hr class="invisible" />


  <div id="ach__footer">
        <p class="pageinfo"><?php tpl_pageinfo()?></p>
        <p><?php tpl_actionlink('top')?></p>
      <div class="clearer">&nbsp;</div>
  </div>

</div><!-- /ach__template -->

<div class="no"><?php tpl_indexerWebBug()?></div>
</body>
</html>
