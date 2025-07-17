<?php

use App\Models\ActivityLog;
use Carbon\Carbon;

function logActivity($action, $targetType, $targetId = null, $notes = null)
{
    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => $action,
        'target_type' => $targetType,
        'target_id' => $targetId,
        'notes' => $notes,
        'created_at' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
    ]);
}
