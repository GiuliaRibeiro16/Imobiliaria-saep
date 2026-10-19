<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Novo Imóvel</title>
    </head>
    <body>
        <h1>Novo Imóvel</h1>
        <form action="<?= base_url('imoveis/inserir') ?>" method="POST">
            <label>Rua:</label><br>
            <input type="text" id="rua" name="rua" placeholder="Rua..." required>

            <br><br>
            
            <label>Número:</label><br>
            <input type="text" id="numero" name="numero" placeholder="123..." required>

            <br><br>
            
            <label>Cidade:</label><br>
            <input type="text" id="cidade" name="cidade" placeholder="Boa Vista..." required>

            <br><br>

            <br><br>

            <label>Proprietario:</label><br>
            <select id="proprietarios" name="proprietarios" required>
                <option value="">Selecione um Proprietário</option>
                <?php foreach($proprietarios as $proprietario): ?>
                    <option value="<?= $proprietario['PRO_ID'] ?>">
                        <?= $proprietario['PRO_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <br><br>

            <input type="submit" id="cadastrar_proprietario" name="cadastrar_proprietario" value="Cadastrar">
        </form>
        <br>
        <a href="<?= base_url('proprietarios') ?>"><button>Voltar</button></a>
    </body>
</html>