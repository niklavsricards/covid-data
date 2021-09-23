<?php

require_once 'vendor/autoload.php';

use App\TableData;

$table = new TableData;
$data = $table->readData('files/covid19.csv');
$search = '';

if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
$records= $table->records($data, $search);
$headers = $table->headers();

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

<form method="get">
    <label>Search: </label><br>
    <input type="text" name="search" placeholder="search">
    <input type="submit" name="submit" value="search">
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <?php foreach ($headers as $header): ?>
                <th> <?php echo $header ?> </th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($records as $record): ?>
            <tr>
                <?php foreach ($record as $item): ?>
                    <td><?php echo $item ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
