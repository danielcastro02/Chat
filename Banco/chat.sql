create database chat;
use chat;

create table usuario(
    id_usuario integer primary key auto_increment,
    nome varchar(100),
    senha varchar(200),
    telefone varchar(11),
    foto varchar(500)
);

create table chat(
id_chat integer primary key auto_increment,
id_remetente integer not null,
id_destinatario integer not null,
is_media integer default 0,
caminho_media varchar(300),
mensagem varchar(1500),
data_envio datetime default now(),
visualizado int(1) default 0,
foreign key (id_remetente) references usuario(id_usuario),
foreign key (id_destinatario) references usuario(id_usuario)
);