<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/logout', 'HomeController@logout')->name('logout')->middleware('auth');

Route::post('/js_viacep', 'Painel\PainelController@js_viacep')->name('painel.js_viacep');
//Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

//Route::get('/', 'Painel\PainelController@index')->name('painel')->middleware('auth');


Route::middleware(['auth'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['namespace' => 'Painel'], function(){

        Route::get('/', 'PainelController@index')->name('painel');

        Route::group(['namespace' => 'Parametros'], function(){
            Route::group(['namespace' => 'LocalCongrega'], function(){
                Route::get('/local_congrega', 'LocalCongregaController@index')->name('local_congrega.index');
                Route::get('/local_congrega/create', 'LocalCongregaController@create')->name('local_congrega.create');
                Route::post('/local_congrega/store', 'LocalCongregaController@store')->name('local_congrega.store');
                Route::get('/local_congrega/{local_congrega}', 'LocalCongregaController@show')->name('local_congrega.show');
                Route::put('/local_congrega/{local_congrega}/update', 'LocalCongregaController@update')->name('local_congrega.update');
                Route::delete('/local_congrega/{local_congrega}/destroy', 'LocalCongregaController@destroy')->name('local_congrega.destroy');
            });
            Route::group(['namespace' => 'MeioAdmissao'], function(){
                Route::get('/meio_admissao', 'MeioAdmissaoController@index')->name('meio_admissao.index');
                Route::get('/meio_admissao/create', 'MeioAdmissaoController@create')->name('meio_admissao.create');
                Route::post('/meio_admissao/store', 'MeioAdmissaoController@store')->name('meio_admissao.store');
                Route::get('/meio_admissao/{meio_admissao}', 'MeioAdmissaoController@show')->name('meio_admissao.show');
                Route::put('/meio_admissao/{meio_admissao}/update', 'MeioAdmissaoController@update')->name('meio_admissao.update');
                Route::delete('/meio_admissao/{meio_admissao}/destroy', 'MeioAdmissaoController@destroy')->name('meio_admissao.destroy');
            });
            Route::group(['namespace' => 'MeioDemissao'], function(){
                Route::get('/meio_demissao', 'MeioDemissaoController@index')->name('meio_demissao.index');
                Route::get('/meio_demissao/create', 'MeioDemissaoController@create')->name('meio_demissao.create');
                Route::post('/meio_demissao/store', 'MeioDemissaoController@store')->name('meio_demissao.store');
                Route::get('/meio_demissao/{meio_demissao}', 'MeioDemissaoController@show')->name('meio_demissao.show');
                Route::put('/meio_demissao/{meio_demissao}/update', 'MeioDemissaoController@update')->name('meio_demissao.update');
                Route::delete('/meio_demissao/{meio_demissao}/destroy', 'MeioDemissaoController@destroy')->name('meio_demissao.destroy');
            });
            Route::group(['namespace' => 'Oficio'], function(){
                Route::get('/oficio', 'OficioController@index')->name('oficio.index');
                Route::get('/oficio/create', 'OficioController@create')->name('oficio.create');
                Route::post('/oficio/store', 'OficioController@store')->name('oficio.store');
                Route::get('/oficio/{oficio}', 'OficioController@show')->name('oficio.show');
                Route::put('/oficio/{oficio}/update', 'OficioController@update')->name('oficio.update');
                Route::delete('/oficio/{oficio}/destroy', 'OficioController@destroy')->name('oficio.destroy');
            });
            Route::group(['namespace' => 'Ministerio'], function(){
                Route::get('/ministerio', 'MinisterioController@index')->name('ministerio.index');
                Route::get('/ministerio/create', 'MinisterioController@create')->name('ministerio.create');
                Route::post('/ministerio/store', 'MinisterioController@store')->name('ministerio.store');
                Route::get('/ministerio/{ministerio}', 'MinisterioController@show')->name('ministerio.show');
                Route::put('/ministerio/{ministerio}/update', 'MinisterioController@update')->name('ministerio.update');
                Route::delete('/ministerio/{ministerio}/destroy', 'MinisterioController@destroy')->name('ministerio.destroy');
            });
            Route::group(['namespace' => 'SituacaoMembro'], function(){
                Route::get('/situacao_membro', 'SituacaoMembroController@index')->name('situacao_membro.index');
                Route::get('/situacao_membro/create', 'SituacaoMembroController@create')->name('situacao_membro.create');
                Route::post('/situacao_membro/store', 'SituacaoMembroController@store')->name('situacao_membro.store');
                Route::get('/situacao_membro/{situacao_membro}', 'SituacaoMembroController@show')->name('situacao_membro.show');
                Route::put('/situacao_membro/{situacao_membro}/update', 'SituacaoMembroController@update')->name('situacao_membro.update');
                Route::delete('/situacao_membro/{situacao_membro}/destroy', 'SituacaoMembroController@destroy')->name('situacao_membro.destroy');
            });
            Route::group(['namespace' => 'TipoSolicitacao'], function(){
                Route::get('/tipo_solicitacao', 'TipoSolicitacaoController@index')->name('tipo_solicitacao.index');
                Route::get('/tipo_solicitacao/create', 'TipoSolicitacaoController@create')->name('tipo_solicitacao.create');
                Route::post('/tipo_solicitacao/store', 'TipoSolicitacaoController@store')->name('tipo_solicitacao.store');
                Route::get('/tipo_solicitacao/{tipo_solicitacao}', 'TipoSolicitacaoController@show')->name('tipo_solicitacao.show');
                Route::put('/tipo_solicitacao/{tipo_solicitacao}/update', 'TipoSolicitacaoController@update')->name('tipo_solicitacao.update');
                Route::delete('/tipo_solicitacao/{tipo_solicitacao}/destroy', 'TipoSolicitacaoController@destroy')->name('tipo_solicitacao.destroy');
            });
        });

        Route::group(['namespace' => 'Cadastro'], function(){
            Route::group(['namespace' => 'Usuario'], function(){
                Route::get('/usuario', 'UsuarioController@index')->name('usuario.index');
                Route::get('/usuario/create', 'UsuarioController@create')->name('usuario.create');
                Route::post('/usuario/store', 'UsuarioController@store')->name('usuario.store');
                Route::get('/usuario/{usuario}', 'UsuarioController@show')->name('usuario.show');
                Route::put('/usuario/{usuario}/update', 'UsuarioController@update')->name('usuario.update');
                Route::delete('/usuario/{usuario}/destroy', 'UsuarioController@destroy')->name('usuario.destroy');
            });
            Route::group(['namespace' => 'Membro'], function(){
                Route::get('/membro', 'MembroController@index')->name('membro.index');
                Route::get('/membro/create', 'MembroController@create')->name('membro.create');
                Route::post('/membro/store', 'MembroController@store')->name('membro.store');
                Route::get('/membro/{membro}', 'MembroController@show')->name('membro.show');
                Route::put('/membro/{membro}/update', 'MembroController@update')->name('membro.update');
                Route::delete('/membro/{membro}/destroy', 'MembroController@destroy')->name('membro.destroy');
            });
        });

    });

});

//** Páginas de Acesso pelo Portal, para cadastro de novos Membros **/
Route::group(['namespace' => 'Guest'], function(){

    Route::group(['namespace' => 'Cadastro\Proposta'], function(){
        Route::get('/proposta', 'PropostaController@create')->name('proposta.create');
        Route::post('/proposta/create', 'PropostaController@store')->name('proposta.store');
        Route::get('/proposta/bemvindo', 'PropostaController@bemvindo')->name('proposta.bemvindo');
    });
});

