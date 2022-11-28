<?php
require_once('config.php');
require_once('./model' . DIRECTORY_SEPARATOR . 'myPDO.php');

$conn = new myPDO(APPDB); 

$crud  = 'select';
$prod  = [];
$uprod = [];

if(isset($_POST['crud']) && $_POST['crud'] != 'select')
{
    $crud = $_POST['crud'];

    if($_POST['crud'] == 'insert')
    {
        if(isset($_POST['estudante']) && isset($_POST['id']))
        {
            $sql = "INSERT INTO estudante (aluno, id) VALUES (?, ?)";
            $prm = [
                $_POST['estudante'],
                $_POST['id'],
            ];
            $prod = $conn->insert($sql, $prm);
            
            $_SESSION['msg'] = $prod !== false ? 'Aluno cadastrado com sucesso!' : $prod;

            # Redirect to list products
            $prod = $conn->select("SELECT * FROM estudante");
            $crud = 'select';
        }
    }
    else if($_POST['crud'] == 'update')
    {
        if(isset($_POST['id_update']))
        {
            $sql = "SELECT * FROM estudante WHERE id = ?";
            $prm = [
                $_POST['id_update'],
            ];
            $prod = $conn->select($sql, $prm);
            $uprod = $prod[0];
        }
        else if(isset($_POST['id']) && isset($_POST['estudante']) && isset($_POST['id']))
        {
            $sql = "UPDATE estudante SET aluno = ?, ano = ? WHERE matricula = ?";
            $prm = [
                $_POST['estudante'],
                $_POST['aluno'],
                $_POST['semestre'],
            ];
            $prod = $conn->update($sql, $prm);
            $uprod = [
                "aluno" => $_POST['estudante'],
                "ano"       => $_POST['estudande'],
                "semestre"      => $_POST['estudante'],
                ];
            
            $_SESSION['msg'] = $prod !== false ? 'Aluno atualizado com sucesso!' : $prod;
            
            # Redirect to list products
            $prod = $conn->select("SELECT * FROM estudante");
            $crud = 'select';
        }
    }
    else if($_POST['crud'] == 'delete')
    {
        $sql = "DELETE FROM estudante WHERE id = ?";
        $prm = [
            $_POST['id_delete'],
        ];
        $prod = $conn->delete($sql, $prm);
        
        $_SESSION['msg'] = $prod !== false ? 'Aluno excluído com sucesso!' : $prod;

        # Redirect to list products
        $prod = $conn->select("SELECT * FROM estudante");
        $crud = 'select';
    }
}
else
{
    $prod = $conn->select("SELECT * FROM estudande");
}

// echo "<pre>";
// print_r($_POST);
// print_r($prod);
// print_r($uprod);
// echo "</pre>";