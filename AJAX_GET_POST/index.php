<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .container{
      width: 100%;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .box{
      display: flex;
      flex-direction: column;
      align-items: center;
      border: 1px solid black;
      gap: 10px;
      padding: 50px;
    }

    .inputs{
      width: 400px;
      background: white;
      padding: 50px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .target{
      border: 1px solid black;
      padding: 20px;
    }

    .btn{
      width: 100px;
      height: 30px;
    }

    input{
      height: 30px;
      padding: 0 10px;
    }

    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }


  </style>
</head>
<body>
  
  <div class="container">
    <div class="box">
        <div class="target">

        </div>
        <div class="inputs" id="myDiv">
            <input type="text" placeholder="Name" id="inputName">
            <input type="text" placeholder="Email" id="inputEmail">
        </div>
        <button class="btn" onclick="load()">Button</button>
    </div>
  </div>

  <script>
    
    function loadTable(){

      const xhttp = new XMLHttpRequest();

      xhttp.onload = function () {

        var data = JSON.parse(xhttp.responseText);
        
        if(data == ""){
          document.querySelector('.target').innerHTML = "There's no data : (";
          return;
        }
      
        var table = "<table>";
        table += "<thead><tr>";

        for(var key in data[0]){
          if(data[0].hasOwnProperty(key)){
            table += '<th>' + key + '</th>';
          }
        }

        table += '</tr></thead>';
        table += '<tbody>';

        for (var i = 0; i < data.length; i++) {
          table += '<tr>';
          for (var key in data[i]) {
              if (data[i].hasOwnProperty(key)) {
                  table += '<td>' + data[i][key] + '</td>';
              }
          }
          table += '</tr>';
        }
        
        table += '</tbody></table>';
        document.querySelector('.target').innerHTML = table;

      }

      xhttp.open("GET", "get.php");
      xhttp.send();
    }



    function load() {
      
      const xhttp = new XMLHttpRequest();
      
      let name = document.querySelector('#inputName').value;
      let email = document.querySelector('#inputEmail').value;
      
      if(name == "" || email == ""){
        let inputs = document.querySelector('.inputs');
        inputs.innerHTML = "<div style=\"color:red;\"> Input Empty </div>" + inputs.innerHTML;
        return;
      }


      console.log(name);
      console.log(email);

      let data = JSON.stringify({"name": name, "email": email});

      // xhttp.onload = function () {
      //   document.querySelector('.target').innerHTML = this.responseText;
      // }

      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          // reload the table after the POST request has been completed
          loadTable();
        }
      }
      
      xhttp.open("POST", "post.php");
      xhttp.setRequestHeader('Content-Type','application/json');
      xhttp.send(data);
      loadTable();
    }


    loadTable();

    </script>
</body>
</html>