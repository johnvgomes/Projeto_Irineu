-- create database cadastro_funcionario;


-- criando FN3


-- criando tabela estado


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


create table funcionario(
	
	matricula int primary key not null,
	nome varchar(100),
	dataNasc date,
	nacionalidade varchar(100),
	sexo varchar(100),
	RG int,
	CPF int unique,
	dataAdmissao date,
	cdEndereco int,
	cdEstCivil int,
	

	foreign key (cdEndereco) references endereco(cd_endereco),
	foreign key (cdEstCivil) references estadoCivil(cd_estCivil)
);


-- criando a tabela telefone funcionario

create table telefoneFuncionario(
	
	cd_telefone int primary key,
	telefone int,
	cdFuncionario int,

	foreign key (cdFuncionario) references funcionario(matricula)
);


-- criando a tabela cargo
	
create table cargo(
	cd_cargo int primary key,
	nomeCargo varchar(100)

);

-- criando a tabela cargo funcionario


create table cargo_funcionario(

	dataInicio date,
	dataFim date,
	cdFuncionario int,
	cdCargo int,

	primary key (cdFuncionario,cdCargo),

	foreign key (cdFuncionario) references funcionario(matricula)
);


create table dependentes(

	cd_dependente int primary key,
	nomeDependente varchar(100),
	dataNasc date,
	cdFuncionario int,

	foreign key (cdFuncionario) references funcionario(matricula)
);



