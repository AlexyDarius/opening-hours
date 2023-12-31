<!DOCTYPE html>
<html data-bs-theme="light" lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>opening-hours</title>
    <link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/css/Login-Form-Basic-icons.css">
</head>

<body>
    <h1 class="text-center" style="margin-top: 12px;font-weight: bold;text-decoration:  underline;">Éditer vos horaires d'ouverture</h1>
    <section class="position-relative py-4 py-xl-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2>Se connecter</h2>
                    <p class="w-lg-50">Connectez-vous pour accéder à la modification des horaires d'ouverture de votre boutique</p>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-5">
                        <div class="card-body d-flex flex-column align-items-center">
                            <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"></path>
                                </svg></div>
                            <form id="loginForm" action="authenticate.php" class="text-center" method="post">
                                <div class="mb-3"><input class="form-control" type="text" id="username" name="username" placeholder="Nom d'utilisateur" required></div>
                                <div class="mb-3"><input class="form-control" type="password" id="password" name="password" placeholder="Mot de passe" required></div>
                                <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit" value="Login">Se connecter</button></div>
                                <p class="text-muted"><a href="#" data-bs-target="#toast-1" data-bs-toggle="toast"><span style="color: rgba(33, 37, 41, 0.75);">Mot de passe oublié ?</span></a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col d-lg-flex justify-content-lg-center">
                    <div class="toast hide" role="alert" data-bs-animation="false" data-bs-autohide="false" id="toast-1">
                        <div class="toast-header"><strong class="me-auto">Mot de passe oublié ?</strong><button class="btn-close ms-2 mb-1 close" type="button" aria-label="Close" data-bs-dismiss="toast"></button></div>
                        <div class="toast-body" role="alert">
                            <p>Contactez votre administrateur système :&nbsp;<a>alexyroman.dev@gmail.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="styles/js/bootstrap.min.js"></script>
</body>

</html>
