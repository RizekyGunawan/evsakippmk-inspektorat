<?php

use App\Models\UnitEvaluatorModel;

if (!function_exists('send_notification')) {
    /**
     * Send notification to user(s)
     * 
     * @param int|array $userId User ID or array of User IDs
     * @param string $title Notification title
     * @param string $message Notification message
     * @param string|null $url URL to redirect to when clicked
     * @return bool|array Returns true if successful, or array of errors
     */
    function send_notification($userId, string $title, string $message, ?string $url = null)
    {
        $notificationModel = new \App\Models\NotificationModel();
        
        if (!is_array($userId)) {
            $userId = [$userId];
        }
        
        $success = true;
        $errors = [];
        
        foreach ($userId as $id) {
            $data = [
                'user_id' => $id,
                'title'   => $title,
                'message' => $message,
                'url'     => $url,
                'is_read' => 0,
            ];
            
            try {
                $notificationModel->createNotification($data);
            } catch (\Exception $e) {
                $errors[$id] = $e->getMessage();
                $success = false;
                log_message('error', 'Failed to send notification: ' . $e->getMessage());
            }
        }
        
        return $success ?: $errors;
    }
}

if (!function_exists('notify_evaluators')) {
    /**
     * Send notification to all evaluators of a unit
     * 
     * @param int $unitId Unit ID
     * @param string $title Notification title
     * @param string $message Notification message
     * @param string|null $url URL to redirect to when clicked
     * @return bool|array Returns true if successful, or array of errors
     */
    function notify_evaluators(int $unitId, string $title, string $message, ?string $url = null)
    {
        $unitEvaluatorModel = new UnitEvaluatorModel();
        $evaluators = $unitEvaluatorModel->getEvaluatorsByUnit($unitId);
        
        if (empty($evaluators)) {
            log_message('info', "No evaluators found for unit ID: {$unitId}");
            return false;
        }
        
        $evaluatorIds = array_column($evaluators, 'evaluator_id');
        return send_notification($evaluatorIds, $title, $message, $url);
    }
}

if (!function_exists('notify_unit')) {
    /**
     * Send notification to all users in a unit
     * 
     * @param int $unitId Unit ID
     * @param string $title Notification title
     * @param string $message Notification message
     * @param string|null $url URL to redirect to when clicked
     * @return bool|array Returns true if successful, or array of errors
     */
    function notify_unit(int $unitId, string $title, string $message, ?string $url = null)
    {
        // Assuming you have a model to get users by unit
        $userModel = new \App\Models\UserModel();
        $users = $userModel->where('unit_id', $unitId)->findAll();
        
        if (empty($users)) {
            log_message('info', "No users found in unit ID: {$unitId}");
            return false;
        }
        
        $userIds = array_column($users, 'id');
        return send_notification($userIds, $title, $message, $url);
    }
}
