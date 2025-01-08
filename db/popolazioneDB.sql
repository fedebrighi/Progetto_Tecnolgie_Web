INSERT INTO CARRELLO (codCarrello, totale)
VALUES
(1, 133),
(2, 0),
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0);

INSERT INTO CLIENTE (username, codCarrello, pw, email, nome, cognome, dataNascita, indirizzo, citta, cap, telefono)
VALUES
('giovanni_rossi', 1, 'Giovanni123!', 'giovanni.rossi@example.com', 'Giovanni', 'Rossi', '1985-04-15', 'Via Milano 10', 'Milano', '20100','3332989455'),
('maria_bianchi', 2, 'Maria456!', 'maria.bianchi@example.com', 'Maria', 'Bianchi', '1990-07-20', 'Via Roma 25', 'Roma', '00100','3332989454'),
('luca_verdi', 3, 'Luca789!', 'luca.verdi@example.com', 'Luca', 'Verdi', '1992-11-05', 'Via Torino 40', 'Torino', '10100','3332989453'),
('chiara_zanetti', 4, 'Chiara987!', 'chiara.zanetti@example.com', 'Chiara', 'Zanetti', '1987-02-12', 'Viale Europa 15', 'Napoli', '80100','3332989452'),
('francesco_martini', 5, 'Francesco123!', 'francesco.martini@example.com', 'Francesco', 'Martini', '1983-03-25', 'Corso Italia 5', 'Bologna', '40100','3332989451'),
('valentina_ferrari', 6, 'Valentina321!', 'valentina.ferrari@example.com', 'Valentina', 'Ferrari', '1994-06-30', 'Via San Francesco 18', 'Firenze', '50100','3332989450'),
('andrea_conti', 7, 'Andrea654!', 'andrea.conti@example.com', 'Andrea', 'Conti', '1991-08-10', 'Piazza Garibaldi 12', 'Verona', '37100','3332989456'),
('giulia_marini', 8, 'Giulia456!', 'giulia.marini@example.com', 'Giulia', 'Marini', '1995-12-25', 'Viale Vittorio Emanuele 60', 'Genova', '16100','3332989457'),
('matteo_neri', 9, 'Matteo789!', 'matteo.neri@example.com', 'Matteo', 'Neri', '1989-09-18', 'Via Giuseppe Mazzini 45', 'Palermo', '90100','3332989458'),
('laura_bellucci', 10, 'Laura1234!', 'laura.bellucci@example.com', 'Laura', 'Bellucci', '1992-01-22', 'Piazza del Popolo 8', 'Bari', '70100','3332989459');

INSERT INTO SPEDIZIONE( tipo, sovrapprezzo)
VALUES
('Standard', 0),
('Express', 2.50);

INSERT INTO ORDINE (username, codiceOrdine, dataOrdine, dataSpedizione, dataArrivo, totale, tipoPagamento, indirizzo, citta, cap, note, tipo)
VALUES
('giovanni_rossi', 1, '2025-01-05', '2025-01-06', '2025-01-10', 50.00, 'Carta di credito', 'Via Milano 10', 'Milano', '20100', 'Ordine urgente', 'Standard'),
('giovanni_rossi', 2, '2025-01-05', '2025-01-07', '2025-01-12', 75.50, 'PayPal', 'Via Milano 10', 'Milano', '20100', 'Richiesta di imballaggio regalo', 'Express');

INSERT INTO INFO_VENDITA (codInfo, quantitaVendute, spese, ricavo)
VALUES
(1, 0, 100, 0),
(2, 0, 100, 0),
(3, 0, 100, 0),
(4, 0, 100, 0),
(5, 0, 100, 0),
(6, 0, 100, 0),
(7, 0, 100, 0);

INSERT INTO PRODOTTO (codProdotto, codInfo, nome, alc, descrizione, prezzo, quantitaMagazzino, immagine)
VALUES
(1, 1, 'EMILIA PARANOICA', 9.5, 'Birra dal colore nero impenetrabile, come la nebbia degli inverni della pianura emiliana. Al naso note di cioccolato, liquirizia e caffè accompagnate da leggeri sentori di vaniglia e caramello che ricompaiono anche in bevuta. Birra con un corpo pieno e avvolgente con un finale morbido e appagante che nascondono i suoi 9,5%.', 4.50, 100, 'emilia.png'),
(2, 2, 'CHARLIE DON’T SURF', 7.5, 'Birra prodotta con soli malti Pils e Carapils, luppolata con Nelson Sauvin, Riwaka ed Enigma. Il risultato è una birra con una forte spinta aromatica verso l’agrumato, floreale, che si trova tale e quale al palato. Rendendola estremamente beverina e appagante, facendone dimenticare la gradazione.', 4.20, 100, 'charlie.png'),
(3, 3 , 'KIWI PASSENGER', 6.0, 'Fermata in Nuova Zelanda per farti provare l’esplosione dei luppoli della Farm Hop Revolution. Nelson Sauvin, Motueka e Riwaka fanno da protagonisti per una birra che sprigiona sentori esotici. Freschissima e super gradevole, è accompagnata poi da un corpo morbido che ne bilancia la bevuta e che invoglia immediatamente al secondo sorso.', 4.00, 100, 'kiwi.png' ),
(4, 4, 'DON QUISCIOTTE', 6.5, 'West Coast IPA fatta con malto Pils e Pale, chiara e ben luppolata. Con luppoli Citra, Mosaic, Simcoe e Columbus al naso sprigiona un intenso aroma di frutta tropicale, l’amaro è ben bilanciato nella beva.', 3.80, 100, 'don.png' ),
(5, 5, 'CONFIDENTIAL', 6.0, 'Birra in stile West Coast IPA creata con una nuova tecnica di estrazione della luppolina da parte della farm Crosby Hop. I luppoli Strata, Nelson Sauvin e Nugget sono usati nella loro versione CGX . Processo criogenico avanzato che separa la luppolina dalla materia vegetativa del luppolo in un ambiente ad ossigeno zero e a temperature bassisime -30/-45 °C. Ne esce una birra con una notevole parte aromatica di frutta gialla e tropicale. Con note di pesca e papaya. In bocca è setosa e piacevolmente equilibrata con un amaro delicato sul finale.', 4.00, 100, 'confidential.png'),
(6, 6, 'PANDA', 5.0, 'American Ipa luppolata con Ekuanot, Amarillo e Nuggets su una base di malti Pale. In aroma spicca la componente agrumata con note di arancia, pompelmo e limone seguita da sentori floreali ed erbacei. L’amaro è equilibrato e persistente. GLUTEN FREE', 3.50, 100, 'panda.png'),
(7, 7, 'MOLLY', 4.0, 'Birra di stampo British da bere in quantità. Prodotta con malti Maris Otter e Crystal, e fermentata con un ceppo di lievito Inglese. Di color ambrato, in aroma spiccano note di nocciola e mou. In bocca è morbida e scorrevole, con note di malto e biscotto in evidenza, seguite da richiami terrosi che accompagnano in un finale lievemente amaro.', 3.50, 100, 'molly.png');


INSERT INTO VENDITORE (username, pw, email, telefono, indirizzo, citta, cap)
VALUES
('marco_massa', '1234567890', 'marco.massa@example.com', '1234567890', 'via forli 19', 'forli', '47121'),
('mattia_saponaro', '1234567890', 'mattia.saponaro@example.com', '3456789012', 'via cesena 12', 'forli', '47122'),
('federico_brighi', '1234567890', 'federico.brighi@example.com', '7890123456', 'via faenza 22', 'forli', '47121');

INSERT INTO ingredienti (codProdotto, ingrediente)
VALUES
(1, 'acqua'),
(1, 'malto d\'ORZO'),
(1, 'malto destrine'),
(1, 'luppolo'),
(1, 'lievito'),
(2, 'Acqua'),
(2, 'malto d\'ORZO'),
(2, 'ORZO'),
(2, 'luppolo'),
(2, 'lievito'),
(3, 'acqua'),
(3, 'malto d\'ORZO'),
(3, 'luppolo'),
(3, 'lievito'),
(4, 'Acqua'),
(4, 'malto d\'ORZO'),
(4, 'AVENA'),
(4, 'luppolo'),
(4, 'lievito'),
(5, 'acqua'),
(5, 'malto d\'ORZO'),
(5, 'ORZO'),
(5, 'luppolo'),
(5, 'lievito'),
(6, 'acqua'),
(6, 'malto d\'ORZO'),
(6, 'ORZO'),
(6, 'luppolo'),
(6, 'lievito'),
(7, 'acqua'),
(7, 'malto d\'ORZO'),
(7, 'ORZO'),
(7, 'luppolo'),
(7, 'lievito');


INSERT INTO CARRELLO (codCarrello, totale)
VALUES
(11, 0),
(12, 0),
(13, 0);


INSERT INTO CLIENTE (username, codCarrello, pw, email, nome, cognome, dataNascita, indirizzo, citta, cap)
VALUES
('mattia', 11, 'password123', 'mattia.massara@example.com', 'Mattia', 'Massara', '1990-05-15', 'Via Roma 10', 'Bologna', '40121'),
('monia', 12, 'securePass', 'monia.gorini@example.com', 'Monia', 'Gorini', '1985-11-03', 'Corso Garibaldi 23', 'Milano', '20121'),
('dave', 13, 'davide1234', 'davide.samorani@example.com', 'Davide', 'Samorani', '1995-08-27', 'Piazza Duomo 7', 'Firenze', '50122');


INSERT INTO RECENSIONE (codRecensione, valutazione, testo, codProdotto, username)
VALUES
(1, 5, 'Birre fantastiche e servizio impeccabile! 🔥', 1, 'mattia'),
(2, 5, 'Il miglior negozio di birre artigianali che abbia mai trovato.', 2, 'monia'),
(3, 5, 'Birre fantastiche, perfette da abbinare ad una buona pizza! 🍕🍺 Qualità top, consigliatissimo!', 3, 'dave');


INSERT INTO composizioneOrdine (codProdotto, username, codiceOrdine, quantita)
VALUES
(1, 'giovanni_rossi', 1, 1),
(2, 'giovanni_rossi', 1, 1),
(3, 'giovanni_rossi', 2, 1),
(4, 'giovanni_rossi', 2, 1);

INSERT INTO composizioneCarrello (codProdotto, codCarrello, quantita)
VALUES
(1, 1, 5),
(2, 1, 6),
(3, 1, 2);