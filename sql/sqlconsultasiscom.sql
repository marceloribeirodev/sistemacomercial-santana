-- ambiente de consulta

use bancosistemacomercial;

SELECT count(*) as 'contadorPositivoTarifaBilheteiro' from resultadoBilheteiro as rb inner join usuario as u on rb.matriculaBilheteiro = u.matricula 
where rb.resultadoTarifa - rb.metaTarifa >= 0 and u.matricula = '4056' and MONTH(rb.dataResultado) = 02 AND YEAR(rb.dataResultado) = 2020;

SELECT u.nome as 'Nome', u.cargo as 'Cargo', u.matricula as 'Matrícula', e.nomeEstabelecimento as 'Estabelecimento',
rb.dataResultado as 'Data', rb.resultadoSeguro as 'Realizado Seguro', rb.metaSeguro as 'Meta Seguro', (rb.resultadoSeguro - rb.metaSeguro)
as 'Resultado $', round((((rb.resultadoSeguro * 100)/rb.metaSeguro)-100),2) as '%'  from usuario as u inner join Estabelecimento as e inner join resultadoBilheteiro as rb on 
u.idEstabelecimento = e.codigoEstabelecimento and u.matricula = rb.matriculaBilheteiro where u.matricula = '{$matricula}' and MONTH(rb.dataResultado) = '{$mes}' AND YEAR(rb.dataResultado) = '{$ano}';

desc resultadoBilheteiro;

SELECT count(*) as 'contadorPositivoTarifaBilheteiro' from resultadoBilheteiro as rb inner join usuario as u on rb.matriculaBilheteiro = u.matricula 
where rb.resultadoTarifa - rb.metaTarifa >= 0 and u.matricula = '{$matricula}' and MONTH(rb.dataResultado) = '{$mes}' AND YEAR(rb.dataResultado) = '{$ano}';


SELECT count(*) as 'contadorPositivoTarifaBilheteiro' from resultadoBilheteiro as rb inner join usuario as u on rb.matriculaBilheteiro = u.matricula 
where rb.resultadoTarifa - rb.metaTarifa >= 0 and u.matricula = '{$matricula}' and MONTH(rb.dataResultado) = '{$mes}' AND YEAR(rb.dataResultado) = '{$ano}';


SELECT count(*) as 'contadorNegativoTarifaBilheteiro' from resultadoBilheteiro as rb inner join usuario as u on rb.matriculaBilheteiro = u.matricula 
where rb.resultadoTarifa - rb.metaTarifa < 0 and u.matricula = '{$matricula}' and MONTH(rb.dataResultado) = '{$mes}' AND YEAR(rb.dataResultado) = '{$ano}';

SELECT rb.resultadoTarifa, rb.resultadoSeguro, rb.metaTarifa, rb.metaSeguro from resultadobilheteiro as rb;

update usuario set senha = md5(123) where matricula = 3385;

select * from usuario;

SELECT u.nome as 'Nome', u.cargo as 'Cargo', u.matricula as 'Matrícula', e.nomeEstabelecimento as 'Estabelecimento',
rc.dataResultado as 'Data', rc.resultado as 'Realizado', rc.meta as 'Meta', (rc.resultado- rc.meta)
as 'Resultado $', round((((rc.resultado * 100)/rc.meta)-100),2) as '%'  from usuario as u inner join Estabelecimento as e inner join resultadoCobrador as rc on 
u.idEstabelecimento = e.codigoEstabelecimento and u.matricula = rc.matriculaCobrador where u.matricula = '3385' and MONTH(rc.dataResultado) = 02 AND YEAR(rc.dataResultado) = 2020;

SELECT count(*) as 'contadorPositivoCobrador' from resultadoCobrador as rc inner join usuario as u on rc.matriculaCobrador= u.matricula 
where rc.resultado - rc.meta >= 0 and u.matricula = '3385' and MONTH(rc.dataResultado) = 02 AND YEAR(rc.dataResultado) = 2020;

SELECT count(*) as 'contadorNegativoCobrador' from resultadoCobrador as rc inner join usuario as u on rc.matriculaCobrador = u.matricula 
where rc.resultado - rc.meta < 0 and u.matricula = '3385' and MONTH(rc.dataResultado) = '02' AND YEAR(rc.dataResultado) = '2020';

select cargo from usuario where matricula = 3385;

SELECT * FROM resultadoCobrador INNER JOIN usuario on resultadoCobrador.matriculaCobrador = usuario.matricula
 WHERE usuario.matricula = '{$matricula}' AND MONTH(dataResultado) = '{$mes}' AND YEAR(dataResultado) = '{$ano}';





SELECT u.nome as 'Nome', u.cargo as 'Cargo', u.matricula as 'Matrícula', e.nomeEstabelecimento as 'Estabelecimento',
  rb.dataResultado as 'Data', rb.resultadoTarifa as 'Resultado', rb.resultadoSeguro as 'resultadoSeguro', rb.metaTarifa as 'Meta', rb.metaSeguro as 'metaSeguro' from usuario as u inner join Estabelecimento as e inner join resultadoBilheteiro as rb on 
  u.idEstabelecimento = e.codigoEstabelecimento and u.matricula = rb.matriculaBilheteiro where u.matricula = '4056' and MONTH(rb.dataResultado) = '02' AND YEAR(rb.dataResultado) = '2020';

SELECT u.nome as 'Nome', u.cargo as 'Cargo', u.matricula as 'Matrícula', e.nomeEstabelecimento as 'Estabelecimento',
  rc.dataResultado as 'Data', rc.resultado as 'Resultado', rc.meta as 'Meta'from usuario as u inner join Estabelecimento as e inner join resultadoCobrador as rc on 
  u.idEstabelecimento = e.codigoEstabelecimento and u.matricula = rc.matriculaCobrador where u.matricula = '3385' and MONTH(rc.dataResultado) = '02' AND YEAR(rc.dataResultado) = '2020';
  