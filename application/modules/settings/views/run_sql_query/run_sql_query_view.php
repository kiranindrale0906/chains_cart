<html>
  <body>
    <form method="post" action="<?= ADMIN_PATH?>settings/run_sql_query/index?type=POST"
      <label>Query : </label>
      <textarea name="sql_query_statement"></textarea>
      <button type="submit" name="run">Execute</button>
    </form>
  </body>
</html>