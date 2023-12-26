<?php
namespace App\Repositories;

use App\Models\User;

use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    /**
     * ユーザーの情報を取得
     *
     * @param int $id
     * @return User
     */
    public function getUser($id)
    {
        return User::where('id', $id)->firstOrFail();
    }
}