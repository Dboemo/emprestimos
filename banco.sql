-- Banco de dados: `bdemprestimo`

create table emprestimos_log (  
      log_id int auto_increment primary key,  
	  old_id_usuario int,
	  old_id_equipamento int,
      old_data_emprestimo date,
	  new_id_usuario int, 
	  new_id_equipamento int, 
      new_data_emprestimo date,  
      operacao varchar(50),  
      usuario varchar(50),
	  equipamento varchar(50),
	  setor varchar(50),
	  hora timestamp  
 );
CREATE TABLE `emprestimos` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `equipamento` int(11) NOT NULL,
  `data` datetime NOT NULL
);


CREATE TABLE `equipamentos` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `setor` varchar(50) NOT NULL
);

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL
);


ALTER TABLE `emprestimos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipo` (`equipamento`),
  ADD KEY `usuario` (`usuario`);

ALTER TABLE `equipamentos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `emprestimos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `equipamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `emprestimos`
  ADD CONSTRAINT `equipo` FOREIGN KEY (`equipamento`) REFERENCES `equipamentos` (`id`),
  ADD CONSTRAINT `usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`);



