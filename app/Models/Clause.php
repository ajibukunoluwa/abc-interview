<?php

namespace App\Models;

class Clause
{
    public function where(array $conditions) : string
    {
        $counter = 0;
        $whereClause = '';
        $total = count($conditions);

        foreach($conditions as $key => $value)
        {
            // $format = (is_int($value)) ? "`$key` = $value" : "`$key` = '$value'";
            $format = (is_numeric($value)) ? "`$key` = $value" : "`$key` = '$value'";
            if(++$counter === 1)
            {
                $whereClause .= $format;
            }
            else
            {
                $whereClause .= " AND $format";
            }
        }

        return $whereClause;
    }

    public function set(array $conditions) : string
    {
        $counter = 0;
        $setClause = '';
        $total = count($conditions);

        foreach($conditions as $key => $value)
        {
            ++$counter;
            // $format = (is_int($value)) ? "`$key` = $value" : "`$key` = '$value'";
            $format = (is_numeric($value)) ? "`$key` = $value" : "`$key` = '$value'";

            if($counter === 1)
            {
                $setClause .= $format;
            }
            else
            {
                $setClause .= ", $format";
            }
            // if($counter === 1)
            // {
            //     $setClause .= $format;
            // }
            // elseif($counter > 1 AND $counter !== $total)
            // {
            //     $setClause .= ", $format ,";
            // }
            // elseif($counter === $total)
            // {
            //     $setClause .= ", $format";
            // }
        }

        return $setClause;
    }

    public function insert(array $data) : string
    {
        $columns = "`". implode("`,`", array_keys($data)) . "`";
        $values = "'". implode("','", array_values($data)) . "'";

        return "($columns) VALUES ($values)";
    }

}