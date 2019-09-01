INSERT INTO permissao(nome) VALUES('Admin'),('Atendente'),('Cliente');

INSERT INTO usuario(nome,email,senha,id_permissao) VALUES('Admin','admin@gmail.com','81dc9bdb52d04dc20036dbd8313ed055',1);

INSERT INTO usuario(nome,email,senha,id_permissao) VALUES('Diego','didiego1903@gmail.com','81dc9bdb52d04dc20036dbd8313ed055',2);

INSERT INTO usuario(nome,email,telefone,senha,id_permissao) VALUES('Thiago','tiago123@gmail.com','41988830954','81dc9bdb52d04dc20036dbd8313ed055',3);

INSERT INTO relacionamentos(id_atendente,id_cliente) VALUES(2,3);

INSERT INTO mensagens(id_relacionamento,id_envia,id_recebe,conteudo) 
VALUES 
(1,3,2,'Helo'),
(1,2,3,'hey');
