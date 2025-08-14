<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
</head>
<body>
    <?php

        #SALVAR PESSOA
        function Salvar($nome, $cpf, $endereco){
            $connection = require("conectar.php");  
            if ($connection -> 
                query(@"INSERT INTO pessoa (nome, cpf, endereco) VALUES ('$nome', '$cpf', '$endereco');")) {                 
            } 
            $connection -> close();
        }

        #RECUPERAR
        function Recuperar(){
            $connection = require("conectar.php");
            $sql = "SELECT idpessoa, nome, cpf, endereco from pessoa";

            $result = $mysqli->query($sql);
            echo "<table>";
            while ($row = $result->fetch_assoc()) {   
                $rowid = "'_" . $row["idpessoa"] . "'";       
                $nome = $row["nome"];
                $cpf = $row["cpf"];
                $endereco = $row["endereco"];              
                echo "<div>"; 
                echo "<tr id = "."_".$row["idpessoa"].">"
                        . "</td>"
                           . @"<input type='text' class = 'valor-nome' value = '$nome'/>"                         
                        . "</td>"
                        . "</td>"
                           . @"<input type='text' class = 'valor-cpf' value = '$cpf'/>"                         
                        . "</td>"
                        . "</td>"
                           . @"<input type='text' class = 'valor-endereco' value = '$endereco'/>"                         
                        . "</td>"
                        . "</td>"
                        . @"<button onclick=removerTodo($rowid)>Remover</button>"
                        . "</td>"
                        . "</td>"
                        . @"<button onclick=atualizarTodo($rowid)>Atualizar</button>"
                        ."</td>"                                            
                    ."</tr>";                          
                echo "</div>";
            }
            echo "</table>";
        }      
        
        #VERIFICAR O BD
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nome = htmlspecialchars($_POST['nome']); 
                $cpf = htmlspecialchars($_POST['cpf']);
                $endereco = htmlspecialchars($_POST['endereco']);
                if(!empty($nome) && !empty($cpf) && !empty($endereco)){
                Salvar($nome, $cpf, $endereco);
                }                 
            }
            Recuperar(); 
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            Recuperar();        
        }

        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $idRemover = $_GET['id']; 
            echo "Pegou: ". $idRemover;           
        }     
        
    ?>

    <!--RECEBE DADOS DO USUARIO!-->
    <form method="post">
        <label for="pessoa">Cadastros de Pessoas</label>
        <input name="nome" id="nome" placeholder= "nome" type="text">
        <input name="cpf" id="cpf" placeholder= "cpf" type="text">
        <input name="endereco" id = "endereco" placeholder = "endereco" type="text">
        <button type="submit">Salvar</button>
    </form> 
</body>
<script src="/js/index.js"></script>
</html>