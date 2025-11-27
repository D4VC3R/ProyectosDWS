<?php

namespace App\Interface;

interface ControllerInterface
{

  // Mostrar todos los usuarios
function index();
// Mostrar detalles de un usuario
function show($id);
// Mostrar el formulario para crear un usuario.
function create();
//Que pasa cuando le dan a guardar usuario.
function store();
// Mostrar la vista de editar.
function edit ($id);
// Que pasa cuando le dan a guardar cambios.
function update ($id);
// Que pasa cuando le dan a borrar usuario.
function delete($id);
}