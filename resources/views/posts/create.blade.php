<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ 'Add a new post - ' . config('app.name') }}</title>
</head>

<body>
    <h3>Add a new post</h3>
    <form method="post" action="{{ route('posts.store') }}">
        <label>Title: </label>
        <input type="text" name="title" /><br />
        <label>Excerpt: </label>
        <textarea name="excerpt"></textarea><br />
        <label>Content: </label>
        <textarea name="content"></textarea><br />
        <button type="submit">Save post</button>
    </form>
</body>

</html>
