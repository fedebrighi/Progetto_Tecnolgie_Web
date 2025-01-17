-- *********************************************
-- * Standard SQL generation
-- *********************************************
-- * DB-MAIN version: 11.0.2
-- *********************************************
-- * Generation date: Fri Jan  3 17:44:02 2025
-- *********************************************
-- Database Section
-- ________________
CREATE DATABASE IF NOT EXISTS ER_2PHPint;
USE ER_2PHPint;

-- Tables Section
-- _______________
CREATE TABLE CARRELLO (
    codCarrello INT NOT NULL,
    totale DECIMAL(10, 2) NOT NULL,
    CONSTRAINT ID_CARRELLO_ID PRIMARY KEY (codCarrello)
);

CREATE TABLE CLIENTE (
    username VARCHAR(50) NOT NULL,
    codCarrello INT NOT NULL,
    pw VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    dataNascita DATE NOT NULL,
    indirizzo VARCHAR(255) NOT NULL,
    citta VARCHAR(50) NOT NULL,
    cap INT NOT NULL,
    telefono BIGINT NOT NULL,
    CONSTRAINT ID_CLIENTE_ID PRIMARY KEY (username),
    CONSTRAINT SID_CLIEN_CARRE_ID UNIQUE (codCarrello)
);

CREATE TABLE composizioneCarrello (
    codProdotto INT NOT NULL,
    codCarrello INT NOT NULL,
    quantita INT NOT NULL,
    CONSTRAINT ID_composizioneCarrello_ID PRIMARY KEY (codCarrello, codProdotto)
);

CREATE TABLE composizioneOrdine (
    codProdotto INT NOT NULL,
    username VARCHAR(50) NOT NULL,
    codiceOrdine INT NOT NULL,
    quantita INT NOT NULL,
    CONSTRAINT ID_composizioneOrdine_ID PRIMARY KEY (codProdotto, username, codiceOrdine)
);

CREATE TABLE INFO_VENDITA (
    codInfo INT NOT NULL,
    quantitaVendute INT NOT NULL,
    spesaUnitaria DECIMAL(10, 2) NOT NULL,
    ricavo DECIMAL(10, 2) NOT NULL,
    CONSTRAINT ID_INFO_VENDITA_ID PRIMARY KEY (codInfo)
);


CREATE TABLE ORDINE (
    username VARCHAR(50) NOT NULL,
    codiceOrdine INT NOT NULL,
    dataOrdine DATE NOT NULL,
    dataSpedizione DATE NOT NULL,
    dataArrivo DATE,
    totale DECIMAL(10, 2) NOT NULL,
    tipoPagamento VARCHAR(50) NOT NULL,
    indirizzo VARCHAR(255) NOT NULL,
    citta VARCHAR(50) NOT NULL,
    cap CHAR(5) NOT NULL,
    note TEXT,
    tipo VARCHAR(50) NOT NULL,
    CONSTRAINT ID_ORDINE_ID PRIMARY KEY (username, codiceOrdine)
);

CREATE TABLE PRODOTTO (
    codProdotto INT NOT NULL,
    codInfo INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    alc DECIMAL(5, 2),
    descrizione TEXT,
    listaIngredienti TEXT,
    prezzo DECIMAL(10, 2) NOT NULL,
    quantitaMagazzino INT NOT NULL,
    immagine VARCHAR(255),
    glutenFree BOOLEAN NOT NULL DEFAULT FALSE,
    CONSTRAINT ID_PRODOTTO_ID PRIMARY KEY (codProdotto),
    CONSTRAINT SID_PRODO_INFO__ID UNIQUE (codInfo)
);

CREATE TABLE inserimento (
    codProdotto INT NOT NULL,
    quantita INT NOT NULL,
    username VARCHAR(50) NOT NULL,
    CONSTRAINT ID_inser_PRODO_ID PRIMARY KEY (codProdotto)
);

CREATE TABLE RECENSIONE (
    codRecensione INT NOT NULL,
    valutazione INT NOT NULL CHECK (valutazione BETWEEN 1 AND 5),
    testo TEXT,
    codProdotto INT NOT NULL,
    username VARCHAR(50) NOT NULL,
    CONSTRAINT ID_RECENSIONE_ID PRIMARY KEY (codRecensione)
);

CREATE TABLE SPEDIZIONE (
    tipo VARCHAR(50) NOT NULL,
    sovrapprezzo DECIMAL(10, 2) NOT NULL,
    CONSTRAINT ID_SPEDIZIONE_ID PRIMARY KEY (tipo)
);

CREATE TABLE VENDITORE (
    username VARCHAR(50) NOT NULL,
    pw VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefono VARCHAR(15),
    indirizzo VARCHAR(255) NOT NULL,
    citta VARCHAR(50) NOT NULL,
    cap CHAR(5) NOT NULL,
    CONSTRAINT ID_VENDITORE_ID PRIMARY KEY (username)
);

-- Constraints Section
-- ____________________
ALTER TABLE CLIENTE ADD CONSTRAINT SID_CLIEN_CARRE_FK
    FOREIGN KEY (codCarrello)
    REFERENCES CARRELLO(codCarrello);

ALTER TABLE composizioneCarrello ADD CONSTRAINT REF_compo_CARRE
    FOREIGN KEY (codCarrello)
    REFERENCES CARRELLO(codCarrello);

ALTER TABLE composizioneCarrello ADD CONSTRAINT REF_compo_PRODO_1_FK
    FOREIGN KEY (codProdotto)
    REFERENCES PRODOTTO(codProdotto);

ALTER TABLE composizioneOrdine ADD CONSTRAINT EQU_compo_ORDIN_FK
    FOREIGN KEY (username, codiceOrdine)
    REFERENCES ORDINE(username, codiceOrdine);

ALTER TABLE composizioneOrdine ADD CONSTRAINT REF_compo_PRODO
    FOREIGN KEY (codProdotto)
    REFERENCES PRODOTTO(codProdotto);

ALTER TABLE ORDINE ADD CONSTRAINT REF_ORDIN_SPEDI_FK
    FOREIGN KEY (tipo)
    REFERENCES SPEDIZIONE(tipo);

ALTER TABLE ORDINE ADD CONSTRAINT REF_ORDIN_CLIEN
    FOREIGN KEY (username)
    REFERENCES CLIENTE(username);

ALTER TABLE PRODOTTO ADD CONSTRAINT SID_PRODO_INFO__FK
    FOREIGN KEY (codInfo)
    REFERENCES INFO_VENDITA(codInfo);

ALTER TABLE inserimento ADD CONSTRAINT ID_inser_PRODO_FK
    FOREIGN KEY (codProdotto)
    REFERENCES PRODOTTO(codProdotto);

ALTER TABLE inserimento ADD CONSTRAINT REF_inser_VENDI_FK
    FOREIGN KEY (username)
    REFERENCES VENDITORE(username);

ALTER TABLE RECENSIONE ADD CONSTRAINT REF_RECEN_PRODO_FK
    FOREIGN KEY (codProdotto)
    REFERENCES PRODOTTO(codProdotto);

ALTER TABLE RECENSIONE ADD CONSTRAINT REF_RECEN_CLIEN_FK
    FOREIGN KEY (username)
    REFERENCES CLIENTE(username);
-- Index Section
-- ______________
CREATE UNIQUE INDEX ID_CARRELLO_IND ON CARRELLO (codCarrello);
CREATE UNIQUE INDEX ID_CLIENTE_IND ON CLIENTE (username);
CREATE UNIQUE INDEX SID_CLIEN_CARRE_IND ON CLIENTE (codCarrello);
CREATE UNIQUE INDEX ID_composizioneCarrello_IND ON composizioneCarrello (codCarrello, codProdotto);
CREATE INDEX REF_compo_PRODO_1_IND ON composizioneCarrello (codProdotto);
CREATE UNIQUE INDEX ID_composizioneOrdine_IND ON composizioneOrdine (codProdotto, username, codiceOrdine);
CREATE INDEX EQU_compo_ORDIN_IND ON composizioneOrdine (username, codiceOrdine);
CREATE UNIQUE INDEX ID_INFO_VENDITA_IND ON INFO_VENDITA (codInfo);
CREATE UNIQUE INDEX ID_ORDINE_IND ON ORDINE (username, codiceOrdine);
CREATE INDEX REF_ORDIN_SPEDI_IND ON ORDINE (tipo);
CREATE UNIQUE INDEX ID_PRODOTTO_IND ON PRODOTTO (codProdotto);
CREATE UNIQUE INDEX SID_PRODO_INFO__IND ON PRODOTTO (codInfo);
CREATE UNIQUE INDEX ID_inser_PRODO_IND ON inserimento (codProdotto);
CREATE INDEX REF_inser_VENDI_IND ON inserimento (username);
CREATE UNIQUE INDEX ID_RECENSIONE_IND ON RECENSIONE (codRecensione);
CREATE INDEX REF_RECEN_PRODO_IND ON RECENSIONE (codProdotto);
CREATE INDEX REF_RECEN_CLIEN_IND ON RECENSIONE (username);
CREATE UNIQUE INDEX ID_SPEDIZIONE_IND ON SPEDIZIONE (tipo);
CREATE UNIQUE INDEX ID_VENDITORE_IND ON VENDITORE (username);
