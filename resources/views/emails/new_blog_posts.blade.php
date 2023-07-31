<!-- resources/views/emails/new_blog_posts.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>New Blog Posts</title>
</head>
<body>
<h1>New Blog Posts Added Today</h1>
<ul>
    @foreach ($blogPosts as $blogPost)
        <li>
            <a href="{{ route('blog.show', $blogPost->id) }}">{{ $blogPost->title }}</a>
        </li>
    @endforeach
</ul>
</body>
</html>
