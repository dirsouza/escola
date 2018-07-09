

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Editar Curso</h1>
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
                                <form action="/curso/editar/<?= $curso['idCurso'] ?>" method="post">
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <label for="Nome">Nome:</label>
                                            <input type="text" name="nome" class="form-control" placeholder="Nome do Curso" value="<?= $curso['nome'] ?>" autofocus required>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="idProfessor">Professor:</label>
                                            <select name="idProfessor" class="form-control select2" required>
                                                <option></option>
                                                <?php foreach($prof as $item): ?>
                                                    <option value="<?= $item['idProfessor'] ?>" <?= ($item['idProfessor'] == $curso['idProfessor']) ? "selected" : null ?>><?= $item['nome'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-right">
                                        <button type="submit" class="btn btn-primary">Atualizar</button>
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
