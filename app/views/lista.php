<?php include 'header.php'; ?>

<h2>Produtos</h2>

<a href="index.php?novo=1" class="btn btn-primary mb-3">
Novo Produto
</a>

<table class="table table-striped">

<tr>
<th>Nome</th>
<th>Preço</th>
<th>Ação</th>
</tr>

<?php if(!empty($dados)){ ?>

<?php foreach ($dados as $doc) { ?>

<tr>

<td><?= $doc['nome'] ?></td>

<td><?= $doc['preco'] ?></td>

<td>

<a class="btn btn-danger btn-sm"
href="deletar.php?id=<?= $doc['id'] ?>">
Excluir
</a>

</td>

</tr>

<?php } ?>

<?php } ?>

</table>

<?php include 'footer.php'; ?>