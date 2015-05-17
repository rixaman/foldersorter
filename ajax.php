<?
    /* functions */
    function dbConnect($dbHost, $dbLogin, $dbPass, $dbBase) {       
        $link = @mysql_connect($dbHost, $dbLogin, $dbPass) or die('Попытка соединения с базой данных провалилась!');
        mysql_set_charset('utf8');
        mysql_select_db($dbBase, $link);
        //echo 'Есть коннект!<br>';
        //dbReadToJson();
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

    function countFiles($path, $countFiles) {  
        $folder = opendir($path);
        if (!$folder)
        return -1;

        while ($file = readdir($folder)) :
            if ($file == '..' || $file == '.')
              continue;
            if (is_dir($path . $file)) :
                $data['folders'][] = $file;
                countFiles($path.$file.DIRECTORY_SEPARATOR, $countFiles);
            else :
                $countFiles++;
                $data['files'][] = $file;
            endif;
        endwhile;

        $data['count'] = $countFiles;
        closedir($folder); 
        echo json_encode($data);
    }

    function scaningDir($path) {
        $data = reScaningDir($path);
        echo json_encode($data);
    }
    function reScaningDir($path) {
        $data[label] = basename($path);
        $scan = scanDir($path);

        foreach ($scan as $key => $file) {
            if ($file == '..' || $file == '.') {
                //unset($scan[$key]);
                continue;
            }
            if (is_dir($path.$file)) {
                //$folders[] = $file;
                $data[children][] = reScaningDir($path.$file.DIRECTORY_SEPARATOR);
            } else {
                $data[children][][label] = $file;
            }
        }
        return $data;
    }
    /*
    function countFiles($path, $skolko_failov) {
     
        //global $arRi;

        $papka_handle = opendir($path);

        if (!$papka_handle)
        return -1;

        while ($file = readdir($papka_handle)) :

        if ($file == '..' || $file == '.')
          continue;

        if (is_dir($path . $file)) :
            $skolko_papok++;
            echo $file.'-papka<br><br>';
            countFiles($path.$file.DIRECTORY_SEPARATOR, $skolko_failov);
        else :
            $skolko_failov++;
            echo $file.'-'.$skolko_failov.'<br><br>';
            //if($file == "move.txt") {
            //    rename($path.$file, $path."papka20".DIRECTORY_SEPARATOR.$file);
            //}
        endif;
        endwhile;
            closedir($papka_handle); 
            mysql_query("INSERT INTO count (files_count) values (".$skolko_failov.")");
    }
    */

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
        dbConnect($dbHost, $dbLogin, $dbPass, $dbBase);
        $skolko_failov = 0;
        countFiles($catalog, $skolko_failov);
    }
    if($_POST["code"] == "dbReadToJson") {
        dbConnect($dbHost, $dbLogin, $dbPass, $dbBase);
        dbReadToJson();
    }
    if($_POST["code"] == "scanDir") {
        dbConnect($dbHost, $dbLogin, $dbPass, $dbBase);
        scaningDir($catalog);
    }
    
    //echo $_POST["id"]
?>