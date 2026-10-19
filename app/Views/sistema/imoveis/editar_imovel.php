<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar Imóveis</title>
    </head>
    <body>
        <h1>Editar Imóveis</h1>

        <form action="<?= base_url('imoveis/atualizar/'.$imoveis['IMO_ID']) ?>" method="POST">
            <label>Rua:</label><br>
            <input type="text" id="rua" name="rua" value="<?= $imoveis['IMO_RUA'] ?>" required>
            <br><br>
            <label>Número:</label><br>
            <input type="text" id="numero" name="numero" value="<?= $imoveis['IMO_NUM'] ?>" required>
            <br><br>
            <label>Cidade:</label><br>
            <input type="text" id="cidade" name="cidade" value="<?= $imoveis['IMO_CIDADE'] ?>" required>
            <br><br>

            <label>Proprietário:</label><br>
            <select id="proprietarios" name="proprietarios" required>
                <?php foreach($proprietarios as $proprietario): ?>
                    <option value="<?= $proprietario['PRO_ID'] ?>"
                        <?= $proprietario['PRO_ID'] == $imoveis['FK_PRO_ID'] ? 'selected' : '' ?>>
                        <?= $proprietario['PRO_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <br><br>

            <input type="submit" id="editar_imovel" name="editar_imovel" value="Salvar Alterações">
        </form>

        <br>
        <a href="<?= base_url('imoveis') ?>"><button>Voltar</button></a>
    </body>
</html>