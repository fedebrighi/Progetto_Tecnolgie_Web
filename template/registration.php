<main>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="border border-secondary rounded p-4">
                    <h2 class="text-center mb-4">Registrati</h2>
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-info">
                            <?= htmlspecialchars($message) ?>
                        </div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" name="nome" class="form-control" id="nome"
                                placeholder="Inserisci il tuo nome" required />
                        </div>
                        <div class="mb-3">
                            <label for="cognome" class="form-label">Cognome:</label>
                            <input type="text" name="cognome" class="form-control" id="cognome"
                                placeholder="Inserisci il tuo cognome" required />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Inserisci la tua email" required />
                        </div>
                        <div class="alert alert-danger d-none" id="emailError">
                            L'email inserita è già in utilizzo.
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" name="username" class="form-control" id="username"
                                placeholder="Inserisci un username" required />
                        </div>
                        <div class="alert alert-danger d-none" id="usernameError">
                            L'username inserito è già in utilizzo.
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password:</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control pe-5" id="password"
                                    placeholder="Inserisci una password" required />
                                <span class="input-group-text bg-white">
                                    <em class="bi bi-eye toggle-password" style="cursor: pointer;"></em>
                                </span>
                                <span class="input-group-text bg-white">
                                    <em class="bi bi-shuffle generate-password" style="cursor: pointer;"
                                        title="Genera password casuale"></em>
                                </span>
                            </div>
                            <small id="passwordStrength" class="form-text mt-2"></small>
                        </div>
                        <div class="alert alert-danger d-none" id="passwordError">
                            La password deve essere almeno "Forte" per procedere con la registrazione.
                        </div>
                        <div class="mb-2">
                            <label for="dataNascita" class="form-label fs-6">Data di
                                Nascita:</label>
                            <input type="date" name="dataNascita" class="form-control" id="dataNascita"
                                required />
                        </div>
                        <div class="alert alert-danger d-none" id="dataNascitaError">
                            Devi essere maggiorenne per registrarti!
                        </div>
                        <div class="row mb-3">
                            <div class="col-8">
                                <label for="citta" class="form-label">Città:</label>
                                <input type="text" name="citta" class="form-control" id="citta"
                                    placeholder="Inserisci la città" required />
                            </div>
                            <div class="col-4">
                                <label for="cap" class="form-label">CAP:</label>
                                <input type="text" name="cap" class="form-control" id="cap" placeholder="CAP"
                                    pattern="^\d{5}$" maxlength="5" required />
                            </div>
                        </div>
                        <div class="alert alert-danger d-none" id="capError">
                            Devi inserire esattamente 5 cifre.
                        </div>
                        <div class="mb-3">
                            <label for="indirizzo" class="form-label">Indirizzo:</label>
                            <input type="text" name="indirizzo" class="form-control" id="indirizzo"
                                placeholder="Inserisci il tuo indirizzo" required />
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Telefono:</label>
                            <input type="text" name="telefono" class="form-control" id="telefono"
                                placeholder="Inserisci il tuo numero di telefono" pattern="^\d{10}$" maxlength="10"
                                required />
                        </div>
                        <div class="alert alert-danger d-none" id="telefonoError">
                            Devi inserire esattamente 10 cifre.
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn w-100 fw-bold"
                                id="submitButton">Registrati!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <link href="css/password_style.css" rel="stylesheet" />
    <script src="js/gestionePassword.js"></script>
    <script src="js/checkdati.js"></script>
</main>