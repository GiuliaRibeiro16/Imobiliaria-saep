<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\AgendamentosModel;
use App\Models\ImoveisModel;
use App\Models\ProprietariosModel;


class AgendamentosController extends BaseController
{
    // Exibe a listagem de agendamentos
    public function index()
    {
        // Instancia o Model de agendamento
        $model = new AgendamentosModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o termo digitado
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca os agendamentos juntamente com
            // informações do veiculo e do responsável
            $dados['agendamento'] = $model
                ->select(
                    'AGENDAMENTOS.*,
                    IMOVEIS.IMO_RUA,
                    PRORPIETARIOS.PRO_NOME'
                )

                // Relaciona o agendamento ao veiculo
                ->join(
                    'IMOVEIS',
                    'IMOVEIS.IMO_ID = AGENDAMENTOS.FK_IMO_ID'
                )

                // Relaciona o agendamento ao responsável
                ->join(
                    'PRORPIETARIOS',
                    'PRORPIETARIOS.PRO_ID = AGENDAMENTOS.FK_PRO_ID'
                )

                // Agrupa as condições utilizadas na pesquisa
                ->groupStart()

                    // Pesquisa pelo nome do veiculo
                    ->like('IMOVEIS.IMO_RUA', $pesquisar)

                    // Pesquisa pelo nome do responsável
                    ->orLike('PRORPIETARIOS.PRO_NOME', $pesquisar)

                    // Pesquisa pelo servico
                    ->orLike('AGE_MOTIVO', $pesquisar)

                    // Pesquisa pelo status
                    ->orLike('AGE_STATUS', $pesquisar)

                ->groupEnd()

                // Ordena os agendamentos pela data e hora
                ->orderBy('AGE_DATA_HORA', 'ASC')

                // Executa a consulta
                ->findAll();
        }
        else {

            // Caso nenhuma pesquisa tenha sido realizada,
            // busca todos os agendamentos
            $dados['agendamento'] = $model
                ->select(
                    'AGENDAMENTOS.*,
                    IMOVEIS.IMO_RUA,
                    PROPRIETARIOS.PRO_NOME'
                )

                // Relaciona o veiculo ao agendamento
                ->join(
                    'IMOVEIS',
                    'IMOVEIS.IMO_ID = AGENDAMENTOS.FK_IMO_ID'
                )

                // Relaciona o responsável ao agendamento
                ->join(
                    'PROPRIETARIOS',
                    'PROPRIETARIOS.PRO_ID = AGENDAMENTOS.FK_PRO_ID'
                )

                // Ordena pela data e hora do agendamento
                ->orderBy('AGE_DATA_HORA', 'ASC')

                // Executa a consulta
                ->findAll();
        }

        // Carrega a View com os agendamentos encontrados
        return view('sistema/agendamentos/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo agendamento
    public function novo()
    {
        // Instancia o Model de veiculo
        $imoveisModel = new ImoveisModel();

        // Instancia o Model de responsável
        $proprietariosModel = new ProprietariosModel();

        // Busca todos os imoveis para preencher o SELECT
        $dados['imoveis'] = $imoveisModel->findAll();

        // Busca todos os responsáveis para preencher o SELECT
        $dados['proprietarios'] = $proprietariosModel->findAll();

        // Carrega o formulário
        return view(
            'sistema/agendamentos/novo_agendamento',
            $dados
        );
    }


    // Insere um novo agendamento
    public function inserir()
    {
        // Instancia o Model
        $model = new AgendamentosModel();

        // Recupera os dados enviados pelo formulário
        $dados = [
            'AGE_DATA_HORA' => $this->request->getPost('data_hora'),
            'AGE_MOTIVO' => $this->request->getPost('motivo'),
            'AGE_STATUS' => $this->request->getPost('status'),

            // veiculo escolhido no formulário
            'FK_IMO_ID' => $this->request->getPost('imoveis'),

            // Responsável escolhido no formulário
            'FK_PRO_ID' => $this->request->getPost('proprietarios')
        ];

        // Insere o agendamento no banco
        $model->insert($dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('agendamentos'))
            ->with('success', 'Agendamento cadastrado com sucesso!');
    }


    // Exibe o formulário de edição
    public function editar($id)
    {
        // Instancia os três Models necessários
        $agendamentosModel = new AgendamentosModel();
        $imoveisModel = new ImoveisModel();
        $proprietariosModel = new ProprietariosModel();

        // Busca o agendamento pelo ID
        $dados['agendamento'] = $agendamentosModel->find($id);

        // Busca os imoveis para preencher o SELECT
        $dados['imoveis'] = $imoveisModel->findAll();

        // Busca os responsáveis para preencher o SELECT
        $dados['proprietarios'] = $proprietariosModel->findAll();

        // Carrega a View de edição
        return view(
            'sistema/agendamentos/editar_agendamento',
            $dados
        );
    }


    // Atualiza um agendamento
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new AgendamentosModel();

        // Recupera os novos valores enviados pelo formulário
        $dados = [
            'AGE_DATA_HORA' => $this->request->getPost('data_hora'),
            'AGE_MOTIVO' => $this->request->getPost('motivo'),
            'AGE_STATUS' => $this->request->getPost('status'),
            'FK_IMO_ID' => $this->request->getPost('imoveis'),
            'FK_PRO_ID' => $this->request->getPost('proprietarios')
        ];

        // Atualiza o agendamento no banco
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('agendamentos'))
            ->with('success', 'Agendamento atualizado com sucesso!');
    }


    // Exclui um agendamento
    public function excluir($id)
    {
        // Instancia o Model
        $model = new AgendamentosModel();

        // Exclui o agendamento pelo ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('agendamentos'))
            ->with('success', 'Agendamento excluído com sucesso!');
    }
}