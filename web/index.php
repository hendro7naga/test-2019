<?php
define('BASE_PATH', dirname(__DIR__));
$env = include_once BASE_PATH . '/app/bootstrap.php';
define('ENV', $env);

spl_autoload_register(
    function ($class_name) {
        include BASE_PATH . '/' . $class_name . '.php';
    }
);

$controller = new \App\Controllers\HomeController();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perangkat</title>
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<main>

    <div class="row">
        <div class="col s12 m10 offset-m1">
            <?php
            if (isset($_POST['submit'])) {
                $res = $controller->insertData($_POST['nama'], $_POST['jumlah']);
                $message = "";
                if ($res == 1) {
                    $message = "Data perangkat berhasil ditambahkan";
                } else {
                    $message = "gagal menambahkan data";
                }
                ?>
                <div class="section">
                    <div class="row">
                        <div class="col s12 m10 l6 offset-m1 offset-l3
                   yellow lighten-2 center">
                            <p><?php echo $message; ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
            else if (isset($_POST['submitedit'])) {
                $res = $controller->updateData($_POST['namaedit'], $_POST['jumlahedit'], $_POST['id']);
                if ($res) {
                    header('Location: http://localhost/testprogrammer-master/web/');
                }
            }
            else if (isset($_GET['hapus'])) {
                $res = $controller->deleteData($_GET['hapus']);
                if ($res) {
                    header('Location: http://localhost/testprogrammer-master/web/');
                }
            }

            ?>
            <div class="section">
                <div class="row">
                    <?php
                    if (isset($_GET['actions'])) {
                        $actions = $_GET['actions'];
                        if ($actions == 'edit') {
                            ?>
                            <h5>Edit Data Perangkat</h5>
                            <div class="divider"></div>
                            <form name="fom" class="col s12 m10 offset-m1" method="POST">
                                <div class="card-panel grey lighten-4 center-align">
                                    <div class="row">
                                        <div class="input-field col s12 m4">
                                            <input type="text" name="namaedit" id="nama"
                                                   class="validate" value="<?php echo $_GET['nama']; ?>" required>
                                            <label for="nama">Nama Perangkats</label>
                                        </div>
                                        <div class="input-field col s12 m3 offset-m1">
                                            <input type="hidden" name="id" id="id" value="<?php echo $_GET['pid']; ?>">
                                            <input type="text" name="jumlahedit" id="jumlahedit" value="<?php echo $_GET['jumlah']; ?>"
                                                   class="validate" requrired>
                                            <label for="jumlah">Jumlah</label>
                                        </div>
                                        <div class="col s12 m3">
                                            <button type="submit" name="submitedit" id="submitedit"
                                                    class="btn waves-effect blue-grey">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php
                        }
                    } else {
                        ?>
                        <h5>Tambah Data Perangkat</h5>
                        <div class="divider"></div>
                        <form name="fom" class="col s12 m10 offset-m1" method="POST">
                            <div class="card-panel grey lighten-4 center-align">
                                <div class="row">
                                    <div class="input-field col s12 m4">
                                        <input type="text" name="nama" id="nama"
                                               class="validate" required>
                                        <label for="nama">Nama Perangkat</label>
                                    </div>
                                    <div class="input-field col s12 m3 offset-m1">
                                        <input type="text" name="jumlah" id="jumlah"
                                               class="validate" requrired>
                                        <label for="jumlah">Jumlah</label>
                                    </div>
                                    <div class="col s12 m3">
                                        <button type="submit" name="submit" id="submit"
                                                class="btn waves-effect blue-grey">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php
                    }
                    ?>

                </div>
            </div>

            <div class="divider"></div>
            <div class="section">
                <table class="responsive-table striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Perangkat</th>
                        <th>Jumlah</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php
                    $datas = $controller->getData();
                    $iteration = 0;
                    foreach ($datas as $data) {
                        $iteration = $iteration + 1;
                        ?>
                        <tr>
                            <td><?php echo  $iteration; ?></td>
                            <td><?php echo $data->nama; ?></td>
                            <td><?php echo $data->jumlah; ?></td>
                            <td>
                                <a class="btn-small waves-effect modal-trigger"
                                   href="?actions=edit&pid=<?php echo $data->id; ?>&nama=<?php echo $data->nama; ?>&jumlah=<?php echo $data->jumlah; ?>"
                                   name="actionedit" type="button" id="btn-edit"
                                   data-get="<?php echo $data->id?>">
                                    <i class="material-icons">mode_edit</i>
                                </a>

                                <a class="btn-small waves-effect red" href="index.php?hapus=<?php echo $data->id; ?>">
                                    <i class="material-icons">delete_forever</i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<script src="js/materialize.min.js"></script>
<script>
    (function () {
        'use strict';
        document.addEventListener('DOMContentLoaded', function () {
            M.updateTextFields();
        });
    })();
</script>
</body>
</html>
