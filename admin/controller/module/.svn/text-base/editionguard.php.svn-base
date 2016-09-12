<?php
/*
 * @support
 * http://www.opensourcetechnologies.com/contactus.html
 * sales@opensourcetechnologies.com
 * */
class ControllerModuleEditionGuard extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/editionguard');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('editionguard', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
	
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_secret'] = $this->language->get('entry_secret');
		$data['entry_distributorid'] = $this->language->get('entry_distributorid');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
				
		if (isset($this->error['editionguard_email'])) {
			$data['error_editionguard_email'] = $this->error['editionguard_email'];
		} else {
			$data['error_editionguard_email'] = '';
		}
		
		if (isset($this->error['editionguard_secret'])) {
			$data['error_editionguard_secret'] = $this->error['editionguard_secret'];
		} else {
			$data['error_editionguard_secret'] = '';
		}
		
		if (isset($this->error['editionguard_distributorid'])) {
			$data['error_editionguard_distributorid'] = $this->error['editionguard_distributorid'];
		} else {
			$data['error_editionguard_distributorid'] = '';
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/editionguard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/editionguard', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['editionguard_status'])) {
			$data['editionguard_status'] = $this->request->post['editionguard_status'];
		} else {
			$data['editionguard_status'] = $this->config->get('editionguard_status');
		}
		
		if (isset($this->request->post['editionguard_email'])) {
			$data['editionguard_email'] = $this->request->post['editionguard_email'];
		} else {
			$data['editionguard_email'] = $this->config->get('editionguard_email');
		}
		
		if (isset($this->request->post['editionguard_secret'])) {
			$data['editionguard_secret'] = $this->request->post['editionguard_secret'];
		} else {
			$data['editionguard_secret'] = $this->config->get('editionguard_secret');
		}
		
		if (isset($this->request->post['editionguard_distributorid'])) {
			$data['editionguard_distributorid'] = $this->request->post['editionguard_distributorid'];
		} else {
			$data['editionguard_distributorid'] = $this->config->get('editionguard_distributorid');
		}
		
		if (isset($this->request->post['editionguard_sort_order'])) {
			$data['editionguard_sort_order'] = $this->request->post['editionguard_sort_order'];
		} else {
			$data['editionguard_sort_order'] = $this->config->get('editionguard_sort_order');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/editionguard.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/editionguard')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (!$this->request->post['editionguard_distributorid']) {
			$this->error['editionguard_distributorid'] = $this->language->get('error_editionguard_distributorid');
		}
		if (!$this->request->post['editionguard_email']) {
			$this->error['editionguard_email'] = $this->language->get('error_editionguard_email');
		}
		if (!$this->request->post['editionguard_secret']) {
			$this->error['editionguard_secret'] = $this->language->get('error_editionguard_secret');
		}
		return !$this->error;
	}
}
