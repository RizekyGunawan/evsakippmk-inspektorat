<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('notification_model');
        $this->load->helper('url');
        
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            $this->output->set_status_header(401);
            exit('Unauthorized');
        }
    }

    public function index() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $notifications = $this->notification_model->getUserNotifications($this->session->userdata('id'));
        $unreadCount = $this->notification_model->getUnreadCount($this->session->userdata('id'));
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => 'success',
                'data' => $notifications,
                'unread_count' => $unreadCount
            ]));
    }

    public function markAsRead($id = null) {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $userId = $this->session->userdata('id');
        
        if ($id) {
            $this->notification_model->markAsRead($id, $userId);
        } else {
            $this->notification_model->markAllAsRead($userId);
        }
        
        $unreadCount = $this->notification_model->getUnreadCount($userId);
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => 'success',
                'unread_count' => $unreadCount
            ]));
    }

    public function unreadCount() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $unreadCount = $this->notification_model->getUnreadCount($this->session->userdata('id'));
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'count' => $unreadCount
            ]));
    }

    // Admin function to send notifications
    public function send() {
        // Only allow admin access
        if ($this->session->userdata('role') !== 'admin') {
            show_404();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('user_id', 'User ID', 'required|numeric');
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');
            
            if ($this->form_validation->run()) {
                $data = [
                    'user_id' => $this->input->post('user_id'),
                    'title' => $this->input->post('title'),
                    'message' => $this->input->post('message'),
                    'url' => $this->input->post('url')
                ];
                
                $this->notification_model->create($data);
                
                $this->session->set_flashdata('success', 'Notification sent successfully');
                redirect('notification/send');
            }
        }
        
        $this->load->view('notification/send');
    }
}
