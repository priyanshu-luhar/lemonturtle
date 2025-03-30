<?php
// Edited by Priyanshu Luhar

function makeTable($data, $showHeader = true) {
    $tableStr = "";

    $tableStr .= "<table style=\"width:100%;  font-size:16px;\">";

    foreach($data as $row) {
        if ($showHeader) {
            $tableStr .= "<tr>";
            foreach($row as $columnName => $columnValue) {
                $tableStr .= sprintf("<td><h1><pre>%s </pre></h1></td>", strtoupper($columnName));
            }
            $tableStr .= "</tr>";
            $showHeader = false;
        }
        $tableStr .= "<tr style=\"outline: thin solid white\">";
        foreach($row as $columnName => $columnValue) {
            $tableStr .= sprintf("<td>%s</td>", $columnValue);
        }
        $tableStr .= "</tr>";
    }

    $tableStr .= "</table>";

    return $tableStr;
}

?>
