<?php

$host = $_POST['host'];
$login = $_POST['login'];
$password = $_POST['password'];
$database = $_POST['database'];

ob_start();

do {
    echo "尝试连接数据库主机：";
    if (!@mysql_connect($host, $login, $password)) {
        echo "无法连接\n" . mysql_error();
        exit;
    }
    echo "成功连接到 {$host}\n";

    echo "尝试打开数据库 {$database}：";
    if (!@mysql_select_db($database)) {
        echo "数据库不存在\n";
        echo "尝试建立数据库 {$database}：";

        if (!@mysql_query("CREATE DATABASE {$database}")) {
            echo "失败\n" .mysql_error();
            exit;
        }
        mysql_select_db($database);
    }
    echo "成功\n\n";

    $rs = mysql_query('SELECT VERSION()');
    $row = mysql_fetch_row($rs);
    $version = $row[0];
    if ($version >= '4.1') {
        mysql_query("SET NAMES 'utf8'");
        $version = 5;
    } else {
        $version = 3;
    }

    $rootdir = realpath(dirname(__FILE__) . '/../');
    foreach (glob(realpath($rootdir . '/Example') . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR) as $dir) {
        $dir .= DIRECTORY_SEPARATOR . 'setup';
        $filename = $dir . DIRECTORY_SEPARATOR . 'database_mysql.sql';
        if (!is_readable($filename)) { continue; }

        $shortname = substr($filename, strlen($rootdir));
        echo "脚本: {$shortname}...";
        $script = file_get_contents($filename);
        foreach (explode(';', $script) as $sql) {
            $sql = trim($sql);
            if (strtoupper(substr($sql, 0, 12)) == 'CREATE TABLE' && $version == 5) {
                $sql .= " DEFAULT CHARSET=utf8";
            }

            if ($sql == '') { continue; }
            if (!@mysql_query($sql)) {
                echo "\n执行错误：\n" . mysql_error() . "\n\n";
                exit;
            }
        }
        echo "OK\n";
    }

    echo "\n数据库脚本文件执行完毕。\n\n";

    echo "写入配置文件：";
    $configFilename = realpath(dirname(__FILE__) . '/../Example/_Shared/')
            . DIRECTORY_SEPARATOR . 'DSN.php';
    echo $configFilename ."\n";
    if (file_exists($configFilename)) {
        echo "* 配置文件已经存在，该文件将被覆盖 *\n";
    }

    $host = "'" . addslashes($host) . "'";
    $login = "'" . addslashes($login) . "'";
    $password = "'" . addslashes($password) . "'";
    $database = "'" . addslashes($database) . "'";

    $config = <<<EOT
<?php

return array(
    'internalCacheDir' => dirname(__FILE__) . '/_Cache',
    'dbDSN' => array(
        'driver'    => 'mysql',
        'host'      => {$host},
        'login'     => {$login},
        'password'  => {$password},
        'database'  => {$database}
    )
);

EOT;
    $fp = fopen($configFilename, 'w');
    if (!$fp) {
        echo "尝试写入文件失败。\n";
        exit;
    }

    fwrite($fp, $config);
    fclose($fp);
    echo "\n写入配置文件成功。安装完成。\n";
    echo "\n\nSUCCESSED.\n";

    $continue = true;
} while (false);

echo "\n\n";

$content = ob_get_clean();
echo nl2br(htmlspecialchars($content));
