<?php
declare(strict_types=1);

namespace Barya\Stats\Storage\MySql;


use Barya\Stats\Api\Models\Post;
use Barya\Stats\Storage\PostStorageInterface;

class PostStorage implements PostStorageInterface
{
    private \PDO $db;

    private const COLUMNS = [
        'id', 'from_id', 'from_name', 'type', 'message', 'message_length', 'created_time'
    ];

    public function __construct(\PDO $db) {
        $this->db = $db;
    }

    /**
     * @inheritDoc
     */
    public function bulkSave($posts): bool {
        if (empty($posts)) {
            return true;
        }

        $columnsString = implode(', ', array_map(function($col) {
            return "`$col`";
        }, self::COLUMNS));

        $toBind = [];
        $sqlValues = [];
        foreach ($posts as $key => $post) {
            $params = [];
            foreach (self::COLUMNS as $col) {
                list ($param, $value, $type) = $this->getParamInfo($col, $key, $post);
                $params[] = $param;
                $toBind[$param] = [
                    'value' => $value,
                    'type' => $type
                ];
            }
            $sqlValues[] = sprintf('(%s)', implode(', ', $params));
        }

        $sqlValuesString = implode(', ', $sqlValues);
        $onDuplicateUpdateString = implode(', ', $this->prepareOnDuplicateValues());

        $sql = sprintf('INSERT INTO posts (%s) VALUES %s ON DUPLICATE KEY UPDATE %s',
            $columnsString,
            $sqlValuesString,
            $onDuplicateUpdateString
        );

        $pdoStatement = $this->db->prepare($sql);
        foreach ($toBind as $param => $value) {
            $pdoStatement->bindValue($param, $value['value'], $value['type']);
        }

        return $pdoStatement->execute();
    }

    private function prepareOnDuplicateValues(): array {
        $onDuplicateValues = [];
        foreach (self::COLUMNS as $col) {
            if ($col === 'id') {
                continue;
            }
            $onDuplicateValues[] = sprintf('`%s`=VALUES(`%s`)', $col, $col);
        }
        return $onDuplicateValues;
    }

    private function getParamInfo($col, $key, Post $post): array {
        $param = sprintf(":%s_%s", $col, $key);
        switch ($col) {
            case 'id':
                $value = $post->getId();
                $type = \PDO::PARAM_STR;
                break;
            case 'from_id':
                $value = $post->getFromId();
                $type = \PDO::PARAM_STR;
                break;
            case 'from_name':
                $value = $post->getFromName();
                $type = \PDO::PARAM_STR;
                break;
            case 'type':
                $value = $post->getType();
                $type = \PDO::PARAM_STR;
                break;
            case 'message':
                $value = $post->getMessage();
                $type = \PDO::PARAM_STR;
                break;
            case 'message_length':
                $value = mb_strlen($post->getMessage());
                $type = \PDO::PARAM_INT;
                break;
            case 'created_time':
                $value = (new \DateTime($post->getCreatedTime()))->format('Y-m-d H:i:s');
                $type = \PDO::PARAM_STR;
                break;
            default:
                throw new \RuntimeException('Broken columns set');
        }
        return [$param, $value, $type];
    }
}
