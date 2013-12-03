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
	public $components = array(
		'RequestHandler',
        'Session',
        'Auth'
    );

    public function beforeFilter() {
    	$this->Auth->userModel = 'User';
    	$this->Auth->authorize = array('Controller');
    	$this->Auth->loginAction = array('controller' => 'User', 'action' => 'login');
		$this->Auth->authenticate = array(
		    'Form' => array(
		        'fields' => array('username' => 'username', 'password' => 'password'),
		        'scope' => array('mail_confirmed' => 1,'active'=>1)
		    ),
		);
		$this->Auth->authError = "Acceso denegado.";
		$this->Auth->unauthorizedRedirect = array('controller' => 'User', 'action' => 'login');
		$this->Auth->loginRedirect = array('controller' => 'User','action'=>"home");
    	$this->Auth->logoutRedirect = array('controller' => 'User','action'=>'login');
        $this->Auth->allow('login','register','contact','getTagsByCategory','faq','terms','politics');
    }

    public function isAuthorized($user) {
	    // Admin can access every action
	    //if (isset($user['isAdmin']) && $user['isAdmin']) {
	        return false;
	    //}
	    // Default deny
	    //return false;
	}
}
