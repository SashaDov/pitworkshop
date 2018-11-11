<table class="table">
    <tbody>

<?php
foreach ($currencies as $currency) {
?>
<tr><td> <?= $currency->vchcode; ?>  </td>
<td> <?= $currency->vcurs; ?>  </td></tr>
<?php
}
?>
    </tbody>
</table>
