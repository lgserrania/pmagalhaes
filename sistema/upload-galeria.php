  <?php  
    // Nas versões do PHP que antecedem a versão 4.1.0, é preciso usar o $HTTP_POST_FILES em vez do $_FILES.
    include "include/controle_sessao.php";       
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "sistema/uploads/";

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$_FILES['file']['name'])) {
        $status = 1;
    }

 ?>