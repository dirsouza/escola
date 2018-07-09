

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Editar Aluno</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <?php if (isset($_SESSION['erro']) && !empty($_SESSION['erro'])): ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?= $_SESSION['erro']['msg']; unset($_SESSION['erro']) ?>
                </div>
                <?php endif; ?>
                <!-- /.alert -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Dados para Editar
                            </div>
                            <div class="panel-body">
                                <form action="/aluno/editar/<?= $aluno['idAluno'] ?>" method="post">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label for="Aluno">Aluno:</label>
                                                <input type="text" name="nome" class="form-control" placeholder="Nome do Completo" value="<?= $aluno['nome'] ?>" autofocus required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="dtNascimento">Data Nascimento:</label>
                                                <input type="date" name="dtNascimento" class="form-control" value="<?= $aluno['dtNascimento'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="idCurso">Curso:</label>
                                                <select name="idCurso" id="select2" class="form-control" required>
                                                    <option></option>
                                                    <?php foreach($curso as $item): ?>
                                                        <option value="<?= $item['idCurso'] ?>" <?= ($item['idCurso'] == $aluno['idCurso']) ? "selected" : null ?>><?= $item['nome'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="cep">CEP:</label>
                                                <input type="tel" name="cep" id="cep" class="form-control" value="<?= $aluno['cep'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <label for="logradouro">Logradouro:</label>
                                                <input type="text" name="logradouro" id="logradouro" class="form-control" placeholder="Logradouro" value="<?= $aluno['logradouro'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="numero">Número:</label>
                                                <input type="number" name="numero" class="form-control" placeholder="Número" value="<?= $aluno['numero'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label for="bairro">Bairro:</label>
                                                <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Bairro" value="<?= $aluno['bairro'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label for="cidade">Cidade:</label>
                                                <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Cidade" value="<?= $aluno['cidade'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="estado">Estado:</label>
                                                <input type="text" name="estado" id="estado" class="form-control" placeholder="Estado" value="<?= $aluno['estado'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 text-right">
                                            <button type="submit" class="btn btn-primary">Atualizar</button>
                                            <button type="button" class="btn btn-warning" onclick="javascript: location.href='/aluno'">Cancelar</button>
                                        </div>
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
