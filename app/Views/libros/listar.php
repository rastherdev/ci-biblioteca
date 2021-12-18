<?= $header ?>
<a href="<?= base_url('crear'); ?>" class="btn btn-success" button" >Agregar un libro</a><br><br>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($libros as $libro) : ?>
            <tr>
                <td><?php echo $libro['idLibro']; ?></td>
                <td><img class="img-thumbnail" src="<?= base_url() ?>/public/uploads/<?= $libro['mImagen']; ?>" width="100" alt=""></td>
                <td><?php echo $libro['aNombreLibro']; ?></td>
                <td>
                    <a href="<?= base_url('editar/' . $libro['idLibro']) ?>" class="btn btn-info" button">Editar</a>
                    <a href="<?= base_url('borrar/' . $libro['idLibro']) ?>" class="btn btn-danger" button">Borrar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $footer ?>