<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Lista de Proprietários</title>
    </head>
    <body>
        <h1>Lista de Proprietários</h1>

        <form method="POST" action="<?= base_url('proprietarios') ?>">
            <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">
            <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
        </form>

        <br>

        <table border="1">
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>

            <?php foreach($proprietarios as $proprietario): ?>
                <tr>
                    <td><?= $proprietario['PRO_NOME'] ?></td>
                    <td><?= $proprietario['PRO_CPF'] ?></td>
                    <td><?= $proprietario['PRO_TELEFONE'] ?></td>
                    <td><a href="<?= base_url('proprietarios/editar/'.$proprietario['PRO_ID']) ?>">Editar</a></td>
                    <td><a href="<?= base_url('proprietarios/excluir/'.$proprietario['PRO_ID']) ?>">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <br>
        <a href="<?= base_url('proprietarios/novo') ?>"><button>Cadastrar Proprietário</button></a>
        <br><br>
        <a href="<?= base_url('inicio') ?>"><button>Voltar</button></a>
    </body>
</html>