
-- create database ordemDeCompra;


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



create table fornecedor(


	cd_fornecedor int primary key,
	nome varchar(100),
	dataNasc date,
	sexo varchar(100),
	RG int,
	cdEndereco int,
	cdEstCivil int,
	

	foreign key (cdEndereco) references endereco(cd_endereco),
	foreign key (cdEstCivil) references estadoCivil(cd_estCivil)



);

create table compra(

	cd_ordemCompra int primary key,
	dataEmissao date,
	cdFornecedor int,
	


	foreign key (cdFornecedor) references fornecedor(cd_fornecedor)

);

create table materiais(

	cd_material int primary key,
	descricao varchar(100),
	qtd int,
	valorUnit real,
	cdOrdemCompra int,
	
	foreign key (cdOrdemCompra) references compra(cd_ordemCompra)

	

);