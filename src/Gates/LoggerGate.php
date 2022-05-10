<?php

namespace Toshkq93\Logger\Gates;

use App\Models\Users\User;

class LoggerGate
{
    /**
     * @param User $user
     * @return bool
     */
    public function check(User $user): bool
    {
        return true;
    }
}
