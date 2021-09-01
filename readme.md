# Operações CODE8734

Aplicativo utilizado para realizar as operações básicas em unidade CODE8734. Por esta aplicação, a franqueadora pode realizar a implantação de uma unidade com o simples preenchimento de um ou mais formulários direto do sistema CAF (Central de Atendimento a Franquia). 

## Funcionalidades 

### Cadastrar franqueados:
O processo de implantação de uma unidade acontece uma vez que o setor jurídico da CODE8734 defere a legalidade da documentação necessária. Assim, o Analista de Implantação deverá acessar o painel de implantação em `local/opsbasics/dashboard.php` e selecionar a opção <button class="btn btn-purple">Novo franquado</button>. Em seguida, deve preencher:

- Nome completo do franqueado;
- E-mail pessoal ou institucional;
- Telefone de contato;

### Cadastrar unidade:
Após preencher as informações de um ou mais franqueados, o analista deve preencher as informações da nova unidade. Para isso, ainda em `local/opsbasics/dashboard.php`, deve selecionar a opção <button class="btn btn-purple">Nova unidade</button>, e informar:

- Nome da unidade, fornecida pelo setor jurídico da CODE8734;
- Franqueado(s) CODE8734; <span style="color: #888"> -- a partir da lista de franqueados</span>
- Nome de e-mail da unidade <span style="color: #888"> -- (nomedaunidade) nos e-mails CODE8734</span>;
- Data limite de implantação;
- Cursos disponíveis;

### Iniciar implantação:
Com os dados iniciais preenchidos, o analista enfim deve selecionar a opção <button class="btn btn-purple">Iniciar implantação</button> para que o plugin realize as seguintes tarefas:

- Gerar os campos na tabela `caf_opsbasics_clients`:
    - `client_mail` (E-mail do franqueado);

- Gerar os campos na tabela `caf_opsbasics_unities`:
    - `unity_email` (E-mail da unidade);
    - `com_email` (E-mail comercial);
    - `ped_email` (E-mail pedagógico);
    - `unity_code` (Código da unidade);

- Criar uma entrada na tabela `caf_opsbasics_client_has_unity` para cada franqueado da unidade;

- Usar o Webservice do Moodle para gerar os coortes `[course_shortname]`_`[unity_code]` (coorte de cada curso no AVA) e `_[unity_code]` (coorte da unidade);

- Criar um usuário no CAF, contendo:
    - Login: padrão CODE8734
    - Senha temporária: 123456-Cc
    - 

## Tabelas

**Tabela `caf_opsbasics_clients`**:

| Campo           | Tipo    |          |
|-----------------|---------|----------|
| id              | INT(10) | PRIMARY KEY AUTO_INCREMENT |
| full_name       | VARCHAR | NOT NULL |
| personal_email  | VARCHAR | NOT NULL |
| phone_number    | VARCHAR | NOT NULL |
| create_timestamp|TIMESTAMP| DEFAULT TIMESTAMP |
| client_mail     | VARCHAR |          |

**Tabela `caf_opsbasics_unities`**:

| Campo               | Tipo    |          |
|---------------------|---------|----------|
| id                  | INT(10) | PRIMARY KEY AUTO_INCREMENT |
| name                | VARCHAR | NOT NULL |
| unity_code          | VARCHAR | NOT NULL |
| address             | VARCHAR | NOT NULL |
| city                | VARCHAR | NOT NULL |
| state               | VARCHAR | NOT NULL |
| size                | VARCHAR | NOT NULL |
| mail_pattern        | VARCHAR | NOT NULL |
| est_ops_date        | DATE    | NOT NULL |
| real_ops_date       | DATE    |          |
| create_timestamp    |TIMESTAMP| DEFAULT TIMESTAMP |
| com_email           | VARCHAR |          |
| ped_email           | VARCHAR |          |
| unity_email         | VARCHAR |          |
| sap_login_unity     | VARCHAR |          |
| sap_login_com       | VARCHAR |          |
| sap_login_ped       | VARCHAR |          |
| sap_pswd_unity      | VARCHAR |          |
| sap_pswd_com        | VARCHAR |          |
| sap_pswd_ped        | VARCHAR |          |

**Tabela `caf_opsbasics_client_has_unity`**:

| Campo     | Tipo    |             |
|-----------|---------|-------------|
| client_id | INTEGER | FOREIGN KEY |
| unity_id  | INTEGER | FOREIGN KEY |