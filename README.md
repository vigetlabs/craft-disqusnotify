# Disqus Notify

Craft plugin to notify authors when a comment is added via Disqus.

## Installation

1. Copy the `disqusnotify` folder to `craft/plugins`.
1. Navigation to the plugins page in the Craft control panel and install **Disqus Notify**.
1. Navigation to the plugin settings to customize the email subject and body.
1. Signup for a [Disqus](https://disqus.com/) account and configure for your site.
1. Utilize the Disqus `onNewComment` callback to make an AJAX request to the Disqus Notify plugin.

You need to pass the following pieces of data to the plugin:

1. Disqus Comment Text
1. Entry ID
1. Entry Author ID

The URL that you need to `POST` to is `{{ actionUrl("disqusNotify/notify/notify") }}`

Here is an example of the plugin in action utilizing jQuery:

```html
<script>
  var disqus_config = function () {
    this.page.identifier = '{{ entry.id }}';

    this.callbacks.onNewComment = [function(comment) {
      $.post('{{ actionUrl("disqusNotify/notify/notify") }}', {
        comment: comment.text,
        entryId: {{ entry.id }},
        authorId: {{ entry.author.id }}
      });
    }];
  };

  (function() {  // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');

    s.src = '//subdomain.disqus.com/embed.js';

    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
  })();
</script>
```

*Note: you will need to update your Disqus subdomain in this code snippet.*