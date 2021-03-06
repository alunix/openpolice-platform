<?
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<? foreach($categories as $category) : ?>
    <div class="article">
        <h1 class="article__header">
            <a href="<?= helper('route.category', array('row' => $category)) ?>">
                <?= escape($category->title);?>
            </a>
        </h1>

        <? if($category->attachments_attachment_id) : ?>
        <a class="article__thumbnail" href="<?= helper('route.category', array('row' => $category)) ?>">
            <?= helper('com:police.image.thumbnail', array(
                'attachment' => $category->attachments_attachment_id,
                'attribs' => array('width' => '400', 'height' => '300'))) ?>
        </a>
        <? endif ?>

        <? if ($category->description) : ?>
            <?= $category->description; ?>
        <? endif; ?>

        <? if($category->count) : ?>
        <a class="article__readmore" href="<?= helper('route.category', array('row' => $category)) ?>"><?= translate('Read more') ?></a>
        <? endif ?>
    </div>
<? endforeach; ?>
