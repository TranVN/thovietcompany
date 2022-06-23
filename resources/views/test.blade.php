<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" integrity="sha512-Mo79lrQ4UecW8OCcRUZzf0ntfMNgpOFR46Acj2ZtWO8vKhBvD79VCp3VOKSzk6TovLg5evL3Xi3u475Q/jMu4g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Laravel Image Upload</title>
    <style>
svg{fill: #000000}       
.sticky-menu-container{
  position: fixed;
  left: 60px;
  bottom: 60px;
  display: flex;
  z-index: 1;
  align-items: center;
  justify-content: center;
}

.sticky-menu-container .outer-button{
  position: absolute;
  height: 60px;
  width: 60px;
  border-radius: 50%;
  background: rgb(230, 255, 2);
  background: -moz-linear-gradient(135deg, rgb(255 211 0) 0%, rgb(223 155 4) 100%);
  background: -webkit-linear-gradient(135deg, rgb(255 211 0) 0%, rgb(223 155 4) 100%);
  background: linear-gradient(135deg, rgb(255 211 0) 0%, rgb(223 155 4) 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 10px 10px 18px 5px rgba(0,0,0,0.2);
  cursor: pointer;
}
.sticky-menu-container .outer-button .icon-container{
  height: inherit;
  width: inherit;
  border-radius: inherit;
  display: inherit;
  align-items: inherit;
  justify-content: inherit;
  overflow: hidden;
  position: relative;
  cursor: inherit;
}
.sticky-menu-container .outer-button .close-icon{
  transform: scale(0) rotate(-270deg);
  opacity: 0;
  height: 25px;
  width: 25px;
  position: absolute;
  fill: #000000;
}

.sticky-menu-container .outer-button .arrow-icon{
  height: 25px;
  width: 25px;
  position: absolute;
  fill: #ffffff;
}

.sticky-menu-container .outer-button .arrow-icon.hiding-spot{
transform: translateX(60px / -2) translateY(calc(60px) / 2);
  opacity: 0;
}

.sticky-menu-container .outer-button .close-icon.show{
  animation-duration: 1000ms;
  animation-name: close-in;
  animation-fill-mode: forwards;
  animation-timing-function: cubic-bezier(0.86, 0, 0.07, 1); 
}

.sticky-menu-container .outer-button .close-icon.hide{
  animation-duration: 1000ms;
  animation-name: close-out;
  animation-timing-function: cubic-bezier(0.86, 0, 0.07, 1); 
}

.sticky-menu-container .outer-button .arrow-icon.show{
  opacity: 0;
  animation-duration: 1000ms;
  animation-name: arrow-in;
  animation-fill-mode: forwards;
  animation-timing-function:cubic-bezier(0.86, 0, 0.07, 1); 
/*   animation-delay: 250ms; */
}

.sticky-menu-container .outer-button .arrow-icon.hide{
  animation-duration: 1000ms;
  animation-name: arrow-out;
  animation-fill-mode: forwards;
  animation-timing-function: cubic-bezier(0.86, 0, 0.07, 1); 
}

.sticky-menu-container .outer-button::after, sticky-menu-container.outer-button::before{
  position: absolute;
  display: inline-block;
  content: "";
  height: 120px;
  width: 120px;
  border-radius: 50%;
  background-color:transparent;
  border: 0px solid rgba(255,255,255,0.5);
  opcacity: 0;
  cursor: pointer;
}

.sticky-menu-container .outer-button.clicked::after{
  animation-duration: 500ms;
  animation-name: touch-click-inner;
  animation-iteration-count: 1;
  animation-fill-mode: forwards;
}

.sticky-menu-container .outer-button::before{
  height: 120px;
  width: 100px;
}

.sticky-menu-container .outer-button.clicked::before{
  animation-name: touch-click-outer;
  animation-duration: 500ms;
  animation-iteration-count: 1;
  animation-delay: 250ms;
}

.sticky-menu-container .inner-menu{
  position: absolute;
  height: 255px;
  width: 300px;
  border-radius: 10px;
  background-color: #ffffff; 

  transform: translateX(128px) translateY(-169px);
  transition: all 1000ms cubic-bezier(0.86, 0, 0.07, 1);

  padding:15px;
  overflow: hidden;
  box-shadow: 10px 10px 18px 5px rgba(0,0,0,0.4);
}

.sticky-menu-container .inner-menu > ul{
  height: 100%;
  list-style: none;
  display: flex;
  flex-wrap: wrap;
  align-content: space-between;
  margin: 0;
  padding: 0;
}

.sticky-menu-container .inner-menu > .menu-list > .menu-item{
  color: #000000;
  text-transform: uppercase;
  font-weight: 600;
  letter-spacing: 1px;
  width: 100%;
  display: flex;
  align-items: center;
}

.sticky-menu-container .inner-menu > .menu-list > .menu-item{
  overflow: hidden;
}

.sticky-menu-container .inner-menu > .menu-list > .menu-item > .item-icon{
  margin-right: 20px; 
  display: flex;
  align-items: center;
  justify-content: center;
}

.sticky-menu-container .inner-menu > .menu-list > .menu-item > .item-icon > svg{
  height: 30px;
  width: 30px;
}

.sticky-menu-container .inner-menu.closed{
  height: 58px;
  width: 58px;
  border-radius: 50%;
  padding:0;
  transform: unset;
}

.sticky-menu-container .inner-menu > .menu-list > .menu-item > .item-text{
  opacity: 0;  
}

.sticky-menu-container .inner-menu > .menu-list > .menu-item > .item-text.text-in{
  animation-duration: 1500ms;
  animation-name: text-in;
  animation-fill-mode: forwards;
  animation-timing-function: cubic-bezier(0.86, 0, 0.07, 1);
}

.sticky-menu-container .inner-menu > .menu-list > .menu-item.text-hides{
  animation-duration: 200ms;
  animation-name: text-hides;
  animation-fill-mode: forwards;
  animation-timing-function:cubic-bezier(0.86, 0, 0.07, 1);
}

@keyframes touch-click-inner {
  50%{ 
      transform: scale(0.375);
      border-width: 30px;
      opacity: 1;
  }
  100%{ 
      transform: scale(1);
      border-width: 1px;
      opacity: 0;
  }
}

@keyframes touch-click-outer {
  0%{
    border-width: 10px;
    opacity: 0;
  }
  50%{
    opacity: 0.2;
  }
  100%{ 
      transform: scale(1.1);
      opacity: 0;
  }
}

@keyframes close-in{
  0%{
    transform: transform: scale(0) rotate(270deg);
    opacity: 0;
  }
  100% {
    transform: scale(1.1) rotate(0deg);
    opacity: 1;
  }
}

@keyframes close-out{
  0%{
    transform: scale(1.1) rotate(0deg);
    opacity: 1;
  }
  100% {
    transform: scale(0) rotate(270deg);
    opacity: 0;
  }
}

@keyframes arrow-out{
  0%{
    transform: translateX(0) translateY(0);
  }
  100%{
    transform: translateX(calc(60px/ 1.5)) translateY(calc(60pc / -1.5));
  }
}

@keyframes arrow-in{
  0%{
    transform: translateX(calc( -1 * 60px)) translateY(60px);
    opacity: 0;
  }
  100%{
    transform: translateX(0) translateY(0);
    opacity: 1;
  }
}

@keyframes text-in{
  0%{
    opcaity: 1;
    transform: translateY(50px);
  }
  100%{
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes text-hides{
  0%{
    opacity: 1;
  }
  100%{
    opacity: 0;
  }
}
.icon-title{
    font-family: -webkit-body;
    font-weight: 800;
    position: absolute;
    bottom: 95px;
    left: 25px;
    background-color: antiquewhite;
    border-radius: 10px;
    padding: 10px;
    box-shadow: 10px 10px 18px 5px rgb(0 0 0 / 40%);
}

    </style>
    <div class="sticky-menu-container">
        <div class="inner-menu closed">
          <ul class="menu-list">
            
                <li class="menu-item" onclick="location.href='tel:0903532938'">
                <span class="item-icon">
                    <img src="https://thoviet.com.vn/wp-content/uploads/2022/06/telephone-call.png" width="40px"/>
                </span>
                <span class="item-text ">Tổng đài: 0903.532.938 </span>
                </li>
            
            <li class="menu-item" onclick="zaloClick()">
              <span class="item-icon">
                <img src=" https://thoviet.com.vn/wp-content/uploads/2020/03/zalo.svg" width="40px"/>
              </span>
              <span class="item-text">Chat Zalo OA</span>
            </li>
            <li class="menu-item" onclick="fbClick()">
                <span class="item-icon">
                <img src=" https://thoviet.com.vn/wp-content/uploads/2021/06/fbicon.jpg" width="40px"/>
                
              </span>
              <span class="item-text">FanPage Thợ Việt</span></li>
            <li class="menu-item">
              <span class="item-icon" onclick="datlichClick()">
                <img src="https://thoviet.com.vn/wp-content/uploads/2022/06/google-forms.png" width="40px"/>
              </span>
              <span class="item-text">Đặt Hẹn Nhanh</span>
            </li>
          </ul>
        </div>
        <div class="outer-button">
            
            <div class="icon-container">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 92 92" enable-background="new 0 0 92 92" xml:space="preserve" class="close-icon">
                <path id="XMLID_732_" d="M70.7,64.3c1.8,1.8,1.8,4.6,0,6.4c-0.9,0.9-2,1.3-3.2,1.3c-1.2,0-2.3-0.4-3.2-1.3L46,52.4L27.7,70.7
                    c-0.9,0.9-2,1.3-3.2,1.3s-2.3-0.4-3.2-1.3c-1.8-1.8-1.8-4.6,0-6.4L39.6,46L21.3,27.7c-1.8-1.8-1.8-4.6,0-6.4c1.8-1.8,4.6-1.8,6.4,0
                    L46,39.6l18.3-18.3c1.8-1.8,4.6-1.8,6.4,0c1.8,1.8,1.8,4.6,0,6.4L52.4,46L70.7,64.3z"/>
                </svg>
                <img src='https://thoviet.com.vn/wp-content/uploads/2022/06/chat.png' width= '40px' alt="" class="arrow-icon">
                    
            </div>
            
        </div>
       
      </div>
      <div class="icon-title" style="visibility: hidden">
        <h4>Tư Vấn Ngay</h3>
      </div>
      
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      
    var isAnimating = false;
    var isOpen = false;
    var button = document.querySelector(".sticky-menu-container .outer-button");
    var menu = document.querySelector(".sticky-menu-container .inner-menu");
    var closeIcon = document.querySelector(".sticky-menu-container .outer-button .close-icon");
    var arrowIcon = document.querySelector(".sticky-menu-container .outer-button .arrow-icon");
    var menuItems = document.querySelectorAll(".sticky-menu-container .inner-menu > .menu-list > .menu-item");
    var iconTitle = document.querySelector(".icon-title");

    var itemTexts = document.querySelectorAll(".sticky-menu-container .inner-menu > .menu-list > .menu-item > .item-text");

    button.addEventListener("click", function(){
    if(isAnimating) return;
    this.classList.add("clicked");
    menu.classList.toggle("closed");
    // $('.icon-title').show();
    
    
    if(isOpen){
        closeIcon.classList.remove("show");
        closeIcon.classList.add("hide");
        arrowIcon.classList.remove("hide");
        arrowIcon.classList.add("show");
        
        menuItems.forEach(function(item){
        
        item.classList.add("text-hides");
        });
        itemTexts.forEach(function(text, index){
            setTimeout(function(){
            text.classList.remove("text-in");
            });
        });
        isOpen = false;
    }
    else{
        closeIcon.classList.remove("hide");
        closeIcon.classList.add("show");
        arrowIcon.classList.remove("show");
        arrowIcon.classList.add("hide");
        menuItems.forEach(function(item){
       
        item.classList.remove("text-hides");
        });
        itemTexts.forEach(function(text, index){
            setTimeout(function(){
            text.classList.add("text-in");
            }, index*150);
        });
        isOpen = true;
    } 
    
    });

    button.addEventListener("animationstart", function(event){
    isAnimating = true;
    });

    button.addEventListener("animationend", function(event){
    isAnimating = false;
    this.classList.remove("clicked");
    });
    function zaloClick(){
        window.open("https://zalo.me/4057302937133616659",'_blank');
    }
    function datlichClick(){
        window.open("https://thoviet.com.vn/dat-dich-vu-nhanh-chong",'_blank');
    }
    function fbClick(){
        window.open("https://m.me/thoviet.com.vn.vietnam/",'_blank');
    }
    function timeFunction() {
      $('.icon-title').css('visibility','show');
    }
    // $(ready(function() {
      setTimeout(timeFunction,5000); 
    // }));
    jQuery(document).ready(function($){

      // Code goes here
      

      });
    </script>
</body>
</html>