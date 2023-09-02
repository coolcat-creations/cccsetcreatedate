<?php
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;

class PlgContentCccsetCreationDate extends CMSPlugin
{
	public function onContentBeforeSave($context, $article, $isNew)
	{
		$app = Factory::getApplication();

		// Check for both backend and frontend context
		if ($context !== 'com_content.article' && $context !== 'com_content.form') {
			return true;
		}

		if ($app->isClient('administrator')) {
			// Backend
			$input = $app->input;
			$formData = $input->get('jform', array(), 'array');


			if (isset($formData['com_fields']['startdatum']) && !empty($formData['com_fields']['startdatum'])) {
				$article->created = Factory::getDate($formData['com_fields']['startdatum'])->toSql();
			}
		} else {
			// Frontend
			$input = $app->input;
			$formData = $input->get('jform', array(), 'array');

			if (isset($formData['com_fields']['startdatum']) && !empty($formData['com_fields']['startdatum'])) {
				$article->created = Factory::getDate($formData['com_fields']['startdatum'])->toSql();
			}

		}

		return true;
	}
}
