<?php

/**
 * PluginmdConfig form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginmdConfigForm extends BasemdConfigForm
{

	  public function setup()
  {
		parent::setup();

	  	// Agregar Nombre y Clave //
      	$this->widgetSchema ['nombre'] -> setAttribute('readonly', 'readonly');
      	$this->widgetSchema ['clave']  -> setAttribute('readonly', 'readonly');

  }
}
