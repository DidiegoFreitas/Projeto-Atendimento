INSERT INTO permissao(nome) VALUES('Admin'),('Atendente'),('Cliente');

INSERT INTO usuario(id,nome,email,senha,id_permissao) VALUES(1,'Admin','admin@gmail.com','9999',1);

INSERT INTO usuario(id,nome,email,senha,id_permissao) VALUES(2,'Diego','didiego1903@gmail.com','1234',2);

INSERT INTO usuario(id,nome,email,telefone,senha,id_permissao) VALUES(3,'Thiago','tiago123@gmail.com','41988830954','0000',3);

INSERT INTO relacionamentos(id_atendente,id_cliente) VALUES(2,3);

INSERT INTO mensagens(id_relacionamento,id_envia,id_recebe,conteudo) 
VALUES 
(1,3,2,'Helo'),
(1,2,3,'hey');
