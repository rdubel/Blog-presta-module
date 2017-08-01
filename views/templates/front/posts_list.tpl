<h2>Blog !</h2>
<h3>All Blog Posts</h3>
<section class="blog-list">
{foreach from=$posts item=post}
    <a href="{$post.link}">
        <article class="blog-post">
            <h4>{$post.title}</h4>
            <span>{$post.publication_date|date_format}</span>
            <p>{$post.body|truncate:80:"...":true}</p>
        </article>
    </a>
{/foreach}
</section>
