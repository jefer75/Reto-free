<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juega Free</title>
</head>
<body>

    <div class="container">

    <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 
            <label for="mapa"></label>
            <select name="mapa">
                    <option value ="">Seleccione el mapa</option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from mundos");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_mundo'] . ">"
                        . $fila['mundo'] . "</option>";
                    } 
                    ?>
            </select>

            <label for="arma"></label>
            <select name="arma">
                    <option value ="">Seleccione el arma</option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from arma");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_arma'] . ">"
                        . $fila['arma'] . "</option>";
                    } 
                    ?>
            </select>

            <input type="submit" name="validar" value="Registro">
            <input type="hidden" name="MM_insert" value="formreg">
        </form>

    </div>
    
</body>
</html>