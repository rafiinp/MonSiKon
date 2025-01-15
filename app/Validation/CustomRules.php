<?php

namespace App\Validation;

use CodeIgniter\Validation\Rules;
use Config\Database;

class CustomRules
{
    public function exists($str, string $field): bool
    {
        // Split the field into table and column
        [$table, $column] = explode('.', $field);

        // Get database connection
        $db = Database::connect();

        // Check if the value exists in the specified table and column
        $result = $db->table($table)
                     ->where($column, $str)
                     ->countAllResults();

        return $result > 0;
    }
}