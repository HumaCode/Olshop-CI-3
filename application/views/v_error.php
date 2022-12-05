<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | 500 Error</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>template/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>template/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>

    <div class="content">
        <div class="row mt-4">
            <div class="col-md-12 mt-4">


                <div class="error-page">
                    <h2 class="headline text-danger">500</h2>

                    <div class="error-content">
                        <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Ada yang salah.</h3>

                        <p>
                            Kamu mengakses halaman yang tidak diperbolehkan
                            silahkan kembali ke <a href="<?= base_url('home') ?>">Home</a>




                        </p>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- /.error-page -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>template/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url() ?>template/dist/js/demo.js"></script>
</body>

</html>