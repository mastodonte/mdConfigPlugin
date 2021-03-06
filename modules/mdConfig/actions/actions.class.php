<?php

require_once dirname(__FILE__).'/../lib/mdConfigGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/mdConfigGeneratorHelper.class.php';

/**
 * mdConfig actions.
 *
 * @package    mdConfigPlugin
 * @subpackage mdConfig
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mdConfigActions extends autoMdConfigActions
{
	public function executeIndex(sfWebRequest $request)
	{

	// $apps = Doctrine_Core::getTable('mdConfig');
	// 	foreach ($apps as $app) {
 //  		sfConfig::set($app->getClave(), $app->getValor());
 //  	}

    if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
    {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }

    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
  }

	protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

    $values = $form->getTaintedValues();

      if ($form->isValid())
    	{

      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $md_config = $form->save();
        } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
        }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $md_config)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@md_config_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'md_config_edit', 'sf_subject' => $md_config));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

}
