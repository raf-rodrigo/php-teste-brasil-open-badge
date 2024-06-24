<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadstrar Usuário</h5>
            </div>
            <form action="createUser.php" method="POST">
                <input type="hidden" id="last-page" name="last-page" value="<?=$totalPages;?>" />
                <div class="modal-body">
                    <div class="form-group my-4 ">
                        <label for="name" class="text-start">Nome</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group my-4 ">
                        <label for="email" class="text-start">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group my-4 ">
                        <label for="color">Cor</label>
                        <select id="color" name="color" class="form-select form-control text-start justify-content-between">
                            <option value="" selected>Selecione</option>
                            <? foreach ($colors as $color){?>
                                <option value="<? print_r($color['id']);?>"><? print_r($color['name']); ?></option>
                            <?}?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="/" type="button" class="btn btn-outline-danger" data-dismiss="modal">Fechar</a>
                    <button type="submit" class="btn btn-outline-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>