<?php

$titulo = "Añadir usuario";
include_once(DIRECTORIO_TEMPLATE_BACKEND . "head.php");
include_once(DIRECTORIO_TEMPLATE_BACKEND . "hamburger.php");

?>
<body class="d-flex align-items-center py-4 bg-body-tertiary">

<main class="form-signin w-100 m-auto text-center">
    <form action="/user" method="post">
        <a href="/control">
            <img class="mb-1" src="<?= DIRECTORIO_IMG_BACKEND?>userLogin.svg" alt="" width="150" height="97"/>
        </a>
        <h1 class="h3 mb-3 fw-normal">Añadir usuario</h1>
        <div class="form-floating">
            <input
                type="text"
                name="username"
                class="form-control"
                id="floatingInput"
                placeholder="Nombre de usuario"
                required
            />
            <label for="register_username">Nombre de Usuario</label>
        </div>
        <div class="form-floating">
            <input
                type="password"
                name="password"
                class="form-control"
                id="register_password"
                placeholder="Password"
                required
            />
            <label for="register_password">Contraseña</label>
        </div>
        <div class="form-floating">
            <input
                type="email"
                name="email"
                class="form-control"
                id="register_email"
                placeholder="Email"
                required
            />
            <label for="email">Email</label>
        </div>
        <div class="form-floating">
            <input
                type="text"
                name="edad"
                class="form-control"
                id="register_edad"
                placeholder="Edad"
                required
            />
            <label for="edad">Edad</label>
        </div>
        <div class="form-floating">
            <select
                    name="type"
                    id="register_usertype"
                    class="form-select"
                    required
            >
                <option value="normal" selected>Normal</option>
                <option value="anuncios">Anuncios</option>
                <option value="premium">Premium</option>
            </select>
            <label for="tipoUsuario">Tipo de Usuario</label>
        </div>
        <button class="btn btn-success w-100 py-2" type="submit">
            Crear usuario
        </button>
        <p class="mt-5 mb-3 text-body-secondary">&copy; David Cerdán - 2025</p>
    </form>
</main>
</body>
</html>
