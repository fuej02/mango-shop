<?php
session_start();

unset( $_SESSION['phone']);
unset($_SESSION['level']);
echo "<script>
alert('登出');
this.location = 'member.php';
</script>";
?>