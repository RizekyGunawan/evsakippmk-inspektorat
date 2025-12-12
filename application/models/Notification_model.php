<?php
class Notification_model extends CI_Model {
    protected $table = 'notifications';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getUnreadCount($userId) {
        return $this->db->where('user_id', $userId)
                      ->where('is_read', 0)
                      ->where('deleted_at', null)
                      ->count_all_results($this->table);
    }

    public function getUserNotifications($userId, $limit = 10) {
        return $this->db->where('user_id', $userId)
                      ->where('deleted_at', null)
                      ->order_by('created_at', 'DESC')
                      ->limit($limit)
                      ->get($this->table)
                      ->result_array();
    }

    public function markAsRead($id, $userId) {
        return $this->db->where('id', $id)
                      ->where('user_id', $userId)
                      ->update($this->table, [
                          'is_read' => 1,
                          'read_at' => date('Y-m-d H:i:s'),
                          'updated_at' => date('Y-m-d H:i:s')
                      ]);
    }

    public function markAllAsRead($userId) {
        return $this->db->where('user_id', $userId)
                      ->where('is_read', 0)
                      ->update($this->table, [
                          'is_read' => 1,
                          'read_at' => date('Y-m-d H:i:s'),
                          'updated_at' => date('Y-m-d H:i:s')
                      ]);
    }

    public function create($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}
