<?
    /* functions */
    function dbConnect($dbHost, $dbLogin, $dbPass, $dbBase) {       
        $link = @mysql_connect($dbHost, $dbLogin, $dbPass) or die('Попытка соединения с базой данных провалилась!');
        mysql_set_charset('utf8');
        mysql_select_db($dbBase, $link);
        //echo 'Есть коннект!<br>';
        dbReadToJson();
    }

    function dbReadToJson() {
        $my_query = mysql_query("SELECT * FROM catalogs") or die(mysql_error());
        if (mysql_num_rows($my_query)):
            while ($row=mysql_fetch_assoc($my_query)):
                $data[] = $row['name'];
            endwhile;
        else:
            echo "неа";
        endif;
        echo json_encode($data);
    }

    function dbTestRead() {
        $my_query = mysql_query("SELECT * FROM catalogs") or die(mysql_error());
        if (mysql_num_rows($my_query)):
            echo "<ol>";
            while ($row=mysql_fetch_assoc($my_query)):
                echo "<li>". $row['path']. "</li>";
            endwhile;
            echo "</ol>";
        else:
            echo "неа";
        endif;      
    }

    function countFiles($path) {
     
        global $arRi;

        $papka_handle = opendir($path);

        if (!$papka_handle)
        return -1;

        while ($file = readdir($papka_handle)) :

        if ($file == '..' || $file == '.')
          continue;

        if (is_dir($path . $file)) :
            $skolko_papok++;
            echo $file.'-papka<br><br>';
            $arRi['p']++;
            // $skolko_failov += count_files($path . $file . DIRECTORY_SEPARATOR);
            countFiles($path.$file.DIRECTORY_SEPARATOR);
        else :
            $skolko_failov++;
            echo $file.'-'.$skolko_failov.'<br><br>';
            $arRi['f']++;
            if($file == "move.txt") {
                //rename($path.$file, $path."papka20".DIRECTORY_SEPARATOR.$file);
            }
        endif;
        endwhile;

            closedir($papka_handle); 
            // $p = $skolko_papok;
            // $f = $skolko_failov;
            // $arRi['p'] = $p;
            // $arRi['f'] = $f;
            // $arRi[$p] = $f;
            //print_r($arRi);
            //echo $skolko_failov;
        //print_r($arRi);
            //return $skolko_failov;
            //return $arRi;

            //mysql_query("INSERT INTO count (files_count) values (".$skolko_failov.")");
        }

    // function dbBase($dbHost, $dbLogin, $dbPass, $dbBase) {
    //     dbConnect($dbHost, $dbLogin, $dbPass);
    //     mysql_set_charset('utf8');
    //     mysql_select_db($dbBase, $GLOBALS['link']);
    //     echo 'База на связи!';
    // }



    /* codes */
    $code = $_POST["code"];
    $dbHost = $_POST["dbHost"];
    $dbLogin = $_POST["dbLogin"];
    $dbPass = $_POST["dbPass"];
    $dbBase = $_POST["dbBase"];
    $catalog = $_POST["catalog"];
    if($_POST["code"] == "dbConnect") {
        dbConnect($dbHost, $dbLogin, $dbPass, $dbBase);
    }
    if($_POST["code"] == "dbReading") {
        dbTestRead();
    }
    if($_POST["code"] == "countFiles") {
        countFiles($catalog);
    }

    //echo $_POST["id"]
?>