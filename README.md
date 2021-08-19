# Popular posts
Enable view count on posts

# Usage
Posts views are tracked automatically. To set view manually, use:

```
set_post_view() // Current post
set_post_view($post_id) // Specific post 
```

To get post total views:

```
get_post_views(); // Current post
get_post_views($post_id); // Specific post 
```

To get most popular posts:

```
get_popular_posts($args); // Pass additional args to query
```
