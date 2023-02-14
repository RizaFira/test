<html>
  <head>
    <style>
      .headerx {
        background-color: #333;
        color: white;
        text-align: center;
        padding: 10px;
      }
      .store-name {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 10px;
      }
      .menu {
        display: flex;
        justify-content: space-between;
        padding: 10px;
      }
      .menu a {
        color: white;
        text-decoration: none;
        margin-right: 10px;
      }
      .shoe-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 20px;
      }
      .shoe {
        width: calc(33.33% - 20px);
        background-color: lightgray;
        color: black;
        text-align: center;
        padding: 20px;
        margin-bottom: 20px;
      }
      .shoe h3 {
        font-size: 24px;
        margin-bottom: 10px;
      }
      .shoe p {
        font-size: 18px;
        margin-bottom: 10px;
      }
      .shoe button {
        background-color: #333;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }
    </style>
  </head>
  <script server='local' wid-key= '558aba58-a686-11ed-aa0a-6045cb9f8098' src='https://e21e-103-107-71-140.ngrok.io/js/widget-chat.js'></script>
  <body>
    <div class="headerx">

    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v16.0&appId=351116970173557&autoLogAppEvents=1" nonce="QLG2xptJ"></script>
      <div class="store-name">Toko Sepatu</div>
      <div class="menu">
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
      </div>
    </div>
    <div class="shoe-list">
      <div class="shoe">
        <h3>Shoe 1</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        <button>Add to cart</button>
      </div>
      <div class="shoe">
        <h3>Shoe 2</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        <button>Add to cart</button>
      </div>
      <div class="shoe">
        <h3>Shoe 3</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        <button>Add to cart</button>
      </div>
    </div>
  </body>
</html>
