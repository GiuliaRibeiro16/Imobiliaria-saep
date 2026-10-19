<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ProprietariosModel;

class ProprietariosController extends BaseController
{
    // Exibe a listagem de responsavel
    public function index()
    {
        // Instancia o Model responsável pela tabela RESPONSAVEL
        $model = new ProprietariosModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o texto digitado no campo de pesquisa
            $pesquisar = $this->request->getPost('pesquisar');

            // Busca responsaveis que possuem o termo informado
            // no nome ou data de nascimento
            $dados['proprietarios'] = $model
                ->like('PRO_NOME', $pesquisar)
                ->orLike('PRO_CPF', $pesquisar)
                ->findAll();
        }
        else {

            // Caso nenhuma pesquisa tenha sido realizada,
            // busca todos os responsaveis cadastrados
            $dados['proprietarios'] = $model->findAll();
        }

        // Carrega a View de listagem e envia os responsáveis encontrados
        return view('sistema/proprietarios/index', $dados);
    }


    // Exibe o formulário para cadastrar um novo responsavel
    public function novo()
    {
        // Apenas carrega a View com o formulário
        return view('sistema/proprietarios/novo_proprietario');
    }


    // Insere um novo responsavel no banco de dados
    public function inserir()
    {
        // Instancia o Model
        $model = new ProprietariosModel();

        // Recupera os valores enviados pelo formulário
        $dados = [
            'PRO_NOME' => $this->request->getPost('nome'),
            'PRO_CPF' => $this->request->getPost('cpf')
        ];

        // Insere o novo responsavel no banco
        $model->insert($dados);

        // Redireciona para a listagem de responsavel
        return redirect()
            ->to(base_url('proprietarios'))
            ->with('success', 'Proprietário cadastrado com sucesso!');
    }


    // Exibe o formulário para editar um responsavel
    public function editar($id)
    {
        // Instancia o Model
        $model = new ProprietariosModel();

        // Busca o responsavel pelo ID recebido na URL
        $dados['proprietarios'] = $model->find($id);

        // Carrega a View de edição enviando os dados do responsavel
        return view('sistema/proprietarios/editar_proprietario', $dados);
    }


    // Atualiza os dados de um responsavel
    public function atualizar($id)
    {
        // Instancia o Model
        $model = new ProprietariosModel();

        // Recupera os novos valores enviados pelo formulário
        $dados = [
            'PRO_NOME' => $this->request->getPost('nome'),
            'PRO_CPF' => $this->request->getPost('cpf')
        ];

        // Atualiza o registro correspondente ao ID
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('proprietarios'))
            ->with('success', 'Proprietário atualizado com sucesso!');
    }


    // Exclui um responsavel
    public function excluir($id)
    {
        // Instancia o Model
        $model = new ProprietariosModel();

        // Exclui o registro correspondente ao ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('proprietarios'))
            ->with('success', 'Proprietário excluído com sucesso!');
    }
}