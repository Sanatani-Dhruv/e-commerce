<?php
// http_response_code(404);
// die();
// header("HTTP/1.0 404 Not Found");
// $error = http_response_code(404)?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1.0"/>
    <title>View Not Found</title>
    <style>
<?php
include(__DIR__ . "/styles/index.css");
?>
    </style>
  </head>
  <body>
    <h1>
      <code>
        View with name `<?=out($action)?>` not Found.
      </code>
    </h1>
    <h2>
      <code>
        <a href="/">Home Page</a>
      </code>
    </h2>
  </body>
</html>

