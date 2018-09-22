@extends('layout.master')

@section('title','Gallery | Restro')

@section('main')
<style>
      *{
        padding: 0;
        margin: 0;
      }

      img, table, button, .navigation{
        user-select: none;
      }

      a{
        text-decoration: none;
        color: inherit;
      }

      body{
        font-family: "Roboto", Sans-serif;
      }

      .navigation{
        background-color: rgba(0,0,0,0.8);: 
        background: #1E2327;
        width: 100%;
        height: 80px;
        position: fixed;
        z-index: 10; 
      }

      .nav-left{
        float: left;
      }

      .nav-left img{
        width: 140px;
        height: 40px;
        margin: 15px;
      }

      .nav-right{
        float: right;
        padding: 28px;
      }

      

      .nav-right ul li{
        list-style: none;
        display: inline;
        float: left;
        padding-right: 30px;
      }

      .nav-right ul li a{
        padding: 10px;
        position: relative;
        text-decoration: none;
        color: white;
        font-family: "Roboto", Sans-serif;
        font-weight: bolder;
        transition: 0.5s ease;
      }

      .nav-right ul li a:after{
        position: absolute;
        content: "";
        width: 0;
        height: 3px;
        background: #DEDEDE;
        bottom: 0;
        left: 50%;
        transition: 0.3s ease;
      }

      .nav-right ul li a:hover:after{
        width: 100%;
        left: 0;
      }

      .mobile-nav-right{
        display: none;
      }

      .mobile-nav-right button{
        width: 100px;
        height: 40px;
        position: relative;
        margin: 15px;
        background: transparent;
        border: none;
        color: white; 
      }

      .mobile-nav-right .menu{
        z-index: 9;
        background: #1E2327;
        position: absolute;
        right: 0;
        padding: 15px;
        height: 100vh;
        list-style-type: none;
        color: white;
        font-size: 1.2em;
      }

      .mobile-nav-right .menu li{
        padding-top: 15px;
      }

      

      .container{
        
        background-image: url("galleryback.jpg");
        background-repeat: no-repeat;
        background-size: cover; 
        background-attachment: fixed;
        background-position: 100%;
        position: relative; 
        
      }

      .container .header h1{
        padding-top: 100px;
         color: white;
        text-align: center;
        word-spacing: 30px;
      }

      .image_gallery{
        padding: 20px 0;
        display: flex; 
        flex-wrap: wrap; 
         justify-content: space-around;
      }

      .image_gallery .image_container{
        position: relative; 
        width: 250px;
        height: 200px;
        margin-bottom: 20px;
        overflow: hidden;
       
      }

      .image_gallery .image_container img{
        width: 100%;
        height: 100%;
        transition: all 1s ease-out;
        filter: blur(0);
      }

      .image_container .inner{
        position: absolute;
        width: 253px;
        height: 203px;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: all 0.5s ease;
      }

      .image_container .inner p{
        display: none;
        color: white;
        font-size: 40px;
      }

      .image_container .inner:hover{
        background: rgba(10,10,10,0.6);
        cursor: zoom-in;
      }

      .image_container .inner:hover p{
        display: block;
      }

      .image_container:hover img{
        transform: scale(1.1);
      }

     #modal{
		text-align: center;
		vertical-align: middle;
		padding-top: 40px;
      display: none;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 999;
        background: rgba(10,10,10,.8);
        width: 100vw;
        height: 100vh;
      }

      #modal span{
        position: absolute;
        right: 50px;
        top: 20px;
      }

      #modal span:hover{
        cursor: pointer;
      }

      #modal img{
		width: 80%;
		height: auto;
		max-height: 95%;
		margin: 0 auto;
		text-align: center;
      }
    

    
    

    @media screen and (max-width: 1100px){
      .div1{
        flex-flow: column !important;
      }
    }

    @media screen and (max-width: 800px){
      .nav-right{
        font-size: 0.6em;
        display: none;
      }

      .mobile-nav-right{
        display: block;
        float: right;
      }

    }




      

    /*Footer*/

   .footer{
  background-image: url(footer.jpg);
}

.foot{
  color: white;
  display: flex;
  width: 100%;
  justify-content: space-between;
  padding: 20px 0;
}

.footer .foot h3{
  color: #3a5b75;
  margin-top: 10px;
}

.footer .foot p{
  padding-top: 10px;
}

.footer .social i{
  font-size: 35px;
  margin: 15px;
}


.footer .lintend{
  padding: 20px;
}

.footer .lintend p{
  color: #595959;
}

      
    </style>
    
</head>
<body>

<!-- Navigation -->


<div class="gallery_container">    
<div class="header">
<h1 style="text-align: center; padding: 5px 0; color: white;">PHOTO GALLERY</h1>
</div>
<div class="image_gallery">

<!-- Overlay -->

<div id="modal">
  <span class="close" style="color: white; font-size: 40px;" onclick="dontoverlay()">&times;</span>
  <img src="" id="big">
</div>
<!-- Overlay Exit -->
<div id="modal">
  <span class="close" style="color: white; font-size: 40px;" onclick="dontoverlay()">&times;</span>
  <img src="" id="big">
</div>

@foreach($photos as $photo)
	<div class="image_container" onclick="overlay(this.children[0].src)">
		<img src="{{ asset('images/gallery/'.$photo->url) }}">
		<div class="inner"><p>+</p></div> 
	</div>
@endforeach

</div> 

<script>
	var myModal = document.getElementById("modal");
   
    function overlay(bigImage) {
      document.getElementById("big").src = bigImage;
      myModal.style.display = "block";
    }

    function dontoverlay() {
      myModal.style.display = "none";
    }
</script>

@endsection
