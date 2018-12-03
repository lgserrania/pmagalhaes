<?php
    if(isset($_GET["artigo"])){
        listarImagens($_GET["artigo"]);
    }

    function listarImagens($id){
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $banco = "pmagalhaes";
        $conecta = mysqli_connect($servidor,$usuario,$senha,$banco);
        //test conection
    
        if(mysqli_connect_errno()){
            die("Falha ao conectar com o banco de dados!".mysqli_connect_errno());
        }
        $query = "SELECT * FROM tb_galeria WHERE idPost = " . $id;
        $executa = mysqli_query($conecta,$query);
        if($executa){
            $html = "";
            foreach($executa as $galeria){
                $id = $galeria["idPost"];
                $imagem = $galeria["imagem"];
                $html .= "<tr>";
                $html .= "<td><img src='".$galeria["imagem"]."' style='max-width:300px !important;min-width:200px; height:200px'/></td>";
                $html .= "<td><span class='btn btn-danger btn-md' onclick=excluir($id,'$imagem') data-id=$id data-imagem='$imagem'>Excluir</span></td>";
                $html .= "</tr>";      
            }
            echo $html;
        }else{
            echo "erro";
        }
    }
    
    function gerarCodigoUnico() {
        $alfabeto   = "23456789abcdefghijklmnopqrstuvwxyz";
        $tamanho    = 30;
        $letra      = "";
        $resultado  = "";

        for ($i = 1; $i < $tamanho ; $i++ ) {
            $letra      = substr( $alfabeto, rand(0,23), 1); 
            $resultado  .= $letra;
        }

        date_default_timezone_set('America/Sao_Paulo');
        $agora = getdate();

        $codigo_data = $agora['year'] . "_" . $agora['yday'];
        $codigo_data .= $agora['hours'] . $agora['minutes'] . $agora['seconds'];
        return "foto_" . $codigo_data . "_" . $resultado;
    }

    function getExtensao($nome) {
        return strrchr($nome,".");
    }

    function publicarImagem($imagem) {
        $arquivo_temporario = $imagem['tmp_name'];
        $nome_original      = $imagem['name'];
        $nome_novo          = gerarCodigoUnico() . getExtensao($nome_original);
        $root = ".." . DIRECTORY_SEPARATOR;
		$nome_completo 		= $root . "sistema" . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $nome_novo;
        
        
        if(move_uploaded_file($arquivo_temporario, $nome_completo)) {
            return $nome_completo;   
        } else {
            return ("Imagem não publicada");            
        }        
    }

?>