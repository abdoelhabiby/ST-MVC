<?php

namespace Core\Database\Concerns;

use Core\Database\Managers\Contracts\DatabaseManager;

trait ConectsTo
{

    public static function connect(DatabaseManager $databaseManager)
    {
        return $databaseManager->connect();
    }
}
