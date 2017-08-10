<h1>Módulo 8</h1>

<p>Sua URL : <?php echo $_SERVER['REQUEST_URI'] ?></p>

<table>
  <tr>
    <th>Variavel 1:</th>
    <td><?php echo Url::getURL(0) ?></td>
  </tr>
  <tr>
    <th>Variavel 2</th>
    <td><?php echo Url::getURL(1) ?></td>
  </tr>
  <tr>
    <th>Variavel 3</th>
    <td><?php echo Url::getURL(2) ?></td>
  </tr>
  <tr>
    <th>Variavel 4</th>
    <td><?php echo Url::getURL(3) ?></td>
  </tr>
  <tr>
    <th>Variavel 5</th>
    <td><?php echo Url::getURL(4) ?></td>
  </tr>
  <tr>
    <th>Variavel 6</th>
    <td><?php echo Url::getURL(5) ?></td>
  </tr>
</table>
