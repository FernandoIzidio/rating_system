<?php

namespace app\models;

use app\database\config\Connection;

abstract class BaseModel {
/**
 * Prepares a secure query with parameter binding.
 *
 * @param string $query The SQL query to be prepared.
 * @param ...$params An array of associative arrays containing key-value pairs for parameter binding.
 *
 * @return \PDOStatement The prepared statement object.
 */
protected static function getSecureQuery(string $query, ...$params): \PDOStatement {
    $pdo = Connection::getConnection();

    $query = $pdo->prepare($query);

    if (!empty($params)) {
        foreach ($params as $dict) {
            foreach ($dict as $key => $value) {
                $query->bindValue($key, $value);
            }
        }
    }

    return $query;
}


/**
 * Returns severals requested fields from the database based on the primary key value or like pk
 *
 * @param string $pkName The name of the primary key column
 * @param string $pkValue The value of the primary key column
 * @param array $requestedFields The list of fields to be retrieved
 * @return array The record with the requested fields
 */
abstract public static function getField(string $pkName, string $pkValue, array $requestedFields): array;
}