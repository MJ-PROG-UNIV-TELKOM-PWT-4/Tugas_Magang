<?php

use App\Models\ActivityLog;

function logActivity($action, $targetType, $targetId = null, $notes = null)
{
    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => $action,
        'target_type' => $targetType,
        'target_id' => $targetId,
        'notes' => $notes,
        'created_at' => now(),
    ]);
}
