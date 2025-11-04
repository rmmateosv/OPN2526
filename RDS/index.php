<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tareas</title>
</head>
<body>
    <h1>Gestión de Tareas</h1>
    <form action="" method="post">
        <label>Título <input type="text" name="titulo" placeholder="Título"></label>
        <label>Descripción <input type="text" name="descripcion" placeholder="Descripción"></label>
        <label>Prioridad <select name="prioridad">
            <option>Baja</option>
            <option>Media</option>
            <option>Alta</option>
        </select></label>
        <label>Estado <select name="estado">
            <option>Pendiente</option>
            <option>En proceso</option>
            <option>Completada</option>
        </select></label>
    </form>
</body>
</html>