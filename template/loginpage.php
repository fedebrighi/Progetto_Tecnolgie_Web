<main>
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="text-warning">Benvenuto su PHPint!</h1>
            <p>Accedi per scoprire il mondo delle birre artigianali.</p>
        </div>

        <?php if (isset($templateParams["errorelogin"]) && !empty($templateParams["errorelogin"])): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo $templateParams["errorelogin"]; ?>
            </div>
        <?php endif; ?>

        <!-- Sezione Login -->
        <div class="row justify-content-center align-items-center d-flex">
            <div class="col-md-6">
                <div class="border border-secondary rounded p-4">
                    <h2 class="text-center text-warning mb-4">Accesso</h2>
                    <form method="POST" action="login.php">
                        <div class="mb-3">
                            <label for="username-cliente" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="username-cliente" name="username"
                                placeholder="Inserisci il tuo username" />
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password:</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control pe-5" id="password"
                                    placeholder="Inserisci una password" required />
                                <!-- Icona per mostrare/nascondere la password -->
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-eye toggle-password" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn w-100 fw-bold">Accedi!</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Registrazione -->
            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <aside class="border border-secondary rounded p-4 text-center">
                        <h2 class="text-warning mb-4"><i class="bi bi-person-plus"></i> Prima volta sul sito?</h2>
                        <form>
                            <button type="button" class="btn w-100 fw-bold"
                                onclick="window.location.href='regCliente.php';">Registrati!</button>
                        </form>
                    </aside>
                </div>
            </div>

        </div>
    </div>
    <script src="js/gestionePassword.js"></script>
</main>