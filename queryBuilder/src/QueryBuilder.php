<?php

namespace App;

class QueryBuilder
{ 
    private $from;
    private $order = [];
    private $limit;
    private $select = ['*'];
    private $offset;
    private $param = [];
    private $where;

    public function from($table, $alias = null)
    {
        $this->from = "$table";
        if ($alias) {
            $this->from .= " $alias";
        }
        return $this;
    }

    public function select(...$fields)
    {
        if (is_array($fields[0]))
          $fields = $fields[0];
        if ($this->select === ['*'])
          $this->select = $fields;
        else
          $this->select = array_merge($this->select, $fields);
        return $this;
    }

    public function orderBy($field, $order)
    {
        if (!in_array($order, ['ASC', 'DESC'])) {
            $this->order[] = "$field";
        } else {
            $this->order[] = "$field $order";
        }
        return $this;
    }

    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    public function page($page)
    {
        if ($this->limit > 0)
          $this->offset = ($page - 1) * $this->limit;
        return $this;
    }

    public function setParam($param, $value)
    {
        $this->param[] = [$param => $value];
        return $this;
    }

    public function where($condition)
    {
        $this->where = $condition;
        return $this;
    }

    public function fetch($pdo, $field): ?string{
        $query = $pdo->prepare($this->toSQL());
        $query->execute($this->param);
        $result = $query->fetch();
        if ($result === false) {
            return null;
        }
        return $result[$field] ?? null;
    }

    public function count($pdo): int{
        return (int)(clone $this)->select('COUNT(id) count')->fetch($pdo, 'count');
    }

    public function toSQL()
    {
        $sql = "SELECT " . implode(", ", $this->select) . " FROM $this->from";
        if ($this->where) {
            $sql .= " WHERE $this->where";
        }
        if ($this->order) {
            $sql .= " ORDER BY " . implode(", ", $this->order);
        }
        if ($this->limit > 0) {
          $sql .= " LIMIT $this->limit";
        }
        if ($this->offset !== null) {
          $sql .= " OFFSET $this->offset";
        }
        return $sql;
    }
}