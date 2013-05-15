<?
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */
?>
<? $site = @object('application')->getCfg('site') ?>
<? $zone = @object('com:police.model.zone')->id($site)->getRow() ?>

<div class="row">
    <div class="span8 hidden-phone">
        <? foreach (@object('com:news.model.articles')->sticky(true)->getRowset() as $article) : ?>
            <div class="page-header">
                <h1><a href="<?= $site.'/nieuws/'.$article->id.'-'.$article->slug ?>"><?= $article->title ?></a></h1>
                <span class="timestamp">
                    <?= @helper('date.format', array('date'=> $article->ordering_date, 'format' => JText::_('DATE_FORMAT_LC5'))) ?>
                </span>
            </div>

            <div class="clearfix">
                <? if($article->thumbnail): ?>
                    <img class="thumbnail" src="<?= $article->thumbnail ?>" />
                <? endif; ?>

                <?= $article->introtext ?>

                <? if ($article->fulltext) : ?>
                    <a href="<?= $site.'/nieuws/'.$article->id.'-'.$article->slug ?>"><?= @text('Read more') ?></a>
                <? endif; ?>
            </div>
        <? endforeach; ?>
    </div>
    <div class="span4">
        <div class="box">
            <p><strong><i class="icon-phone"></i> 101</strong> voor dringende hulp</p>
            <p><strong><i class="icon-phone"></i> <?= $zone->telephone ?></strong> geen spoed, wél politie.</p>
            <hr />
            <h3><i class="icon-comments-alt"></i> Contacteer ons</h3>
            <ul class="nav">
                <li><a href="#">Commissariaten</a></li>
                <li><a href="#">Je wijkinspecteur</a></li>
                <li><a href="#">Diensten</a></li>
                <li><a href="#">Noodnummers</a></li>
            </ul>
        </div>
    </div>
</div>
<hr />
<div class="row">
    <div class="span3">
        <h3><i class="icon-file-alt"></i> Aangifte doen</h3>
        <p>Aangifte doen is belangrijk, alleen dan kan de politie een onderzoek starten.</p>
        <p><a href="<?= $site ?>/aangifte">Doe aangifte &rarr;</a></p>
    </div>
    <div class="span3">
        <h3><i class="icon-question-sign"></i> Vragen</h3>
        <p>Meer weten over cybercrime of drugs? Of wat de politie doet tegen woninginbraak?</p>
        <p><a href="<?= $site ?>/vragen">Beantwoord uw vraag &rarr;</a></p>
    </div>
    <div class="span3">
        <h3><i class="icon-road"></i>Verkeer</h3>
        <p>Bent u opzoek naar informatie over controle acties of verkeersmaatregelen?</p>
        <p><a href="<?= $site ?>/verkeer">Bekijk verkeersinformatie &rarr;</a></p>
    </div>
    <div class="span3">
        <h3><i class="icon-group"></i> Verloren voorwerpen</h3>
        <p>Iets verloren? Misschien hebben wij je verloren voorwerp gevonden.</p>
        <p><a href="#">Verloren voorwerpen &rarr;</a></p>
    </div>
</div>
