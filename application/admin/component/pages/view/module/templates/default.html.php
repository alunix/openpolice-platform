<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<script src="assets://js/koowa.js" />
<?= helper('behavior.validator') ?>

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<? if($module->isTranslatable()) : ?>
<ktml:module position="actionbar" content="append">
    <?= helper('com:languages.listbox.languages', array('attribs' => array('disabled' => 'true'))) ?>
</ktml:module>
<? endif ?>

<form action="<?= route('id='.$module->id.'&application='.$state->application) ?>" method="post" class="-koowa-form">
	<input type="hidden" name="access" value="0" />
	<input type="hidden" name="published" value="0" />
	<input type="hidden" name="name" value="<?= $module->name ?>" />
	<input type="hidden" name="application" value="<?= $module->application ?>" />
	
	<div class="main">
		<div class="title">
			<input class="required" type="text" name="title" value="<?= escape($module->title) ?>" />
		</div>

		<div class="scrollable">
		    <fieldset>
		    	<legend><?= translate('Details'); ?></legend>
				<div>
				    <label><?= translate('Type') ?></label>
				    <div>
				        <?= translate(ucfirst($module->identifier->package)).' &raquo; '. translate(ucfirst($module->identifier->path[1])); ?>
				    </div>
				</div>
				<div>
				    <label><?= translate('Description') ?></label>
				    <div>
				        <?= translate($module->description) ?>
				    </div>
				</div>
			</fieldset>

            <? if($params_rendered = $params->render('params')) : ?>
            <fieldset>
				<legend><?= translate('Default Parameters'); ?></legend>
                <?= $params_rendered; ?>
			</fieldset>
            <? endif ?>

            <? if($params_rendered = $params->render('params', 'advanced')) : ?>
			<fieldset>
				<legend><?= translate('Advanced Parameters'); ?></legend>
                <?= $params_rendered; ?>
			</fieldset>
			<? endif ?>

            <? if($params_rendered = $params->render('params', 'other')) : ?>
			<fieldset>
				<legend><?= translate('Other Parameters'); ?></legend>
                <?= $params_rendered; ?>
			</fieldset>
			<? endif ?>

			<? if($module->name == 'mod_custom') : ?>
			<fieldset>
				<legend><?= translate('Custom Output') ?></legend>
				<?= object('com:ckeditor.controller.editor')->render(array('name' => 'content', 'text' => $module->content)) ?>
			</fieldset>
			<? endif ?>
		</div>
	</div>

	<div class="sidebar">
        <?= import('default_sidebar.html'); ?>
	</div>
</form>