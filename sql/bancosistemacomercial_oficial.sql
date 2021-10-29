create database bancosistemacomercial;

use bancosistemacomercial;

create table Estabelecimento(
	idEstabelecimento int not null auto_increment primary key,
    codigoEstabelecimento int not null unique,
    nomeEstabelecimento varchar(50) not null
);

create table usuario (
	idUsuario int not null auto_increment,
    idEstabelecimento int,
    nome varchar(200) not null,
    matricula int not null unique,
    cargo varchar(150) not null,
    senha varchar(50) not null,
    primary key(idUsuario),
    constraint foreign key (idEstabelecimento) references Estabelecimento(codigoEstabelecimento)
);

create table resultadoCobrador(
	idResultadoCobrador int not null auto_increment,
    matriculaCobrador int not null,
    dataResultado date not null,
    resultado varchar(10),
    meta varchar(10),
    primary key(idResultadoCobrador,matriculaCobrador),
    constraint fk_matricula_cobrador foreign key(matriculaCobrador) references usuario(matricula)
);

create table resultadoBilheteiro(
	idResultadoBilheteiro int not null auto_increment,
    matriculaBilheteiro int not null,
    dataResultado date not null,
    resultadoTarifa varchar(10),
    metaTarifa varchar(10),
    resultadoSeguro varchar(10),
    metaSeguro varchar(10),
    primary key(idResultadoBilheteiro, matriculaBilheteiro),
    constraint fk_matricula_bilheteiro foreign key(matriculaBilheteiro) references usuario(matricula)
);

create table historico (
	idHistorico int not null auto_increment,
	matriculaHistorico int not null,
    dataAcesso datetime not null,
    primary key (idHistorico, matriculaHistorico),
	constraint fk_matricula_historico foreign key(matriculaHistorico) references usuario(matricula)
);

-- Inserções de Estabelecimentos
insert into Estabelecimento (idEstabelecimento, codigoEstabelecimento, nomeEstabelecimento) values (default,100,'Salvador');
insert into Estabelecimento (idEstabelecimento, codigoEstabelecimento, nomeEstabelecimento) values (default,14,'Feira de Santana');
insert into Estabelecimento (idEstabelecimento, codigoEstabelecimento, nomeEstabelecimento) values (default,73,'Conceição de Jacuipe');

-- Inserção de usuários
insert into usuario (idUsuario,idEstabelecimento, nome, matricula, cargo, senha) values (default,100,'Marcelo Ribeiro Barbosa',4104,'Auxiliar de TI',md5(062589));
insert into usuario (idUsuario,idEstabelecimento, nome, matricula, cargo, senha) values (default,14,'João Mariano da Silva',3385,'Cobrador',md5(123456));
insert into usuario (idUsuario,idEstabelecimento, nome, matricula, cargo, senha) values (default,100,'Maria Joana de Almeida Santos',4056,'Bilheteiro',md5(123456));

-- Inserções Resultado Cobrador
insert into resultadoCobrador (idResultadoCobrador,dataResultado, matriculaCobrador,resultado, meta) values (default,'2020-02-01',3385,'1500','750');
insert into resultadoCobrador (idResultadoCobrador,dataResultado,matriculaCobrador,resultado, meta) values (default,'2020-02-02',3385,'2000','1250');

-- Inserções Resultado Bilheteiro
insert into resultadoBilheteiro (idResultadoBilheteiro,dataResultado,matriculaBilheteiro,resultadoTarifa, metaTarifa, resultadoSeguro, metaSeguro)
values (default,'2020-02-05',4056,'1550','850','150','55');
insert into resultadoBilheteiro (idResultadoBilheteiro,dataResultado,matriculaBilheteiro,resultadoTarifa, metaTarifa, resultadoSeguro, metaSeguro)
values (default,'2020-02-06',4056,'2130','1524','180','75');
insert into resultadoBilheteiro (idResultadoBilheteiro,dataResultado,matriculaBilheteiro,resultadoTarifa, metaTarifa, resultadoSeguro, metaSeguro)
values (default,'2020-02-07',4056,'1500','1550','150','200');
insert into resultadoBilheteiro (idResultadoBilheteiro,dataResultado,matriculaBilheteiro,resultadoTarifa, metaTarifa, resultadoSeguro, metaSeguro)
values (default,'2021-02-07',4056,'1800','1800','200','210');

-- Consulta de funcionários cadastrados em suas respectivos estabelecimentos
select u.nome as 'Nome', u.cargo as 'Cargo', u.matricula as 'Matrícula', e.nomeEstabelecimento as 'Estabelecimento' 
from usuario as u inner join Estabelecimento as e on u.idEstabelecimento = e.codigoEstabelecimento;

-- Consulta de resultado dos cobradores
select u.nome as 'Nome', u.cargo as 'Cargo', u.matricula as 'Matrícula', e.nomeEstabelecimento as 'Estabelecimento',
rc.dataResultado as 'Data', rc.resultado as 'Realizado', rc.meta as 'Meta', (rc.resultado - rc.meta) as 'Resultado', (((rc.resultado * 100)/rc.meta)-100) as '%' from usuario as u inner join Estabelecimento as e
inner join resultadoCobrador as rc on u.idEstabelecimento = e.codigoEstabelecimento and u.matricula = rc.matriculaCobrador;

-- Consulta de resultado das tarifas dos bilheteiros
select u.nome as 'Nome', u.cargo as 'Cargo', u.matricula as 'Matrícula', e.nomeEstabelecimento as 'Estabelecimento',
rb.dataResultado as 'Data', rb.resultadoTarifa as 'Realizado Tarifa', rb.metaTarifa as 'Meta Tarifa', (rb.resultadoTarifa - rb.metaTarifa)
as 'Resultado $', round((((rb.resultadoTarifa * 100)/rb.metaTarifa)-100),2) as '%'  from usuario as u inner join Estabelecimento as e inner join resultadoBilheteiro as rb on 
u.idEstabelecimento = e.codigoEstabelecimento and u.matricula = rb.matriculaBilheteiro;

-- Consulta de resultado dos bilheteiros
select u.nome as 'Nome', u.cargo as 'Cargo', u.matricula as 'Matrícula', e.nomeEstabelecimento as 'Estabelecimento',
rb.dataResultado as 'Data', rb.resultadoSeguro as 'Realizado Seguro', rb.metaSeguro as 'Meta Seguro', (rb.resultadoSeguro - rb.metaSeguro)
as 'Resultado $', (((rb.resultadoSeguro * 100)/rb.metaSeguro)-100) as '%' from usuario as u inner join Estabelecimento as e inner join resultadoBilheteiro as rb on 
u.idEstabelecimento = e.codigoEstabelecimento and u.matricula = rb.matriculaBilheteiro;

-- Consulta usuários
select * from usuario;

-- Consultar se a meta foi batida por aquele usuário - Bilheteiro - Tarifa
select count(*) as 'Contador' from resultadoBilheteiro as rb inner join usuario as u on rb.matriculaBilheteiro = u.matricula 
where rb.resultadoTarifa - rb.metaTarifa >= 0 and u.matricula = 4056;

-- Consultar se a meta foi batida por aquele usuário - Bilheteiro - Seguro
select count(*) from resultadoBilheteiro as rb inner join usuario as u on rb.matriculaBilheteiro = u.matricula 
where rb.resultadoSeguro - rb.metaSeguro >= 0 and u.matricula = 4056;

SELECT * FROM resultadoBilheteiro INNER JOIN usuario on resultadoBilheteiro.matriculaBilheteiro = usuario.matricula 
WHERE usuario.matricula = 4056 AND MONTH(dataResultado) = 2 AND YEAR(dataResultado) = 2020;

-- Consulta das pessoas que estão acessando o sistema
SELECT h.idHistorico as 'ID', u.nome as 'Nome', matriculaHistorico as 'Matrícula', h.dataAcesso as 'Data/Hora Acesso'  FROM historico as h
inner join usuario as u on h.matriculaHistorico = u.matricula;

