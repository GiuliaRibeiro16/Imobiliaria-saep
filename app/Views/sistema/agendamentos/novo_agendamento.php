<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Novo Agendamento</title>
    </head>
    <body>
        <h1>Novo Agendamento</h1>

        <form action="<?= base_url('agendamentos/inserir') ?>" method="POST">
            <label>Data e Hora:</label><br>
            <input type="datetime-local" id="data_hora" name="data_hora" required>
            <br><br>

            <label>Motivo:</label><br>
            <input type="text" id="motivo" name="motivo" placeholder="Motivo..." required>
            <br><br>

            <label>Status:</label><br>
            <input type="text" id="status" name="status" placeholder="Status..." required>
            <br><br>

            <label>Proprietário:</label><br>
            <select id="proprietarios" name="proprietarios" required>
                <option value="">Selecione um Proprietário</option>
                <?php foreach($proprietarios as $proprietario): ?>
                    <option value="<?= $proprietario['PRO_ID'] ?>">
                        <?= $proprietario['PRO_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <label>Imóvel:</label><br>
            <select id="imoveis" name="imoveis" required>
                <option value="">Selecione um Imóvel</option>
                <?php foreach($imoveis as $imovel): ?>
                    <option value="<?= $imovel['IMO_ID'] ?>">
                        <?= $imovel['IMO_RUA'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <input type="submit" id="cadastrar_agendamento" name="cadastrar_agendamento" value="Cadastrar">
        </form>
        <br>
        <a href="<?= base_url('agendamentos') ?>"><button>Voltar</button></a>
    </body>
</html>