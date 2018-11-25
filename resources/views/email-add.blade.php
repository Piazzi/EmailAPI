<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <form action="/emails/add/{emails}" method="post">
        <input name="_method" type="hidden" value="POST">
        <div class="form-group">
          <label for="">Digite os Emails abaixo</label>
          <input type="text" name="emails" id="" class="form-control" placeholder="..." aria-describedby="helpId">
          <small id="helpId" class="text-muted">Separe os emails com um espaço</small>
        </div>
    
        <button type="submit">Enviar</button>
    </form>
    </div>

</body>
</html>