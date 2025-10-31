<?php

$titulo = "Editar usuario";
include_once(DIRECTORIO_TEMPLATE_BACKEND . "head.php");
include_once(DIRECTORIO_TEMPLATE_BACKEND . "hamburger.php");

?>
<body class="d-flex align-items-center py-4 bg-body-tertiary">

<main class="form-signin w-100 m-auto text-center">
    <form action="/user/<?=$usuario->getUuid()?>" method="post">
        <input type="hidden" name="_method" value="PUT">
        <a href="/control">
            <img class="mb-1" src="<?= DIRECTORIO_IMG_BACKEND?>userLogin.svg" alt="" width="150" height="97"/>
        </a>
        <h1 class="h3 mb-3 fw-normal">Editar usuario</h1>
        <div class="form-floating mb-1">
            <input
                type="text"
                name="username"
                class="form-control"
                id="register_username"
                placeholder="Nombre de usuario"
                value="<?=$usuario->getUsername()?>"
                required
            />
            <label for="register_username">Nombre de Usuario</label>
        </div>
        <div class="form-floating mb-1">
            <input
                type="password"
                name="password"
                class="form-control m-0"
                id="register_password"
                placeholder="Password"
                value="<?=$usuario->getPassword()?>"
                required
            />
            <label for="register_password">Contraseña</label>
        </div>
        <div class="form-floating mb-1">
            <input
                type="email"
                name="email"
                class="form-control"
                id="register_email"
                placeholder="Email"
                value="<?=$usuario->getEmail()?>"
                required
            />
            <label for="email">Email</label>
        </div>
        <div class="form-floating mb-1">
            <input
                type="number"
                name="edad"
                class="form-control"
                id="register_edad"
                placeholder="Edad"
                value="<?=$usuario->getEdad()?>"
                required
            />
            <label for="edad">Edad</label>
        </div>
        <div class="form-floating mb-1">
            <select
                name="type"
                id="register_usertype"
                class="form-select"
                required
            >
                <option value="normal" <?= $usuario->getTipo()->name === 'NORMAL' ? 'selected' : '' ?>>Normal</option>
                <option value="anuncios" <?= $usuario->getTipo()->name === 'ANUNCIOS' ? 'selected' : '' ?>>Anuncios</option>
                <option value="admin" <?= $usuario->getTipo()->name === 'ADMIN' ? 'selected' : '' ?>>Admin</option>
            </select>
            <label for="tipoUsuario">Tipo de Usuario</label>
        </div>
        <div class="mt-3">
            <button class="btn btn-warning w-100 mb-2" type="submit">
                Actualizar usuario
            </button>
            <a href="/user/<?= $usuario->getUuid() ?>" class="btn btn-secondary w-100">Volver</a>
        </div>

        <p class="mt-5 mb-3 text-body-secondary">&copy; David Cerdán - 2025</p>
    </form>
</main>
</body>
</html>
