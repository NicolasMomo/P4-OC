var chapter = document.getElementById('WrittingChap');
var comments = document.getElementById('adminComments');
var posts = document.getElementById('adminPosts');


document.getElementById('newChapter').addEventListener('click', function () {
    chapter.style.display = 'block';
    comments.style.display = 'none';
    posts.style.display = 'none';
});

document.getElementById('showComments').addEventListener('click', function () {
    chapter.style.display = 'none';
    comments.style.display = 'block';
    posts.style.display = 'none';
});

document.getElementById('showPosts').addEventListener('click', function () {
    chapter.style.display = 'none';
    comments.style.display = 'none';
    posts.style.display = 'block';
});
