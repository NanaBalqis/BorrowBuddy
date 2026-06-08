<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'userId';
    protected $allowedFields = [
        'fullName', 
        'email', 
        'password', 
        'phoneNum', 
        'userType',
        'membershipDate', 
        'position', 
        'staffSince',
        'profile_picture',
        'created_at', 
        'remember_token', 
        'reset_token', 
        'reset_expires_at'
    ];

    // Get user by username (if used)
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    // Reset password token
    public function setResetToken($email, $token)
    {
        return $this->where('email', $email)
                    ->set([
                        'reset_token' => $token,
                        'reset_expires_at' => date('Y-m-d H:i:s', strtotime('+1 hour'))
                    ])
                    ->update();
    }

    public function verifyResetToken($token)
    {
        return $this->where('reset_token', $token)
                    ->where('reset_expires_at >=', date('Y-m-d H:i:s'))
                    ->first();
    }

    public function updateProfile($primaryKey, $allowedFields)
    {
        return $this->update($primaryKey, $allowedFields);
    }

    public function setRememberToken($primaryKey, $token)
    {
        return $this->update($primaryKey, ['remember_token' => $token]);
    }

    public function getAllMembers()
    {
        return $this->where('userType', 'member')->findAll();
    }

    public function getAllAdmins()
    {
        return $this->where('userType', 'admin')->findAll();
    }
}
