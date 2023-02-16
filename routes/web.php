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

//Route::get('/import', 'ImportController@index')->name('import.index');
//Route::post('/import/membro', 'ImportController@upload')->name('import.upload');


Route::middleware(['auth'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['namespace' => 'Painel'], function(){

        Route::get('/', 'PainelController@index')->name('painel');

        Route::group(['namespace' => 'Parametros'], function(){
            Route::group(['namespace' => 'StatusParticipacao'], function(){
                Route::get('/status_participacao', 'StatusParticipacaoController@index')->name('status_participacao.index');
                Route::get('/status_participacao/create', 'StatusParticipacaoController@create')->name('status_participacao.create');
                Route::post('/status_participacao/store', 'StatusParticipacaoController@store')->name('status_participacao.store');
                Route::get('/status_participacao/{status_participacao}', 'StatusParticipacaoController@show')->name('status_participacao.show');
                Route::put('/status_participacao/{status_participacao}/update', 'StatusParticipacaoController@update')->name('status_participacao.update');
                Route::delete('/status_participacao/{status_participacao}/destroy', 'StatusParticipacaoController@destroy')->name('status_participacao.destroy');
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

            Route::group(['namespace' => 'UsuarioLogado'], function(){
                Route::get('/usuario_logado/{user}', 'UsuarioLogadoController@show')->name('usuario_logado.show');
                Route::put('/usuario_logado/{user}/update', 'UsuarioLogadoController@update')->name('usuario_logado.update');
            });

            Route::group(['namespace' => 'Membro'], function(){
                // Route::get('/membro', 'MembroController@index')->name('membro.index');
                Route::get('/membro/excell', 'MembroController@excell')->name('membro.excell');
                Route::get('/membro/create', 'MembroController@create')->name('membro.create');
                Route::post('/membro/store', 'MembroController@store')->name('membro.store');
                Route::get('/membro/{membro}', 'MembroController@show')->name('membro.show');
                Route::put('/membro/{membro}/update', 'MembroController@update')->name('membro.update');
                Route::delete('/membro/{membro}/destroy', 'MembroController@destroy')->name('membro.destroy');
                Route::get('/membro/{membro}/pdf', 'MembroController@pdf')->name('membro.pdf');

                Route::group(['namespace' => 'HistoricoOficio'], function(){
                    Route::get('/membro/{membro}/historico_oficio/create', 'HistoricoOficioController@create')->name('historico_oficio.create');
                    Route::post('/membro/{membro}/historico_oficio/store', 'HistoricoOficioController@store')->name('historico_oficio.store');
                    Route::get('/membro/{membro}/historico_oficio/{historico_oficio}', 'HistoricoOficioController@show')->name('historico_oficio.show');
                    Route::put('/membro/{membro}/historico_oficio/{historico_oficio}/update', 'HistoricoOficioController@update')->name('historico_oficio.update');
                    Route::delete('/membro/{membro}/historico_oficio/{historico_oficio}/destroy', 'HistoricoOficioController@destroy')->name('historico_oficio.destroy');
                });

                Route::group(['namespace' => 'HistoricoSituacao'], function(){
                    Route::get('/membro/{membro}/historico_situacao/create', 'HistoricoSituacaoController@create')->name('historico_situacao.create');
                    Route::post('/membro/{membro}/historico_situacao/store', 'HistoricoSituacaoController@store')->name('historico_situacao.store');
                    Route::get('/membro/{membro}/historico_situacao/{historico_situacao}', 'HistoricoSituacaoController@show')->name('historico_situacao.show');
                    Route::put('/membro/{membro}/historico_situacao/{historico_situacao}/update', 'HistoricoSituacaoController@update')->name('historico_situacao.update');
                    Route::delete('/membro/{membro}/historico_situacao/{historico_situacao}/destroy', 'HistoricoSituacaoController@destroy')->name('historico_situacao.destroy');
                });

                Route::group(['namespace' => 'MembroFamilia'], function(){
                    Route::get('/membro/{membro}/membro_familia/create', 'MembroFamiliaController@create')->name('membro_familia.create');
                    Route::post('/membro/{membro}/membro_familia/store', 'MembroFamiliaController@store')->name('membro_familia.store');
                    Route::delete('/membro/{membro}/membro_familia/{membro_familia}/destroy', 'MembroFamiliaController@destroy')->name('membro_familia.destroy');
                });

            });

            Route::group(['namespace' => 'MembroFicha'], function(){
                Route::get('/membro_ficha', 'MembroFichaController@index')->name('membro_ficha.index');
                Route::get('/membro_ficha/create', 'MembroFichaController@create')->name('membro_ficha.create');
                Route::post('/membro_ficha/store', 'MembroFichaController@store')->name('membro_ficha.store');
                Route::get('/membro_ficha/{membro_ficha}', 'MembroFichaController@show')->name('membro_ficha.show');
                Route::put('/membro_ficha/{membro_ficha}/update', 'MembroFichaController@update')->name('membro_ficha.update');
                Route::delete('/membro_ficha/{membro_ficha}/destroy', 'MembroFichaController@destroy')->name('membro_ficha.destroy');
            });

            Route::group(['namespace' => 'AgendaSolicitacao'], function(){
                Route::get('/agenda_solicitacao', 'AgendaSolicitacaoController@index')->name('agenda_solicitacao.index');
                Route::get('/agenda_solicitacao/create', 'AgendaSolicitacaoController@create')->name('agenda_solicitacao.create');
                Route::post('/agenda_solicitacao/store', 'AgendaSolicitacaoController@store')->name('agenda_solicitacao.store');
                Route::get('/agenda_solicitacao/{agenda_solicitacao}', 'AgendaSolicitacaoController@show')->name('agenda_solicitacao.show');
                Route::put('/agenda_solicitacao/{agenda_solicitacao}/update', 'AgendaSolicitacaoController@update')->name('agenda_solicitacao.update');
                Route::delete('/agenda_solicitacao/{agenda_solicitacao}/destroy', 'AgendaSolicitacaoController@destroy')->name('agenda_solicitacao.destroy');
            });

        });

        Route::group(['namespace' => 'Dashboard'], function(){

            Route::group(['namespace' => 'Agenda'], function(){
                Route::get('/agenda', 'AgendaController@index')->name('agenda.index');
                Route::post('/agenda', 'AgendaController@index')->name('agenda.index');
            });

            Route::group(['namespace' => 'Relatorio'], function(){
                Route::get('/relatorio', 'RelatorioController@index')->name('relatorio.index');
                Route::get('/relatorio/search', 'RelatorioController@search')->name('relatorio.search');
                Route::get('/relatorio/excell', 'RelatorioController@excell')->name('relatorio.excell');
            });

            Route::group(['namespace' => 'Indicador'], function(){
                Route::get('/indicador', 'IndicadorController@index')->name('indicador.index');
            });
        });

    });

});

//** Páginas de Acesso pelo Portal, para cadastro de novos Membros / Ficha de Atualização **/
Route::group(['namespace' => 'Guest'], function(){

    Route::group(['namespace' => 'Cadastro'], function(){

        Route::group(['namespace' => 'Visitante'], function(){
            Route::get('/novo_membro', 'VisitanteController@create')->name('visitante.create');
            Route::post('/novo_membro/store', 'VisitanteController@store')->name('visitante.store');
            Route::post('/novo_membro/js_viacep', 'VisitanteController@js_viacep')->name('visitante.js_viacep');
            Route::get('/novo_membro/bemvindo', 'VisitanteController@bemvindo')->name('visitante.bemvindo');
        });

        Route::group(['namespace' => 'FichaCadastro'], function(){
            Route::get('/ficha_cadastro', 'FichaCadastroController@create')->name('ficha_cadastro.create');
            Route::post('/ficha_cadastro/store', 'FichaCadastroController@store')->name('ficha_cadastro.store');
            Route::post('/ficha_cadastro/js_viacep', 'FichaCadastroController@js_viacep')->name('ficha_cadastro.js_viacep');
            Route::get('/ficha_cadastro/ok', 'FichaCadastroController@ok')->name('ficha_cadastro.ok');
        });
    });

});

