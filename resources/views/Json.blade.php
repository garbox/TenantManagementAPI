<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Laravel API Fetch with Authorization</title>
</head>
<body>
  <script>
    // Your Laravel API endpoint
    const apiUrl = 'http://localhost/api/user';

    // Your authentication token (replace this with a real token from Laravel Sanctum)
    const authToken = 'your_sanctum_token_here';

    fetch(apiUrl, {
      method: 'GET', // Change to POST, PUT, DELETE if needed
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${authToken}` // Sanctum token
      }
    })
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      console.log('API Response:', data);
      // Handle the response data
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
  </script>
</body>
</html>