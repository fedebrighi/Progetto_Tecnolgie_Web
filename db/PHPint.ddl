-- *********************************************
-- * Standard SQL generation                   
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Fri Jan  3 17:44:02 2025 
-- * LUN file: C:\Users\matti\Desktop\Progetto_Tecnolgie_Web\db\PHPint.lun 
-- * Schema: ER-2PHPint/SQL 
-- ********************************************* 


-- Database Section
-- ________________ 

create database ER-2PHPint;


-- DBSpace Section
-- _______________


-- Tables Section
-- _____________ 

create table CARRELLO (
     codCarrello char(1) not null,
     totale char(1) not null,
     constraint ID_CARRELLO_ID primary key (codCarrello));

create table CLIENTE (
     username char(1) not null,
     codCarrello char(1) not null,
     password char(1) not null,
     email char(1) not null,
     nome char(1) not null,
     cognome char(1) not null,
     dataNascita char(1) not null,
     indirizzo char(1) not null,
     citta char(1) not null,
     cap char(1) not null,
     constraint ID_CLIENTE_ID primary key (username),
     constraint SID_CLIEN_CARRE_ID unique (codCarrello));

create table composizioneCarrello (
     codProdotto char(1) not null,
     codCarrello char(1) not null,
     quantita char(1) not null,
     constraint ID_composizioneCarrello_ID primary key (codCarrello, codProdotto));

create table composizioneOrdine (
     codProdotto char(1) not null,
     username char(1) not null,
     codiceOrdine char(1) not null,
     quantita char(1) not null,
     constraint ID_composizioneOrdine_ID primary key (codProdotto, username, codiceOrdine));

create table INFO_VENDITA (
     codInfo char(1) not null,
     quantitaVendute char(1) not null,
     spese char(1) not null,
     ricavo char(1) not null,
     constraint ID_INFO_VENDITA_ID primary key (codInfo));

create table ingredienti (
     codProdotto char(1) not null,
     ingredienti char(1) not null,
     constraint ID_ingredienti_ID primary key (codProdotto, ingredienti));

create table ORDINE (
     username char(1) not null,
     codiceOrdine char(1) not null,
     dataOrdine char(1) not null,
     dataSpedizione char(1) not null,
     dataArrivo char(1),
     totale char(1) not null,
     tipoPagamento char(1) not null,
     indirizzo char(1) not null,
     citta char(1) not null,
     cap char(1) not null,
     note char(1),
     tipo char(1) not null,
     constraint ID_ORDINE_ID primary key (username, codiceOrdine));

create table PRODOTTO (
     codProdotto char(1) not null,
     codInfo char(1) not null,
     nome char(1) not null,
     alc char(1) not null,
     descrizione char(1) not null,
     prezzo char(1) not null,
     quantitaMagazzino char(1) not null,
     immagine char(1) not null,
     constraint ID_PRODOTTO_ID primary key (codProdotto),
     constraint SID_PRODO_INFO__ID unique (codInfo));

create table inserimento (
     codProdotto char(1) not null,
     quantita char(1) not null,
     username char(1) not null,
     constraint ID_inser_PRODO_ID primary key (codProdotto));

create table RECENSIONE (
     codRecensione char(1) not null,
     valutazione char(1) not null,
     testo char(1) not null,
     codProdotto char(1) not null,
     username char(1) not null,
     constraint ID_RECENSIONE_ID primary key (codRecensione));

create table SPEDIZIONE (
     tipo char(1) not null,
     sovrapprezzo char(1) not null,
     constraint ID_SPEDIZIONE_ID primary key (tipo));

create table VENDITORE (
     username char(1) not null,
     password char(1) not null,
     email char(1) not null,
     telefono char(1) not null,
     indirizzo char(1) not null,
     citta char(1) not null,
     cap char(1) not null,
     constraint ID_VENDITORE_ID primary key (username));


-- Constraints Section
-- ___________________ 

alter table CARRELLO add constraint ID_CARRELLO_CHK
     check(exists(select * from CLIENTE
                  where CLIENTE.codCarrello = codCarrello)); 

alter table CLIENTE add constraint SID_CLIEN_CARRE_FK
     foreign key (codCarrello)
     references CARRELLO;

alter table composizioneCarrello add constraint REF_compo_CARRE
     foreign key (codCarrello)
     references CARRELLO;

alter table composizioneCarrello add constraint REF_compo_PRODO_1_FK
     foreign key (codProdotto)
     references PRODOTTO;

alter table composizioneOrdine add constraint EQU_compo_ORDIN_FK
     foreign key (username, codiceOrdine)
     references ORDINE;

alter table composizioneOrdine add constraint REF_compo_PRODO
     foreign key (codProdotto)
     references PRODOTTO;

alter table INFO_VENDITA add constraint ID_INFO_VENDITA_CHK
     check(exists(select * from PRODOTTO
                  where PRODOTTO.codInfo = codInfo)); 

alter table ingredienti add constraint FKPRO_ing
     foreign key (codProdotto)
     references PRODOTTO;

alter table ORDINE add constraint ID_ORDINE_CHK
     check(exists(select * from composizioneOrdine
                  where composizioneOrdine.username = username and composizioneOrdine.codiceOrdine = codiceOrdine)); 

alter table ORDINE add constraint REF_ORDIN_SPEDI_FK
     foreign key (tipo)
     references SPEDIZIONE;

alter table ORDINE add constraint REF_ORDIN_CLIEN
     foreign key (username)
     references CLIENTE;

alter table PRODOTTO add constraint ID_PRODOTTO_CHK
     check(exists(select * from ingredienti
                  where ingredienti.codProdotto = codProdotto)); 

alter table PRODOTTO add constraint ID_PRODOTTO_CHK
     check(exists(select * from inserimento
                  where inserimento.codProdotto = codProdotto)); 

alter table PRODOTTO add constraint SID_PRODO_INFO__FK
     foreign key (codInfo)
     references INFO_VENDITA;

alter table inserimento add constraint ID_inser_PRODO_FK
     foreign key (codProdotto)
     references PRODOTTO;

alter table inserimento add constraint REF_inser_VENDI_FK
     foreign key (username)
     references VENDITORE;

alter table RECENSIONE add constraint REF_RECEN_PRODO_FK
     foreign key (codProdotto)
     references PRODOTTO;

alter table RECENSIONE add constraint REF_RECEN_CLIEN_FK
     foreign key (username)
     references CLIENTE;


-- Index Section
-- _____________ 

create unique index ID_CARRELLO_IND
     on CARRELLO (codCarrello);

create unique index ID_CLIENTE_IND
     on CLIENTE (username);

create unique index SID_CLIEN_CARRE_IND
     on CLIENTE (codCarrello);

create unique index ID_composizioneCarrello_IND
     on composizioneCarrello (codCarrello, codProdotto);

create index REF_compo_PRODO_1_IND
     on composizioneCarrello (codProdotto);

create unique index ID_composizioneOrdine_IND
     on composizioneOrdine (codProdotto, username, codiceOrdine);

create index EQU_compo_ORDIN_IND
     on composizioneOrdine (username, codiceOrdine);

create unique index ID_INFO_VENDITA_IND
     on INFO_VENDITA (codInfo);

create unique index ID_ingredienti_IND
     on ingredienti (codProdotto, ingredienti);

create unique index ID_ORDINE_IND
     on ORDINE (username, codiceOrdine);

create index REF_ORDIN_SPEDI_IND
     on ORDINE (tipo);

create unique index ID_PRODOTTO_IND
     on PRODOTTO (codProdotto);

create unique index SID_PRODO_INFO__IND
     on PRODOTTO (codInfo);

create unique index ID_inser_PRODO_IND
     on inserimento (codProdotto);

create index REF_inser_VENDI_IND
     on inserimento (username);

create unique index ID_RECENSIONE_IND
     on RECENSIONE (codRecensione);

create index REF_RECEN_PRODO_IND
     on RECENSIONE (codProdotto);

create index REF_RECEN_CLIEN_IND
     on RECENSIONE (username);

create unique index ID_SPEDIZIONE_IND
     on SPEDIZIONE (tipo);

create unique index ID_VENDITORE_IND
     on VENDITORE (username);

