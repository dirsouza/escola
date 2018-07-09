

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Relatórios</h1>
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
                            <div class="panel-heading"></div>
                            <div class="panel-body">
                                <form id="relatorio" method="post">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Módulo:</label>
                                                <select name="modulo" id="modulo" class="form-control select2" required>
                                                    <option></option>
                                                <?php foreach ($tabelas as $item): ?>
                                                    <option value="<?= $item['Tables_in_db_escola'] ?>"><?= ucfirst(preg_replace('/tb/',"", $item['Tables_in_db_escola'])) ?></option>
                                                <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Tipo:</label>
                                                <select name="tipo" id="tipo" class="form-control select2" required>
                                                    <option></option>
                                                    <option value="simplificado">Simplificado</option>
                                                    <option value="analitico">Analítico</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 text-right">
                                            <button type="button" id="gerarRelatorio" class="btn btn-primary">Gerar Relatório</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div id="toastr" class="hidden"><?= $_SESSION['msg'] ?? null; unset($_SESSION['msg']) ?></div>
            </div>
            <!-- /#page-wrapper -->
