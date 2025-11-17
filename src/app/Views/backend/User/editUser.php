<?php

$titulo = "Editar usuario";
include_once(DIRECTORIO_TEMPLATE_BACKEND . "head.php");
include_once(DIRECTORIO_TEMPLATE_BACKEND . "hamburger.php");

?>
<body class="d-flex align-items-center py-4 bg-body-tertiary">

<main class="form-signin w-100 m-auto text-center">
    <form action="/user/<?=$usuario->getUuid()?>" method="post">
        <a href="/control">
            <img class="mb-1" src="<?= DIRECTORIO_IMG_BACKEND?>userLogin.svg" alt="" width="150" height="97"/>
        </a>
        <h1 class="h3 mb-3 fw-normal">Editar usuario</h1>
        <div class="form-floating mb-1">
            <input
                type="text"
                name="username"
                class="form-control"
                id="inputUsername"
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
                id="inputPassword"
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
                id="inputEmail"
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
                id="inputAge"
                placeholder="Edad"
                value="<?=$usuario->getEdad()?>"
                required
            />
            <label for="edad">Edad</label>
        </div>
        <div class="form-floating mb-1">
            <select
                name="type"
                id="inputUsertype"
                class="form-select"
                required
            >
                <option value="normal" <?= $usuario->getType()->name === 'NORMAL' ? 'selected' : '' ?>>Normal</option>
                <option value="premium" <?= $usuario->getType()->name === 'PREMIUM' ? 'selected' : '' ?>>Premium</option>
                <option value="admin" <?= $usuario->getType()->name === 'ADMIN' ? 'selected' : '' ?>>Administrador</option>
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
<script>

    function peticionPUT(){

        let username = document.getElementById('inputUsername');
        let password = document.getElementById('inputPassword');
        let email = document.getElementById('inputEmail');
        let edad = document.getElementById('inputEdad');
        let type = document.getElementById('inputUsertype');

        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        const raw = JSON.stringify({
            "username": username.value,
            "password": password.value,
            "email": email.value,
            "edad": edad.value,
            "type": type.value
        });

        const requestOptions = {
            method: "PUT",
            headers: myHeaders,
            body: raw,
            redirect: "follow"
        };

        fetch("http://localhost:8080/user/<?=$usuario->getUuid()?>", requestOptions)
            .then((response) => response.text())
            .then((result) => volverAUsuarios())
            .catch((error) => console.error(error));
    }

    function volverAUsuarios(){
        window.location.replace("http://localhost:8080/user")
    }
</script>

</body>
</html>
