

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Aluno</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Lista de Alunos
                            </div>
                            <div class="panel-body">
                                <div class="row-border">
                                    <a href="/aluno/novo" class="btn btn-success">Cadastar</a>
                                </div>
                                <div class="row-border" style="margin-top: 20px;">
                                    <!-- List -->
                                    <table id="table" class="table table-striped table-bordered nowrap" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">Cod.</th>
                                                <th>Nome</th>
                                                <th width="30%">Curso</th>
                                                <th width="15%">Data Nascimento</th>
                                                <th width="5%">Opções</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($aluno as $item): ?>
                                            <tr>
                                                <td class="text-center"><?= str_pad($item['idAluno'], 5, 0, STR_PAD_LEFT)?></td>
                                                <td><?= $item['nome'] ?></td>
                                                <td><?= $item['curso'] ?></td>
                                                <td><?= date('d/m/Y', strtotime($item['dtNascimento'])) ?></td>
                                                <td class="text-center">
                                                    <a href="/aluno/editar/<?= $item['idAluno'] ?>" class="btn btn-xs btn-primary btn-flat" style="width: 25px;" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                                                    <a href="/aluno/excluir/<?= $item['idAluno'] ?>" onclick="return confirm('Deseja excluir este registro?')" class="btn btn-xs btn-danger btn-flat" style="width: 25px;" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div id="toastr" class="hidden"><?= $_SESSION['msg'] ?? null; unset($_SESSION['msg']) ?></div>
            </div>
            <!-- /#page-wrapper -->
