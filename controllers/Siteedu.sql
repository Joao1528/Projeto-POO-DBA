create schema Siteedu;
use Siteedu;

CREATE TABLE IF NOT EXISTS aluno (
  id int(11) NOT NULL,
  nome varchar(45) NOT NULL,
  senha int(11) NOT NULL,
  email varchar(65) NOT NULL,
  PRIMARY KEY (id)
)DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS professor (
  id int(11) ,
  nome varchar(45),
  senha int(11) ,
  email varchar(145) ,
  PRIMARY KEY (id)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS materia (
  codigo int(11),
  nome varchar(45),
  id_professor int(11),
  PRIMARY KEY (codigo),
  foreign key (id_professor) references professor(id)
)DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS presença (
  id_aluno int(11),
  codigo_materia int(11),
  frequencia int(11),
  PRIMARY KEY (id_aluno,codigo_materia),
  FOREIGN KEY  (id_aluno) references aluno(id),
  FOREIGN KEY  (codigo_materia) references materia(codigo)
)DEFAULT CHARSET=utf8;

DELIMITER $
CREATE TRIGGER tr_inicio after insert
ON aluno
FOR EACH ROW
BEGIN
	update presença set frequencia=0 where id_aluno=new.id;
END $
DELIMITER ;

DELIMITER $
CREATE TRIGGER tr_fim before delete
ON aluno
FOR EACH ROW
BEGIN
	delete from presença where id_aluno=old.id;
END $
DELIMITER ;

create user 'aluno'@'127.0.0.1' identified by 'aluno';
grant select on Siteedu.aluno to 'aluno'@'127.0.0.1';
grant select on Siteedu.presença to 'aluno'@'127.0.0.1';

show grants for 'aluno'@'127.0.0.1';


create user 'professor'@'127.0.0.1' identified by 'professor';
grant select, delete, insert, update on Siteedu.materia to 'professor'@'127.0.0.1';
grant select, insert on Siteedu.professor to 'professor'@'127.0.0.1';

insert into aluno(id, nome, senha, email) values( 1, 'gabri', 123, 'teste@testa');
insert into aluno(id, nome, senha, email) values( 12, 'gab', 13, 'teste@tes.com');

 select*from aluno;
 
insert into professor(id, nome, senha, email) values( 5, 'roger', 321, 'teste@teste');
insert into professor(nome, senha, email) values('roh', 5556, 'teste@teste');

 select*from professor;

insert into materia(codigo, nome) values(4443, 'matematica');
insert into materia(codigo, nome, id_professor) values(4403, 'fisica', 5);
insert into materia(codigo, nome, id_professor) values(9, 'you', 8);

 
 select*from materia;

insert into presença(id_aluno, codigo_materia) values(1, 4403);
insert into presença(id_aluno, codigo_materia, frequencia) values(1, 4443, 4);

 select*from presença;
delete from aluno where id=1;






















