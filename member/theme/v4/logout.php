<?php
session_unset();
session_destroy();
// header("location: /housing/");
echo '<script>window.location.href = "http://housing.oneheartwd.biz/"</script>';
?>