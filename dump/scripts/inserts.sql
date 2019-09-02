INSERT INTO permissao(nome) VALUES('Admin'),('Atendente'),('Cliente');

INSERT INTO usuario(nome,email,senha,id_permissao) VALUES('Admin','admin@gmail.com','81dc9bdb52d04dc20036dbd8313ed055',1);

INSERT INTO usuario(nome,email,senha,id_permissao) VALUES('Atendente_1','atendente_1@gmail.com','81dc9bdb52d04dc20036dbd8313ed055',2);

INSERT INTO usuario(nome,email,senha,id_permissao) VALUES('Atendente_2','atendente_2@gmail.com','81dc9bdb52d04dc20036dbd8313ed055',2);

INSERT INTO usuario(nome,email,telefone,senha,id_permissao) VALUES('Cliente_1','cliente_1@gmail.com','41999999999','81dc9bdb52d04dc20036dbd8313ed055',3);

INSERT INTO usuario(nome,email,telefone,senha,id_permissao) VALUES('Cliente_2','cliente_2@gmail.com','41999999999','81dc9bdb52d04dc20036dbd8313ed055',3);

INSERT INTO relacionamentos(id_atendente,id_cliente) VALUES(2,5),(3,4);

INSERT INTO mensagens(id_relacionamento,id_envia,id_recebe,conteudo) 
VALUES 
(1,5,2,'Bom dia'),
(1,2,5,'Bom dia, em que posso ajudar?'),
(1,5,2,'Estou com uma duvida sobre um produto que comprei'),
(1,2,5,'Sr. poderia passar o numero de identificacao do produto?'),
(2,4,3,'Bom dia'),
(2,3,4,'Bom dia, em que posso ajudar?'),
(2,4,3,'Quanto tempo leva para a entrega de um produto?'),
(2,3,4,'Vai depender de sua localidade!'),
(2,3,4,'Poderia me passar seus dados para poder calcular para o senhor?');
