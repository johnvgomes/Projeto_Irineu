-- create database cadProjetos;

-- crinado FN3


-- criando a tabela estado


create table estado(
	
	cd_estado int primary key,
	nomeEstado varchar(100),
	siglaEstado varchar(2)

);




-- criando a tabela cidade

create table cidade(
	
	cd_cidade int primary key,
	nomeCidade varchar(100),
	cdEstado int,


	foreign key (cdEstado) references estado(cd_estado)
);


-- criando a tabela endereco

create table endereco(

	cd_endereco int primary key,
	cep int,
	rua varchar(100),
	numero int,
	bairro varchar(100),
	cdCidade int,


	foreign key (cdCidade) references cidade(cd_cidade)
	
);
	

-- criando a tabela estado civil


create table estadoCivil(
	cd_estCivil int primary key,
	estado_civil varchar(100)
);


create table gerente(

	cd_gerente int primary key,
	nome varchar(100),
	dataNasc date,
	sexo varchar(100),
	RG int,
	cdEndereco int,
	cdEstCivil int,
	

	foreign key (cdEndereco) references endereco(cd_endereco),
	foreign key (cdEstCivil) references estadoCivil(cd_estCivil)

);


create table departamento(
	cd_departamento int primary key,	
	nome varchar(100)

);



create table projetos(
	
	cd_projeto int primary key,
	nome varchar(100),
	data_inicio date,
	data_fim date,
	cdDepartamento int,
	cdGerente int,
	

	foreign key(cdDepartamento) references departamento(cd_departamento),
	foreign key(cdGerente) references gerente(cd_gerente)

);

create table empregados(

	cd_empregado int primary key,
	nome varchar(100),
	dataNasc date,
	sexo varchar(100),
	RG int,
	cdEndereco int,
	cdEstCivil int,



	foreign key (cdEndereco) references endereco(cd_endereco),
	foreign key (cdEstCivil) references estadoCivil(cd_estCivil)
	
);

create table empregadoHorasTrab(

	num_horasTrab real,
	cdProjeto int,
	cdEmpregado int,

	primary key(cdProjeto,cdEmpregado),

	foreign key(cdEmpregado) references empregados(cd_empregado),
	foreign key(cdProjeto) references projetos(cd_projeto)


);

