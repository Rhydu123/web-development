function displayWelcomeMessage() {
    alert("Hello, welcome to my page!");
}
document.getElementById('profile-pic').addEventListener('mouseover', function() {
    document.body.style.backgroundColor = '	#AFEEEE';
});

document.getElementById('profile-pic').addEventListener('mouseout', function() {
    document.body.style.backgroundColor = '#f0f8ff';
});
