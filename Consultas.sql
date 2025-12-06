select *from aluno;
select *from turma;
select *from curso;

SELECT aluno.id_aluno, concat(nome_aluno," ",sobrenome_aluno) as "Nome Completo",
aluno.bi_aluno, aluno.email_aluno, aluno.numero_matricula_aluno, aluno.telefone,
aluno.bairro_regidencia, aluno.municipio_regidencia, aluno.status_aluno,
aluno.img,turma.turma, sala.numero_sala, curso.curso,turma.ano , concat(classe.classe,"º Classe") as classe, periodo.periodo
FROM gestao_escolar.aluno join turma on aluno.id_turma=turma.id_turma join sala on turma.id_sala=sala.id_sala join curso on curso.id_curso=turma.id_curso
 join classe on classe.id_classe=turma.id_classe join periodo on periodo.id_periodo=turma.id_turma;

select turma.turma, sala.numero_sala, curso.curso,turma.ano , concat(classe.classe,"º Classe") as classe, periodo.periodo
 from turma join sala on turma.id_sala=sala.id_sala join curso on curso.id_curso=turma.id_curso
 join classe on classe.id_classe=turma.id_classe join periodo on periodo.id_periodo=turma.id_turma;

select curso.id_curso, curso.curso, area_formacao.area_formacao, concat(curso.duracao," Anos") as duracao from curso join area_formacao on area_formacao.id_area_formacao=curso.id_area_formacao;


select autor,camiho_arquivo,titulo, editora from livro;