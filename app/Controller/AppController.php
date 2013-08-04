<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('CakeNumber', 'Utility');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array('DebugKit.Toolbar', 'Session', 'Cookie');
	public $helpers = array(
		'Js' => array('Jquery'),
		'Number' => array(
			'places' => 2,
			'thousands' => '.',
			'decimals' => ',',
			'wholeSymbol' => '€',
			'wholePosition' => 'after'
		)
	);
	//public $theme = 'Loteria';
	
	public function beforeFilter() {
	    parent::beforeFilter();
	    
	    $this->Cookie->time = '1 year';  // or '1 hour'
	}
	
	public function beforeRender() {
		parent::beforeRender();
		
		CakeNumber::addFormat('EUR', array(
			'thousands' => '.',
			'decimals' => ',',
			'wholeSymbol' => ' €',
			'wholePosition' => 'after'
		));
		CakeNumber::defaultCurrency('EUR');
	}
}
