<?php
$titulo = "Login - Admin";
include_once(DIRECTORIO_TEMPLATE_BACKEND."head.php");
include_once(DIRECTORIO_TEMPLATE_BACKEND."hamburger.php");

?>
<body class="d-flex align-items-center py-4 bg-body-tertiary">

<main class="form-signin w-100 m-auto text-center">
    <form action="/user/login" method="post">
        <a href="/control">
            <img class="mb-1" src="<?=DIRECTORIO_IMG_FRONTEND?>userLogin.svg" alt="" width="150" height="97" />
        </a>
        <h1 class="h3 mb-3 fw-normal">Inicia sesión</h1>
        <div class="form-floating">
            <input
                    type="text"
                    name="username"
                    class="form-control"
                    id="floatingInput"
                    placeholder="Nombre de usuario"
                    required
            />
            <label for="floatingInput">Nombre de Usuario</label>
        </div>
        <div class="form-floating">
            <input
                    type="password"
                    name="password"
                    class="form-control"
                    id="floatingPassword"
                    placeholder="Password"
                    required
            />
            <label for="floatingPassword">Contraseña</label>
        </div>
        <div class="form-check text-start my-3">
            <input
                    class="form-check-input"
                    type="checkbox"
                    name="remember"
                    value="1"
                    id="checkDefault"
            />
            <label class="form-check-label" for="checkDefault">
                Recuérdame
            </label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">
            Iniciar sesión
        </button>
        <p class="mt-5 mb-3 text-body-secondary">&copy; David Cerdán - 2025</p>
    </form>
</main>
</body>
</html>
