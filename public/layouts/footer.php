    </div>
    <div id="footer">
      Copyright <?php echo date("Y", time()); ?> Piotr Opozda
    </div>
</html>
<?php isset($database) ? $database->close_connection() : null;