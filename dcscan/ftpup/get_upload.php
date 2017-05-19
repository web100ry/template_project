<?php
/**
 * Created by PhpStorm.
 * User: web100ry
 * Date: 18.05.17
 * Time: 16:51
 */
//имя файла, который нужно загрузить
$filep = $_FILES['userfile']['tmp_name'];
$ftp_server = $_POST['server'];
$ftp_user_name = $_POST['user'];
$ftp_user_pass = $_POST['password'];
$paths = $_POST['pathserver'];
//имя файла на сервере после того, как вы его загрузите
$name = $_FILES['userfile']['name'];

$conn_id = ftp_connect($ftp_server);
// входим при помощи логина и пароля
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
// проверяем подключение
if ((!$conn_id) || (!$login_result)) {
    echo "FTP connection has failed!";
    echo "Attempted to connect to $ftp_server for user: $ftp_user_name";
    exit;
} else {
    echo "Connected to $ftp_server, for user: $ftp_user_name";
}
// загружаем файл
$upload = ftp_nb_put($conn_id, 'public_html/'.$paths.'/'.$name, $filep, FTP_BINARY);
// проверяем статус загрузки
if (!$upload) {
    echo "Error: FTP upload has failed!";
} else {
    echo "Good: Uploaded $name to $ftp_server";
}
ftp_close($conn_id);
set_time_limit(3000);


?>