<h2>Blog !</h2>
<h3>All Blog Posts</h3>
<section>
{foreach from=$bonjour item=post}
    <article class="post post{$post.id_blog_post}">
        <h4>{$post.title}</h4>
        <span>{$post.publication_date}</span>
        <p>{$post.body}</p>
    </article>
{/foreach}
</section>
