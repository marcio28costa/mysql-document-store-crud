<?php include 'header.php'; ?>

<h2>Novo Produto</h2>

<form action="salvar.php" method="POST">

<div class="mb-3">

<label>Nome</label>

<input name="nome" class="form-control">

</div>

<div class="mb-3">

<label>Preço</label>

<input name="preco" class="form-control">

</div>

<button class="btn btn-success">
Salvar
</button>

</form>

<?php include 'footer.php'; ?>