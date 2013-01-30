<a href="<?php echo Config::get('SITE_URL'); ?>/admin/product/add">Add product</a> <br><br>

<style>
    table td {
        border: 1px solid #bfbfbf;
    }
</style>

<table cellpadding="5" cellspacing="0">
<thead>
    <tr>
        <td>Nume produs</td>
        <td>Poza</td>
        <td>Pret</td>
        <td>Actiuni</td>
    </tr>
</thead>
<tbody>
    <?php
    foreach($this->products as $product) {
        echo "
            <tr>
                <td>{$product['nume']}</td>
                <td><img src=''</td>
                <td>{$product['pret']}</td>
                <td>
                    <a href='" . Config::get('SITE_URL') . "/admin/product/edit/id/{$product['id']}'>Editeaza</a>|
                    <a href='" . Config::get('SITE_URL') . "/admin/product/delete/id/{$product['id']}'>Sterge</a>
                </td>
            </tr>
        ";
    }
    ?>
</tbody>
</table>