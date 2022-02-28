<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel='icon' href="<?php echo base_url(); ?>assets/img/favicon.ico"/> 

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Login CSS -->
    <link href="<?= base_url('assets/css/login.css') ?>" rel="stylesheet">

    <!-- Notify -->
    <link href="<?= base_url('assets/css/notify.min.css') ?>" rel="stylesheet"/>
    <script src="<?= base_url('assets/js/notify.min.js') ?>"></script>

    <title>Arnou | Remuneraciones</title>
</head>

<body>
    <div class="container">
        <div class="row align-items-center" style="min-height: 100vh">
            <div class="col-md-2 col-lg-3 col-xl-4"></div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-6 col-xl-4">
            <?php if ($_SESSION['message']) : ?>
                    <div class="alert alert-danger mt-2 mb-2 alert-dismissible fade show text-center">
                        <?= $_SESSION['message'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <img src="<?= base_url('assets/img/logo_complete.png') ?>" class="card-img-top" alt="Logo">
                    <div class="card-body">
                        <div class="card-title">
                            REMUNERACIONES
                        </div>
                        <form action="<?php echo base_url();?>auth/login" method="POST">
                            <div class="mb-3">
                                <input type="text" name="identity" id="identity" placeholder="Correo" class="form-control text-center">
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" id="password" placeholder="Contraseña" class="form-control text-center">
                            </div>
                            <div class="d-grid gap-2 col-6 mx-auto text-center">
                                <button type="submit" class="btn btn-light">Acceder</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    window.onload(){
        notify('success', 'Excelente')
    }
</script>
</html> 
</html>