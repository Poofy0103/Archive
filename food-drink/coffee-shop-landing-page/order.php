<?php

if(isset($_POST['submit'])) {
    $host = 'ghillcoffee.mysql.database.azure.com';
    $username = 'ghilladmin';
    $password = 'gcoffee@1';
    $db_name = 'don_hang_website';

    //Initializes MySQLi
    $conn = mysqli_init();

    mysqli_ssl_set($conn,NULL,NULL, "DigiCertGlobalRootG2.crt.pem", NULL, NULL);

    // Establish the connection
    mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306, NULL, MYSQLI_CLIENT_SSL);

    //If connection failed, show the error
    if (mysqli_connect_errno())
    {
        die('Failed to connect to MySQL: '.mysqli_connect_error());
    }

    $txtHo = $_POST['txtHo'];
    $txtTen = $_POST['txtTen'];
    $txtEmail = $_POST['txtEmail'];
    $txtDiaChi = $_POST['txtDiaChi'];
    $txtLienHe = $_POST['txtLienHe'];

    if ($stmt = mysqli_prepare($conn, "INSERT INTO don_hang_website (Ho, Ten, Email, DiaChi, LienHe) VALUES (?, ?, ?, ?, ?)"))
    {
        mysqli_stmt_bind_param($stmt, 'sssss', $txtHo, $txtTen, $txtEmail, $txtDiaChi, $txtLienHe);
        mysqli_stmt_execute($stmt);
        printf("Insert: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
        mysqli_stmt_close($stmt);
    }
}
 ?>