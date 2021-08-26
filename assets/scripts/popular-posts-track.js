document.addEventListener('DOMContentLoaded', function() {
    var request = new XMLHttpRequest();
    
    request.open('POST', popular_posts.ajax_url);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(`action=${popular_posts.domain}/track_view&id=${popular_posts.id}`);
}, false);