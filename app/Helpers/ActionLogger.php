<?php

namespace App\Helpers;

use App\Helpers\AuthCommon;
use App\Models\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActionLogger
{
    /**
     * Log an action performed by the user.
     *
     * @param string $action
     * @param string $module
     * @param string|null $description
     */
    public static function log(string $action, ?string $description = null) {}
}
