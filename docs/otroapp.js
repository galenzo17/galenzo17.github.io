console.log('123')
var url = 'insert.php';
var data = {username: 'example'};

fetch(url, {
 // method: 'POST', // or 'PUT'
  //body: JSON.stringify(data), // data can be `string` or {object}!
  headers:{
    'Content-Type': 'application/json'
  }
}).then(res => res.json())
.catch(error => console.error('Error:', error))
.then(response => console.log('Success:', response));