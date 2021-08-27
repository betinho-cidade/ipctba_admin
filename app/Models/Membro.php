<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membro extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function local_congrega(){

        return $this->belongsTo('App\Models\LocalCongrega');
    }

    public function meio_admissao(){

        return $this->belongsTo('App\Models\MeioAdmissao');
    }

    public function meio_demissao(){

        return $this->belongsTo('App\Models\MeioDemissao');
    }

    public function situacao_membro(){

        return $this->belongsTo('App\Models\SituacaoMembro');
    }

    public function membro_ministerios(){

        return $this->hasMany('App\Models\MembroMinisterio');
    }

    public function historico_oficios(){

        return $this->hasMany('App\Models\HistoricoOficio');
    }

    public function getHistoricoOficioAtualAttribute(){

        $historico_atual = $this->historico_oficios()
                                ->whereNull('data_fim')
                                ->first();

        return ($historico_atual) ? $historico_atual->nome : ' --- ';
    }

    public function getImagemAttribute()
    {
        return ($this->path_imagem) ? asset('images/avatar/'.$this->path_imagem) : asset('images/avatar/avatar.png');
    }

}

