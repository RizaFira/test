<!DOCTYPE html>
<html>
  <head>
    <title>My Landing Page</title>
    <style>
        /* Global Styles */
body {
  font-family: Arial, sans-serif;
  color: #444;
}

/* Header Styles */
header {
  background-color: #333;
  color: #fff;
  text-align: center;
  padding: 20px;
}

header h1 {
  margin: 0;
}

/* Hero Section Styles */
#hero {
  text-align: center;
}

#hero img {
  width: 100%;
}

#hero h2 {
  margin: 20px 0;
}

#hero #cta-button {
  background-color: #333;
  color: #fff;
  padding: 10px 20px;
  border: none;
}

/* Features Section Styles */
#features {
  text-align: center;
}

#features h3 {
  margin-bottom: 20px;
}

#features ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

/* Pricing Section Styles */
#pricing {
  text-align: center;
}

#pricing h3 {
  margin-bottom: 20px;
}

#pricing ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

/* Footer Styles */
footer {
  background-color: #333;
  color: #fff;
  text-align: center;
  padding: 20px;
}
    </style>
  </head>
  <script server='local' wid-key= 'e9c23478-a5c6-11ed-9afe-6045cb9f8098' src='https://2a2f-103-107-71-140.ngrok.io/js/widget-chat.js'></script>
  <body>
  <form class="needs-validation" novalidate method="post" action="{{ route('store') }}" enctype="multipart/form-data" >
    @csrf
        <input type="text" placeholder="081393961320,0821212122,08128282812"name='phones'>
        <input type="text" name="caption">
        <input type="file" name="upload_file">
        <button type="submit"> Submit</button>
    </form>
  </body>
    <footer>
      <p>Copyright © 2021 My Website</p>
    </footer>
    <script>
        document.getElementById("cta-button").addEventListener("click", function() {
  // Show an alert when the button is clicked
  alert("Thanks for clicking the button!");
});
    </script>
  </body>
</html>
