<!DOCTYPE html >
<html>
<meta=charset UTF8/>
<head>
<title>Page Connexion</title>
</head>
<body>
<select id="mySelect" onchange="selected()">
    <option onchange="selectR()">Red</option>
    <option onchange="selectG()">Green</option>
    <option onchange="selectB()">Blue</option>
  </select>
  </body>
  </html>
  <p id="p">You Currently Have "RED" Selected!
    </p>
    <script>
  function selected(){
      var index = document.getElementById("mySelect").selectedIndex;
      switch(index) {
          case 0:
              document.getElementById("p").innerHTML = 'You Currently Have "RED" Selected!';
              break;
          case 1:
              document.getElementById("p").innerHTML = 'You Currently Have "GREEN" Selected!';
              break;
            case 2:
              document.getElementById("p").innerHTML = 'You Currently Have "BLUE" Selected!';
              break;
              
      }
  }
  </script>