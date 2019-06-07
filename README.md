##Trabalho prático de Linguagem de programação 4

Verifique os dados de conexão com o banco no arquivo conexao.php, altere, se necessário, servidor, usuário e senha.

Após validado essas informações, é necessário rodar os scripts na seguinte ordem:

- banco.sql (criação do banco e das tabelas)
- autor.sql (procedures de autor)
- editora.sql (procedures de autor)
- livros.sql (procedures de autor)
- usuarios.sql (procedures de autor)
- dump.sql (população de dados)

Sem usuário logado, apenas será feito a listagem de livros, editoras e autores.

O usuário "paulo" com a senha "123456" tem acesso administrativo e pode listar, incluir, alterar e excluir livros, editoras, autores e usuários.

Os usuários "alan", "thiago" e "maurici" com a senha "123456" não tem acesso administrativo e podem apenas listar e adicionar livros, editoras e autores. 

As senhas são guardadas após passarem por algorítmo de hash, utilizamos o SHA-1.

Utilizamos jquery, popper, bootstrap, fontawesome e datatables nesse trabalho para focarmos nas regras de negócio e aproveitarmos o que já havia pronto.

Alunos: 
- Alan Bernadino da Silva
- Maurici Ferreira Junior
- Thiago Giannaccini Leal