<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar Agendamento</title>
    </head>
    <body>
        <h1>Editar Agendamento</h1>

        <form action="<?= base_url('agendamentos/atualizar/'.$agendamento['AGE_ID']) ?>" method="POST">
            <label>Data e Hora:</label><br>
            <input type="datetime-local" id="data_hora" name="data_hora" value="<?= date('Y-m-d\TH:i', strtotime($agendamento['AGE_DATA_HORA'])) ?>" required>
            <br><br>

            <label>Motivo:</label><br>
            <input type="text" id="motivo" name="motivo" value="<?= $agendamento['AGE_MOTIVO'] ?>" required>
            <br><br>

            <label>Status:</label><br>
            <input type="text" id="status" name="status" value="<?= $agendamento['AGE_STATUS'] ?>" required>
            <br><br>

            <label>Proprietário:</label><br>
            <select id="proprietario" name="proprietario" required>
                <?php foreach($proprietarios as $proprietario): ?>
                    <option value="<?= $proprietario['PRO_ID'] ?>"
                        <?= $proprietario['PRO_ID'] == $agendamento['FK_PRO_ID'] ? 'selected' : '' ?>>
                        <?= $proprietario['PRO_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <label>Imóvel:</label><br>
            <select id="imovel" name="imovel" required>
                <?php foreach($imoveis as $imovel): ?>
                    <option value="<?= $imovel['IMO_ID'] ?>"
                        <?= $imovel['IMO_ID'] == $agendamento['FK_IMO_ID'] ? 'selected' : '' ?>>
                        <?= $imovel['IMO_RUA'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <input type="submit" id="editar_agendamento" name="editar_agendamento" value="Salvar Alterações">
        </form>
        <br>
        <a href="<?= base_url('agendamentos') ?>"><button>Voltar</button></a>
    </body>
</html>