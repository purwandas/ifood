<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>COBA</title>
  </head>
  <body>
    <?php echo form_open("test/kirim"); ?>
      <?php foreach ($this->db->get("sada_produk")->result() as $row): ?>
        <table>
          <tr>
            <td>
                <?php echo $row->nama_produk; ?>
            </td>
            <td>
              <input type="text" name="<?php echo $row->id_produk ?>" value="qty">
            </td>
          </tr>


      <?php endforeach; ?>
      <tr>
        <td colspan="2">
          <input type="submit" value="kirim">
        </td>
      </tr>
      </table>
    </form>
  </body>
</html>
