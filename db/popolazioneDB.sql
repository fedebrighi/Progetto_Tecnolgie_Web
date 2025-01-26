INSERT INTO CARRELLO (codCarrello, totale)
VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0),
(11, 0),
(12, 0),
(13, 0),
(14, 0);

INSERT INTO UTENTE (username, codCarrello, pw, email, nome, cognome, dataNascita, indirizzo, citta, cap, telefono, tipo)
VALUES
('marco_massa', 1, '1234567890', 'marcomassa@gmail.com', 'Marco', 'Massa', '2003-12-12', 'Via Aspini 10', 'Milano', 20100, 3332222882, 'venditore'),
('giovanni_rossi', 2, 'Giovanni123!', 'giovanni.rossi@example.com', 'Giovanni', 'Rossi', '1985-04-15', 'Via Milano 10', 'Milano', 20100, 3332989455, 'cliente'),
('maria_bianchi', 3, 'Maria456!', 'maria.bianchi@example.com', 'Maria', 'Bianchi', '1990-07-20', 'Via Roma 25', 'Roma', 00100,3332989454, 'cliente'),
('luca_verdi', 4, 'Luca789!', 'luca.verdi@example.com', 'Luca', 'Verdi', '1992-11-05', 'Via Torino 40', 'Torino', 10100,3332989453, 'cliente'),
('chiara_zanetti', 5, 'Chiara987!', 'chiara.zanetti@example.com', 'Chiara', 'Zanetti', '1987-02-12', 'Viale Europa 15', 'Napoli', 80100, 3332989452, 'cliente'),
('francesco_martini', 6, 'Francesco123!', 'francesco.martini@example.com', 'Francesco', 'Martini', '1983-03-25', 'Corso Italia 5', 'Bologna', 40100,3332989451, 'cliente'),
('valentina_ferrari', 7, 'Valentina321!', 'valentina.ferrari@example.com', 'Valentina', 'Ferrari', '1994-06-30', 'Via San Francesco 18', 'Firenze', 50100,3332989450, 'cliente'),
('andrea_conti', 8, 'Andrea654!', 'andrea.conti@example.com', 'Andrea', 'Conti', '1991-08-10', 'Piazza Garibaldi 12', 'Verona',37100,3332989456, 'cliente'),
('giulia_marini', 9, 'Giulia456!', 'giulia.marini@example.com', 'Giulia', 'Marini', '1995-12-25', 'Viale Vittorio Emanuele 60', 'Genova', 16100,3332989457, 'cliente'),
('matteo_neri', 10, 'Matteo789!', 'matteo.neri@example.com', 'Matteo', 'Neri', '1989-09-18', 'Via Giuseppe Mazzini 45', 'Palermo', 90100,3332989458, 'cliente'),
('laura_bellucci', 11, 'Laura1234!', 'laura.bellucci@example.com', 'Laura', 'Bellucci', '1992-01-22', 'Piazza del Popolo 8', 'Bari', 70100,3332989459, 'cliente'),
('mattia', 12, 'password123', 'mattia.massara@example.com', 'Mattia', 'Massara', '1990-05-15', 'Via Roma 10', 'Bologna', 40121, 2137685381, 'cliente'),
('monia', 13, 'securePass', 'monia.gorini@example.com', 'Monia', 'Gorini', '1985-11-03', 'Corso Garibaldi 23', 'Milano', 20121, 2134769011, 'cliente'),
('dave', 14, 'davide1234', 'davide.samorani@example.com', 'Davide', 'Samorani', '1995-08-27', 'Piazza Duomo 7', 'Firenze', 50122, 2132198763, 'cliente');


INSERT INTO SPEDIZIONE( tipo, sovrapprezzo)
VALUES
('standard', 0),
('rapida', 5);

INSERT INTO INFO_VENDITA (codInfo, quantitaVendute, spesaUnitaria, ricavo)
VALUES
(1, 3, 2, 13.5),
(2, 2, 2, 8.40),
(3, 5, 2, 20.00),
(4, 2, 2, 7.60),
(5, 0, 1, 0),
(6, 3, 1, 10.50),
(7, 1, 1, 3.50);

INSERT INTO PRODOTTO (codProdotto, codInfo, nome, alc, descrizione, listaIngredienti, prezzo, quantitaMagazzino, immagine,glutenFree)
VALUES
(1, 1, 'EMILIA PARANOICA', 9.5, 'Birra dal colore nero impenetrabile, come la nebbia degli inverni della pianura emiliana. Al naso note di cioccolato, liquirizia e caffè accompagnate da leggeri sentori di vaniglia e caramello che ricompaiono anche in bevuta. Birra con un corpo pieno e avvolgente con un finale morbido e appagante che nascondono i suoi 9,5%.','acqua, malto d\'orzo, malto destrine, luppolo, lievito.', 4.50, 100, 'emilia.png',FALSE),
(2, 2, 'CHARLIE DON’T SURF', 7.5, 'Birra prodotta con soli malti Pils e Carapils, luppolata con Nelson Sauvin, Riwaka ed Enigma. Il risultato è una birra con una forte spinta aromatica verso l’agrumato, floreale, che si trova tale e quale al palato. Rendendola estremamente beverina e appagante, facendone dimenticare la gradazione.','Acqua, malto d\'orzo, orzo, luppolo, lievito.', 4.20, 100, 'charlie.png',FALSE),
(3, 3 , 'KIWI PASSENGER', 6.0, 'Fermata in Nuova Zelanda per farti provare l’esplosione dei luppoli della Farm Hop Revolution. Nelson Sauvin, Motueka e Riwaka fanno da protagonisti per una birra che sprigiona sentori esotici. Freschissima e super gradevole, è accompagnata poi da un corpo morbido che ne bilancia la bevuta e che invoglia immediatamente al secondo sorso.','acqua, malto d\'orzo, luppolo, lievito.', 4.00, 100, 'kiwi.png',FALSE ),
(4, 4, 'DON QUISCIOTTE', 6.5, 'West Coast IPA fatta con malto Pils e Pale, chiara e ben luppolata. Con luppoli Citra, Mosaic, Simcoe e Columbus al naso sprigiona un intenso aroma di frutta tropicale, l’amaro è ben bilanciato nella beva.','Acqua, malto d\'orzo, avena, luppolo, lievito.', 3.80, 100, 'don.png',FALSE ),
(6, 6, 'PANDA', 5.0, 'American Ipa luppolata con Ekuanot, Amarillo e Nuggets su una base di malti Pale. In aroma spicca la componente agrumata con note di arancia, pompelmo e limone seguita da sentori floreali ed erbacei. L’amaro è equilibrato e persistente. GLUTEN FREE','acqua, malto d\'orzo, orzo, luppolo, lievito.', 3.50, 100, 'panda.png', TRUE),
(7, 7, 'MOLLY', 4.0, 'Birra di stampo British da bere in quantità. Prodotta con malti Maris Otter e Crystal, e fermentata con un ceppo di lievito Inglese. Di color ambrato, in aroma spiccano note di nocciola e mou. In bocca è morbida e scorrevole, con note di malto e biscotto in evidenza, seguite da richiami terrosi che accompagnano in un finale lievemente amaro.','acqua, malto d\'orzo, orzo, luppolo, lievito.', 3.50, 100, 'molly.png',FALSE);

INSERT INTO RECENSIONE (codRecensione, valutazione, testo, codProdotto, username)
VALUES
(1, 5, 'Birra fantastica e rinfrescante, fresca sulla spiaggia è un must!', 1, 'mattia'),
(2, 5, 'Sapore unico e piacevole, inoltre spedizione impeccabile!!', 2, 'monia'),
(3, 5, 'Bevetela con una pizza, fidatevi ne vale davvero la pena!', 3, 'dave');

INSERT INTO coupons (username, coupon_code, discount_amount, is_used)
VALUES
('giovanni_rossi', 'DISCOUNT10', 5, 0),
('dave', 'WELCOME5', 5, 0),
('luca_verdi', 'FREESHIP', 0, 0);

INSERT INTO ORDINE (username, codiceOrdine, dataOrdine, dataSpedizione, dataArrivo, dataPrevista, stato, totale, tipoPagamento, indirizzo, citta, cap, note, tipo, scontoUsato)
VALUES
    ('giovanni_rossi', 1, '2025-01-01', '2025-01-03', '2025-01-13', '2025-01-13', 'Consegnato', 25.50, 'Carta di Credito', 'Indirizzo giovanni_rossi', 'Città Fittizia', '12345', NULL, 'standard', NULL),
    ('maria_bianchi', 2, '2025-01-02', '2025-01-04', '2025-01-07', '2025-01-06', 'Consegnato', 34.00, 'Carta di Credito', 'Indirizzo maria_bianchi', 'Città Fittizia', '12345', NULL, 'rapida', NULL),
    ('luca_verdi', 3, '2025-01-05', '2025-01-07', NULL, '2025-01-10', 'In Consegna', 20.70, 'Carta di Credito', 'Indirizzo luca_verdi', 'Città Fittizia', '12345', NULL, 'rapida', NULL);

INSERT INTO composizioneOrdine (codProdotto, username, codiceOrdine, quantita)
VALUES
    (1, 'giovanni_rossi', 1, 3),
    (2, 'giovanni_rossi', 1, 2),
    (3, 'maria_bianchi', 2, 5),
    (4, 'maria_bianchi', 2, 2),
    (6, 'luca_verdi', 3, 3),
    (7, 'luca_verdi', 3, 1);


