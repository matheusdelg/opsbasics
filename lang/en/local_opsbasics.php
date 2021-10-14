<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Provides meta-data about the plugin.
 *
 * @package     local_opsbasics
 * @author      2021 Matheus Delgado <https://github.com/matheusdelg>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['plugintitle'] = 'Operações CODE8734';
$string['pluginname'] = '⚙️ Operações CODE8734';
$string['plugindescription'] = 'Crie, implante e gerencie todas as unidades CODE8734 com apenas um clique. Selecione uma das opções abaixo para iniciar uma operação.';

$string['clientediturl'] = '/local/opsbasics/client/edit.php';
$string['clientviewurl'] = '/local/opsbasics/client/view.php';
$string['unityediturl'] = '/local/opsbasics/unity/edit.php';
$string['unityviewurl'] = '/local/opsbasics/unity/view.php';
$string['dashboardurl'] = '/local/opsbasics/index.php';
$string['startimplurl'] = '/local/opsbasics/implantation.php';

$string['pluginactions'] = "Ações";
$string['dashboardheading'] = 'Operações CODE8734';

$string['newclient'] = 'Novo franqueado';
$string['newclient_description'] = 'Toda unidade CODE8734 precisa de um franqueado. Preencha aqui as informações de um (ou mais) novo(s) franqueado(s) CODE8734.';
$string['clientfullname'] = 'Nome completo';
$string['clientpersonalemail'] = 'E-mail de contato (pessoal ou institucional)';
$string['clientphonenumber'] = 'Telefone';
$string['clientmail'] = 'E-mail CODE8734 do franqueado';
$string['clientcreatetimestamp'] = 'Data/hora de criação/edição';
$string['clientaddedsuccess'] = 'Cliente adicionado/editado com sucesso na base de dados.';
$string['clientinfo'] = 'Dados do franqueado';

$string['newunity'] = 'Nova unidade';
$string['newunity_description'] = 'Escolha esta opção para preencher os dados da mais nova unidade CODE8734. É necessário ter em mãos as informações do e-mail de liberação de nova unidade.';
$string['unitybasicinfo'] = 'Informações básicas';
$string['unityfullname'] = 'Nome da unidade';
$string['unitycode'] = 'Código da unidade';
$string['unityaddress'] = 'Endereço';
$string['unitycity'] = 'Cidade';
$string['unitystate'] = 'Estado (UF)';
$string['unitysize'] = 'Tamanho/Modalidade';
$string['mailpattern'] = 'Nome de e-mail da unidade';
$string['unitydateinfo'] = 'Datas';
$string['unitymailinfo'] = 'Contas de e-mail';
$string['unitysapinfo'] = 'Gama SAP';
$string['unityestopsdate'] = 'Data estimada para o início da operação';
$string['unityrealopsdate'] = 'Data real do início da operação';
$string['unitycreatetimestamp'] = 'Data/hora de criação/edição';
$string['unitycomemail'] = 'E-mail comercial da unidade';
$string['unitypedemail'] = 'E-mail pedagógico da unidade';
$string['unityemail'] = 'E-mail geral da unidade';
$string['unitysaplogin'] = 'Login SAP da unidade';
$string['unitysaplogincom'] = 'Login SAP comercial';
$string['unitysaploginped'] = 'Login SAP pedagógico';
$string['unitysappswd'] = 'Senha SAP da unidade';
$string['unitysappswdcom'] = 'Senha SAP comercial';
$string['unitysappswdped'] = 'Senha SAP pedagógico';
$string['unityaddedsuccess'] = 'Unidade adicionada/editada com sucesso na base de dados.';
$string['unitysizes'] = ['Intinerante', 'Compacta', 'Mini', 'Mega'];

$string['implantationinfo'] = 'Associar dados';
$string['selectunity'] = 'Selecione a unidade CODE8734';
$string['selectclient'] = 'Selecione o franqueado';

$string['implantationheading'] = 'Implantação de unidade';
$string['startimp'] = 'Iniciar implantação';
$string['startimp_description'] = 'Mãos a obra! Escolha esta opção para iniciar os processos de liberação da nova unidade CODE8734. É preciso registrar o(s) franqueado(s) e a unidade em outras opções desta aplicaçao.';
$string['implantationsuccess'] = 'Implantação de unidade terminada com êxito.';

$string['clientheading'] = 'Franqueados CODE8734';
$string['client_description'] = 'Crie ou edite as informações de um franqueado CODE8734 neste formulário.';
$string['noclientselected'] = 'Nenhum cliente selecionado. Selecione um franqueado na pagina de Dashboard e clique na opção "novo cliente".';

$string['unityheading'] = 'Unidades CODE8734';
$string['unity_description'] = 'Crie ou edite as informações de uma unidade CODE8734 neste formulário.';
$string['nounityselected'] = 'Nenhuma unidade selecionada. Selecione uma unidade na pagina de Dashboard e clique na opção "nova unidade".';

$string['errornounityid'] = 'Unidade não selecionada ou inválida';
$string['errornoclientid'] = 'Franqueado não selecionado ou inválido';
$string['errornocapability'] = 'Você não tem permissão para acessar esta página';

$string['tooltipview'] = 'Ver detalhes';
$string['tooltipedit'] = 'Editar';
$string['tooltiponboarding'] = 'Onboarding';
$string['tooltipdelete'] = 'Excluir';
$string['formrequired'] = 'Este campo é obrigatório.';
$string['select'] = 'Selecione';
$string['selecttrainings'] = 'Inscrever nos treinamentos';

$string['configheader'] = 'Tokens da API (webservices)';
$string['caftoken'] = 'Token do Webservice do CAF';
$string['desccaftoken'] = 'Token para realizar a chamada do webservice deste site. O Token pode ser obtido após a configuração do webservice neste site.';
$string['cafdomain'] = 'URL do CAF';
$string['desccafdomain'] = 'URL no formato "https://subdominio.dominio.com" do CAF (este site)';
$string['defaultcafdomain'] = $CFG->httpswwwroot;
$string['avatoken'] = 'Token do Webservice do AVA';
$string['descavatoken'] = 'Token para realizar a chamada do webservice do AVA. O Token pode ser obtido após a configuração do webservice no AVA.';
$string['avadomain'] = 'URL do AVA';
$string['descavadomain'] = 'URL no formato "https://subdominio.dominio.com" do AVA';
$string['defaultavadomain'] = 'https://ava.code8734.com.br';
$string['stdpswd'] = 'Senha padrão';
$string['descstdpswd'] = 'Senha inicial de usuários do AVA/CAF';