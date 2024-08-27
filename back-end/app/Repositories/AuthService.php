<?php

namespace App\Repositories;

use App\Models\Account;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class AuthService
{
    public function register($username, $password, $email)
    {
        DB::beginTransaction();
        try {
            $userAccount = new Account();
            $userAccount->username = $username;
            $userAccount->password = bcrypt($password);
            $userAccount->email = $email;
            $userAccount->save();
            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            if ($e->getCode() == 23505)
                return ['error' => 'Duplicate key value'];
            return ['error' => 'Database error: ' . $e->getMessage()];
        }
    }
}
