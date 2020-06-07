<?php

include_once('db.config.php');

class Data
{
    function getAllData() {
        global $conn;

        $array = [];
        $sql = "SELECT * FROM tb_dainam";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        $array = mysqli_fetch_all ($result, MYSQLI_ASSOC);

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                 //echo $row['keyword'] . '<br>';
            }
        }
        return $array;
    }

    function getRow($keyword) {
        global $conn;
        $row = 0;
        $keyword = mb_convert_case($keyword, MB_CASE_TITLE, "UTF-8");
        $sql = "SELECT * FROM tb_dainam WHERE keyword = '$keyword'
        or keyword LIKE CONCAT('%', CONVERT(' $keyword ', BINARY), '%') 
        or keyword LIKE CONCAT('%', CONVERT(' $keyword,', BINARY), '%') 
        or keyword LIKE CONCAT('%', CONVERT('$keyword', BINARY), '%')";
        //echo $sql;
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $row = mysqli_fetch_array($result);
        }
        return $row;
    }
}


