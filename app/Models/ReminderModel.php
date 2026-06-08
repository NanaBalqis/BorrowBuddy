<?php

namespace App\Models;

use CodeIgniter\Model;

class ReminderModel extends Model
{
    protected $table = 'reminder';
    protected $primaryKey = 'reminderId';
    protected $allowedFields = [
        'rentalId', 
        'userId', 
        'message', 
        'type', 
        'reminderDate'
    ];

    public function getReminderForUser($userId)
    {
        return $this->where('userId', $userId)->orderBy('reminderDate', 'DESC')->findAll();
    }

    public function createReminder($userId, $message)
    {
        return $this->insert([
            'userId' => $userId,
            'message' => $message,
            'type' => 'reminder',
            'reminderDate' => date('Y-m-d H:i:s')
        ]);
    }

    public function createOverdueAlert($userId, $message)
    {
        return $this->insert([
            'userId' => $userId,
            'message' => $message,
            'type' => 'overdue',
            'reminderDate' => date('Y-m-d H:i:s')
        ]);
    }
}
