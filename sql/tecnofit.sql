-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 08-Abr-2019 às 18:01
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tecnofit`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `detalhes_pedido`
--

DROP TABLE IF EXISTS `detalhes_pedido`;
CREATE TABLE IF NOT EXISTS `detalhes_pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  PRIMARY KEY (`id_pedido`,`id_produto`),
  KEY `detalhes_produto` (`id_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `detalhes_pedido`
--

INSERT INTO `detalhes_pedido` (`id_pedido`, `id_produto`) VALUES
(1, 2),
(3, 2),
(4, 2),
(3, 3),
(4, 3),
(8, 3),
(4, 4),
(5, 4),
(7, 5),
(8, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt_pedido` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(13,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`id`, `dt_pedido`, `total`) VALUES
(1, '2019-04-07 20:33:06', '1599.90'),
(3, '2019-04-08 13:01:18', '2732.60'),
(4, '2019-04-08 13:02:38', '3462.10'),
(5, '2019-04-08 13:05:33', '729.50'),
(7, '2019-04-08 14:19:01', '393.50'),
(8, '2019-04-08 14:47:07', '1526.20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(125) NOT NULL,
  `descricao` text,
  `preco` decimal(13,2) NOT NULL,
  `sku` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `descricao`, `preco`, `sku`) VALUES
(2, 'Ar Condicionado Philco 12000Btus PAC12000IFM8', 'O Ar Condicionado Philco 12000Btus PAC12000IFM8 Inverter Frio possui sistema de controle inverter, que mantém a temperatura ideal de forma constante e econômica!', '1599.90', 'PAC0IFM8'),
(3, 'Lustre Candelabro de Cristal ADN Maria Tereza', 'Buscando beleza e requinte para seu lar? Esse Lustre Maria Tereza de cristal é a resposta confeccionado em cristal k9 na cor transparente 8 braços ADN possui estilo clássico modelo candelabro , estrutura em vidro base em metal e cristais de alta qualidade , com um fino acabamento proporciona uma iluminação agradável com estilo e design. Lustre com um brilho incomparável, luxuoso e requintado com soquete E14 para lâmpadas velas, Indicado para o uso em Salas de jantar, hall social, hall de entrada, salão de festas, hotéis, restaurantes, museus, escritórios , igrejas e etc.', '1132.70', 'LCCADNMT'),
(4, 'Guarda Roupa Casal com Espelho 3 Portas de Correr Lotse Carioca Móveis Flex Color', 'Guarda Roupa com maior resistência, durabilidade e acabamento, revestimento interno e externo: Pintura em estufas modernas com UV (ultra violeta), são túneis que secam os produtos através de lâmpadas especiais que reproduzem artificialmente os raios ultravioletas do sol. Modelo com corrediça metálica em aço, 4 gavetas espaçosas, perfil em alumínio, roldanas de aço carbono com rolamento, divisão ele/ela. Guarda Roupa com portas flex, poderá ser montando na opção Malbec com Roveri ou todo Malbec.', '729.50', 'GRCFX001'),
(5, 'Forno Elétrico PFE46 Branco Capacidade Para 46 Litros Philco 127V', 'O Forno Elétrico PFE46B Philco possui multifunções. Assim você pode escolher a melhor maneira de preparar o seu alimento, aquecendo, ou então assando, talvez tostando, quem sabe gratinando ou grelhando, que maravilha, né?!Ele tem capacidade de até 46 litros, além de contar com 2 resistências, superior e inferior, com controle individual de temperatura, para melhor distribuir o calor.Também possui função timer de 90 minutos, com desligamento automático.E função dourar, que deixa o alimento mais dourado e crocante.Sua porta em vidro temperado é mais um diferencial, pois proporciona maior resistência ao calor e possibilita a visualização do alimento durante o preparo.Ainda acompanha grelha deslizante, com regulagem de altura, facilitando o manuseio e o acesso ao alimento.Cozinhar fica ainda mais prazeroso com o Forno Elétrico PFE46B Philco!', '393.50', 'FEPFE46V');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `detalhes_pedido`
--
ALTER TABLE `detalhes_pedido`
  ADD CONSTRAINT `detalhes_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id`),
  ADD CONSTRAINT `detalhes_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
