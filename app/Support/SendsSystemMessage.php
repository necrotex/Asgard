<?php

namespace Asgard\Support;

use Asgard\Models\SystemMessage;

trait SendsSystemMessage
{
    private function notifySystem(
        string $level,
        string $title,
        string $message,
        string $type = "system",
        ?string $contextType = null,
        ?int $contextId = null,
        $active = true
    ) {

        if(!in_array($level, ['debug', 'info', 'warning', 'error'])) {
            throw new \Exception('Unkown System Message Level: ' . $level);
        }

        SystemMessage::create(
            [
                'type' => $type,
                'message' => $message,
                'context_type' => $contextType,
                'level' => $level,
                'title' => $title,
                'context_id' => $contextId,
                'active' => $active
            ]);
    }

}