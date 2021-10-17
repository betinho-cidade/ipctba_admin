            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->

                        <ul class="metismenu list-unstyled" id="side-menu">


                            @if($user->roles->contains('name', 'Gestor'))
                            <!-- Menus Relacioandos a administração - Acesso somente para GESTOR - INICIO-->

                            <li class="menu-title">GESTÃO ORGANIZACIONAL</li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ri-store-2-line"></i>
                                    <span>Dashboard</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('indicador.index') }}">Indicadores</a></li>
                                    <li><a href="{{ route('agenda.index') }}">Agenda</a></li>
                                    <li><a href="{{ route('relatorio.index') }}">Filtro de Membros</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ri-store-2-line"></i>
                                    <span>Parametrizações</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('status_participacao.index') }}">Status de Participação</a></li>
                                    <li><a href="{{ route('meio_admissao.index') }}">Meios de Admissão</a></li>
                                    <li><a href="{{ route('meio_demissao.index') }}">Meios de Demissão</a></li>
                                    <li><a href="{{ route('oficio.index') }}">Ofícios</a></li>
                                    <li><a href="{{ route('ministerio.index') }}">Ministérios</a></li>
                                    <li><a href="{{ route('situacao_membro.index') }}">Situações dos Membros</a></li>
                                    <li><a href="{{ route('tipo_solicitacao.index') }}">Tipos de Solicitação</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ri-store-2-line"></i>
                                    <span>Cadastros</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('usuario.index') }}">Usuários</a></li>
                                    <li><a href="{{ route('membro.index') }}">Membros</a></li>
                                    <li><a href="{{ route('membro_ficha.index') }}">Ficha de Atualização</a></li>
                                </ul>
                            </li>
                            {{--  <li>
                                <a href="{{route('tipo_solicitacao.index')}}" class="waves-effect">
                                    <i class="ri-file-user-line"></i>
                                    <span>Tipos de Solicitação</span>
                                </a>
                            </li>  --}}
                            <!-- Menus Relacioandos a administração - Acesso somente para GESTOR - FIM-->
                            @endif


                            @if($user->roles->contains('name', 'Lider'))
                            <!-- Menus Relacioandos as Lider - Acesso somente para LIDER - INICIO-->

                            <li class="menu-title">GESTÃO ORGANIZACIONAL</li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ri-store-2-line"></i>
                                    <span>Dashboard</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('indicador.index') }}">Indicadores</a></li>
                                    <li><a href="{{ route('agenda.index') }}">Agenda</a></li>
                                    <li><a href="{{ route('relatorio.index') }}">Filtro de Membros</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ri-store-2-line"></i>
                                    <span>Cadastros</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('membro.index') }}">Membros</a></li>
                                    <li><a href="{{ route('membro_ficha.index') }}">Ficha de Atualização</a></li>
                                </ul>
                            </li>
                            <!-- Menus Relacioandos as Lider - Acesso somente para LIDER - FIM-->
                            @endif

                        </ul>

                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
