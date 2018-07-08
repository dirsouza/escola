

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Cadastro de Professor</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <?php if (isset($_SESSION['erro']) && !empty($_SESSION['erro'])): ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?= $_SESSION['erro']['msg'] ?>
                </div>
                <?php endif; ?>
                <!-- /.alert -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Dados para Cadastro
                            </div>
                            <div class="panel-body">
                                <form action="/professor/novo" method="post">
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label for="Nome">Nome:</label>
                                            <input type="text" name="nome" class="form-control" placeholder="Nome Completo" value="<?= $_SESSION['erro']['fields']['nome'] ?? null ?>" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="Nascimento">Data Nascimento:</label>
                                            <input type="date" name="dtNascimento" class="form-control text-center" value="<?= $_SESSION['erro']['fields']['dtNascimento'] ?? null; unset($_SESSION['erro']) ?>" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-right">
                                        <button type="submit" class="btn btn-success">Cadastrar</button>
                                        <button type="button" class="btn btn-warning" onclick="javascript: location.href='/professor'">Cancelar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->
