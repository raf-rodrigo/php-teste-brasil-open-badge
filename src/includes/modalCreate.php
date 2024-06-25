<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novo Registro</h5>
            </div>
            <form action="createUser.php" method="POST">
                <div class="modal-body">
                    <div class="form-group my-4">
                        <label for="name" class="text-start">Nome</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group my-4">
                        <label for="email" class="text-start">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div id="colors-container">
                        <div>
                            <button type="button" id="add-color-btn" class="btn btn-outline-primary">Adicionar Cor</button>
                        </div>
                        <script type="text/template" id="color-template">
                            <div class="form-group my-4">
                                <label for="color">Cor</label>
                                <select name="colors[]" class="form-select form-control text-start justify-content-between">
                                    <?php foreach ($colors as $color) { ?>
                                        <option value="<?php echo $color['id']; ?>"><?php echo $color['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </script>

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
<script>
    document.getElementById('add-color-btn').addEventListener('click', function() {
        var template = document.getElementById('color-template').innerHTML;
        var container = document.getElementById('colors-container');
        var newColorSelect = document.createElement('div');
        newColorSelect.innerHTML = template;
        container.appendChild(newColorSelect);
    });

    document.addEventListener('DOMContentLoaded', function () {
        var myModal = new bootstrap.Modal(document.getElementById('updateUserModal'));

        // Capturar o evento de clique nos links que abrem o modal
        var modalLinks = document.querySelectorAll('[data-bs-toggle="modal"]');
        modalLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
        event.preventDefault(); // Prevenir o comportamento padrão do link

        // Obter o user_id do atributo data-user-id
        var userId = this.getAttribute('data-user-id');

        // Atualizar o valor do input hidden dentro do modal
        var userIdInput = document.getElementById('user-id-input');
        userIdInput.value = userId;

        // Mostrar o modal
        myModal.show();
        });
    });
});


</script>
