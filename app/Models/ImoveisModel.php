<?php
namespace App\Models;
use CodeIgniter\Model;

// Model = representa a tabela no banco
class ImoveisModel extends Model
{
    protected $table = 'IMOVEIS'; // nome da tabela
    protected $primaryKey = 'IMO_ID'; // chave primária

    // Campos permitidos para INSERT/UPDATE
    protected $allowedFields = [
        // colunas na tabela IMOVEIS do banco
        'IMO_RUA',
        'IMO_NUM',
        'IMO_CIDADE',
        'FK_PRO_ID'
    ];
}