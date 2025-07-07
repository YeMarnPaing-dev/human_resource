const formTitle = document.getElementById('form-title');
const nameGroup = document.getElementById('name-group');
const toggleLink = document.getElementById('toggle-link');
const toggleMsg = document.getElementById('toggle-msg');
const form = document.getElementById('auth-form');

let isLogin = true;

toggleLink.addEventListener('click', () => {
  isLogin = !isLogin;
  if (isLogin) {
    formTitle.textContent = 'Login';
    nameGroup.style.display = 'none';
    toggleMsg.innerHTML = `Don't have an account? <a id="toggle-link">Register</a>`;
  } else {
    formTitle.textContent = 'Register';
    nameGroup.style.display = 'block';
    toggleMsg.innerHTML = `Already have an account? <a id="toggle-link">Login</a>`;
  }
  attachToggleEvent(); // re-attach event listener
});

function attachToggleEvent() {
  document.getElementById('toggle-link').addEventListener('click', () => {
    toggleLink.click();
  });
}
attachToggleEvent();

form.addEventListener('submit', (e) => {
  e.preventDefault();
  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value.trim();

  if (!email || !password || (!isLogin && !name)) {
    alert("Please fill in all required fields.");
    return;
  }

  if (isLogin) {
    alert(`Logged in as ${email}`);
  } else {
    alert(`Registered successfully as ${name}`);
  }

  form.reset();
});
