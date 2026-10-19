<?php
namespace App\Models;
use CodeIgniter\Model;

// Model = representa a tabela no banco
class ProprietariosModel extends Model
{
    protected $table = 'PROPRIETARIOS'; // nome da tabela
    protected $primaryKey = 'PRO_ID'; // chave primária

    // Campos permitidos para INSERT/UPDATE
    protected $allowedFields = [
        // colunas na tabela CLIENTE do banco
        'PRO_NOME',
        'PRO_CPF',
        'PRO_TELEFONE'
    ];
}