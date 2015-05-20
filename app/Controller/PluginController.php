<?php
class PluginController extends AppController{
	
	function admin_index() {
		if($this->Connect->connect() AND $this->Connect->if_admin()) {
			 
			$this->set('title_for_layout',$this->Lang->get('PLUGINS_LIST'));
			$this->layout = 'admin';
		} else {
			$this->redirect('/');
		}
	}

	function admin_delete($id = false) {
		if($this->Connect->connect() AND $this->Connect->if_admin()) {
			if($id != false) {
				 
				if($this->EyPlugin->delete($id)) {
					$this->History->set('DELETE_PLUGIN', 'plugin');
					$this->Session->setFlash($this->Lang->get('PLUGIN_DELETE_SUCCESS'), 'default.success');
					$this->redirect(array('controller' => 'plugin', 'action' => 'index', 'admin' => true));
				} else {
					$this->Session->setFlash($this->Lang->get('INTERNAL_ERROR'), 'default.error');
					$this->redirect(array('controller' => 'plugin', 'action' => 'index', 'admin' => true));
				}
			} else {
				$this->redirect(array('controller' => 'plugin', 'action' => 'index', 'admin' => true));
			}
		} else {
			$this->redirect('/');
		}
	}

	function admin_enable($id = false) {
		if($this->Connect->connect() AND $this->Connect->if_admin()) {
			if($id != false) {
				 
				if($this->EyPlugin->enable($id)) {
					$this->History->set('ENABLE_PLUGIN', 'plugin');
					$this->Session->setFlash($this->Lang->get('PLUGIN_ENABLE_SUCCESS'), 'default.success');
					$this->redirect(array('controller' => 'plugin', 'action' => 'index', 'admin' => true));
				} else {
					$this->Session->setFlash($this->Lang->get('INTERNAL_ERROR'), 'default.error');
					$this->redirect(array('controller' => 'plugin', 'action' => 'index', 'admin' => true));
				}
			} else {
				$this->redirect(array('controller' => 'plugin', 'action' => 'index', 'admin' => true));
			}
		} else {
			$this->redirect('/');
		}
	}

	function admin_disable($id = false) {
		if($this->Connect->connect() AND $this->Connect->if_admin()) {
			if($id != false) {
				 
				if($this->EyPlugin->disable($id)) {
					$this->History->set('DISABLE_PLUGIN', 'plugin');
					$this->Session->setFlash($this->Lang->get('PLUGIN_DISABLE_SUCCESS'), 'default.success');
					$this->redirect(array('controller' => 'plugin', 'action' => 'index', 'admin' => true));
				} else {
					$this->Session->setFlash($this->Lang->get('INTERNAL_ERROR'), 'default.error');
					$this->redirect(array('controller' => 'plugin', 'action' => 'index', 'admin' => true));
				}
			} else {
				$this->redirect(array('controller' => 'plugin', 'action' => 'index', 'admin' => true));
			}
		} else {
			$this->redirect('/');
		}
	}

	function admin_install($plugin_id = false, $plugin_name = false) {
		if($this->Connect->connect() AND $this->Connect->if_admin()) {
			if($plugin_id != false AND $plugin_name != false) {
				 
				if($this->EyPlugin->install($plugin_id, $plugin_name)) {
					$this->History->set('INSTALL_PLUGIN', 'plugin');
					$this->Session->setFlash($this->Lang->get('PLUGIN_INSTALL_SUCCESS'), 'default.success');
					$this->redirect(array('controller' => 'plugin', 'action' => 'index', 'admin' => true));
				} else {
					$this->Session->setFlash($this->Lang->get('INTERNAL_ERROR'), 'default.error');
					$this->redirect(array('controller' => 'plugin', 'action' => 'index', 'admin' => true));
				}
			} else {
				$this->redirect(array('controller' => 'plugin', 'action' => 'index', 'admin' => true));
			}
		} else {
			$this->redirect('/');
		}
	}

	function admin_update($plugin_id, $plugin_name) {
		if($this->Connect->connect() AND $this->Connect->if_admin()) {
			if($plugin_id != false AND $plugin_name != false) {
				 
				if($this->EyPlugin->update($plugin_id, $plugin_name)) {
					$this->History->set('UPDATE_PLUGIN', 'plugin');
					$this->Session->setFlash($this->Lang->get('PLUGIN_UPDATE_SUCCESS'), 'default.success');
					$this->redirect(array('controller' => 'plugin', 'action' => 'index', 'admin' => true));
				} else {
					$this->Session->setFlash($this->Lang->get('INTERNAL_ERROR'), 'default.error');
					$this->redirect(array('controller' => 'plugin', 'action' => 'index', 'admin' => true));
				}
			} else {
				$this->redirect(array('controller' => 'plugin', 'action' => 'index', 'admin' => true));
			}
		} else {
			$this->redirect('/');
		}
	}

}