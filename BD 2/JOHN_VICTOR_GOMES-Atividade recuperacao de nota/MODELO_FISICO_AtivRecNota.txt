-- create database empresa_empregado;


-- criando FN3

-- criando tabela estado


create table estado(
	
	cd_estado serial primary key NOT NULL,
	nomeEstado varchar(100) NOT NULL,
	siglaEstado varchar(2) NOT NULL

);


-- criando a tabela cidade

create table cidade(
	
	cd_cidade serial primary key NOT NULL,
	nome_cidade varchar(100) NOT NULL,
	cdEstado int NOT NULL,


	foreign key (cdEstado) references estado(cd_estado)
);




-- criando a tabela endereco

create table endereco(

	cd_endereco serial primary key NOT NULL,
	cep int NOT NULL,
	rua varchar(100) NOT NULL,
	numero int NOT NULL,
	bairro varchar(100) NOT NULL,
	cdCidade int NOT NULL,


	foreign key (cdCidade) references cidade(cd_cidade)
	
);
	



create table empregado(
	
	CPF int unique primary key NOT NULL,
	CPF_supervisor int NOT NULL,
	nome varchar(100) NOT NULL,
	data_nasc date NOT NULL,
	sexo varchar(100) NOT NULL,
	salario real NOT NULL,
	cdEndereco int NOT NULL,	

	foreign key (cdEndereco) references endereco(cd_endereco),

	foreign key (CPF_supervisor) references empregado(CPF)
);


-- criando a tabela telefone

create table telefone(
	
	cd_telefone int primary key NOT NULL,
	telefone int NOT NULL,
	CPFEmpregado int NOT NULL,

	foreign key (CPFEmpregado) references empregado(CPF)
);


-- criando a tabela ATIVIDADES

create table atividades(

	cd_atividade serial primary key NOT NULL,
	descricao varchar(100) NOT NULL
	
	);



-- criando a tabela PROJETOS

create table projetos(

	cd_projeto serial primary key NOT NULL,
	descricao varchar(100) NOT NULL,
	valor real NOT NULL
	
	);


-- criando a tabela empregado_atividade_projetos

-- (REALIZA)

create table empregado_atividade_projetos(
	
	CPFempregado int NOT NULL,
	cdAtividade int NOT NULL,
	cdProjeto int NOT NULL,
	
	primary key (CPFempregado,cdAtividade,cdProjeto),

	foreign key (CPFempregado) references empregado(CPF),
	
	foreign key (cdAtividade) references atividades(cd_atividade),

	foreign key (cdProjeto) references projetos(cd_projeto)


	);


-- criando a tabela empregado_tecnico


create table empregado_tecnico(
	
	ultima_serie varchar(100) NOT NULL,
	CPFempregado int primary key NOT NULL,


	foreign key (CPFempregado) references empregado(CPF)
);


-- criando a tabela empregado_SUPERIOR


create table empregado_superior(


	CPFempregado int primary key NOT NULL,


	foreign key (CPFempregado) references empregado(CPF)
);




-- criando a tabela TITULACAO


create table titulacao(

	cd_titulacao serial primary key NOT NULL,
	data_entrada date NOT NULL,
	

	foreign key (cd_titulacao) references empregado_superior(CPFempregado)
);

-- criando a tabela IES


create table IES(

	cd_IES serial primary key NOT NULL,
	nome_IES varchar(100) NOT NULL,
	sigla_IES varchar(2) NOT NULL
);




-- criando a tabela grau


create table tipograu(

	cd_tipograu serial primary key NOT NULL,
	nome varchar(100) NOT NULL
	
);


-- criando a tabela grau


create table grau(

	cd_grau serial primary key NOT NULL,
	cdTipoGrau int NOT NULL,

	foreign key (cdTipoGrau) references tipograu(cd_tipograu)

);



-- criando a tabela titulacao_IES_GRAU


create table titulacao_IES_grau(

	
	cdTitulacao int NOT NULL,
	cdIES int NOT NULL,
	cdGrau int NOT NULL,
	
	primary key (cdTitulacao,cdIES,cdGrau),

	foreign key (cdTitulacao) references titulacao(cd_titulacao),
	
	foreign key (cdIES) references IES(cd_IES),

	foreign key (cdGrau) references grau(cd_grau)


	);


-- criando a tabela departamento
	
create table departamento(
	cd_departamento serial primary key NOT NULL,
	nomedepartamento varchar(100) NOT NULL

);

-- criando a tabela departamento empregado

create table departamento_empregado(

	data_entrada date NOT NULL,
	CPFempregado int NOT NULL,
	cdDepartamento int NOT NULL,

	primary key (CPFempregado,cdDepartamento),

	foreign key (CPFempregado) references empregado(CPF),

	foreign key (cdDepartamento) references departamento(cd_departamento)


);


-- criando a tabela gratificacao
	
create table gratificacao(

	cd_gratificacao serial primary key NOT NULL,
	descricao varchar(100) NOT NULL,
	CPFempregado int NOT NULL,
	cdDepartamento int NOT NULL,

	foreign key (CPFempregado) references empregado(CPF),

	foreign key (cdDepartamento) references departamento(cd_departamento)


);





