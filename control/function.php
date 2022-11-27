<?php

function require_view($file, $type)
{
    $variables = get_replacement($type);

    if($type == 'list_item')
    {
        $new_html = "";
        foreach($variables as $var)
        {
            $html = file_get_contents($file);

            foreach($var as $key => $val)
            {
                $html = str_replace($key, $val, $html);
            }

            $new_html .= $html;
        }
        
        $list = file_get_contents('view' . DIRECTORY_SEPARATOR . 'list.html');
        $html = str_replace('{{list_items}}', $new_html, $list);
    }
    else
    {
        $html = file_get_contents($file);

        foreach($variables as $key => $val)
        {
            $html = str_replace($key, $val, $html);
        }
    }

    echo $html;
}



function get_replacement($type)
{
    global $crud;
    global $uprod;

    if($type == 'header')
    {
        $alert = isset($_SESSION['msg']) ? '<div class="alert alert-success" role="alert">'.$_SESSION['msg'].'</div>' : '';
        unset($_SESSION['msg']);

        if($crud == 'select')
        {
            return ['{{alert-msg}}' => $alert, '{{title}}' => 'Listagem de Materia', '{{h1}}' => 'Materia']; 
        }
        else if($crud == 'insert')
        {
            return ['{{alert-msg}}' => $alert, '{{title}}' => 'CRUD - Insert', '{{h1}}' => 'Inserir Aluno']; 
        }
        else if($crud == 'update')
        {
            return ['{{alert-msg}}' => $alert, '{{title}}' => 'CRUD - Update', '{{h1}}' => 'Atualizar Aluno']; 
        }
    }
    else if($type == 'insert')
    {
        return ['{{crud}}' => 'insert', '{{matricula}}' => '', '{{product}}' => '', '{{ano}}' => '', '{{btn}}' => 'Cadastrar']; 
    }
    else if($type == 'update')
    {
        $id    = isset($uprod['matricula']) ? $uprod['matricula'] : '';
        $nome  = isset($uprod['aluno']) ? $uprod['aluno'] : '';
        $valor = isset($uprod['semestre']) ? $uprod['semestre'] : '';

        return ['{{crud}}' => 'update', '{{matricula}}' => $id, '{{product}}' => $nome, '{{semestre}}' => $valor, '{{btn}}' => 'Atualizar']; 
    }
    else if($type == 'list_item')
    {
        return mount_replacement();
    }

    return [];
}

function mount_replacement()
{
    global $prod;

    $data = [];

    foreach($prod as $rtn)
    {
        array_push($data, [
            '{{matricula}}'       => $rtn['matricula'],
            '{{faculdade}}'  => $rtn['aluno'],
            '{{semestre}}'    => number_format($rtn['ano'], 2, ',', '.'),
            '{{carga}}' => number_format($rtn['carga_horaria'], 2, ',', '.'),
        ]);
    }

    return $data;
}