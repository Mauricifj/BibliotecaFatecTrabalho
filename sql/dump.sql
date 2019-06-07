-- RESET DAS TABELAS --

DELETE FROM LIVRO_AUTOR WHERE TRUE;
DELETE FROM LIVRO WHERE TRUE;
DELETE FROM AUTOR WHERE TRUE;
DELETE FROM EDITORA WHERE TRUE;

-- GAME OF THRONES --

CALL adicionarEditora('Bantam Spectra');

CALL adicionarAutor('George R. R. Martin');

CALL adicionarLivroComEditora('A Guerra dos Tronos', (SELECT ID FROM EDITORA WHERE NOME = 'Bantam Spectra'), '1996-08-06');

CALL adicionarAutorEmLivro((SELECT ID FROM LIVRO WHERE TITULO = 'A Guerra dos Tronos'), (SELECT ID FROM AUTOR WHERE NOME = 'George R. R. Martin'));

-- GAME OF THRONES --

CALL adicionarLivroComEditora('A Fúria dos Reis', (SELECT ID FROM EDITORA WHERE NOME = 'Bantam Spectra'), '1998-11-16');

CALL adicionarAutorEmLivro((SELECT ID FROM LIVRO WHERE TITULO = 'A Fúria dos Reis'), (SELECT ID FROM AUTOR WHERE NOME = 'George R. R. Martin'));

-- GAME OF THRONES --

CALL adicionarLivroComEditora('A Tormenta de Espadas', (SELECT ID FROM EDITORA WHERE NOME = 'Bantam Spectra'), '2000-08-08');

CALL adicionarAutorEmLivro((SELECT ID FROM LIVRO WHERE TITULO = 'A Tormenta de Espadas'), (SELECT ID FROM AUTOR WHERE NOME = 'George R. R. Martin'));

-- GAME OF THRONES --

CALL adicionarLivroComEditora('O Festim dos Corvos', (SELECT ID FROM EDITORA WHERE NOME = 'Bantam Spectra'), '2011-07-12');

CALL adicionarAutorEmLivro((SELECT ID FROM LIVRO WHERE TITULO = 'O Festim dos Corvos'), (SELECT ID FROM AUTOR WHERE NOME = 'George R. R. Martin'));

-- GAME OF THRONES --

CALL adicionarLivroComEditora('A Dança dos Dragões', (SELECT ID FROM EDITORA WHERE NOME = 'Bantam Spectra'), '2005-10-17');

CALL adicionarAutorEmLivro((SELECT ID FROM LIVRO WHERE TITULO = 'A Dança dos Dragões'), (SELECT ID FROM AUTOR WHERE NOME = 'George R. R. Martin'));


-- LORD OF THE RINGS --

CALL adicionarEditora('Allen & Unwin');

CALL adicionarAutor('J. R. R. Tolkien');

CALL adicionarLivroComEditora('A Sociedade do Anel', (SELECT ID FROM EDITORA WHERE NOME = 'Allen & Unwin'), '1996-08-06');

CALL adicionarAutorEmLivro((SELECT ID FROM LIVRO WHERE TITULO = 'A Sociedade do Anel'), (SELECT ID FROM AUTOR WHERE NOME = 'J. R. R. Tolkien'));

-- LORD OF THE RINGS --

CALL adicionarLivroComEditora('As Duas Torres', (SELECT ID FROM EDITORA WHERE NOME = 'Allen & Unwin'), '1954-07-29');

CALL adicionarAutorEmLivro((SELECT ID FROM LIVRO WHERE TITULO = 'As Duas Torres'), (SELECT ID FROM AUTOR WHERE NOME = 'J. R. R. Tolkien'));

-- LORD OF THE RINGS --

CALL adicionarLivroComEditora('O Retorno do Rei', (SELECT ID FROM EDITORA WHERE NOME = 'Allen & Unwin'), '1954-07-29');

CALL adicionarAutorEmLivro((SELECT ID FROM LIVRO WHERE TITULO = 'O Retorno do Rei'), (SELECT ID FROM AUTOR WHERE NOME = 'J. R. R. Tolkien'));

-- ADMIN --
-- sha1('123456') -> 7c4a8d09ca3762af61e59520943dc26494f8941b --
CALL adicionarUsuario('Paulo Cândido', 'paulo', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'ADMIN');

-- USUARIOS --
CALL adicionarUsuario('Alan Bernardino da Silva', 'alan', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'USUARIO');
CALL adicionarUsuario('Maurici Ferreira Junior', 'maurici', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'USUARIO');
CALL adicionarUsuario('Thiago Giannaccini Leal', 'thiago', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'USUARIO');

