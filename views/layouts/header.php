<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Необходимые Мета-теги всегда на первом месте -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Игровой форум</title>
        <base href="/GameNewsPortal/">
        <!-- Bootstrap CSS -->
        <link href="template/css/bootstrap.min.css" rel="stylesheet">
        <link href="template/css/bootstrap-reboot.min.css" rel="stylesheet">
        <link href="template/css/font-awesome.min.css" rel="stylesheet">
        <link href="template/css/mystyle.css" rel="stylesheet">
        
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="category-<?PHP echo $categories[0]['id']; ?>"><span class="<?PHP echo $categories[0]['icon']; ?>"></span>
                    <?PHP echo $categories[0]['name']; ?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" 
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <?php foreach ($categories as $key => $category):
                            if ($key == 0):
                                continue;
                            endif; ?>
                        <li class="nav-item">
                            <a class="nav-link <?PHP if ($category['id'] == $categoryi_id): echo 'active'; endif; ?> " href="category-<?PHP echo $category['id']; ?>">
                                <span class="<?PHP echo $category['icon']; ?>">
                                </span>&nbsp
                                <?PHP echo $category['name']; ?></a>
                        </li>
                        <?PHP endforeach; ?>
                    </ul>
                    <form class="form-inline my-2 my-lg-0 ">
                        <input class="form-control mr-sm-2" type="text" aria-label="Search">
                        <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Поиск</button>
                    </form>
                    <ul class="form-inline my-2 my-lg-0 navbar-nav">
                        <?PHP if (isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logincheck"><span class="fa fa-share-square-o"></span>  Кабинет</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login_out"><span class="fa fa-sign-out"></span>  Выход</a>
                        </li>
                        <?PHP endif; ?>
                        <?PHP if (!isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="ragistration_form"><span class="fa fa-check-square-o"></span>  Регистрация</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login_form"><span class="fa fa-sign-in"></span>  Вход</a>
                        </li>
                        <?PHP endif; ?>
                    </ul>
                </div>
            </nav>
        </header>