<?php 
require_once 'controlador.php';
?>
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
        <button type="submit" name="crear">+</button>
    </form>
    <form action="" method="post">
        <table>
            <tr>
                <th>Id</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha Creción</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <p></p>
            <?php 
                $tareas = $bd->obtenerTareas();
                foreach($tareas as $t){
                    echo '<tr>';
                    echo '<td>'.$t->getId().'</td>';
                    echo '<td>'.$t->getTitulo().'</td>';
                    echo '<td>'.$t->getDescripcion().'</td>';
                    echo '<td>'.$t->getFechaC().'</td>';
                    echo '<td>'.$t->getPrioridad().'</td>';
                    echo '<td>'.$t->getEstado().'</td>';
                    echo '<td>
                    <button type="submit" name="empezar"'.($t->getEstado()!='pendiente' || $t->getEstado()=='completada'?'style="display:none"':'').'>Empezar</button>
                    <button type="submit" name="terminar"'.($t->getEstado()!='en proceso' || $t->getEstado()=='completada'?'style="display:none"':'').'>Terminar</button>
                    <button type="submit" name="borrar">Borrar</button>
                    </td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </form>
    <?php 
    if(isset($error)){
        echo '<div style="color:red">';
        foreach($error  as $e){
            echo '<h3>'.$e.'<h3>';
        }
        echo '</div>';
    }
     if(isset($mensaje)){
        echo '<div style="color:green">';
        foreach($mensaje  as $m){
            echo '<h3>'.$m.'<h3>';
        }
        echo '</div>';
    }
    ?>
</body>
</html>