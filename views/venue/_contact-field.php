<?php if($link) {
$linkLink = $link;
if($label == "Phone") { $linkLink = "tel:{$link}"; }
if($label == "Email") { $linkLink = "mailto:{$link}"; }
?>
<div class="row">
  <div class="col-4 col-md-3 col-lg-2 col-xl-1 text-right">
    <strong><?= $label ?>:</strong>
  </div>
  <div class="col-8 col-md-9 col-lg-10 col-xl-11">
      <a href="<?= $linkLink ?>" target="_blank"><?= $link ?></a>
  </div>
</div>
<?php } ?>
