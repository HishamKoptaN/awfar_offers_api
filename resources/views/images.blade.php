<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض الصور</title>
</head>
<body>
    <h1>عرض الصور</h1>
    <div id="images-container">
        @foreach ($images as $image)
            <div style="margin: 10px;">
                <img src="{{ url('/storage/' . $image['file'] . '/' . $image['name']) }}" alt="{{ $image['name'] }}" width="200">
                <p>{{ $image['name'] }}</p>
            </div>
        @endforeach
    </div>
</body>
</html>
