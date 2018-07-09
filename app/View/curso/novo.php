

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Cadastro de Curso</h1>
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
                                <form action="/curso/novo" method="post">
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <label for="Curso">Curso:</label>
                                            <input type="text" name="nome" class="form-control" placeholder="Nome do Curso" value="<?= $_SESSION['erro']['fields']['nome'] ?? null ?>" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="idProfessor">Professor:</label>
                                            <select name="idProfessor" id="select2" class="form-control" required>
                                                <option></option>
                                            <?php foreach($prof as $item): ?>
                                                <option value="<?= $item['idProfessor'] ?>" <?= ($item['idProfessor'] == ($_SESSION['erro']['fields']['idProfessor'] ?? null)) ? "selected" : null ?>><?= $item['nome']; unset($_SESSION['erro']) ?></option>
                                            <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-right">
                                        <button type="submit" class="btn btn-success">Cadastrar</button>
                                        <button type="button" class="btn btn-warning" onclick="javascript: location.href='/curso'">Cancelar</button>
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
