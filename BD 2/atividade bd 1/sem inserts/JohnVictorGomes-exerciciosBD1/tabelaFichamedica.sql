-- create databse fichaMedica;

-- criando FN3

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


create table medico(

	medico_CRM int primary key,
	nome varchar(100),
	dataNasc date,
	sexo varchar(100),
	RG int,
	cdEndereco int,
	cdEstCivil int,
	

	foreign key (cdEndereco) references endereco(cd_endereco),
	foreign key (cdEstCivil) references estadoCivil(cd_estCivil)

);


create table paciente(

	num_paciente int primary key,
	nome varchar(100),
	dataNasc date,
	sexo varchar(100),
	convenio varchar(100),
	RG int,
	cdEndereco int,
	cdEstCivil int,
	

	foreign key (cdEndereco) references endereco(cd_endereco),
	foreign key (cdEstCivil) references estadoCivil(cd_estCivil)

);


create table telefonePaciente(
	
	cd_telefone int primary key,
	telefone int,
	cdpaciente int,

	foreign key (cdpaciente) references paciente(num_paciente)
);

create table telefoneMedico(
	
	cd_telefone int primary key,
	telefone int,
	medicoCRM int unique not null,
	
	foreign key (medicoCRM) references medico(medico_CRM)

);

create table consultas(

	numero_consulta int primary key,
	data date,
	diagnostico varchar(100),
	medicoCRM int unique not null,
	cdpaciente int,
	

	foreign key (medicoCRM) references medico(medico_CRM),
	foreign key (cdpaciente) references paciente(num_paciente)



);


create table exames(

	cd_exame int primary key,
	exame varchar(100),
	data date,
	numeroConsulta int,

	foreign key (numeroConsulta) references consultas(numero_consulta)


);