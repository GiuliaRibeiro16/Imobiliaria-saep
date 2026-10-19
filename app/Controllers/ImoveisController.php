<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ProprietariosModel;
use App\Models\ImoveisModel;

// Vincula o Paciente com seu respectivo Responsavel (FK_RES_ID)
class ImoveisController extends BaseController
{
    // Exibe a listagem de paciente
    public function index()
    {
        // Instancia o Model de paciente
        $model = new ImoveisModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o texto digitado pelo usuário
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca os pacientes juntamente com o nome do responsavel
            // responsável por cada paciente
            $dados['imoveis'] = $model
                ->select('IMOVEIS.*, PROPRIETARIOS.PRO_NOME')

                // Relaciona PACIENTE com RESPONSAVEL pela chave estrangeira
                ->join(
                    'PROPRIETARIOS',
                    'PROPRIETARIOS.PRO_ID = IMOVEIS.FK_PRO_ID'
                )

                // Agrupa as condições da pesquisa
                ->groupStart()

                    // Pesquisa pela PLACA
                    ->like('IMO_RUA', $pesquisar)

                    // Pesquisa pela MARCA
                    ->orLike('IMO_NUM', $pesquisar)

                    // Pesquisa pela MARCA
                    ->orLike('IMO_CIDADE', $pesquisar)

                    // Também permite pesquisar pelo nome do responsavel
                    ->orLike('PROPRIETARIOS.PRO_NOME', $pesquisar)

                ->groupEnd()

                // Executa a consulta
                ->findAll();
        }
        else {

            // Caso não exista pesquisa, busca todos os pacientes
            // juntamente com o nome dos respectivos responsaveis
            $dados['imoveis'] = $model
                ->select('IMOVEIS.*, PROPRIETARIOS.PRO_NOME')
                ->join(
                    'PROPRIETARIOS',
                    'PROPRIETARIOS.PRO_ID = IMOVEIS.FK_PRO_ID'
                )
                ->findAll();
        }

        // Carrega a View de paciente
        return view('sistema/imoveis/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo paciente
    public function novo()
    {
        // Instancia o Model de responsavel
        $proprietariosModel = new ProprietariosModel();

        // Busca todos os responsavel cadastrados
        // Esses dados serão utilizados em um campo SELECT
        $dados['proprietarios'] = $proprietariosModel->findAll();

        // Carrega o formulário de cadastro do veículo
        return view('sistema/imoveis/novo_imovel', $dados);
    }


    // Insere um novo paciente
    public function inserir()
    {
        // Instancia o Model de paciente
        $model = new ImoveisModel();

        // Recupera os dados enviados pelo formulário
        $dados = [
            'IMO_RUA' => $this->request->getPost('rua'),
            'IMO_NUM' => $this->request->getPost('num'),
            'IMO_CIDADE' => $this->request->getPost('cidade'),

            // Guarda o ID do responsavel escolhido no formulário
            // como chave estrangeira do paciente
            'FK_PRO_ID' => $this->request->getPost('proprietarios')
        ];

        // Insere o paciente no banco
        $model->insert($dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('imoveis'))
            ->with('success', 'Imóvel cadastrado com sucesso!');
    }


    // Exibe o formulário de edição
    public function editar($id)
    {
        // Instancia o Model de Paciente
        $imoveisModel = new ImoveisModel();

        // Instancia o Model de responsavel
        $proprietariosModel = new ProprietariosModel();

        // Busca o paciente que será editado
        $dados['imoveis'] = $ImoveisModel->find($id);

        // Busca todos os responsáveis para preencher o SELECT
        $dados['proprietarios'] = $proprietariosModel->findAll();

        // Carrega a View de edição
        return view('sistema/imoveis/editar_imovel', $dados);
    }


    // Atualiza um paciente
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new ImoveisModel();

        // Recupera os novos dados do formulário
        $dados = [
            'IMO_RUA' => $this->request->getPost('rua'),
            'IMO_NUM' => $this->request->getPost('num'),
            'IMO_CIDADE' => $this->request->getPost('cidade'),

            // Guarda o ID do responsavel escolhido no formulário
            // como chave estrangeira do paciente
            'FK_PRO_ID' => $this->request->getPost('proprietarios')
        ];

        // Atualiza o paciente pelo ID
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('imoveis'))
            ->with('success', 'Imóvel atualizado com sucesso!');
    }


    // Exclui um paciente
    public function excluir($id)
    {
        // Instancia o Model
        $model = new ImovelModel();

        // Exclui o Imóvel pelo ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('imoveis'))
            ->with('success', 'Imóvel excluído com sucesso!');
    }
}