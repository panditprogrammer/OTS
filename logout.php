<?php require_once "config.php"; ?>
<script>
    sessionStorage.removeItem("username");
    location.assign("<?php echo $root; ?>/index.php");
</script>