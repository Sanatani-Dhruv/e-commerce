{{-- 
 * Check if "offset" position is quoted
 *
 * @param int $offset
 * @param string $text
 * @return boolean
  --}}
{{-- ') {
                $closedOn = strpos($sql, ' --}}
{{-- 
 * Remove comments from sql
 *
 * @param string sql
 * @param boolean is multicomment line
 * @return string
  --}}
{{-- 
 * Import SQL from file
 *
 * @param string path to sql file
  --}}
{{--  echo "Peak MB: ", memory_get_peak_usage(true)/1024/1024; --}}
{{--  header('Content-Type: text/html;charset=utf-8'); --}}
{{--  echo '#<strong>SQL CODE TO RUN:</strong><br>' . htmlspecialchars($sql) . ';<br><br>'; --}}
{{--  4. separate sql queries by delimiter --}}
{{--  3. parse delimiter row --}}
{{--  2. clear comments --}}
{{--  1. ignore empty string and comment row --}}
{{--  remove BOM for utf-8 encoded file --}}
{{--  For Object Oriented Method --}}
{{--  Connect to the database --}}
{{--  Basic connection settings --}}
@php require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/helper/ConsoleHelper.php';

$consoleHelper = new ConsoleHelper();

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$databaseHost = $_ENV['DB_HOST'];
$databaseUsername = $_ENV['DB_USERNAME'];
$databasePassword = $_ENV['DB_PW'];
$databaseName = $_ENV['DB_NAME'];

try {
    $consoleHelper->print(message: "\nCreating Connection to SQL Server...\n------------------------------------", textColor: "blue", bold: true);
        $mysqli = new mysqli($databaseHost, $databaseUsername, $databasePassword);
    $consoleHelper->print(message: "\nConnection Successful", textColor: "green", bold: true);
    $mysqli->set_charset("utf8");
} catch (Exception $e) {
    $consoleHelper->print(message: "\nError Connecting to SQL server\n------------------------------", textColor: "red", bold: true);
    $consoleHelper->print(message: "\nCheck if database server is running, and variables in .env are correct.", textColor: "red", bold: false);
    $consoleHelper->print(message: "\nConnection Error: ", textColor: "red", bold: true);
    echo "$e";
}

try {
    if ($mysqli) {
        $sql = "CREATE DATABASE ". $_ENV['DB_NAME'];

        $consoleHelper->print(message: "\nCreating DB...", textColor: "blue", bold: true);
        $mysqli->query($sql);
        $consoleHelper->print(message: "\nCreated Database `". $_ENV['DB_NAME'] ."`", textColor: "green", bold: true);

        $mysqli = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);
        $consoleHelper->print(message: "Filling Database `". $_ENV['DB_NAME'] ."` with tables...", textColor: "blue", bold: true);
        sqlImport('sql.sql');
        $consoleHelper->print(message: "\nSuccessfully completed database `". $_ENV['DB_NAME'] ."`", textColor: "green", bold: true);
        exit();
    }
} catch (Exception $err) {
    try {
        $drop_sql = "DROP DATABASE ". $_ENV['DB_NAME'];
        $mysqli = new mysqli($databaseHost, $databaseUsername, $databasePassword);
        $consoleHelper->print(message: "Removing existing database...", textColor: "red", bold: true);
        $mysqli->query($drop_sql);

        $consoleHelper->print(message: "Trying to create DB...", textColor: "blue", bold: true);
        $mysqli->query($sql);
        $consoleHelper->print(message: "\nCreated Database `". $_ENV['DB_NAME'] ."`", textColor: "green", bold: true);
        $mysqli = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);
        $consoleHelper->print(message: "Filling Database `". $_ENV['DB_NAME'] ."` with tables...", textColor: "blue", bold: true);
        sqlImport('sql.sql');

        $consoleHelper->print(message: "\nSuccessfully completed database `". $_ENV['DB_NAME'] ."`", textColor: "green", bold: true);
        exit();
    } catch (Exception $err) {
        $consoleHelper->print(message: "\nError Creating Database `". $_ENV['DB_NAME'] ."`", textColor: "red", bold: true);
        $consoleHelper->print(message: "\nCheck if database server is running, and variables in .env are correct", textColor: "red", bold: true);
    }
}


function sqlImport($file) {

    $delimiter = ';';
    $file = fopen($file, 'r');
    $isFirstRow = true;
    $isMultiLineComment = false;
    $sql = '';

    while (!feof($file)) {

        $row = fgets($file);

                if ($isFirstRow) {
            $row = preg_replace('/^\x{EF}\x{BB}\x{BF}/', '', $row);
            $isFirstRow = false;
        }

                if (trim($row) == '' || preg_match('/^\s*(#|--\s)/sUi', $row)) { @endphp 
 @continue 
 @php }

                $row = trim(clearSQL($row, $isMultiLineComment));

                if (preg_match('/^DELIMITER\s+[^ ]+/sUi', $row)) {
            $delimiter = preg_replace('/^DELIMITER\s+([^ ]+)$/sUi', '$1', $row); @endphp 
 @continue 
 @php }

                $offset = 0;
        while (strpos($row, $delimiter, $offset) !== false) {
            $delimiterOffset = strpos($row, $delimiter, $offset);
            if (isQuoted($delimiterOffset, $row)) {
                $offset = $delimiterOffset + strlen($delimiter);
            } else {
                $sql = trim($sql . ' ' . trim(substr($row, 0, $delimiterOffset)));
                query($sql);

                $row = substr($row, $delimiterOffset + strlen($delimiter));
                $offset = 0;
                $sql = '';
            }
        }
        $sql = trim($sql . ' ' . $row);
    }
    if (strlen($sql) > 0) {
        query($row);
    }

    fclose($file);
}


function clearSQL($sql, &$isMultiComment) {
    if ($isMultiComment) {
        if (preg_match('#\*/#sUi', $sql)) {
            $sql = preg_replace('#^.*\*/\s*#sUi', '', $sql);
            $isMultiComment = false;
        } else {
            $sql = '';
        }
        if(trim($sql) == ''){
            return $sql;
        }
    }

    $offset = 0;
    while (preg_match('{--\s|#|/\*[^!]}sUi', $sql, $matched, PREG_OFFSET_CAPTURE, $offset)) {
        list($comment, $foundOn) = $matched[0];
        if (isQuoted($foundOn, $sql)) {
            $offset = $foundOn + strlen($comment);
        } else {
            if (substr($comment, 0, 2) == '', $foundOn);
                if ($closedOn !== false) {
                    $sql = substr($sql, 0, $foundOn) . substr($sql, $closedOn + 2);
                } else {
                    $sql = substr($sql, 0, $foundOn);
                    $isMultiComment = true;
                }
            } else {
                $sql = substr($sql, 0, $foundOn); @endphp 
 @break 
 @php }
        }
    }
    return $sql;
}


function isQuoted($offset, $text) {
    if ($offset > strlen($text))
        $offset = strlen($text);

    $isQuoted = false;
    for ($i = 0; $i < $offset; $i++) {
        if ($text[$i] == "'")
            $isQuoted = !$isQuoted;
        if ($text[$i] == "\\" && $isQuoted)
            $i++;
    }
    return $isQuoted;
}

function query($sql) {
    global $mysqli;
        if (!$query = $mysqli->query($sql)) {
        throw new Exception("Cannot execute request to the database {$sql}: " . $mysqli->error);
    }
}

set_time_limit(0); @endphp