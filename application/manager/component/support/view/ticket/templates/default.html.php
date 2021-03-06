<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<script src="assets://js/koowa.js" />
<script src="assets://support/js/comment.js" />
<script src="assets://files/js/uri.js" />

<style src="assets://support/css/default.css" />

<script>
    window.addEvent('domready', function() {
        new Comment({
            container: 'comment',
            action: '<?= route('&view=comment&row='.$ticket->id.'&table=support_tickets') ?>',
            token: '<?= $this->getObject('user')->getSession()->getToken() ?>'
        });
    });
</script>

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<div id="support__ticket" class="scrollable">
    <div class="header">
        <h1>
            <?= $ticket->zone ?> - <?= $ticket->title ?>
        </h1>
        <?= $ticket->created_by_name ?> - <?= helper('date.format', array('date'=> $ticket->created_on, 'format' => 'd F Y H:m')) ?>
        <span class="label label-<?= $ticket->status ?>"><?= translate($ticket->status) ?></span>
    </div>

    <form id="comment" class="group" action="<?= route('&view=comment&row='.$ticket->support_ticket_id.'&table=support_tickets') ?>" method="post">
        <input type="hidden" name="row" value="<?= $ticket->support_ticket_id ?>" />
        <input type="hidden" name="site" value="<?= $ticket->zone ?>" />
        <input type="hidden" name="table" value="support_tickets" />
        <input type="hidden" name="status" value="" />
        <?= object('com:ckeditor.controller.editor')->render(array('name' => 'text', 'text' => '', 'toolbar' => 'basic')) ?>
        <br />
        <a class="btn" href="#" data-action="submit" data-status="open">
            <?= translate('Submit') ?>
        </a>
        <? if($user->getRole() == '25') : ?>
        <a class="btn btn-warning" href="#" data-action="submit" data-status="pending">
            <?= translate('Submit as Pending') ?>
        </a>
        <? endif ?>
        <a class="btn btn-success" href="#" data-action="submit" data-status="solved">
            <?= translate('Submit as Solved') ?>
        </a>
    </form>

    <div class="comments">
        <? foreach($ticket->getCommentsFromElasticSearch() as $comment) : ?>
            <div class="comment comment_<?= $comment->id ?>">
                <strong><?= $comment->created_by == $user->getId() ? translate('You') : $comment->created_by_name ?></strong>
                <span class="muted">
                    <?= helper('date.format', array('date'=> $comment->created_on, 'format' => 'd F Y H:i')) ?>
                </span>
                <div class="comment__text">
                    <?= $comment->text ?>
                </div>
            </div>
        <? endforeach; ?>

        <div class="comment">
            <strong><?= $ticket->created_by == $user->getId() ? translate('You') : $ticket->created_by_name ?></strong>
            <span class="muted">
                <?= helper('date.format', array('date'=> $ticket->created_on, 'format' => 'd F Y H:i')) ?>
            </span>
            <?= $ticket->text ?>
        </div>
    </div>
</div>
