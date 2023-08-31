<nav class="navbar is-dark" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="index.php?vista=homescreen">
    <i class="fa-duotone fa-house-building"></i>
    </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    <span class="icon-text">
                    <span class="icon">
                    <i class="fal fa-user"></i>
                    </span>
                        <span>Usuarios</span>
                    </span>
                </a>

                <div class="navbar-dropdown">
                    <a href="index.php?vista=user_new" class="navbar-item">Nuevo</a>
                    <a href="index.php?vista=user_list" class="navbar-item">Lista</a>
                    <a href="index.php?vista=user_search" class="navbar-item">Buscar</a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                <span class="icon-text">
                    <span class="icon">
                    <i class="fa-light fa-boxes-stacked"></i>
                    </span>
                        <span>Categorias</span>
                    </span>
                </a>

                <div class="navbar-dropdown">
                    <a href="index.php?vista=category_new" class="navbar-item">Nueva</a>
                    <a href="index.php?vista=category_list" class="navbar-item">Lista</a>
                    <a href="index.php?vista=category_search" class="navbar-item">Buscar</a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    <span class="icon-text">
                    <span class="icon">
                    <i class="fa-light fa-bread-slice"></i>
                    </span>
                        <span>Productos</span>
                    </span>
                </a>

                <div class="navbar-dropdown">
                <a class="navbar-item" href=index.php?vista=produc_new>Nuevo</a>
                <a class="navbar-item" href=index.php?vista=produc_list>Lista</a>
                <a class="navbar-item" href=index.php?vista=produc_category>Por categorias</a>
                <a class="navbar-item" href=index.php?vista=produc_search>Buscar</a>
                </div>
            </div>
            
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                <span class="icon-text">
                    <span class="icon">
                    <i class="fal fa-industry-alt"></i>
                    </span>
                        <span>Materia Prima</span>
                    </span>
                </a>

                <div class="navbar-dropdown">
                <a class="navbar-item" href=index.php?vista=mp_new>Nuevo</a>
                <a class="navbar-item" href=index.php?vista=mp_list>Lista</a>
                <a class="navbar-item" href=index.php?vista=mp_search>Buscar</a>
                <a class="navbar-item" href=index.php?vista=mp_formula_panadera>Formula Panadera</a>
                </div>
            </div>

        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                <a href="index.php?vista=user_profile&user_id_up=<?php echo $_SESSION['id']; ?>" class="button is-primary is-rounded">
                        Mi cuenta
                    </a>

                    <a href="index.php?vista=logout" class="button is-link is-rounded">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>