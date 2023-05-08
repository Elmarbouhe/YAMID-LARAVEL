<!DOCTYPE html>
<html>
<link rel="stylesheet" href="shop/style.css">

<head>
    <title>Get User Location</title>
    <style></style>
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            // Redirect to Laravel route with latitude and longitude parameters
            window.location.href = '/dashboard?latitude=' + latitude + '&longitude=' + longitude;
        }
    </script>
</head>

<body>
    <div class="container">
        <h1>Search for Shops</h1>
        <form action="{{ route('dashboard.index') }}" method="GET">
            <div class="form-group">
                <label for="search">Search:</label>
                <input type="text" class="form-control" id="search" name="search" value="{{ old('search') }}">
            </div>
            <button type="submit" class="btn btn-primary" onclick="getLocation()">Search</button>
        </form>

        @if ($shops->count() > 0)
            <h2>Results:</h2>
            <ul>
                @foreach ($shops as $shop)
                    <li>{{ $shop->name }}
                     is {{ $shop->distance }} km far from you</li>
                @endforeach
            </ul>
        @elseif (request()->has('search'))
            <p>No shops found.</p>
        @endif
    </div>
</body>

</html>
<style>
/* Add a background color to the body */
body {
  background-color: #f1f1f1;
}

/* Center the container */
.container {
  margin: auto;
  width: 50%;
  padding: 10px;
}

/* Style the header */
h1 {
  font-size: 36px;
  text-align: center;
  margin-bottom: 20px;
}

/* Style the form */
form {
  display: flex;
  flex-direction: column;
  align-items: center;
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

/* Style the form input */
input[type="text"],
input[type="number"] {
  width: 100%;
  padding: 12px;
  margin: 8px 0;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

/* Style the form submit button */
button[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-top: 10px;
}

/* Style the form submit button on hover */
button[type="submit"]:hover {
  background-color: #45a049;
}

/* Style the results */
h2 {
  font-size: 24px;
  margin-top: 20px;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

li {
  margin: 10px 0;
  padding: 10px;
  background-color: #fff;
  border-radius: 4px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

</style>
