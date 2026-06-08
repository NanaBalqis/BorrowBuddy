<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminLogModel extends Model
{
    protected $table = 'adminactivitylog';
    protected $primaryKey = 'logId';
    protected $allowedFields = [
        'adminId', 
        'action', 
        'description', 
        'actionDateTime'];

    public function logAction($adminId, $actionType, $description)
    {
        return $this->insert([
            'adminId' => $adminId,
            'action' => $actionType,
            'description' => $description,
            'actionDateTime' => date('Y-m-d H:i:s')
        ]);
    }

    public function getLogsByAdmin($adminId)
    {
        return $this->where('adminId', $adminId)->orderBy('actionDateTime', 'DESC')->findAll();
    }
}
