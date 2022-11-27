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
        if(isset($_POST['faculdade']) && isset($_POST['matricula']))
        {
            $sql = "INSERT INTO faculdade (aluno, matricula) VALUES (?, ?)";
            $prm = [
                $_POST['faculdade'],
                $_POST['matricula'],
            ];
            $prod = $conn->insert($sql, $prm);
            
            $_SESSION['msg'] = $prod !== false ? 'Aluno(a) cadastrado(a) com sucesso!' : $prod;

            # Redirect to list products
            $prod = $conn->select("SELECT * FROM faculdade");
            $crud = 'select';
        }
    }
    else if($_POST['crud'] == 'update')
    {
        if(isset($_POST['matricula_update']))
        {
            $sql = "SELECT * FROM faculdade WHERE matricula = ?";
            $prm = [
                $_POST['matricula_update'],
            ];
            $prod = $conn->select($sql, $prm);
            $uprod = $prod[0];
        }
        else if(isset($_POST['matricula']) && isset($_POST['faculdade']) && isset($_POST['matricula']))
        {
            $sql = "UPDATE faculdade SET aluno = ?, semestre = ? WHERE matricula = ?";
            $prm = [
                $_POST['faculdade'],
                $_POST['aluno'],
                $_POST['matricula'],
            ];
            $prod = $conn->update($sql, $prm);
            $uprod = [
                "matricula" => $_POST['matricula'],
                "aluno"       => $_POST['faculdade'],
                "semestre"      => $_POST['ano'],
                ];
            
            $_SESSION['msg'] = $prod !== false ? 'Aluno(a) atualizado(a) com sucesso!' : $prod;
            
            # Redirect to list products
            $prod = $conn->select("SELECT * FROM faculdade");
            $crud = 'select';
        }
    }
    else if($_POST['crud'] == 'delete')
    {
        $sql = "DELETE FROM faculdade WHERE matricula = ?";
        $prm = [
            $_POST['matricula_delete'],
        ];
        $prod = $conn->delete($sql, $prm);
        
        $_SESSION['msg'] = $prod !== false ? 'Aluno(a) excluído(a) com sucesso!' : $prod;

        # Redirect to list products
        $prod = $conn->select("SELECT * FROM faculdade");
        $crud = 'select';
    }
}
else
{
    $prod = $conn->select("SELECT * FROM faculdade");
}

// echo "<pre>";
// print_r($_POST);
// print_r($prod);
// print_r($uprod);
// echo "</pre>";